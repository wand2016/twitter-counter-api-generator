<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchAggregateResultApi;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Domain\TweetSearchCriteria\TweetSearchCriteria;
use Carbon\CarbonImmutable;

/**
 * Class TweetSearchAggregateResultApi
 * @package App\Domain\TweetSearchAggregateResultApi
 */
class TweetSearchAggregateResultApi
{
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
     * @param EndpointName $endpointName
     * @param TweetSearchCriteria $searchCriteria
     */
    public function __construct(EndpointName $endpointName, TweetSearchCriteria $searchCriteria)
    {
        $this->endpointName = $endpointName;
        $this->searchCriteria = $searchCriteria;
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
