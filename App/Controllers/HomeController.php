<?php

namespace App\Controllers;
require("App\Models\Weather.php");
require("App\Routee\SendSms.php");

use App\Models\Weather;
use App\Routee\SendSms;

class HomeController {

    /**
     * Send sms message
     *
     */
    public function index()
    {

        $id = trim(isset($_POST["id"]) ? $_POST["id"] : '');
        $secret = trim(isset($_POST["secret"]) ? $_POST["secret"] : '');
        $message = $this->getMessage();
        $res = (new SendSms())->send($id, $secret, $message);
        echo json_encode(['response' => $res]);
    }

    /**
     * Get weather message
     * @return string
     */
    private function getMessage()
    {
        $weather = new Weather();
        $temp = $weather->getTemperature();

        return $weather->showMessage($temp, 20);
    }

}