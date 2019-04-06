<?php

namespace Appoly\Payrun;

use Appoly\Payrun\HttpClient\PayRunHttpClient;

class PayrunRequest
{
    public $method;
    public $url;
    public $data;

    public function __construct($data = null)
    {
        $this->payRunObject = new PayRunHttpClient();
        $this->data = $data;
    }

    /**
     * @throws \Exception
     */
    public function send() {
        $request = [
            'url' => $this->url,
            'method' => $this->method,
            'data' => $this->data,
        ];
        return $this->payRunObject->call($request);
    }
}
