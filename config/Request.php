<?php

class Request {

    /**
     * @return string
     */
    public static function url()
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }

}