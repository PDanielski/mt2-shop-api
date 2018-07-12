<?php


namespace App\Courier\Exception;


use Throwable;

class PlayerRequiredException extends  \Exception {
    public function __construct(string $message = "", int $code = 4004, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}