<?php

namespace ArthurTavaresDev\Dicio\Exceptions;

class WordNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Word not found');
    }
}
