<?php

namespace ArthurTavaresDev\Dicio;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;
use Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;

/**
 * Unofficial PHP API for Dicio.com.br
 * Class Dicio
 * @author Arthur Tavares <arthurabreu00@gmail.com>
 * @package Arthurtavaresdev\Dicio
 */
class Dicio
{
    const BASE_URL = 'http://www.dicio.com.br/';
    const HTML_SELECTOR_MEANING = '.significado';
    const HTML_SELECTOR_ETYMOLOGY = '.etim';
    const HTML_SELECTOR_SYNONYMS = '.adicional.sinonimos .wrapper';
    const HTML_SELECTOR_EXTRA = '.adicional';
    const HTML_SELECTOR_PHRASE = '.frases .frase';

    /**
     * Search for word.
     * Dicio API with meaning, synonyms and extra information.
     * @param string $word
     * @return stdClass
     * @throws Exception
     * @throws GuzzleException
     */
    public function search(string $word): stdClass
    {
        if (empty($word)) {
            throw new Exception('Word not found');
        }

        $url = Utils::format_url(self::BASE_URL) . Utils::clear_string($word);

        $page = Crawler::page($url);
        if (!is_object($page)) {
            throw new Exception('Error on Crawler');
        }

        return (object)[
            'meaning' => $this->meaning($page),
            'etymology' => $this->etymology($page),
            'synonyms' => $this->synonyms($page),
            'examples' => $this->examples($page),
            'extras' => $this->extras($page)
        ];
    }


    /**
     * Return meaning and etymology.
     * @param SymfonyCrawler $page
     * @return array
     */
    public function meaning(SymfonyCrawler $page)
    {
        $result = $page->filter(self::HTML_SELECTOR_MEANING)->filter('br+span');
        return $result->each(function ($content) {
            $meaning = trim($content->text(false));
            if (!$meaning && in_array($content->attr('class'), [self::HTML_SELECTOR_ETYMOLOGY, 'cl'])) {
                return false;
            }

            return trim($meaning);
        });
    }

    public function etymology(SymfonyCrawler $page)
    {
        return trim($page->filter(self::HTML_SELECTOR_ETYMOLOGY)->text(null));
    }

    /**
     * Return list of synonyms.
     * @param SymfonyCrawler $page
     * @return array
     */
    public function synonyms(SymfonyCrawler $page)
    {
        $result = $page->filter(self::HTML_SELECTOR_SYNONYMS)->text(false);
        $synonyms = explode(',', $result);
        return array_map('trim', $synonyms);
    }

    /**
     * Return a list of examples.
     * @param SymfonyCrawler $page
     * @return array
     */
    public function examples(SymfonyCrawler $page)
    {
        $result = $page->filter(self::HTML_SELECTOR_PHRASE);

        return $result->each(function ($content) {
            $content = trim($content->text(false));
            if (empty($content)) {
                return false;
            }
            return $content;

        });
    }

    /**
     * Return a dictionary of extra information.
     * @param SymfonyCrawler $page
     */
    public function extras(SymfonyCrawler $page)
    {
        $result = $page->filter(self::HTML_SELECTOR_EXTRA)->filter('span');
        return $result->each(function ($content) {
            $content = trim($content->text(false));
            if (empty($content)) {
                return false;
            }
            return $content;

        });
    }

}