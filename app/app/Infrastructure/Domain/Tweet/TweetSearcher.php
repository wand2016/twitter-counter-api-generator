<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\Tweet;

use App\Domain\Tweet\TweetCollection;
use App\Domain\Tweet\TweetSearcher as TweetSearcherInterface;
use App\Domain\Tweet\TweetSearcher\Criteria;
use App\Infrastructure\Gateway\Twitter\v2\BearerTokenPool;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\QueryStringifier;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\RequestDto;

/**
 * Class TweetSearcher
 * @package App\Infrastructure\Domain\Tweet
 */
class TweetSearcher implements TweetSearcherInterface
{
    /**
     * @var BearerTokenPool
     */
    private BearerTokenPool $bearerTokenPool;

    /**
     * @var QueryStringifier
     */
    private QueryStringifier $queryStringifier;

    /**
     * TweetSearcher constructor.
     * @param BearerTokenPool $bearerTokenPool
     * @param QueryStringifier $queryStringifier
     */
    public function __construct(BearerTokenPool $bearerTokenPool, QueryStringifier $queryStringifier)
    {
        $this->bearerTokenPool = $bearerTokenPool;
        $this->queryStringifier = $queryStringifier;
    }


    /**
     * @inheritDoc
     */
    public function search(Criteria $criteria): TweetCollection
    {
        $bearerToken = $this->bearerTokenPool->getBearerToken();

        $request = new RequestDto(
            $this->queryStringifier->stringifyMatch($criteria->getMatch()),
            null,
            null,
            [],
            null
        );

        // stub
        // TODO: impl
        return new TweetCollection();
    }
}
