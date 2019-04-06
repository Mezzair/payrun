<?php

namespace Appoly\Payrun\Requests\Employer;

use Appoly\Payrun\PayrunRequest;
use Appoly\Payrun\HttpClient\PayRunHttpClient;

class Employee
{

    public function all($employer_id)
    {
        $request = new PayrunRequest();
        $request->method = "GET";
        $request->url = "Employer/$employer_id/Employees";
        return $request->send();
    }

    public function get($employer_id, $employee_id)
    {
        $request = new PayrunRequest();
        $request->method = "GET";
        $request->url = "Employer/$employer_id/Employee/$employee_id";
        return $request->send();
    }

    public function store($employer_id, $employer_data)
    {
        $request = new PayrunRequest($employer_data);
        $request->method = "STORE";
        $request->url = "Employer/$employer_id/Employees";
        return $request->send();
    }

    public function update($employer_id, $employee_id, $employer_data)
    {
        $request = new PayrunRequest($employer_data);
        $request->method = "STORE";
        $request->url = "Employer/$employer_id/Employee/$employee_id";
        return $request->send();
    }

    public function delete($employer_id, $employee_id)
    {
        $request = new PayrunRequest();
        $request->method = "DELETE";
        $request->url = "Employer/$employer_id/Employee/$employee_id";
        return $request->send();
    }
}
