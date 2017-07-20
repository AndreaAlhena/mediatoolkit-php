<?php

namespace AndrewReborn\Mediatoolkit\Models;

class Group
{
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
        $this->_id       = $data['id'];
        $this->_isPublic = $data['public'];
        $this->_name     = $data['name'];

        foreach ($data['keywords'] as $keyword) {
            $this->_keywords[] = new Keyword($keyword);
        }
    }

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

    public function getName()
    {
        return $this->_name;
    }

    public function isPublic()
    {
        return $this->_isPublic;
    }
}