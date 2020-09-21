<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\Tweet;

use App\Domain\Tweet\Tweet;
use App\Domain\Tweet\TweetSearcher as TweetSearcherInterface;
use App\Domain\Tweet\TweetSearcher\Criteria;
use App\Domain\Tweet\TweetSearchResult;
use App\Exceptions\Tweet\TweetSearchFailedException;
use App\Exceptions\TwitterApi\AuthorizationFailedException;
use App\Exceptions\TwitterApi\AuthorizationTokenParseFailedException;
use App\Exceptions\TwitterApi\SearchRecentFailedException;
use App\Exceptions\TwitterApi\SearchRecentResponseParseFailedException;
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
     */
    public function search(Criteria $criteria): TweetSearchResult
    {
        try {
            return $this->trySearch($criteria);
        } catch (
            // @formatter:off
            AuthorizationFailedException |
            AuthorizationTokenParseFailedException |
            SearchRecentFailedException |
            SearchRecentResponseParseFailedException $e
            // @formatter:on
        ) {
            throw new TweetSearchFailedException($e);
        }
    }

    /**
     * @param Criteria $criteria
     * @return TweetSearchResult
     * @throws AuthorizationFailedException
     * @throws AuthorizationTokenParseFailedException
     * @throws SearchRecentFailedException
     * @throws SearchRecentResponseParseFailedException
     */
    private function trySearch(Criteria $criteria): TweetSearchResult
    {
        $tweets = collect([]);
        /** @var Token|null $nextToken */
        $nextToken = null;

        do {
            $requestDto = $this->requestDtoFactory->createWithCriteria(
                $criteria,
                [new SearchRecentTweetsGateway\Dto\RequestDto\TweetField\CreatedAt()],
                $nextToken
            );

            $responseDto = $this->searchRecentTweetsGateway->call($requestDto);
            $nextToken = $responseDto->getMeta()->getNextToken();

            $chunk = collect($responseDto->getData())
                ->map(
                    function (SearchRecentTweetsGateway\Dto\ResponseDto\Datum $datum): Tweet {
                        $createdAt = $datum->getCreatedAt();
                        assert($createdAt !== null, 'created_at is specified in request tweet.fields');
                        return Tweet::create($createdAt);
                    }
                );

            $tweets = $tweets->concat($chunk);
        } while ($nextToken);

        return new TweetSearchResult(...$tweets);
    }
}
