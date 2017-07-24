<?php

namespace Mediatoolkit\Helpers;

use Mediatoolkit\Models\Group;

class GroupHelper extends Helper
{
    const RESPONSE_GROUPS_KEY       = 'groups';

    public function create(string $name, bool $isPublic = true): Group
    {
        $response = $this->request(
            'groups',
            [
                Group::DATA_IS_PUBLIC_KEY => $isPublic,
                Group::DATA_NAME_KEY      => $name
            ],
            'post'
        );

        $data  = $response->getData();
        return new Group($data);
    }

    public function find(int $group): Group
    {

    }

    /**
     * Returns the available groups
     *
     * @return mixed array An array with the available Group models
     */
    public function read($group = null): array
    {
        $response = $this->request('groups', []);

        $data   = $response->getData();
        $groups = [];

        foreach ($data[self::RESPONSE_GROUPS_KEY] as $group) {
            $groups[] = new Group($group);
        }

        return $groups;
    }
}