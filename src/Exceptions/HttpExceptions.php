<?php

namespace SON\Framework\Exceptions;

class HttpExceptions extends \Exception
{
    
    public function __construct($message, $code, \Exception $previous = null)
    {
        http_response_code($code);

        //chama o construtor da class exceptions
        parent::__construct($message, $code, $previous);
    }
}