<?php

namespace Appoly\Payrun\RemoteObjects;

use Appoly\Payrun\PayrunRemoteObject;

class NominalCode extends PayrunRemoteObject
{

    public function all($employer_id)
    {
        $this->request->url = "Employer/$employer_id/NominalCodes";
        return $this->request->get();
    }

    public function get($employer_id, $nominal_code_id)
    {
        $this->request->url = "Employer/$employer_id/NominalCode/$nominal_code_id";
        return $this->request->get();
    }

    public function store($employer_id, $data)
    {
        $this->request->url = "Employer/$employer_id/NominalCodes";
        return $this->request->post($data);
    }

    public function update($employer_id, $nominal_code_id, $data)
    {
        $this->request->url = "Employer/$employer_id/NominalCode/$nominal_code_id";
        return $this->request->patch($data);
    }

    public function delete($employer_id, $nominal_code_id)
    {
        $this->request->url = "Employer/$employer_id/NominalCode/$nominal_code_id";
        return $this->request->delete();
    }
}
