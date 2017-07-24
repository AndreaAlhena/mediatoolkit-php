<?php

declare(strict_types = 1);

namespace Mediatoolkit\Helpers;

use GuzzleHttp\Exception\ClientException,
    Mediatoolkit\Helpers\Exceptions\InvalidKeywordTypeException,
    Mediatoolkit\Models\Group,
    Mediatoolkit\Models\Keyword;

class KeywordHelper extends Helper
{
    const CREATE_TYPE_PHRASE = 'phrase';

    const REQUEST_KEYWORD_KEY = 'keyword';
    const REQUEST_NAME_KEY    = 'name';

    const REQUEST_KEYWORD_NATURAL_QUERY_KEY               = 'natural_query';
    const REQUEST_KEYWORD_QUERY_KEY                       = 'query';
    const REQUEST_KEYWORD_QUERY_PHRASE_KEY                = 'phrase';
    const REQUEST_KEYWORD_QUERY_PHRASE_CASE_SENSITIVE_KEY = 'case_sensitive';
    const REQUEST_KEYWORD_QUERY_PHRASE_TEXT_KEY           = 'text';

    const RESPONSE_CODE_KEYWORD_IS_REMOVED = 'KEYWORD_IS_REMOVED';
    const RESPONSE_MESSAGE_CODE            = 'message_code';

    public function create(Group $group, string $text, string $type, string $naturalQuery = '', string $name = '', bool $isCaseSensitive = false): Keyword
    {
        if (!in_array($type, ['phrase'])) {
            throw new InvalidKeywordTypeException('The given Keyword Type is not supported');
        }

        $keywordData = json_encode(
            [
                self::REQUEST_KEYWORD_QUERY_KEY => [
                    self::REQUEST_KEYWORD_QUERY_PHRASE_KEY => [
                        self::REQUEST_KEYWORD_QUERY_PHRASE_CASE_SENSITIVE_KEY => $isCaseSensitive,
                        self::REQUEST_KEYWORD_QUERY_PHRASE_TEXT_KEY           => $text
                    ]
                ]
            ]
        );

        $response = $this->request(
            "groups/{$group->getId()}/keywords",
            [
                self::REQUEST_KEYWORD_KEY => $keywordData,
                self::REQUEST_NAME_KEY => (!empty($name)) ? $name : $text
            ],
            'post'
        );

        $data = $response->getData();
        return new Keyword($data);
    }

    public function delete(Keyword $keyword)
    {
        try {
            $response = $this->request("groups/{$keyword->getGroupId()}/keywords/{$keyword->getId()}", [], 'delete');
        } catch(ClientException $e) {
            return false;
        }

        $data = $response->getData();
        return ($data[self::RESPONSE_MESSAGE_CODE] === self::RESPONSE_CODE_KEYWORD_IS_REMOVED);
    }

    public function find(int $group, int $keyword)
    {
        try {
            $response = $this->request("groups/$group/keywords/$keyword", []);
        } catch(ClientException $e) {
            return new Keyword(
                [
                    Keyword::DATA_GROUP_ID_KEY      => 0,
                    Keyword::DATA_ID_KEY            => 0,
                    Keyword::DATA_IS_ACTIVE_KEY     => false,
                    Keyword::DATA_LAST_EDIT_KEY     => 0,
                    Keyword::DATA_NAME_KEY          => '',
                    Keyword::DATA_NATURAL_QUERY_KEY => ''
                ]
            );
        }

        $data = $response->getData();
        return new Keyword($data);
    }

    public function update(Keyword $keyword)
    {
        $keywordData = json_encode(
            [
                self::REQUEST_KEYWORD_QUERY_KEY => [
                    self::REQUEST_KEYWORD_QUERY_PHRASE_KEY => [
                        self::REQUEST_KEYWORD_QUERY_PHRASE_CASE_SENSITIVE_KEY => $keyword->isCaseSensitive,
                        self::REQUEST_KEYWORD_QUERY_PHRASE_TEXT_KEY           => $keyword->text
                    ]
                ]
            ]
        );

        $response = $this->request(
            "groups/{$keyword->getGroupId()}/keywords/{$keyword->getId()}",
            [
                self::REQUEST_KEYWORD_KEY => $keywordData,
                self::REQUEST_NAME_KEY => $keyword->name
            ],
            'post'
        );

        $data = $response->getData();
        return new Keyword($data);
    }
}