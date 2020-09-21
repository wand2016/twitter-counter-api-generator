<?php

declare(strict_types=1);

namespace App\Domain\TweetAggregateResult;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\Id;

/**
 * Interface TweetAggregateResultRepository
 * @package App\Domain\TweetAggregateResult
 */
interface TweetAggregateResultRepository
{
    /**
     * @param Id $id
     * @return TweetAggregateResult
     * TODO: specify error
     */
    public function findById(Id $id): TweetAggregateResult;

    /**
     * @param TweetAggregateResult $tweetAggregateResult
     * TODO: specify error
     */
    public function persist(TweetAggregateResult $tweetAggregateResult): void;
}
