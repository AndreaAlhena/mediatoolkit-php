<?php

namespace Tests;

use Mediatoolkit\Mediatoolkit,
    Mediatoolkit\Exceptions\MediatoolkitException,
    PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
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