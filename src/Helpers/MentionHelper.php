<?php

namespace Mediatoolkit\Helpers;

use GuzzleHttp\Exception\ClientException,
    Mediatoolkit\Models\Keyword;

class MentionHelper extends Helper
{
    const DATA_RESPONSE_KEY = 'response';

    /**
     * Returns the available groups
     *
     * @return mixed array An array with the available Group models
     */
    public function read(Keyword $keyword): array
    {
        $response = $this->request("groups/{$keyword->getGroupId()}/keywords/{$keyword->getId()}/mentions", []);
        //$response = $this->request("groups/59205/keywords/6170713/mentions", []);
        $data     = $response->getData()[self::DATA_RESPONSE_KEY];
        $mentions = [];

        foreach ($data as $mention) {
            $mentions[] = new Mention($mention);
        }

        return $mentions;
    }
}