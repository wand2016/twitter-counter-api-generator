<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\Tweet;

use App\Domain\Tweet\Tweet;
use App\Domain\Tweet\TweetCollection;
use App\Domain\Tweet\TweetSearcher as TweetSearcherInterface;
use App\Domain\Tweet\TweetSearcher\Criteria;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway;
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
     * @var SearchRecentTweetsGateway
     */
    private SearchRecentTweetsGateway $searchRecentTweetsGateway;

    /**
     * TweetSearcher constructor.
     * @param RequestDtoFactory $requestDtoFactory
     * @param SearchRecentTweetsGateway $searchRecentTweetsGateway
     */
    public function __construct(
        RequestDtoFactory $requestDtoFactory,
        SearchRecentTweetsGateway $searchRecentTweetsGateway
    ) {
        $this->requestDtoFactory = $requestDtoFactory;
        $this->searchRecentTweetsGateway = $searchRecentTweetsGateway;
    }


    /**
     * @inheritDoc
     * TODO: error handling
     */
    public function search(Criteria $criteria): TweetCollection
    {
        $requestDto = $this->requestDtoFactory->createFromCriteria($criteria);

        $responseDto = $this->searchRecentTweetsGateway->call($requestDto);

        $tweets = collect($responseDto->getData())
            ->map(
                function (SearchRecentTweetsGateway\Dto\ResponseDto\Datum $datum): Tweet {
                    return Tweet::create(
                        $datum->getCreatedAt()
                    );
                }
            );

        return new TweetCollection(...$tweets);
    }
}
