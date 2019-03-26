<?php

namespace Appoly\Payrun;

use Appoly\Payrun\HttpClient\PayRunHttpClient;

class Payrun
{
    public function test()
    {
    	return 'Hello World';
    }

    public function testCall()
    {
    	$client = new PayRunHttpClient();
    	return $client->call();
    }
}
