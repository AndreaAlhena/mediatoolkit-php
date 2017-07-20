<?php

declare(strict_types = 1);

namespace Mediatoolkit;

use GuzzleHttp\Client,
    Mediatoolkit\Exceptions\MediatoolkitException,
    Mediatoolkit\Helpers\GroupHelper,
    Mediatoolkit\Helpers\KeywordHelper;

class Mediatoolkit
{
    const BASE_URI               = 'https://api.mediatoolkit.com';
    const ORGANISATION_ENV_NAME  = 'MEDIATOOLKIT_API_ORGANISATION';
    const TOKEN_ENV_NAME         = 'MEDIATOOLKIT_API_TOKEN';
    
    /**
     * The organization Id
     *
     * @var string
     */
    private $_organisation;

    /**
     * A Token is required to authorize each request
     *
     * @var string
     */
    private $_token;
    
    /**
     * The Guzzle HTTP Client
     *
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * Initialize the Mediatoolkit SDK
     */
    public function __construct(string $organisation = null, string $token = null)
    {
        $this->_organisation = ($organisation == null)
            ? getenv(self::ORGANISATION_ENV_NAME)
            : $organisation;

        $this->_token        = ($token == null)
            ? getenv(self::TOKEN_ENV_NAME)
            : $token;

        if (empty($this->_organisation)) {
            throw new MediatoolkitException('No Organisation provided');
        }

        if (empty($this->_token)) {
            throw new MediatoolkitException('No Token provided');
        }

        $this->client = new Client(['base_uri' => self::BASE_URI]);
    }

    /**
     * Returns an instance of the GroupHelper that provides the Group CRUD endpoints
     *
     * @return GroupHelper
     */
    public function getGroupHelper(): GroupHelper
    {
        return new GroupHelper($this->client, $this->_organisation, $this->_token);
    }

    /**
     * Returns an instance of the KeywordHelper that provides the Keyword CRUD endpoints
     *
     * @return GroupHelper
     */
    public function getKeywordHelper(): KeywordHelper
    {
        return new KeywordHelper($this->client, $this->_organisation, $this->_token);
    }

    /**
     * Returns the current Organization
     * 
     * @return string
     */
    public function getOrganization(): string
    {
        return $this->_organization;
    }

    /**
     * Returns the current Token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->_token;
    }
}