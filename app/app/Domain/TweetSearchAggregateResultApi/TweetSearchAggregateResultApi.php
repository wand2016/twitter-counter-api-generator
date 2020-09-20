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
     * @var Id|null
     */
    private ?Id $id;

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
     * @param Id|null $id
     * @param EndpointName $endpointName
     * @param Criteria $searchCriteria
     */
    public function __construct(?Id $id, EndpointName $endpointName, Criteria $searchCriteria)
    {
        $this->id = $id;
        $this->endpointName = $endpointName;
        $this->searchCriteria = $searchCriteria;
    }

    /**
     * @return Id|null
     */
    public function getId(): ?Id
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJsonEndpointName(): string
    {
        return $this->endpointName->getValue() . '.json';
    }

    /**
     * @return Criteria
     */
    public function getSearchCriteria(): Criteria
    {
        return $this->searchCriteria;
    }
}
