<?php

namespace Tests\Helpers;

use Mediatoolkit\Mediatoolkit,
    Mediatoolkit\Helpers\GroupHelper,
    Mediatoolkit\Helpers\KeywordHelper,
    Mediatoolkit\Helpers\MentionHelper,
    PHPUnit\Framework\TestCase;

/**
 * A test class against the Group Helper CRUD functionalities
 */
class MentionHelperTest extends TestCase
{
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
        $this->mentionHelper = $this->mediatoolkit->getMentionHelper();
    }
    
    public function testHelperInstanceType()
    {
        $this->assertInstanceOf(MentionHelper::class, $this->mentionHelper);
    }

    public function testRead()
    {
        $group   = $this->groupHelper->create('test', true);
        $keyword = $this->keywordHelper->create(
            $group,
            KeywordHelperTest::CREATE_TEST_NAME,
            KeywordHelper::CREATE_TYPE_PHRASE,
            KeywordHelperTest::CREATE_TEST_IS_CASE_SENSITIVE
        );
        $mentions = $this->mentionHelper->read($keyword);

        $this->assertTrue(is_array($mentions));

        $this->keywordHelper->delete($keyword);
        $this->groupHelper->delete($group);
    }

}