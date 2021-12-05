<?php

namespace App\Helpers\Errors;
require_once  './App/Helpers/Errors/ErrorInterface.php';

class UnprocessableEntity implements ErrorInterface {

    /**
     * @var
     */
    protected $message;
    /**
     * @var string
     */
    protected $status = "422";

    /**
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Show message
     */
    public function throwError()
    {
        echo json_encode(['error' => $this->message, 'status' => $this->status]);
    }

}