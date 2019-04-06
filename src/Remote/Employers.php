<?php

namespace Appoly\Payrun\Requests\Employer;

use Appoly\Payrun\PayrunRequest;
use Appoly\Payrun\HttpClient\PayRunHttpClient;
use Appoly\Payrun\Remote\RemoteObject;

class Employers
{

    public function all()
    {
        $request = new PayrunRequest();
        $request->method = "GET";
        $request->url = "Employers";
        return $request->send();
    }

    public function get($employer_id)
    {
        $request = new PayrunRequest();
        $request->method = "GET";
        $request->url = "Employer/$employer_id/";
        return $request->send();
    }

    public function store($employer_data)
    {
        $request = new PayrunRequest($employer_data);
        $request->method = "STORE";
        $request->url = "Employers";
        return $request->send();
    }

    public function update($employer_id, $employer_data)
    {
        $request = new PayrunRequest($employer_data);
        $request->method = "STORE";
        $request->url = "Employer/$employer_id/";
        return $request->send();
    }

    public function delete($employer_id)
    {
        $request = new PayrunRequest();
        $request->method = "DELETE";
        $request->url = "Employer/$employer_id/";
        return $request->send();
    }
}
