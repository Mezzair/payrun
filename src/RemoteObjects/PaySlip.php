<?php

namespace Appoly\Payrun\RemoteObjects;

use Appoly\Payrun\PayrunRemoteObject;

class PaySlip extends PayrunRemoteObject
{

    // public function all($employer_id)
    // {
    //     $this->request->url = "Employer/$employer_id/PaySchedules";
    //     return $this->request->get();
    // }

    public function get($employer_id, $pay_schedule_id, $tax_year, $payment_date, $pdf = false)
    {
        $this->request->url = "Report/PAYSLIP3/run?EmployerKey=".$employer_id."&PayScheduleKey=".$pay_schedule_id."&TaxYear=".$tax_year."&PaymentDate=".$payment_date;
        //One underneath is for pdf
        if($pdf){
            $this->request->url = "Report/PAYSLIP3/run?EmployerKey=".$employer_id."&PayScheduleKey=".$pay_schedule_id."&TaxYear=".$tax_year."&PaymentDate=".$payment_date.'&TransformDefinitionKey=Payslip-A5-Basic-Pdf';
        }

        return $this->request->get();
    }

    // public function store($employer_id, $data)
    // {
    //     $this->request->url = "Employer/$employer_id/PaySchedules";
    //     return $this->request->post($data);
    // }

    // public function update($employer_id, $pay_schedule_id, $data)
    // {
    //     $this->request->url = "Employer/$employer_id/PaySchedule/$pay_schedule_id";
    //     return $this->request->patch($data);
    // }

    // public function delete($employer_id, $pay_schedule_id)
    // {
    //     $this->request->url = "Employer/$employer_id/PaySchedule/$pay_schedule_id";
    //     return $this->request->delete();
    // }
}
