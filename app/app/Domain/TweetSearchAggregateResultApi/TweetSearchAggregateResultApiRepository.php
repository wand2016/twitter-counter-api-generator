<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchAggregateResultApi;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\Id;

/**
 * Interface TweetSearchAggregateResultApiRepository
 * @package App\Domain\TweetSearchAggregateResultApi
 */
interface TweetSearchAggregateResultApiRepository
{
    /**
     * @param Id $id
     * @return TweetSearchAggregateResultApi
     * TODO: specify throws
     */
    public function findById(Id $id): TweetSearchAggregateResultApi;
}
