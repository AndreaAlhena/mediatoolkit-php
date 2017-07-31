<?php

declare(strict_types = 1);

namespace Mediatoolkit\Models;

use Carbon\Carbon;

class Mention implements \JsonSerializable
{
    const
        DATA_COMMENT_COUNT_KEY        = 'comment_count',
        DATA_DATABASE_INSERT_TIME_KEY = 'database_insert_time',
        DATA_DESCRIPTION_KEY          = 'description',
        DATA_DOMAIN_KEY               = 'domain',
        DATA_ENGAGEMENT_RATE_KEY      = 'engagement_rate',
        DATA_FROM_KEY                 = 'from',
        DATA_ID_KEY                   = 'id',
        DATA_IN_ZEED_KEY              = 'in_zeed',
        DATA_IMAGE_KEY                = 'image',
        DATA_INFLUENCE_SCORE_KEY      = 'influence_score',
        DATA_INSERT_TIME_KEY          = 'insert_time',
        DATA_INTERACTION_KEY          = 'interaction',
        DATA_KEYWORD_NAME_KEY         = 'keyword_name',
        DATA_LANGUAGES_KEY            = 'languages',
        DATA_LINKEDIN_COUNT_KEY       = 'linkedin_count',
        DATA_LIKE_COUNT_KEY           = 'like_count',
        DATA_LOCATIONS_KEY            = 'locations',
        DATA_MENTION_KEY              = 'mention',
        DATA_MOZRANK_KEY              = 'mozrank',
        DATA_NUMBER_OF_SIMILARS_KEY   = 'number_of_similars',
        DATA_PINTEREST_COUNT_KEY      = 'pinterest_count',
        DATA_PHOTO_KEY                = 'photo',
        DATA_PR_VALUE_KEY             = 'pr_value',
        DATA_REACH_KEY                = 'reach',
        DATA_REDDIT_COMMENT_COUNT_KEY = 'reddit_comment_count',
        DATA_REDDIT_DOWNS_COUNT_KEY   = 'reddit_downs_count',
        DATA_REDDIT_UPS_COUNT_KEY     = 'reddit_ups_count',
        DATA_SHARE_COUNT_KEY          = 'share_count',
        DATA_SIMILAR_MENTIONS_KEY     = 'similar_mentions',
        DATA_TAG_FEED_LOCATIONS_KEY   = 'tag_feed_locations', 
        DATA_TITLE_KEY                = 'title',
        DATA_TYPE_KEY                 = 'type',
        DATA_URL_KEY                  = 'url',
        DATA_VIRALITY_KEY             = 'virality';
    
    private $_commentCount;

    private $_databaseInsertTime;

    private $_description;

    private $_domain;

    private $_engagementRate;

    private $_from;

    private $_id;

    private $_image;

    private $_influenceScore;

    private $_insertTime;

    private $_interaction;

    private $_inZeed;

    private $_keywordName;

    private $_languages;

    private $_linkedinCount;

    private $_likeCount;

    private $_locations;

    private $_mention;

    private $_mozrank;

    private $_numberOfSimilar;

    private $_pinterestCount;

    private $_photo;

    private $_prValue;

    private $_reach;

    private $_redditCommentCount;

    private $_redditDownCount;

    private $_redditUpsCount;

    private $_shareCount;

    private $_similarMentions;

    private $_tagFeedLocations;

    private $_title;

    private $_type;

    private $_url;

    private $_virality;

    /**
     * Constructor
     *
     * @param array $data An associative array that matches the Mediatoolkit API Group JSON response
     */
    public function __construct($data)
    {        
        $this->_commentCount       = $data[self::DATA_COMMENT_COUNT_KEY] ?? 0;
        $this->_databaseInsertTime = Carbon::createFromTimestamp($data[self::DATA_DATABASE_INSERT_TIME_KEY]);
        $this->_description        = $data[self::DATA_DESCRIPTION_KEY];
        $this->_domain             = $data[self::DATA_DOMAIN_KEY];
        $this->_engagementRate     = $data[self::DATA_ENGAGEMENT_RATE_KEY];
        $this->_from               = $data[self::DATA_FROM_KEY];
        $this->_id                 = $data[self::DATA_ID_KEY];
        $this->_image              = $data[self::DATA_IMAGE_KEY];
        $this->_influenceScore     = $data[self::DATA_INFLUENCE_SCORE_KEY];
        $this->_insertTime         = Carbon::createFromTimestamp($data[self::DATA_INSERT_TIME_KEY]);
        $this->_interaction        = $data[self::DATA_INTERACTION_KEY];
        $this->_inZeed             = $data[self::DATA_IN_ZEED_KEY];
        $this->_keywordName        = $data[self::DATA_KEYWORD_NAME_KEY];
        $this->_languages          = $data[self::DATA_LANGUAGES_KEY];
        $this->_linkedinCount      = $data[self::DATA_LINKEDIN_COUNT_KEY] ?? 0;
        $this->_likeCount          = $data[self::DATA_LIKE_COUNT_KEY];
        $this->_locations          = $data[self::DATA_LOCATIONS_KEY];
        $this->_mention            = $data[self::DATA_MENTION_KEY];
        $this->_mozrank            = $data[self::DATA_MOZRANK_KEY];
        $this->_numberOfSimilars   = $data[self::DATA_NUMBER_OF_SIMILARS_KEY] ?? 0;
        $this->_pinterestCount     = $data[self::DATA_PINTEREST_COUNT_KEY] ?? 0;
        $this->_photo              = $data[self::DATA_PHOTO_KEY];
        $this->_prValue            = $data[self::DATA_PR_VALUE_KEY];
        $this->_reach              = $data[self::DATA_REACH_KEY];
        $this->_redditCommentCount = $data[self::DATA_REDDIT_COMMENT_COUNT_KEY] ?? 0;
        $this->_redditDownCount    = $data[self::DATA_REDDIT_DOWNS_COUNT_KEY] ?? 0;
        $this->_redditUpsCount     = $data[self::DATA_REDDIT_UPS_COUNT_KEY] ?? 0;
        $this->_shareCount         = $data[self::DATA_SHARE_COUNT_KEY] ?? 0;
        $this->_similarMentions    = $data[self::DATA_SIMILAR_MENTIONS_KEY] ?? [];
        $this->_tagFeedLocations   = $data[self::DATA_TAG_FEED_LOCATIONS_KEY] ?? [];
        $this->_title              = $data[self::DATA_TITLE_KEY];
        $this->_type               = $data[self::DATA_TYPE_KEY];
        $this->_url                = $data[self::DATA_URL_KEY];
        $this->_virality           = $data[self::DATA_VIRALITY_KEY];
    }

    public function getCommentCount(): int
    {
        return $this->_commentCount;
    }

    public function getDescription(): string
    {
        return $this->_description;
    }

    public function getDomain(): string
    {
        return $this->_domain;
    }

    /**
     * Returns the Group Id
     *
     * @return void
     */
    public function getId(): int
    {
        return $this->_id;
    }

    public function getInsertTime(): Carbon
    {
        return $this->_insertTime;
    }

    public function getKeywordName(): string
    {
        return $this->_keywordName;
    }

    public function getNumberOfSimilar(): int
    {
        return $this->_numberOfSimilars;
    }

    public function getReach(): int
    {
        return $this->_reach;
    }

    public function getTitle(): string
    {
        return $this->_title;
    }

    public function getType(): string
    {
        return $this->_type;
    }

    public function getUrl(): string
    {
        return $this->_url;
    }

    public function jsonSerialize(): array
    {
        return [
            self::DATA_COMMENT_COUNT_KEY     => $this->_commentCount,
            self::DATA_DESCRIPTION_KEY       => $this->_description,
            self::DATA_DOMAIN_KEY            => $this->_domain,
            self::DATA_ID_KEY                => $this->_id,
            self::DATA_INSERT_TIME           => $this->_insertTime->format('Y-m-d H:i:s'),
            self::DATA_KEYWORD_NAME          => $this->_keywordName,
            self::DATA_NUMBER_OF_SIMILARS_KEY => $this->_numberOfSimilar,
            self::DATA_REACH_KEY             => $this->_reach,
            self::DATA_TITLE_KEY             => $this->_title,
            self::DATA_TYPE_KEY              => $this->_type,
            self::DATA_URL_KEY               => $this->_url
        ];
    }
}