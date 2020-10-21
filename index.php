<?php

require_once 'vendor/autoload.php';


$dicio = new ArthurTavaresDev\Dicio\Dicio();

$word = $dicio->search('doce');

print_r($word);