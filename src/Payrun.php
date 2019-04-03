<?php

namespace Appoly\Payrun;

use Appoly\Payrun\HttpClient\PayRunHttpClient;

class Payrun
{
	   public function __construct(){
			$this->payRunObject = new PayRunHttpClient();
	   }

	/**
	* create
	*This method create an employer in payrun.io 
	*@param $data is the incomming data , the data has all the post params
	*@param $response returns Response of Payrun.io
    */
    public function create($data)
    {
    
    	
    	$data = ['url' => 'Employers','method'=>'POST','data'=>$data];
    	return $this->payRunObject->call($data);
    }


     public function update(){

     	$data = ['url' => 'Employers','method'=>'POST','data'=>$data];
    	return $this->payRunObject->call($data);	
     }
    
}

