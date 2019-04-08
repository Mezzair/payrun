<?php

namespace Appoly\Payrun\RemoteObjects;

use Appoly\Payrun\PayrunRemoteObject;

class Employer extends PayrunRemoteObject
{

    public function all()
    {
        $this->request->url = "Employers";
        return $this->request->get();
    }

    public function get($employer_id)
    {
        $this->request->url = "Employer/$employer_id/";
        return $this->request->get();
    }

    public function store($data)
    {
        $this->request->url = "Employers";
        return $this->request->post($data);
    }

    public function update($employer_id, $data)
    {
        $this->request->url = "Employer/$employer_id/";
        return $this->request->patch($data);
    }

    public function delete($employer_id)
    {
        $this->request->url = "Employer/$employer_id/";
        return $this->request->delete();
    }
}
