<?php

namespace Appoly\Payrun\HttpClient;

use Appoly\Payrun\Requests\PayRunHttpClient;

class PayrunRequest
{
    public $method;
    public $url;
    public $data;
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    private function send() {
        $request = [
            'url' => $this->url,
            'method' => $this->method,
            'data' => $this->data,
        ];
        if($this->client->batch) {
            return $this->client->batch->addRequest($request);
        }
        return $this->client->call($request);
    }

    public function get() {
        $this->method = "GET";
        return $this->send();
    }

    public function post($data) {
        $this->method = "POST";
        $this->data = $data;
        return $this->send();
    }

    public function patch($data) {
        $this->method = "PATCH";
        $this->data = $data;
        return $this->send();
    }

    public function delete() {
        $this->method = "DELETE";
        return $this->send();
    }

}
