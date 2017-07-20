<?php

namespace AndrewReborn\Mediatoolkit\Helpers;

use AndrewReborn\Mediatoolkit\Interfaces\HelperInterface,
    GuzzleHttp\Client;

class Helper implements HelperInterface
{
    protected $client;

    protected $organisation;

    protected $token;

    public function __construct(Client $client, $organisation, $token)
    {
        $this->client       = $client;
        $this->organisation = $organisation;
        $this->token        = $token;
    }

    public function request($address, $data = []): HelperResponse
    {
        return new HelperResponse($this->client->get($address, $data));
    }
}