<?php

namespace App\Models;
class Auth {

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @param $id
     * @param $secret
     */
    public function __construct($id, $secret)
    {
        $this->id = trim($id);
        $this->secret = trim($secret);
    }

    /**
     * Routee login
     * @return bool|string
     */
    public function login()
    {

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://auth.routee.net/oauth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => [
                'authorization: Basic ' . $this->getBase64Auth(),
                "content-type: application/x-www-form-urlencoded",
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }

    }

    /**
     * Convert id and secret to base64
     * @return string
     */
    private function getBase64Auth()
    {
        return base64_encode($this->id . ':' . $this->secret);

    }

}