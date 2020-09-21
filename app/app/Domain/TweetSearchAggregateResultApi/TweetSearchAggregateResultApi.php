<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchAggregateResultApi;

use App\Domain\Tweet\TweetSearcher\Criteria;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\Id;

/**
 * Class TweetSearchAggregateResultApi
 * @package App\Domain\TweetSearchAggregateResultApi
 */
class TweetSearchAggregateResultApi
{
    /**
     * @var Id
     */
    private Id $id;

    /**
     * @var EndpointName
     */
    private EndpointName $endpointName;

    /**
     * @var Criteria
     */
    private Criteria $searchCriteria;

    /**
     * TweetSearchAggregateResultApi constructor.
     * @param Id $id
     * @param EndpointName $endpointName
     * @param Criteria $searchCriteria
     */
    public function __construct(Id $id, EndpointName $endpointName, Criteria $searchCriteria)
    {
        $this->id = $id;
        $this->endpointName = $endpointName;
        $this->searchCriteria = $searchCriteria;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return EndpointName
     */
    public function getEndpointName(): EndpointName
    {
        return $this->endpointName;
    }

    /**
     * @return Criteria
     */
    public function getSearchCriteria(): Criteria
    {
        return $this->searchCriteria;
    }
}
