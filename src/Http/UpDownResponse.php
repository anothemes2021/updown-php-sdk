<?php
/**
 * Copyright (c) 2019 - present
 * updown - UpDownResponse.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Http;

use Biscolab\UpDown\Exception\ResponseException;
use GuzzleHttp\Psr7\Response;

/**
 * Class UpDownResponse
 * @package Biscolab\UpDown\Http
 */
class UpDownResponse
{

    /**
     * @var Response
     */
    protected $response = null;

    /**
     * @var UpDownResult
     */
    protected $result = null;

    /**
     * @var string
     */
    protected $status = null;

    /**
     * @var string
     */
    protected $error_message = null;

    /**
     * @var array
     */
    protected $array_response = null;

    /**
     * @var int
     */
    protected $http_status_code = null;

    /**
     * UpDownResponse constructor.
     *
     * @param Response $response
     */
    public function __construct(Response $response)
    {

        $this->setResponse($response);

        $this->parseResponse();

        $this->checkHttpStatusCode();
    }

    /**
     * @param Response $response
     *
     * @return UpDownResponse
     */
    public function setResponse(Response $response): UpDownResponse
    {

        $this->response = $response;

        return $this;
    }

    /**
     * @return UpDownResponse
     *
     * @throws ResponseException
     */
    protected function parseResponse(): UpDownResponse
    {

        $json_response = $this->response->getBody()->getContents();
        $array_response = $this->toArray($json_response);

        $this->detectError($array_response);

        $this->setResult(new UpDownResult($array_response));

        return $this;
    }

    /**
     * @param string $json_response
     *
     * @return array
     */
    public function toArray(string $json_response): array
    {

        $this->array_response = json_decode($json_response, true);

        return $this->array_response;
    }

    /**
     * @param array|null $array_response
     *
     * @throws ResponseException
     */
    protected function detectError(?array $array_response = null)
    {

        if (is_null($array_response)) {
            throw new ResponseException('Missing "results" in UpDownApi Response');
        }

        if (!empty($array_response['error'])) {
            $this->setErrorMessage($array_response['error']);
            throw new ResponseException($array_response['error']);
        }

    }

    /**
     * Check HTTP status code (silent/No exceptions!)
     * @return int
     */
    protected function checkHttpStatusCode(): int
    {

        $this->http_status_code = $this->response->getStatusCode();

        return $this->http_status_code;
    }

    /**
     * @return UpDownResult
     */
    public function getResult()
    {

        return $this->result;
    }

    /**
     * @param UpDownResult $result
     *
     * @return UpDownResponse
     */
    public function setResult(UpDownResult $result): UpDownResponse
    {

        $this->result = $result;

        return $this;
    }

    /**
     * @return array
     */
    public function getArrayResponse(): array
    {

        return $this->array_response;
    }

    /**
     * @param array $array_response
     *
     * @return UpDownResponse
     */
    public function setArrayResponse(array $array_response): UpDownResponse
    {

        $this->array_response = $array_response;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {

        return $this->error_message;
    }

    /**
     * @param $error_message
     *
     * @return UpDownResponse
     */
    public function setErrorMessage($error_message): UpDownResponse
    {

        $this->error_message = $error_message;

        return $this;
    }

    /**
     * @return int
     */
    public function getHttpStatusCode(): int
    {

        return intval($this->http_status_code);
    }

}