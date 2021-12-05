<?php

namespace App\Routee;

use App\Models\Routee;

require("App\Models\Routee.php");
require("App\Routee\RouteeSendInterface.php");
require("App\Helpers\Errors\UnprocessableEntity.php");

class SendSms implements RouteeSendInterface {

    /**
     * Send sms via Routee
     * @param $id
     * @param $secret
     * @param $message
     * @return bool|mixed|string
     */
    public function send($id, $secret, $message)
    {

        list($routee, $auth) = $this->getRoutee($id, $secret, $message);
        if (isset($auth["error"]) && $auth["error"] === "Unauthorized") {
            return $auth;
        }
        $accessToken = json_decode($routee->auth, true)["access_token"];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://connect.routee.net/sms",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{"body": "' . $routee->message . '","to" : "' . $routee->phone . '","from": "amdTelecom"}',
            CURLOPT_HTTPHEADER => [
                'authorization: Bearer ' . $accessToken,
                "content-type: application/json",
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
     * @param $id
     * @param $secret
     * @param $message
     * @return array
     */
    private function getRoutee($id, $secret, $message)
    {
        $routee = (new Routee($id, $secret, $message));
        $auth = json_decode($routee->auth, true);

        return [$routee, $auth];
    }

}