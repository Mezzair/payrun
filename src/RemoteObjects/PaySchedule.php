<?php

namespace Appoly\Payrun\RemoteObjects;

use Appoly\Payrun\PayrunRemoteObject;

class PaySchedule extends PayrunRemoteObject
{

    public function all($employer_id)
    {
        $this->request->url = "Employer/$employer_id/PaySchedules";
        return $this->request->get();
    }

    public function get($employer_id, $pay_schedule_id)
    {
        $this->request->url = "Employer/$employer_id/PaySchedule/$pay_schedule_id";
        return $this->request->get();
    }

    public function store($employer_id, $data)
    {
        $this->request->url = "Employer/$employer_id/PaySchedules";
        return $this->request->get($data);
    }

    public function update($employer_id, $pay_schedule_id, $data)
    {
        $this->request->url = "Employer/$employer_id/PaySchedule/$pay_schedule_id";
        return $this->request->get($data);
    }

    public function delete($employer_id, $pay_schedule_id)
    {
        $this->request->url = "Employer/$employer_id/PaySchedule/$pay_schedule_id";
        return $this->request->get();
    }
}
