<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApiRepository;

/**
 * Class SearchAndAggregateTweetsAll
 * @package App\UseCases
 */
final class SearchAndAggregateTweetsAll
{
    /**
     * @var TweetSearchAggregateResultApiRepository
     */
    private TweetSearchAggregateResultApiRepository $tweetSearchAggregateResultApiRepository;

    /**
     * @var SearchAndAggregateTweets
     */
    private SearchAndAggregateTweets $searchAndAggregateTweets;

    /**
     * SearchAndAggregateTweetsAll constructor.
     * @param TweetSearchAggregateResultApiRepository $tweetSearchAggregateResultApiRepository
     * @param SearchAndAggregateTweets $searchAndAggregateTweets
     */
    public function __construct(
        TweetSearchAggregateResultApiRepository $tweetSearchAggregateResultApiRepository,
        SearchAndAggregateTweets $searchAndAggregateTweets
    ) {
        $this->tweetSearchAggregateResultApiRepository = $tweetSearchAggregateResultApiRepository;
        $this->searchAndAggregateTweets = $searchAndAggregateTweets;
    }


    /**
     * @throws \App\Exceptions\TweetAggregateResult\TweetAggregateResultParseFailedException
     * @throws \App\Exceptions\TweetAggregateResult\TweetAggregateResultPersistFailedException
     * @throws \App\Exceptions\Tweet\TweetSearchFailedException
     */
    public function run(): void
    {
        $apis = $this->tweetSearchAggregateResultApiRepository->findAll();

        foreach ($apis as $api) {
            $this->searchAndAggregateTweets->run($api);
        }
    }
}
