<?php

namespace Mediatoolkit\Helpers;

use Mediatoolkit\Models\Group;

class GroupHelper extends Helper
{
    const RESPONSE_GROUPS_KEY = 'groups';

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
            $response = $this->request('groups', []);

            $data   = $response->getData();
            $groups = [];

            foreach ($data[self::RESPONSE_GROUPS_KEY] as $group) {
                $groups[] = new Group($group);
            }

            return $groups;
        }
    }
}