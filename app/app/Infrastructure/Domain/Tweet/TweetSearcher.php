<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\Tweet;

use App\Domain\Tweet\TweetCollection;
use App\Domain\Tweet\TweetSearcher as TweetSearcherInterface;
use App\Domain\Tweet\TweetSearcher\Criteria;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDtoFactory;

/**
 * Class TweetSearcher
 * @package App\Infrastructure\Domain\Tweet
 */
class TweetSearcher implements TweetSearcherInterface
{
    /**
     * @var RequestDtoFactory
     */
    private RequestDtoFactory $requestDtoFactory;

    /**
     * TweetSearcher constructor.
     * @param RequestDtoFactory $requestDtoFactory
     */
    public function __construct(RequestDtoFactory $requestDtoFactory)
    {
        $this->requestDtoFactory = $requestDtoFactory;
    }

    /**
     * @inheritDoc
     */
    public function search(Criteria $criteria): TweetCollection
    {
        $requestDto = $this->requestDtoFactory->createFromCriteria($criteria);

        // stub
        // TODO: impl
        return new TweetCollection();
    }
}
