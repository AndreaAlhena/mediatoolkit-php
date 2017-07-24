<?php

namespace Tests\Helpers;

use Carbon\Carbon,
    Mediatoolkit\Mediatoolkit,
    Mediatoolkit\Models\Group,
    Mediatoolkit\Models\Keyword,
    Mediatoolkit\Helpers\GroupHelper,
    Mediatoolkit\Helpers\KeywordHelper,
    PHPUnit\Framework\TestCase;

/**
 * A test class against the Group Helper CRUD functionalities
 */
class KeywordHelperTest extends TestCase
{
    const CREATE_TEST_NAME              = 'Test';
    const CREATE_TEST_IS_CASE_SENSITIVE = false;
    const UPDATE_TEST_NAME_UPDATED      = 'Test updated';

    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__ . '/../../');
        $dotenv->load();
        
        $this->mediatoolkit = new Mediatoolkit(
            getenv('TESTS_MEDIATOOLKIT_ORGANISATION'),
            getenv('TESTS_MEDIATOOLKIT_TOKEN')
        );

        $this->groupHelper   = $this->mediatoolkit->getGroupHelper();
        $this->keywordHelper = $this->mediatoolkit->getKeywordHelper();
    }
    
    public function testHelperInstanceType()
    {
        $this->assertInstanceOf(KeywordHelper::class, $this->keywordHelper);
    }

    /**
     * Tests the create method of the Helper
     *
     * @return void
     */
    public function testCreate()
    {
        $group   = $this->groupHelper->create('test', true);
        $keyword = $this->keywordHelper->create(
            $group,
            self::CREATE_TEST_NAME,
            KeywordHelper::CREATE_TYPE_PHRASE,
            self::CREATE_TEST_IS_CASE_SENSITIVE
        );

        $this->assertInstanceOf(Keyword::class, $keyword);

        return [
            'group'   => $group,
            'keyword' => $keyword
        ];
    }

    /**
     * Tests the find method against the newly created Keyword
     * 
     * @depends testCreate
     * 
     * @return void
     */
    public function testFindWithExistingKeyword($data)
    {
        $keyword = $this->keywordHelper->find($data['group']->getId(), $data['keyword']->getId());
        $this->assertInstanceOf(Keyword::class, $keyword);
        $this->assertEquals($keyword->getId(), $data['keyword']->getId());

        return $data;
    }
    
    /**
     * Tests the find method of the helper
     *
     * @return void
     */
    public function testFindWithUnexistingGroup()
    {
        $keyword = $this->keywordHelper->find(0, 0);
        $this->assertInstanceOf(Keyword::class, $keyword);
        $this->assertEquals($keyword->getId(), 0);
    }

    /**
     * Tests the update method of the helper
     *
     * @depends testFindWithExistingKeyword
     * 
     * @return void
     */
    public function testUpdate($data)
    {
        $group   = $data['group'];
        $keyword = $data['keyword'];

        $keyword->name = self::UPDATE_TEST_NAME_UPDATED;
        $keyword       = $this->keywordHelper->update($keyword);

        $this->assertInstanceOf(Keyword::class, $keyword);
        $this->assertEquals($keyword->name, $data['keyword']->name);

        return $keyword;
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
    public function testDelete($keyword)
    {
        $ret = $this->keywordHelper->delete($keyword);
        $this->assertTrue($ret);
    }
}