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
     * @var TweetSearchCriteria\Match
     */
    private TweetSearchCriteria\Match $match;

    /**
     * TweetSearchAggregateResultApi constructor.
     * @param EndpointName $endpointName
     * @param TweetSearchCriteria\Match $match
     */
    public function __construct(EndpointName $endpointName, TweetSearchCriteria\Match $match)
    {
        $this->endpointName = $endpointName;
        $this->match = $match;
    }


    /**
     * @return EndpointName
     */
    public function getEndpointName(): EndpointName
    {
        return $this->endpointName;
    }

    /**
     * @return TweetSearchCriteria\Match
     */
    public function getMatch(): TweetSearchCriteria\Match
    {
        return $this->match;
    }

    /**
     * TODO: delete
     * @return TweetSearchCriteria
     */
    public function getSearchCriteria(): TweetSearchCriteria
    {
        $today = CarbonImmutable::today();
        $since = $today->subDays(6);

        return new TweetSearchCriteria(
            $this->match,
            TweetSearchCriteria\Period::create(
                $since->year,
                $since->month,
                $since->day,
                $today->year,
                $today->month,
                $today->day
            )
        );
    }
}
