<?php

namespace Appoly\Payrun\HttpClient;

use Appoly\Payrun\Requests\PayRunHttpClient;

class PayrunRequestBatch
{
    private $instructions;

    public function __construct($data = null)
    {
        $this->instructions = [];
    }

    public function addRequest($request)
    {
        $this->instructions[] = [
            $request['method'] => [
                "@Href" => $request['url'],
                "Body" => $request['data'],
            ]
        ];
        return $this->instructions;
    }
}
