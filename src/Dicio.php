<?php

namespace ArthurTavaresDev\Dicio;

use ArthurTavaresDev\Dicio\Data\Word;
use ArthurTavaresDev\Dicio\Exceptions\UnavailableServiceException;
use ArthurTavaresDev\Dicio\Exceptions\WordNotFoundException;
use ArthurTavaresDev\Dicio\Utils\Str;

/**
 * Unofficial PHP API for Dicio.com.br
 * Class Dicio
 * @author Arthur Tavares <arthurabreu00@gmail.com>
 * @package Arthurtavaresdev\Dicio
 */
class Dicio
{
    public const BASE_URL = 'https://www.dicio.com.br/';

    /**
     * Search for word.
     * Dicio API with meaning, synonyms and extra information.
     * @param string $word
     * @return Word
     */
    public function search(string $word): Word
    {
        if (empty($word)) {
            throw new WordNotFoundException();
        }

        $url = Str::format_url(self::BASE_URL) . Str::clear_string($word);
        $page = Crawler::page($url);
        if (!is_object($page)) {
            throw new UnavailableServiceException();
        }

        return new Word($page, $url);
    }
}