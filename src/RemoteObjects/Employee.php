<?php

namespace Appoly\Payrun\RemoteObjects;

use Appoly\Payrun\PayrunRemoteObject;

class Employee extends PayrunRemoteObject
{

    public function all($employer_id)
    {
        $this->request->url = "Employer/$employer_id/Employees";
        return $this->request->get();
    }

    public function get($employer_id, $employee_id)
    {
        $this->request->url = "Employer/$employer_id/Employee/$employee_id";
        return $this->request->get();
    }

    public function store($employer_id, $data)
    {
        $this->request->url = "Employer/$employer_id/Employees";
        return $this->request->post($data);
    }

    public function update($employer_id, $employee_id, $data)
    {
        $this->request->url = "Employer/$employer_id/Employee/$employee_id";
        return $this->request->patch($data);
    }

    public function delete($employer_id, $employee_id)
    {
        $this->request->url = "Employer/$employer_id/Employee/$employee_id";
        return $this->request->delete();
    }
}
