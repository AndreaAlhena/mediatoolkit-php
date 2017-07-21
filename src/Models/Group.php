<?php

namespace Mediatoolkit\Models;

class Group
{
    const DATA_ID_KEY              = 'id';
    const DATA_IS_PUBLIC_KEY       = 'public';
    const DATA_KEYWORDS_KEY        = 'keywords';
    const DATA_NAME_KEY            = 'name';

    private $_id;

    private $_isPublic;

    private $_keywords;

    private $_name;

    /**
     * Constructor
     *
     * @param array $data An associative array that matches the Mediatoolkit API Group JSON response
     */
    public function __construct($data)
    {
        $this->_id       = $data[self::DATA_ID_KEY];
        $this->_isPublic = $data[self::DATA_IS_PUBLIC_KEY];
        $this->_keywords = [];
        $this->_name     = $data[self::DATA_NAME_KEY];

        foreach ($data[self::DATA_KEYWORDS_KEY] as $keyword) {
            $this->_keywords[] = new Keyword($keyword);
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
     * Returns the keywords associated to the Group
     *
     * @return array An array of Keyword models
     */
    public function getKeywords()
    {
        return $this->_keywords;
    }

    /**
     * Returns the Group name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * Returns if the Group is public or not
     *
     * @return boolean
     */
    public function isPublic()
    {
        return $this->_isPublic;
    }
}