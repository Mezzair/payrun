<?php

namespace Appoly\Payrun\RemoteObjects;

use Appoly\Payrun\PayrunRemoteObject;

class P60 extends PayrunRemoteObject
{

    public function get($employer_id, $employee_id, $tax_year)
    {
        $this->request->url = "Report/P60/run?EmployerKey=" . $employer_id . "&EmployeeKey=" . $employee_id . "&TaxYear=" . $tax_year;
        return $this->request->get();
    }

    public function getPDF($employer_id, $employee_id, $tax_year)
    {
        $this->request->url = "Report/P60/run?EmployerKey=" . $employer_id . "&EmployeeKey=" . $employee_id . "&TaxYear=" . $tax_year . '&TransformDefinitionKey=P60-2017-Pdf';
        return $this->request->get();
    }
}
