<?php

namespace Tests\Helpers;

use Carbon\Carbon,
    GuzzleHttp\Client,
    Mediatoolkit\Mediatoolkit,
    Mediatoolkit\Models\Group,
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

    /**
     * Tests the create method of the Helper
     *
     * @return void
     */
    public function testCreate()
    {
        $ret = $this->helper->create('test', true);
        $this->assertInstanceOf(Group::class, $ret);
    }

    /**
     * Tests the find method of the helper
     *
     * @return void
     */
    public function testFind()
    {
        $ret = $this->helper->find(0, true);
        $this->assertInstanceOf(Group::class, $ret);
        $this->assertEquals($ret->getId(), 0);
    }

    /**
     * Tests the read method of the helper
     *
     * @return void
     */
    public function testRead()
    {
        $ret = $this->helper->read();
        $this->assertTrue(is_array($ret));
    }
}