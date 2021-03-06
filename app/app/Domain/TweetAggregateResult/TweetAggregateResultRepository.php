<?php

declare(strict_types=1);

namespace App\Domain\TweetAggregateResult;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match;
use App\Exceptions\TweetAggregateResult\TweetAggregateResultNotFoundException;
use App\Exceptions\TweetAggregateResult\TweetAggregateResultParseFailedException;
use App\Exceptions\TweetAggregateResult\TweetAggregateResultPersistFailedException;

/**
 * Interface TweetAggregateResultRepository
 * @package App\Domain\TweetAggregateResult
 */
interface TweetAggregateResultRepository
{
    /**
     * @param EndpointName $endpointName
     * @return TweetAggregateResult
     * @throws TweetAggregateResultNotFoundException
     * @throws TweetAggregateResultParseFailedException
     */
    public function findByEndpointName(EndpointName $endpointName): TweetAggregateResult;

    /**
     * @param TweetAggregateResult $tweetAggregateResult
     * @param Match $match
     * @throws TweetAggregateResultPersistFailedException
     */
    public function persist(TweetAggregateResult $tweetAggregateResult, Match $match): void;
}
