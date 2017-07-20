<?php

namespace AndrewReborn\Mediatoolkit\Helpers;

use AndrewReborn\Mediatoolkit\Models\Keyword;

class KeywordHelper extends Helper
{
    /**
     * Returns the available groups. If a $group is provided, a Group is returned.
     * Otherwise, a stack of Groups is provided
     *
     * @param string $group The Group identifier
     * 
     * @return mixed Group | array
     */
    public function read($group = null)
    {
        if (empty($group)) {
            return new Keyword($this->request('groups', [])->getData());
        }
    }
}