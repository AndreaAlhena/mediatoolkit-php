<?php

declare(strict_types = 1);

namespace Tests\Models;

use Mediatoolkit\Models\Mention,
    PHPUnit\Framework\TestCase;

class MentionTest extends TestCase
{
    public function testMentionGetters()
    {
        $mockedMention = json_decode(file_get_contents(__DIR__ . '/../Mocks/mention.json'), true);
        $mention       = new Mention($mockedMention);
        
        $this->assertEquals(
            [
                $mockedMention[Mention::DATA_COMMENT_COUNT_KEY],
                $mockedMention[Mention::DATA_DESCRIPTION_KEY],
                $mockedMention[Mention::DATA_DOMAIN_KEY],
                $mockedMention[Mention::DATA_ID_KEY],
                $mockedMention[Mention::DATA_INSERT_TIME_KEY],
                $mockedMention[Mention::DATA_KEYWORD_NAME_KEY],
                $mockedMention[Mention::DATA_NUMBER_OF_SIMILARS_KEY],
                $mockedMention[Mention::DATA_REACH_KEY],
                $mockedMention[Mention::DATA_TITLE_KEY],
                $mockedMention[Mention::DATA_TYPE_KEY],
                $mockedMention[Mention::DATA_URL_KEY]
            ],
            [
                $mention->getCommentCount(),
                $mention->getDescription(),
                $mention->getDomain(),
                $mention->getId(),
                $mention->getInsertTime()->timestamp,
                $mention->getKeywordName(),
                $mention->getNumberOfSimilar(),
                $mention->getReach(),
                $mention->getTitle(),
                $mention->getType(),
                $mention->getUrl()
            ]
        );
    }
}