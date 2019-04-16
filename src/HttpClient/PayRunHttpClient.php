<?php

namespace Appoly\Payrun\Requests;

use Appoly\Payrun\HttpClient\PayrunRequestBatch;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class PayRunHttpClient
{
    private $consumer_key, $consumer_secret, $signature_method, $api_url;
    public $batch;
    public $response_type;

    public function __construct()
    {
        $this->consumer_key = env('PAYRUN_CONSUMER_KEY');
        $this->consumer_secret = env('PAYRUN_CONSUMER_SECRET');
        $this->signature_method = 'HMAC-SHA1';
        $this->api_url = "https://api.test.payrun.io/";
        $this->response_type = "JSON";
    }

    /**
     * Call payroll API and collect response
     * @param $data array - is Params to pass in API Via (GET,POST,DELETE,PUT)
     * @return mixed - returns Response of Payrun.io
     * @throws \Exception
     */
    public function call($data)
    {
        $client = $this->getGuzzleClient();

        // Set the "auth" request option to "oauth" to sign using oauth
        switch ($data[ 'method' ]) {
            case 'GET':
                try {
                    $response = $client->get($this->api_url . $data[ 'url' ], [
                        'auth' => 'oauth',
                        'headers' => [
                            'Accept' => 'application/json',
                            // 'Accept' => 'application/xml', Needed for payslip pdf
                            // 'Content-type' => 'application/xml',
                        ]
                    ]);
                } catch (RequestException $e) {

                    $response = $e->getResponse();
                    $responseBodyAsString = $response->getBody()->getContents();
                    throw new \Exception($responseBodyAsString);
                } catch (\GuzzleHttp\Exception\ConnectException $e) {
                    $responseBodyAsString = $e->getResponse()->getContents();
                    throw new \Exception($responseBodyAsString);
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    $responseBodyAsString = $e->getResponse()->getContents();
                    throw new \Exception($responseBodyAsString);
                }
                break;
            case 'POST':
                try {
                    $response = $client->post($data[ 'url' ], [
                        'auth' => 'oauth',
                        'headers' => [
                            'Accept' => $this->response_type == 'file' ? 'application/xml' : 'application/json',
                            //'Accept' => 'application/xml',
                            'Content-type' => 'application/json',
                            'Api-Version' => "Default"
                        ],
                        'json' => $data[ 'data' ]
                    ]);
                } catch (RequestException $e) {
                    $response = $e->getResponse();
                    $responseBodyAsString = $response->getBody()->getContents();

                    throw new \Exception($responseBodyAsString);

                } catch (\GuzzleHttp\Exception\ConnectException $e) {
                    $responseBodyAsString = $e->getResponse()->getContents();
                    throw new \Exception($responseBodyAsString);
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    $responseBodyAsString = $e->getResponse()->getContents();
                    throw new \Exception($responseBodyAsString);
                }
                break;
            default;
                die('Request not found');
        }


        // dd($response->getBody());

        //
        // In most cases we only need the ID of the object being actioned.
        // Allow for multiple response types for PDF etc.
        //
        switch ($this->response_type) {
            case "file":
                return $response->getBody();

            case "uuid":
                $body = (string) $response->getBody();
                $response = json_decode($body);
                $rr = (array) $response->Link;
                $string = $rr[ '@href' ];
                $response1 = preg_match('/\w{8}-\w{4}-\w{4}-\w{4}-\w{12}/', $string, $matches);
                return $matches[0];

            case "JSON":
            default:
                $body = (string) $response->getBody();
                $response = json_decode($body);
                $rr = (array) $response->Link;
                $string = $rr[ '@href' ];
                $response1 = explode('/', $string);
                return end($response1);
        }

    }

    public function startBatch()
    {
        $this->batch = new PayrunRequestBatch();
    }

    public function executeBatch($validate_only = false)
    {
        $client = $this->getGuzzleClient();
        $instructions = $this->batch->getInstructions();

        $response = $client->post($this->api_url . '/jobs/batch', [
            'auth' => 'oauth',
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
                'Api-Version' => "Default"
            ],
            'json' => [
                "BatchJobInstruction" => [
                    "HoldingDate" => null,
                    "ValidateOnly" => $validate_only,
                    "Instructions" => $instructions
                ]
            ]
        ]);

        $this->batch = null;
        return $response;
    }

    public function getGuzzleClient()
    {
        $stack = HandlerStack::create();
        $middleware = new Oauth1([
            'consumer_key' => $this->consumer_key,
            'consumer_secret' => $this->consumer_secret,
            'token_secret' => '',
            'signature_method' => $this->signature_method
        ]);
        $stack->push($middleware);

        $client = new Client([
            'base_uri' => $this->api_url,
            'handler' => $stack
        ]);
        return $client;
    }
}
