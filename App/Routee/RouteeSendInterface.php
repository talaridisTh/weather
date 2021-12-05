<?php

namespace App\Routee;
/**
 * Interface for error
 * Example sms , mail
 *
 */
interface RouteeSendInterface {

    /**
     * @param $id
     * @param $secret
     * @param $message
     * @return mixed
     */
    public function send($id, $secret, $message);

}