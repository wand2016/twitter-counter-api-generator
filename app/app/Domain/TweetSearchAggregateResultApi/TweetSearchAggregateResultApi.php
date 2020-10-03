<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchAggregateResultApi;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\Id;
use App\Domain\TweetSearchCriteria\TweetSearchCriteria;
use Carbon\CarbonImmutable;

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
     * @var TweetSearchCriteria
     */
    private TweetSearchCriteria $searchCriteria;

    /**
     * TweetSearchAggregateResultApi constructor.
     * @param Id $id
     * @param EndpointName $endpointName
     * @param TweetSearchCriteria $searchCriteria
     */
    public function __construct(Id $id, EndpointName $endpointName, TweetSearchCriteria $searchCriteria)
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
     * @return TweetSearchCriteria
     */
    public function getSearchCriteria(): TweetSearchCriteria
    {
        $today = CarbonImmutable::today();
        $since = $today->subDays(6);

        // TODO: persist only matches
        return new TweetSearchCriteria(
            $this->searchCriteria->getMatch(),
            TweetSearchCriteria\Period::since(
                $since->year,
                $since->month,
                $since->day
            )
        );
    }
}
