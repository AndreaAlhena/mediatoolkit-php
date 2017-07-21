<?php

namespace Tests\Models;

use Mediatoolkit\Models\Group,
    PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{
    const TEST_MODEL_ID             = 123;
    const TEST_MODEL_PUBLIC         = true;
    const TEST_MODEL_KEYWORDS_EMPTY = [];
    const TEST_MODEL_NAME           = 'name';

    public function testGroupGetters()
    {
        $model = new Group(
            [
                'id'       => self::TEST_MODEL_ID,
                'public'   => self::TEST_MODEL_PUBLIC,
                'keywords' => self::TEST_MODEL_KEYWORDS_EMPTY,
                'name'     => self::TEST_MODEL_NAME
            ]
        );

        $this->assertEquals(
            [
                self::TEST_MODEL_ID,
                self::TEST_MODEL_PUBLIC,
                self::TEST_MODEL_KEYWORDS_EMPTY,
                self::TEST_MODEL_NAME
            ], [
                $model->getId(),
                $model->isPublic(),
                $model->getKeywords(),
                $model->getName()
            ]
        );
    }
}