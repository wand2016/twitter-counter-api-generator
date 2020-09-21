<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\TweetAggregateResult;

use App\Domain\TweetAggregateResult\TweetAggregateResult;
use App\Domain\TweetAggregateResult\TweetAggregateResultRepository as TweetAggregateResultRepositoryInterface;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use Illuminate\Support\Facades\Storage;

/**
 * Class TweetAggregateResultRepository
 * @package App\Infrastructure\Domain\TweetAggregateResult
 */
class TweetAggregateResultRepository implements TweetAggregateResultRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findByEndpointName(EndpointName $endpointName): TweetAggregateResult
    {
        $obj = Storage::cloud()->get($endpointName->getJsonName());

        // TODO: Implement findByEndpointName() method.
        
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
