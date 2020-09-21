<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Domain\Tweet\TweetSearcher;
use App\Domain\TweetAggregateResult\TweetAggregateResultRepository;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi;

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
     * @throws \App\Exceptions\Tweet\TweetSearchFailedException
     * TODO: error handling
     */
    public function run(TweetSearchAggregateResultApi $tweetSearchAggregateResultApi): void
    {
        $tweetAggregateResult = $this->tweetAggregateResultRepository->findByEndpointName(
            $tweetSearchAggregateResultApi->getEndpointName()
        );

        $tweetSearchResult = $this->tweetSearcher->search($tweetSearchAggregateResultApi->getSearchCriteria());
        $tweetAggregateResult->applySearchResult($tweetSearchResult);

        $this->tweetAggregateResultRepository->persist($tweetAggregateResult);
    }
}
