<?php

namespace Appoly\Payrun\RemoteObjects;

use Appoly\Payrun\PayrunRemoteObject;

class P45 extends PayrunRemoteObject
{

    public function get($employer_id, $employee_id)
    {
        $this->request->url = "Report/P45/run?EmployerKey=" . $employer_id . "&EmployeeKey=" . $employee_id;
        return $this->request->get();
    }

    public function getPDF($employer_id, $employee_id)
    {
        $this->request->url = "Report/P45/run?EmployerKey=" . $employer_id . "&EmployeeKey=" . $employee_id . '&TransformDefinitionKey=P45-Pdf';
        return $this->request->get();
    }
}
