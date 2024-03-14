<?php

namespace ArthurTavaresDev\Dicio\Exceptions;

class UnavailableServiceException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Service unavailable, try again later.');
    }
}
