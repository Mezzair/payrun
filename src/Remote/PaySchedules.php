<?php

namespace Appoly\Payrun\Requests\Employer;

use Appoly\Payrun\PayrunRequest;
use Appoly\Payrun\HttpClient\PayRunHttpClient;

class PaySchedules
{

    public function all($employer_id)
    {
        $request = new PayrunRequest();
        $request->method = "GET";
        $request->url = "Employer/$employer_id/PaySchedules";
        return $request->send();
    }

    public function get($employer_id, $pay_schedule_id)
    {
        $request = new PayrunRequest();
        $request->method = "GET";
        $request->url = "Employer/$employer_id/PaySchedule/$pay_schedule_id";
        return $request->send();
    }

    public function store($employer_id, $employer_data)
    {
        $request = new PayrunRequest($employer_data);
        $request->method = "STORE";
        $request->url = "Employer/$employer_id/PaySchedules";
        return $request->send();
    }

    public function update($employer_id, $pay_schedule_id, $employer_data)
    {
        $request = new PayrunRequest($employer_data);
        $request->method = "STORE";
        $request->url = "Employer/$employer_id/PaySchedule/$pay_schedule_id";
        return $request->send();
    }

    public function delete($employer_id, $pay_schedule_id)
    {
        $request = new PayrunRequest();
        $request->method = "DELETE";
        $request->url = "Employer/$employer_id/PaySchedule/$pay_schedule_id";
        return $request->send();
    }
}
