<?php

namespace Mediatoolkit\Interfaces;

use GuzzleHttp\Client;

/**
 * HelperInterface
 */
interface HelperInterface
{
    public function __construct(Client $client, $organisation, $token);
}