<?php

namespace ArthurTavaresDev\Dicio\Tests\Unit\Data;

use ArthurTavaresDev\Dicio\Crawler;
use ArthurTavaresDev\Dicio\Data\Word;
use ArthurTavaresDev\Dicio\Dicio;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $url = Dicio::BASE_URL . 'doce';
        $page = Crawler::page($url);

        $this->word = new Word($page, $url);
    }

    public function test_meaning(): void
    {
        $meaning = $this->word->meaning();
        $this->assertIsArray($meaning);
        $this->assertNotEmpty($meaning);
    }

    public function test_etymology(): void
    {
        $etymology = $this->word->etymology();
        $this->assertIsString($etymology);
        $this->assertNotEmpty($etymology);
    }

    public function test_synonyms(): void
    {
        $synonyms = $this->word->synonyms();
        $this->assertIsArray($synonyms);
        $this->assertNotEmpty($synonyms);
    }

    public function test_examples(): void
    {
        $examples = $this->word->examples();
        $this->assertIsArray($examples);
        $this->assertNotEmpty($examples);
    }

    public function test_extras(): void
    {
        $extras = $this->word->extras();
        $this->assertIsArray($extras);
    }

    public function test_rhymes(): void
    {
        $extras = $this->word->extras();
        $this->assertIsArray($extras);
    }
}