<?php

namespace Appoly\Payrun\HttpClient;
use Config;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\Exception\ClientException;

class PayRunHttpClient {

	public function __construct()
	{	
<<<<<<< HEAD

		
		// $this->consumer_key = config(['consumer_key' => 'pkqrauIwZUqLw1relB6ZEw']);
		// $this->consumer_secret = config(['consumer_secret' => 'ADc8UJZX1EVTV0JVvvANQT2oN5KSUO2evjdyGFiAw']);
			
		$this->consumer_key = 'pkqrauIwZUqLw1relB6ZEw';
		$this->consumer_secret = 'ADc8UJZX1EVTV0JVvvANQT2oN5KSUO2evjdyGFiAw';

=======
		$this->consumer_key = config(['consumer_key' => '']);
		$this->consumer_secret = config(['consumer_secret' => '']);
>>>>>>> 337f32d656c058a0acca349dfa2e3a35b4f53e3c
		$this->signature_method = 'HMAC-SHA1';
		$this->api_url = "https://api.test.payrun.io/";
	}

	/**
	* call
	*Call payroll API and collect response
	*@param $data is Params to pass in API Via (GET,POST,DELETE,PUT)
	*@param $response returns Response of Payrun.io
    */
	public function call($data)
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

		

		// Set the "auth" request option to "oauth" to sign using oauth
		switch($data['method']){
			case 'GET':

			$response = $client->get($data['url'], [
				'auth' => 'oauth',
				'headers' => [
					'Accept'     => 'application/json',
					]
				]
			);
		  break;
			case 'POST':
			
				$response = $client->post($data['url'], [
					'auth' => 'oauth',
					'headers' => [
						'Accept'     => 'application/json',
						'Content-type' => 'application/json',
						'Api-Version'=>"Default"
					],
					'json'=>$data['data']
					]
				);
			break;
			
		   default;
		   die('Request not found');


		}
		

		$body = (string) $response->getBody();
		return  json_decode($body);
	}

}