<?php

namespace App\Models;
require("App\Models\Auth.php");

class Routee {

    /**
     * @var bool|string
     */
    public $auth;

    /**
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $phone;

    /**
     * @param $id
     * @param $secret
     * @param $message
     * @param string $phone
     */
    public function __construct($id, $secret, $message, $phone = "+30  6911111111")
    {

        $this->auth = (new Auth($id,$secret))->login();
        $this->message = trim($message);
        $this->phone = trim($phone);
    }

}