<?php

namespace ArthurTavaresDev\Dicio\Data;

use Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;

readonly class Word
{
    private const HTML_SELECTOR_MEANING = '.significado';
    private const HTML_SELECTOR_ETYMOLOGY = '.etim';
    private const HTML_SELECTOR_SYNONYMS = '.adicional.sinonimos';
    private const HTML_SELECTOR_EXTRA = '.adicional';
    private const HTML_SELECTOR_PHRASE = '.frases .frase';
    private const HTML_SELECTOR_RHYMES = '.wrap-section ul.list.col-4-row.small';


    /**
     * @var array<string>
     */
    public array $meaning;

    /**
     * @var string
     */
    public string $etymology;

    /**
     * @var array<string>
     */
    public array $synonyms;

    /**
     * @var array<string>
     */
    public array $examples;

    /**
     * @var array<string>
     */
    public array $extras;

    /**
     * @var array<string>
     */
    public array $rhymes;

    public function __construct(
        private SymfonyCrawler $page,
        public string $url
    ) {
        $this->meaning = $this->meaning();
        $this->etymology = $this->etymology();
        $this->synonyms = $this->synonyms();
        $this->examples = $this->examples();
        $this->extras = $this->extras();
        $this->rhymes = $this->rhymes();
    }

    /**
     * Return meaning and etymology.
     * @return array
     */
    public function meaning(): array
    {
        $result = $this->page->filter(self::HTML_SELECTOR_MEANING)->filter('span');
        $meaning = $result->each(function (SymfonyCrawler $content) {
            $meaning = $content->text();
            if (empty($meaning) || in_array('.' . trim($content->attr('class')), [self::HTML_SELECTOR_ETYMOLOGY, '.cl'])) {
                return false;
            }

            return $meaning;
        });

        return array_filter($meaning, static function ($item) {
            return ! empty($item);
        });
    }

    public function etymology(): string
    {
        $etymology = $this->page->filter(self::HTML_SELECTOR_ETYMOLOGY)->text();
        $pos = strpos($etymology, ').');
        if($pos !== false) {
            $etymology = substr($etymology, $pos + 2);
        }

        return trim($etymology);
    }

    /**
     * Return list of synonyms.
     * @param
     * @return array
     */
    public function synonyms(): array
    {
        return $this->page
            ->filter(self::HTML_SELECTOR_SYNONYMS)
            ->filter('a')
            ->each(fn (SymfonyCrawler $content) => trim($content->text()));
    }

    /**
     * Return a list of examples.
     * @param
     * @return array
     */
    public function examples(): array
    {
        return $this->page->filter(self::HTML_SELECTOR_PHRASE)->each(function ($content) {
            $content = $content->text();
            if (empty($content)) {
                return false;
            }

            return $content;

        });
    }

    public function extras(): array
    {
        return $this->page
            ->filter(self::HTML_SELECTOR_EXTRA)
            ->each(function (SymfonyCrawler $content) {
                $content = trim($content->text());
                if (empty($content)) {
                    return false;
                }

                return $content;
            });
    }

    public function rhymes(): array
    {
        return $this->page
            ->filter(self::HTML_SELECTOR_RHYMES)
            ->filter('li')
            ->each(function (SymfonyCrawler $content) {
                $content = trim($content->text());
                if (empty($content)) {
                    return false;
                }

                return $content;
            });
    }
}
