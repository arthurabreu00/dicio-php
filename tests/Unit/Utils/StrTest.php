<?php

namespace ArthurTavaresDev\Dicio\Tests\Unit\Utils;

use ArthurTavaresDev\Dicio\Utils\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function test_format_url(){
        $url = Str::format_url('example.com');
        $this->assertEquals('example.com/', $url);

        $url = Str::format_url('example.com/');
        $this->assertEquals('example.com/', $url);


        $url = Str::format_url('example.com/example?random=1311');
        $this->assertEquals('example.com/example?random=1311/', $url);
    }

    public function test_remove_accents(){
        $string = 'èaíáâãôOÕÔIiÌ)(-óàá';
        $this->assertEquals('eaiaaaoOOOIiI)(-oaa',Str::remove_accents($string));
    }

    public function test_clear_string(){
        $string = 'èaíáâãôOÕÔIiÌ)(-óàá';
        $this->assertEquals('eaiaaaooooiii)(-oaa',Str::clear_string($string));
    }

}