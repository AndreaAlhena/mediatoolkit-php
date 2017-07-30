<?php

namespace Mediatoolkit\Models;

class Group implements \JsonSerializable
{
    const DATA_ID_KEY              = 'id';
    const DATA_IS_PUBLIC_KEY       = 'public';
    const DATA_KEYWORDS_KEY        = 'keywords';
    const DATA_NAME_KEY            = 'name';

    private $_id;

    public $isPublic;

    public $keywords;

    public $name;

    /**
     * Constructor
     *
     * @param array $data An associative array that matches the Mediatoolkit API Group JSON response
     */
    public function __construct($data)
    {
        $this->_id       = $data[self::DATA_ID_KEY];
        $this->isPublic = $data[self::DATA_IS_PUBLIC_KEY];
        $this->keywords = [];
        $this->name     = $data[self::DATA_NAME_KEY];

        foreach ($data[self::DATA_KEYWORDS_KEY] as $keyword) {
            $this->keywords[] = new Keyword($keyword);
        }
    }

    /**
     * Returns the Group Id
     *
     * @return void
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Implements the JsonSerializable interface
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::DATA_ID_KEY        => $this->_id,
            self::DATA_IS_PUBLIC_KEY => $this->isPublic,
            self::DATA_NAME_KEY      => $this->name
        ];
    }
}