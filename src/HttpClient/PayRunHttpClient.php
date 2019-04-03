<?php
namespace Appoly\Payrun\HttpClient;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
class PayRunHttpClient {
    public function __construct() {
        $this->consumer_key = env('PAYRUN_CONSUMER_KEY');
        $this->consumer_secret = env('PAYRUN_CONSUMER_SECRET');
        $this->signature_method = 'HMAC-SHA1';
        $this->api_url = "https://api.test.payrun.io/";
    }
    /**
     * call
     *Call payroll API and collect response
     *@param $data is Params to pass in API Via (GET,POST,DELETE,PUT)
     *@param $response returns Response of Payrun.io
     */
    public function call($data) {
        $stack = HandlerStack::create();
        
        $middleware = new Oauth1(['consumer_key' => $this->consumer_key, 'consumer_secret' => $this->consumer_secret, 'token_secret' => '', 'signature_method' => $this->signature_method]);
        $stack->push($middleware);
        $client = new Client(['base_uri' => $this->api_url, 'handler' => $stack]);
        // Set the "auth" request option to "oauth" to sign using oauth
        switch ($data['method']) {
            case 'GET':
                try {
                    
                    $response = $client->get($data['url'],
                    	['auth' => 'oauth', 
                    	'headers' => ['Accept' => 'application/json', ]]
                    );
                }
                catch(RequestException $e) {

                    $response = $e->getResponse();
                    $responseBodyAsString = $response->getBody()->getContents();
                    throw new \Exception($responseBodyAsString);
                }
                catch(\GuzzleHttp\Exception\ConnectException $e) {
                    $responseBodyAsString = $e->getResponse()->getContents();
                    throw new \Exception($responseBodyAsString);
                }
                catch(\GuzzleHttp\Exception\ClientException $e) {
                    $responseBodyAsString = $e->getResponse()->getContents();
                    throw new \Exception($responseBodyAsString);
                }
            break;
            case 'POST':
                try {
                    $response = $client->post($data['url'], 
                    	['auth' => 'oauth', 
                    	 'headers' => ['Accept' => 'application/json', 'Content-type' => 'application/json', 'Api-Version' => "Default"],
                    	 'json' => $data['data']]);
                }
                catch(RequestException $e) {
                    $response = $e->getResponse();
                    $responseBodyAsString = $response->getBody()->getContents();
                    
        			throw new \Exception($responseBodyAsString);

                }
                catch(\GuzzleHttp\Exception\ConnectException $e) {
                    $responseBodyAsString = $e->getResponse()->getContents();
                    throw new \Exception($responseBodyAsString);
                }
                catch(\GuzzleHttp\Exception\ClientException $e) {
                    $responseBodyAsString = $e->getResponse()->getContents();
                    throw new \Exception($responseBodyAsString);
                }
            break;
            default;
            die('Request not found');
    }
    $body = (string)$response->getBody();
    $response = json_decode($body);
    $rr = (array)$response->Link;
    $string = $rr['@href'];
    $response1 = explode('/', $string);
    return end($response1);
}
}
