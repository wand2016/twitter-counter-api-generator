<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\Tweet;

use App\Domain\Tweet\Tweet;
use App\Domain\Tweet\TweetCollection;
use App\Domain\Tweet\TweetSearcher as TweetSearcherInterface;
use App\Domain\Tweet\TweetSearcher\Criteria;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\Common\Token;
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
        $tweets = collect([]);
        /** @var Token|null $nextToken */
        $nextToken = null;

        $trials = 0;

        do {
            $requestDto = $this->requestDtoFactory->createFromCriteria($criteria, $nextToken);

            $responseDto = $this->searchRecentTweetsGateway->call($requestDto);
            $nextToken = $responseDto->getMeta()->getNextToken();

            $chunk = collect($responseDto->getData())
                ->map(
                    function (SearchRecentTweetsGateway\Dto\ResponseDto\Datum $datum): Tweet {
                        return Tweet::create(
                            $datum->getCreatedAt()
                        );
                    }
                );

            $tweets = $tweets->concat($chunk);

            ++$trials;
        } while ($nextToken && $trials < 20);

        return new TweetCollection(...$tweets);
    }
}
