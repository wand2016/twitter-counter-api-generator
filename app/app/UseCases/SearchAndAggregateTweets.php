<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Domain\Tweet\TweetSearcher;
use App\Domain\TweetAggregateResult\TweetAggregateResult;
use App\Domain\TweetAggregateResult\TweetAggregateResultRepository;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi;
use App\Exceptions\TweetAggregateResult\TweetAggregateResultNotFoundException;

/**
 * Class SearchAndAggregateTweets
 * @package App\UseCases
 */
final class SearchAndAggregateTweets
{
    /**
     * @var TweetAggregateResultRepository
     */
    private TweetAggregateResultRepository $tweetAggregateResultRepository;

    /**
     * @var TweetSearcher
     */
    private TweetSearcher $tweetSearcher;

    /**
     * SearchAndAggregateTweets constructor.
     * @param TweetAggregateResultRepository $tweetAggregateResultRepository
     * @param TweetSearcher $tweetSearcher
     */
    public function __construct(
        TweetAggregateResultRepository $tweetAggregateResultRepository,
        TweetSearcher $tweetSearcher
    ) {
        $this->tweetAggregateResultRepository = $tweetAggregateResultRepository;
        $this->tweetSearcher = $tweetSearcher;
    }

    /**
     * @param TweetSearchAggregateResultApi $tweetSearchAggregateResultApi
     * @throws \App\Exceptions\TweetAggregateResult\TweetAggregateResultParseFailedException
     * @throws \App\Exceptions\TweetAggregateResult\TweetAggregateResultPersistFailedException
     * @throws \App\Exceptions\Tweet\TweetSearchFailedException
     */
    public function run(TweetSearchAggregateResultApi $tweetSearchAggregateResultApi): void
    {
        $tweetAggregateResult = $this->hydrateOrCreateTweetAggregateResult($tweetSearchAggregateResultApi);

        $tweetSearchResult = $this->tweetSearcher->search($tweetSearchAggregateResultApi->getSearchCriteria());
        $tweetAggregateResult->applySearchResult($tweetSearchResult);

        $this->tweetAggregateResultRepository->persist($tweetAggregateResult);
    }

    /**
     * @param TweetSearchAggregateResultApi $tweetSearchAggregateResultApi
     * @return TweetAggregateResult
     * @throws \App\Exceptions\TweetAggregateResult\TweetAggregateResultParseFailedException
     */
    private function hydrateOrCreateTweetAggregateResult(
        TweetSearchAggregateResultApi $tweetSearchAggregateResultApi
    ): TweetAggregateResult {
        try {
            $tweetAggregateResult = $this->tweetAggregateResultRepository->findByEndpointName(
                $tweetSearchAggregateResultApi->getEndpointName()
            );
        } catch (TweetAggregateResultNotFoundException $e) {
            $tweetAggregateResult = TweetAggregateResult::create(
                $tweetSearchAggregateResultApi->getEndpointName()
            );
        }
        return $tweetAggregateResult;
    }
}
