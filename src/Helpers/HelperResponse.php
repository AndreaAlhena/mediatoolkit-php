<?php

namespace AndrewReborn\Mediatoolkit\Helpers;

class HelperResponse
{
    private $_code;

    private $_data;

    private $_duration;

    private $_message;

    private $_method;

    private $_type;
    
    public function __construct($json)
    {
        $response        = json_decode($json, true);
        
        $this->_code     = $response['code'];
        $this->_data     = $response['data'];
        $this->_duration = $response['duration'];
        $this->_message  = $response['message'];
        $this->_method   = $response['method'];
        $this->_type     = $response['type'];
    }

    public function getData()
    {
        return $this->_data;
    }
}