<?php

namespace Mediatoolkit\Models;

use Carbon\Carbon;

class Keyword
{
    const DATA_ID_KEY              = 'id';
    const DATA_IS_ACTIVE_KEY       = 'active';
    const DATA_LAST_EDIT_KEY       = 'edit_timestamp';
    const DATA_NAME_KEY            = 'name';
    const DATA_NATURAL_KEYWORD_KEY = 'natural_keyword';

    private $_isActive;

    private $_id;

    private $_lastEdit;

    private $_name;

    private $_naturalKeyword;

    public function __construct($data)
    {
        $this->_id             = $data[self::DATA_ID_KEY];
        $this->_isActive       = $data[self::DATA_IS_ACTIVE_KEY];
        $this->_lastEdit       = Carbon::createFromTimestamp($data[self::DATA_LAST_EDIT_KEY]);
        $this->_name           = $data[self::DATA_NAME_KEY];
        $this->_naturalKeyword = $data[self::DATA_NATURAL_KEYWORD_KEY];
    }

    public function isActive()
    {
        return $this->_isActive;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getLastEdit(): Carbon
    {
        return $this->_lastEdit;
    }

    public function getName(): string
    {
        return $this->_name;
    }

    public function getNaturalKeyword(): string
    {
        return $this->_naturalKeyword;
    }
}