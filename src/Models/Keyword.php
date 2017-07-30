<?php

declare(strict_types = 1);

namespace Mediatoolkit\Models;

use Carbon\Carbon;

class Keyword implements \JsonSerializable
{
    const DATA_DEFINITION_KEY                             = 'definition';
    const DATA_DEFINITION_QUERY_KEY                       = 'query';
    const DATA_DEFINITION_QUERY_PHRASE_KEY                = 'phrase';
    const DATA_DEFINITION_QUERY_PHRASE_CASE_SENSITIVE_KEY = 'case_sensitive';
    const DATA_DEFINITION_QUERY_PHRASE_TEXT_KEY           = 'text';

    const DATA_GROUP_ID_KEY      = 'group_id';
    const DATA_ID_KEY            = 'id';
    const DATA_IS_ACTIVE_KEY     = 'active';
    const DATA_LAST_EDIT_KEY     = 'edit_timestamp';
    const DATA_NAME_KEY          = 'name';
    const DATA_NATURAL_QUERY_KEY = 'natural_query';

    private $_id;

    private $_groupId; 

    private $_lastEdit;

    public $isActive;

    public $isCaseSensitive;
    
    public $name;

    public $naturalQuery;

    public $text;

    public function __construct(array $data)
    {
        $this->_groupId     = $data[self::DATA_GROUP_ID_KEY];
        $this->_id          = $data[self::DATA_ID_KEY];
        $this->_lastEdit    = Carbon::createFromTimestamp($data[self::DATA_LAST_EDIT_KEY]);
        $this->isActive     = $data[self::DATA_IS_ACTIVE_KEY];
        $this->name         = $data[self::DATA_NAME_KEY];
        $this->naturalQuery = $data[self::DATA_NATURAL_QUERY_KEY];

        if (isset($data[self::DATA_DEFINITION_KEY])) {
            $phrase = $data[self::DATA_DEFINITION_KEY]
                [self::DATA_DEFINITION_QUERY_KEY]
                [self::DATA_DEFINITION_QUERY_PHRASE_KEY];
            
            $this->isCaseSensitive = $phrase[self::DATA_DEFINITION_QUERY_PHRASE_CASE_SENSITIVE_KEY];
            $this->text            = $phrase[self::DATA_DEFINITION_QUERY_PHRASE_TEXT_KEY];
        }
    }

    public function getId(): int
    {
        return $this->_id;
    }

    public function getGroupId(): int
    {
        return $this->_groupId;
    }

    public function getLastEdit(): Carbon
    {
        return $this->_lastEdit;
    }

    /**
     * Implements the JsonSerializable interface
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::DATA_GROUP_ID_KEY                               => $this->_groupId,
            self::DATA_ID_KEY                                     => $this->_id,
            self::DATA_IS_ACTIVE_KEY                              => $this->isActive,
            self::DATA_DEFINITION_QUERY_PHRASE_CASE_SENSITIVE_KEY => $this->isCaseSensitive,
            self::DATA_NAME_KEY                                   => $this->name,
            self::DATA_NATURAL_QUERY_KEY                          => $this->naturalQuery
        ];
    }
}