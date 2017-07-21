<?php

namespace Tests;

use Mediatoolkit\Helpers\GroupHelper,
    Mediatoolkit\Helpers\KeywordHelper,
    Mediatoolkit\Mediatoolkit,
    Mediatoolkit\Exceptions\MediatoolkitException,
    PHPUnit\Framework\TestCase;

class MediatoolkitTest extends TestCase
{
    public function testGetGroupHelper()
    {
        $mediatoolkit = new Mediatoolkit('organisation', 'token');
        $groupHelper  = $mediatoolkit->getGroupHelper();
        $this->assertEquals(get_class($groupHelper), GroupHelper::class);
    }

    public function testGetKeywordHelper()
    {
        $mediatoolkit  = new Mediatoolkit('organisation', 'token');
        $keywordHelper = $mediatoolkit->getKeywordHelper();
        $this->assertEquals(get_class($keywordHelper), KeywordHelper::class);
    }

    public function testMissingOrganisation()
    {
        $this->expectException(MediatoolkitException::class);
        new Mediatoolkit('', 'token');
    }

    public function testMissingOrganisationAndToken()
    {
        $this->expectException(MediatoolkitException::class);
        new Mediatoolkit();
    }

    public function testMissingToken()
    {
        $this->expectException(MediatoolkitException::class);
        new Mediatoolkit('organisation', '');
    }
}