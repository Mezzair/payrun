<?php

namespace Appoly\Payrun\Requests\Employer;

use Appoly\Payrun\PayrunRemoteObject;

class AEAssessment extends PayrunRemoteObject
{

    public function all($employer_id, $employee_id)
    {
        $this->request->url = "/Employer/$employer_id/Employee/$employee_id/AEAssessments";
        return $this->request->get();
    }

    public function get($employer_id, $employee_id, $ae_assessment_id)
    {
        $this->request->url = "/Employer/$employer_id/Employee/$employee_id/AEAssessment/$ae_assessment_id";
        return $this->request->get();
    }

    public function store($employer_id, $employee_id, $data)
    {
        $this->request->url = "/Employer/$employer_id/Employee/$employee_id/AEAssessments";
        return $this->request->post($data);
    }

    public function update($employer_id, $employee_id, $ae_assessment_id, $data)
    {
        $this->request->url = "/Employer/$employer_id/Employee/$employee_id/AEAssessment/$ae_assessment_id";
        return $this->request->patch($data);
    }

    public function delete($employer_id, $employee_id, $ae_assessment_id)
    {
        $this->request->url = "/Employer/$employer_id/Employee/$employee_id/AEAssessment/$ae_assessment_id";
        return $this->request->delete();
    }
}
