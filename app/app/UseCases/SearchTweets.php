<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Domain\Tweet\TweetSearcher;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApiRepository;
use App\Domain\TweetSearchCriteria\TweetSearchCriteriaStringifier;
use App\Exceptions\Tweet\TweetSearchFailedException;
use App\Exceptions\TweetAggregateResultApi\TweetAggregateResultApiNotFoundException;
use Carbon\CarbonImmutable;

class SearchTweets
{
    /**
     * @var TweetSearchAggregateResultApiRepository
     */
    private TweetSearchAggregateResultApiRepository $apiRepository;

    /**
     * @var TweetSearchCriteriaStringifier
     */
    private TweetSearchCriteriaStringifier $tweetSearchCriteriaStringifier;

    /**
     * @var TweetSearcher
     */
    private TweetSearcher $tweetSearcher;

    /**
     * SearchTweets constructor.
     * @param TweetSearchAggregateResultApiRepository $apiRepository
     * @param TweetSearchCriteriaStringifier $tweetSearchCriteriaStringifier
     * @param TweetSearcher $tweetSearcher
     */
    public function __construct(
        TweetSearchAggregateResultApiRepository $apiRepository,
        TweetSearchCriteriaStringifier $tweetSearchCriteriaStringifier,
        TweetSearcher $tweetSearcher
    ) {
        $this->apiRepository = $apiRepository;
        $this->tweetSearchCriteriaStringifier = $tweetSearchCriteriaStringifier;
        $this->tweetSearcher = $tweetSearcher;
    }

    /**
     * @param EndpointName $endpointName
     * @throws TweetAggregateResultApiNotFoundException
     * @throws TweetSearchFailedException
     */
    public function run(EndpointName $endpointName): void
    {
        $api = $this->apiRepository->findByEndpointName($endpointName);
        $criteria = $api->getSearchCriteria();

        echo '==========' . PHP_EOL;
        echo 'query:' . PHP_EOL;
        echo $this->tweetSearchCriteriaStringifier->stringify($criteria);
        echo PHP_EOL;
        echo '==========' . PHP_EOL;

        $tweetSearchResult = $this->tweetSearcher->search($criteria);

        echo 'count:';
        echo $tweetSearchResult->count();
        echo PHP_EOL;
        echo '==========' . PHP_EOL;

        $tweets = $tweetSearchResult->getTweets();
        foreach ($tweets as $tweet) {
            echo '----------' . PHP_EOL;
            echo $tweet->getText();
            echo PHP_EOL;
            echo CarbonImmutable::instance($tweet->getTweetedAt())->toIso8601String();
            echo PHP_EOL;
        }
    }
}
