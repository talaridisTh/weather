<?php

namespace App\Helpers\Errors;
/**
 * Interface for error
 * Example 404(not-found) , 422(Unprocessable Entity)
 *
 */
interface ErrorInterface {

    /**
     * @return mixed
     */
    public function throwError();

}