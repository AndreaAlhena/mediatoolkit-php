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
                Group::DATA_ID_KEY        => self::TEST_MODEL_ID,
                Group::DATA_IS_PUBLIC_KEY => self::TEST_MODEL_PUBLIC,
                Group::DATA_KEYWORDS_KEY  => self::TEST_MODEL_KEYWORDS_EMPTY,
                Group::DATA_NAME_KEY      => self::TEST_MODEL_NAME
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
                $model->isPublic,
                $model->keywords,
                $model->name
            ]
        );
    }
}