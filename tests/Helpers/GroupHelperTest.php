<?php

namespace Tests\Helpers;

use Carbon\Carbon,
    GuzzleHttp\Client,
    Mediatoolkit\Mediatoolkit,
    Mediatoolkit\Helpers\GroupHelper,
    PHPUnit\Framework\TestCase;

/**
 * A test class against the Group Helper CRUD functionalities
 */
class GroupHelperTest extends TestCase
{
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__ . '/../../');
        $dotenv->load();
        
        $this->mediatoolkit = new Mediatoolkit(
            getenv('TESTS_MEDIATOOLKIT_ORGANISATION'),
            getenv('TESTS_MEDIATOOLKIT_TOKEN')
        );

        $this->helper = $this->mediatoolkit->getGroupHelper();
    }
    
    public function testHelperInstanceType()
    {
        $this->assertInstanceOf(GroupHelper::class, $this->helper);
    }

    public function testRead()
    {
        $ret = $this->helper->read();
        $this->assertTrue(is_array($ret));
    }
}