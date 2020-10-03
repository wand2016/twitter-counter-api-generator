<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchAggregateResultApi;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Exceptions\TweetAggregateResultApi\TweetAggregateResultApiNotFoundException;

/**
 * Interface TweetSearchAggregateResultApiRepository
 * @package App\Domain\TweetSearchAggregateResultApi
 */
interface TweetSearchAggregateResultApiRepository
{
    /**
     * @param EndpointName $endpointName
     * @return TweetSearchAggregateResultApi
     * @throws TweetAggregateResultApiNotFoundException
     */
    public function findByEndpointName(EndpointName $endpointName): TweetSearchAggregateResultApi;

    /**
     * @return iterable|TweetSearchAggregateResultApi[]
     * TODO: specify throws
     */
    public function findAll(): iterable;
}
