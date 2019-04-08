<?php

namespace Appoly\Payrun\RemoteObjects;

use Appoly\Payrun\PayrunRemoteObject;

class HolidayScheme extends PayrunRemoteObject
{

    public function all($employer_id)
    {
        $this->request->url = "Employer/$employer_id/HolidaySchemes";
        return $this->request->get();
    }

    public function get($employer_id, $holiday_scheme_id)
    {
        $this->request->url = "Employer/$employer_id/HolidayScheme/$holiday_scheme_id";
        return $this->request->get();
    }

    public function store($employer_id, $data)
    {
        $this->request->url = "Employer/$employer_id/HolidaySchemes";
        return $this->request->post($data);
    }

    public function update($employer_id, $holiday_scheme_id, $data)
    {
        $this->request->url = "Employer/$employer_id/HolidayScheme/$holiday_scheme_id";
        return $this->request->patch($data);
    }

    public function delete($employer_id, $holiday_scheme_id)
    {
        $this->request->url = "Employer/$employer_id/HolidayScheme/$holiday_scheme_id";
        return $this->request->delete();
    }
}
