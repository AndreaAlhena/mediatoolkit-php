<?php

namespace Mediatoolkit\Helpers;

use GuzzleHttp\Exception\ClientException,
    Mediatoolkit\Models\Group;

class GroupHelper extends Helper
{
    const RESPONSE_CODE_GROUP_IS_REMOVED = 'GROUP_IS_REMOVED';
    const RESPONSE_GROUPS_KEY            = 'groups';
    const RESPONSE_MESSAGE_CODE          = 'message_code';

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

        $data = $response->getData();
        return new Group($data);
    }

    public function delete(Group $group): bool
    {
        try {
            $response = $this->request("groups/{$group->getId()}", [], 'delete');
        } catch(ClientException $e) {
            return false;
        }

        $data = $response->getData();

        return ($data[self::RESPONSE_MESSAGE_CODE] === self::RESPONSE_CODE_GROUP_IS_REMOVED);
    }

    public function find(int $group): Group
    {
        try {
            $response = $this->request("groups/$group", []);
        } catch(ClientException $e) {
            return new Group(
                [
                    Group::DATA_ID_KEY        => 0,
                    Group::DATA_IS_PUBLIC_KEY => false,
                    Group::DATA_KEYWORDS_KEY  => [],
                    Group::DATA_NAME_KEY      => ''
                ]
            );
        }

        $data = $response->getData();
        return new Group($data);
    }

    /**
     * Returns the available groups
     *
     * @return mixed array An array with the available Group models
     */
    public function read($group = null): array
    {
        $response = $this->request('groups', []);
        $data     = $response->getData();
        $groups   = [];

        foreach ($data[self::RESPONSE_GROUPS_KEY] as $group) {
            $groups[] = new Group($group);
        }

        return $groups;
    }

    public function update(int $id, string $name, bool $isPublic)
    {
        $response = $this->request(
            "groups/$id",
            [
                Group::DATA_ID_KEY        => $id,
                Group::DATA_IS_PUBLIC_KEY => $isPublic,
                Group::DATA_NAME_KEY      => $name
            ],
            'post'
        );

        $data = $response->getData();
        return new Group($data);
    }
}