<?php
namespace ArthurTavaresDev\Dicio\Tests\Integration;

use ArthurTavaresDev\Dicio\Data\Word;
use ArthurTavaresDev\Dicio\Dicio;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;

class DicioTest extends TestCase
{
    public Dicio $dicio;
    public SymfonyCrawler $page;

    public function setUp(): void
    {
        parent::setUp();

        $this->dicio = new Dicio();
    }

    public function test_search(){
        $data = $this->dicio->search('doce');
        $this->assertInstanceOf(Word::class, $data);
    }

    public function test_search_on_failed(){
        $this->expectException(GuzzleException::class);
        $this->dicio->search('aaaaaaaa');
    }

}