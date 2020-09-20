<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\Tweet;

use App\Domain\Tweet\TweetCollection;
use App\Domain\Tweet\TweetSearcher as TweetSearcherInterface;
use App\Domain\Tweet\TweetSearcher\Criteria;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\RequestFactory;

/**
 * Class TweetSearcher
 * @package App\Infrastructure\Domain\Tweet
 */
class TweetSearcher implements TweetSearcherInterface
{
    /**
     * @var RequestFactory
     */
    private RequestFactory $requestFactory;

    /**
     * TweetSearcher constructor.
     * @param RequestFactory $requestFactory
     */
    public function __construct(RequestFactory $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }


    /**
     * @inheritDoc
     */
    public function search(Criteria $criteria): TweetCollection
    {
        $request = $this->requestFactory->createFromCriteria($criteria);

        // stub
        // TODO: impl
        return new TweetCollection();
    }
}
