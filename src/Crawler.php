<?php

namespace ArthurTavaresDev\Dicio;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;

class Crawler
{
    /**
     * @param String $url
     * @param array $params
     * @return SymfonyCrawler
     * @throws GuzzleException
     */
    public static function page(String $url, array $params = []): SymfonyCrawler
    {
        $client = new Client(['verify' => false]); // ignore ssl verify
        $response = $client->get($url, ['query' => $params]);
        $html = $response->getBody()->getContents();

        return new SymfonyCrawler($html);
    }
}
