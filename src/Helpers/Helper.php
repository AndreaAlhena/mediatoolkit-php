<?php

namespace Mediatoolkit\Helpers;

use Mediatoolkit\Interfaces\HelperInterface,
    GuzzleHttp\Client;

class Helper implements HelperInterface
{
    const MEDIATOOLKIT_REQUEST_BASE_URI         = '/organizations/%s';
    const MEDIATOOLKIT_REQUEST_ORGANISATION_KEY = 'organization';
    const MEDIATOOLKIT_REQUEST_TOKEN_KEY        = 'access_token';

    protected $client;

    protected $organisation;

    protected $token;

    public function __construct(Client $client, $organisation, $token)
    {
        $this->client       = $client;
        $this->organisation = $organisation;
        $this->token        = $token;
    }

    public function request($endpoint, $data = []): HelperResponse
    {
        $url = sprintf(self::MEDIATOOLKIT_REQUEST_BASE_URI, $this->organisation)
            . "/$endpoint";

        return new HelperResponse(
            $this->client->get(
                $url, [
                    'query' => array_merge(
                        $data, [
                            self::MEDIATOOLKIT_REQUEST_TOKEN_KEY => $this->token
                        ]
                    )
                ]
            )
        );
    }
}