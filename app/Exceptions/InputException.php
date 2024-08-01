<?php

namespace App\Exceptions;

use Exception;

class InputException extends Exception
{
    private $messages;
    public function __construct(object $messages) {
        parent::__construct();
        $this->messages = $messages;
    }

    public function getMessages(){
        return $this->messages;
    }
}
