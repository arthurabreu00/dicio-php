<?php
namespace ArthurTavaresDev\Dicio\Tests;

use ArthurTavaresDev\Dicio\Crawler;
use ArthurTavaresDev\Dicio\Dicio;
use PHPUnit\Framework\TestCase;
use ArthurTavaresDev\Dicio\Utils;

class TestDicio extends TestCase
{
    const BASE_URL = 'http://www.dicio.com.br/';

    public $dicio;
    public $page;
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->dicio = new Dicio();
        $this->page = Crawler::page(self::BASE_URL . 'doce');
        parent::__construct($name, $data, $dataName);
    }

    public function test_format_url(){
        $url = Utils::format_url('example.com');
        $this->assertEquals('example.com/', $url);

        $url = Utils::format_url('example.com/');
        $this->assertEquals('example.com/', $url);


        $url = Utils::format_url('example.com/example?random=1311');
        $this->assertEquals('example.com/example?random=1311/', $url);
    }

    public function test_remove_accents(){
        $string = 'èaíáâãôOÕÔIiÌ)(-óàá';
        $this->assertEquals('eaiaaaoOOOIiI)(-oaa',Utils::remove_accents($string));
    }

    public function test_clear_string(){
        $string = 'èaíáâãôOÕÔIiÌ)(-óàá';
        $this->assertEquals('eaiaaaooooiii)(-oaa',Utils::clear_string($string));
    }

    public function test_page(){
        $this->assertInstanceOf('Symfony\Component\DomCrawler\Crawler', $this->page);
    }

    public function test_meaning(){
        $meaning = $this->dicio->meaning($this->page);
        $this->assertIsArray($meaning);
        $this->assertNotEmpty($meaning);
    }

    public function test_etymology(){
        $etymology = $this->dicio->etymology($this->page);
        $this->assertIsString($etymology);
        $this->assertNotEmpty($etymology);
    }

    public function test_synonyms(){
        $synonyms = $this->dicio->synonyms($this->page);
        $this->assertIsArray($synonyms);
        $this->assertNotEmpty($synonyms);
    }

    public function test_examples(){
        $examples = $this->dicio->examples($this->page);
        $this->assertIsArray($examples);
        $this->assertNotEmpty($examples);
    }

    public function test_extras(){
        $extras = $this->dicio->extras($this->page);
        $this->assertIsArray($extras);
    }

    public function test_search(){
        $data = $this->dicio->search('doce');
        $this->assertIsObject($data);
        $this->assertNotEmpty($data);
        $this->assertObjectHasAttribute('meaning', $data);
        $this->assertObjectHasAttribute('etymology', $data);
        $this->assertObjectHasAttribute('synonyms', $data);
        $this->assertObjectHasAttribute('examples', $data);
        $this->assertObjectHasAttribute('extras', $data);
    }

}