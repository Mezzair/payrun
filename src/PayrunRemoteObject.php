<?php

namespace Appoly\Payrun;

use Appoly\Payrun\HttpClient\PayrunRequest;
use Appoly\Payrun\Requests\PayRunHttpClient;

class PayrunRemoteObject
{
    protected $client;
    protected $request;

    public function __construct($client = null)
    {
        $this->client = $client ?? new PayRunHttpClient();
        $this->request = new PayrunRequest($this->client);
    }
}
