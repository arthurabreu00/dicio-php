<?php

require_once 'vendor/autoload.php';


$dicio = new ArthurTavaresDev\Dicio\Dicio();

$dicio = new Dicio;
$word = $dicio->search('batata'); // Objeto com os dados

print_r($word->etymology);