<?php

namespace Tests\Helpers;

use Mediatoolkit\Mediatoolkit,
    Mediatoolkit\Models\Group,
    Mediatoolkit\Helpers\GroupHelper,
    PHPUnit\Framework\TestCase;

/**
 * A test class against the Group Helper CRUD functionalities
 */
class GroupHelperTest extends TestCase
{
    const CREATE_TEST_NAME         = 'Test';
    const UPDATE_TEST_NAME_UPDATED = 'Modified Test Key';

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
        $group = $this->helper->create(self::CREATE_TEST_NAME, true);
        $this->assertInstanceOf(Group::class, $group);

        return $group;
    }

    /**
     * Tests the find method against the newly created Group
     * 
     * @depends testCreate
     * 
     * @return void
     */
    public function testFindWithExistingGroup($group)
    {
        $ret = $this->helper->find($group->getId());
        $this->assertInstanceOf(Group::class, $ret);
        $this->assertEquals($ret->getId(), $group->getId());

        return $group;
    }
    
    /**
     * Tests the find method of the helper
     *
     * @return void
     */
    public function testFindWithUnexistingGroup()
    {
        $ret = $this->helper->find(0);
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

    /**
     * Tests the update method of the helper
     *
     * @depends testFindWithExistingGroup
     * 
     * @return void
     */
    public function testUpdate($group)
    {
        $group->name = self::UPDATE_TEST_NAME_UPDATED;
        $group       = $this->helper->update(
            $group->getId(),
            $group->name,
            $group->isPublic
        );

        $this->assertInstanceOf(Group::class, $group);
        $this->assertEquals($group->name, self::UPDATE_TEST_NAME_UPDATED);

        return $group;
    }

    /**
     * Tests the delete method of the helper
     * Has not been declared in alphabetical order as it's the last method
     * that must be tested, as removes the keywords created during the test
     * 
     * @depends testUpdate
     * 
     * @return void
    */    
    public function testDelete($group)
    {
        $ret = $this->helper->delete($group);
        $this->assertTrue($ret);
    }
}