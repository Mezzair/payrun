<?php

namespace Appoly\Payrun;

use Appoly\Payrun\HttpClient\PayRunHttpClient;

class Pay
{
	   public function __construct(){
			$this->payRunObject = new PayRunHttpClient();
	   }

	

    /**
     * PaySchedule
     * this method create a pay schedule for an employer
     * @param array $data     post data for payrun.io
     * @param String $employer employer id
     * @param String $response returns pay schedule id
     */
    public function PaySchedule($data,$employer){

        $data = ['method'=>'POST','data'=>$data];
        $data['url'] = 'Employer/'.$employer.'/PaySchedules';

        $response = $this->payRunObject->call($data);

        return $response;

        
    }
    /**
     * This api called to create a pay instruction for an employee
     * @param array $data     the data which of payrun instruction
     * @param string $employer is employer id
     * @param string $employee is employee id
     * @param string $response return to to the parent method
     */
    public function PayInstruction($data,$employer,$employee){

        $data = ['method'=>'POST','data'=>$data];
        $data['url'] = 'Employer/'.$employer.'/Employee/'.$employee.'/PayInstructions';
        $response = $this->payRunObject->call($data);

        dd($response);
        die;

        
    }
    
}
