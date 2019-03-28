<?php

namespace Appoly\Payrun;

use Appoly\Payrun\HttpClient\PayRunHttpClient;

class Employees
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
    public function create($data,$employer)
    {

    	$data = ['method'=>'POST','data'=>$data];
    	$data['url'] = $employer.'/Employees';


    	
    	

    	return $this->payRunObject->call($data);
    }

    
}
