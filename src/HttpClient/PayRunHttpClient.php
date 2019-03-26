<?php

namespace Appoly\Payrun\HttpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\Exception\ClientException;

class PayRunHttpClient {

	public function __construct()
	{	
		$this->consumer_key = config(['consumer_key' => '']);
		$this->consumer_secret = config(['consumer_secret' => '']);
		$this->signature_method = 'HMAC-SHA1';
		$this->api_url = "https://api.test.payrun.io/";
	}

	public function call()
	{
		$stack = HandlerStack::create();
		$middleware = new Oauth1(
			[
				'consumer_key' => $this->consumer_key,
				'consumer_secret' => $this->consumer_secret,
				'token_secret' => '',
				'signature_method'=> $this->signature_method
			]
		);
			
		$stack->push($middleware);
			
		$client = new Client([
			'base_uri' => $this->api_url,
			'handler' => $stack
		]);

		dd($client);
	}

}