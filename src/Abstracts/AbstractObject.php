<?php
/**
 * Copyright (c) 2019 - present
 * updown - AbstractObject.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Abstracts;

use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Exception\Exception;
use Biscolab\UpDown\UpDown;
use function Biscolab\UpDown\camel2Snake;

/**
 * Class AbstractObject
 * @package Biscolab\UpDown\Abstracts
 */
abstract class AbstractObject
{

    /**
     * @var array
     */
    protected $typeCheck = [];

    /**
     * @var array
     */
    protected $required = [];

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var null|UpDown
     */
    protected $updown = null;

    /**
     * AbstractObject constructor.
     *
     * @param array $args
     */
    public function __construct($args = [])
    {

        $this->setUpDown();
        $this->setArgs($args);
    }

    /**
     * Set UpDown instance
     */
    protected function setUpDown()
    {

        $this->updown = static::getUpDownInstance(UpDown::instance());

    }

    /**
     * @param UpDown|null $instance
     *
     * @return UpDown
     * @throws Exception
     */
    protected static function getUpDownInstance(UpDown $instance = null): UpDown
    {

        if (!$instance instanceof UpDown) {
            throw new Exception('Invalid UpDown instance');
        }

        return $instance;

    }

    /**
     * @param array|null $args
     *
     * @return AbstractObject
     */
    protected function setArgs(?array $args = []): AbstractObject
    {

        if (is_null($args)) {
            $args = [];
        }

        foreach ($this->typeCheck as $field_name => $field_type) {
            if (empty($args[$field_name]) || is_null($args[$field_name])) {
                if ($this->isFieldRequired($field_name)) {
                    $this->addError('Missing "' . $field_name . '" in ' . static::class);
                }
            } else {
                $this->attributes[$field_name] = $this->parseFieldValue($field_type, $args[$field_name]);
            }
        }
        $this->throwErrors();

        return $this;
    }

    /**
     * @param string $field_name
     *
     * @return bool
     */
    protected function isFieldRequired(string $field_name): bool
    {

        return in_array($field_name, $this->required);
    }

    /**
     * @param string $error
     *
     * @return array
     */
    protected function addError(string $error): array
    {

        array_push($this->errors, $error);

        return $this->errors;
    }

    /**
     * @param string $field_type
     * @param string $field_value
     *
     * @return mixed
     */
    protected function parseFieldValue(string $field_type, $field_value)
    {

        switch ($field_type) {
            case UpDownFieldType::STRING:
            case UpDownFieldType::INT:
            case UpDownFieldType::FLOAT:
            case UpDownFieldType::ARRAY:
            case UpDownFieldType::BOOL:
                return $field_value;
            case UpDownFieldType::DATETIME:
                return strtotime($field_value);
            default:
                return ($field_value instanceof $field_type) ? $field_value : new $field_type($field_value);
        }
    }

    /**
     * @throws Exception
     */
    protected function throwErrors()
    {

        if (count($this->errors)) {
            throw new Exception(implode(', ', $this->errors));
        }
    }

    /**
     * @param array|null $args
     *
     * @return AbstractObject
     */
    public function setData(?array $args = []): AbstractObject
    {

        return $this->setArgs($args);
    }

    /**
     * @return string
     */
    public function toJson(): string
    {

        return json_encode($this->toArray());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {

        $fields = $this->attributes;

        foreach ($fields as $field_name => $field_value) {

            if (!is_scalar($field_value) && method_exists($field_value, 'toJson')) {
                $fields[$field_name] = $field_value->toArray();
            }
        }

        return $fields;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {

        return implode(',', $this->toArray());
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {

        preg_match('/(?<=(g|s)et)([A-Za-z0-9])\w+/', $name, $match);

        $camel_field = (empty($match[0])) ? '' : $match[0];

        $snake_field = ($camel_field) ? camel2Snake($camel_field) : $name;

        if (!empty($match[1])) {
            switch ($match[1]) {
                case 's':
                    return $this->__set($snake_field, current($arguments));
                case 'g':
                    return $this->__get($snake_field);
            }
        }

    }

    /**
     * @param string $snake_field
     *
     * @return mixed|null
     * @throws Exception
     */
    public function __get(string $snake_field)
    {

        $field_type = $this->getPropertyType($snake_field);
        if (!$field_type) {
            throw new Exception('property ' . $snake_field . ' doesn’t exist');
        }

        return (empty($this->attributes[$snake_field])) ? null : $this->attributes[$snake_field];

    }

    /**
     * @param string $snake_field
     * @param        $value
     *
     * @return mixed
     */
    public function __set(string $snake_field, $value)
    {

        $field_type = $this->getPropertyType($snake_field);

        return $this->attributes[$snake_field] = $this->parseFieldValue($field_type, $value);

    }

    /**
     * @param string $snake_field
     *
     * @return null|string
     */
    protected function getPropertyType(string $snake_field): ?string
    {

        return (empty($this->typeCheck[$snake_field])) ? null : $this->typeCheck[$snake_field];
    }

    /**
     * @return string
     */
    public function getClassName()
    {

        return get_called_class();
    }

    /**
     * @return mixed
     */
    public function getCleanClassName()
    {

        return str_replace($this->getNamespace() . '\\', '', get_called_class());
    }

    /**
     * @return string
     */
    public function getNamespace()
    {

        return __NAMESPACE__;
    }

}