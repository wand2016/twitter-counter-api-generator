<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\TweetAggregateResult;

use App\Domain\TweetAggregateResult\TweetAggregateResult;
use App\Domain\TweetAggregateResult\TweetAggregateResultRepository as TweetAggregateResultRepositoryInterface;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\Id;

/**
 * Class TweetAggregateResultRepository
 * @package App\Infrastructure\Domain\TweetAggregateResult
 */
class TweetAggregateResultRepository implements TweetAggregateResultRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findById(Id $id): TweetAggregateResult
    {
        // TODO: Implement findById() method.
        return new TweetAggregateResult();
    }

    /**
     * @inheritDoc
     */
    public function persist(TweetAggregateResult $tweetAggregateResult): void
    {
        // TODO: Implement persist() method.
    }
}
