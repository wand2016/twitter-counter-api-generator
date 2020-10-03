<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Domain\Tweet\TweetSearcher;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApiRepository;
use App\Domain\TweetSearchCriteria\TweetSearchCriteriaMatchStringifier;
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
     * @var TweetSearchCriteriaMatchStringifier
     */
    private TweetSearchCriteriaMatchStringifier $tweetSearchCriteriaMatchStringifier;

    /**
     * @var TweetSearcher
     */
    private TweetSearcher $tweetSearcher;

    /**
     * SearchTweets constructor.
     * @param TweetSearchAggregateResultApiRepository $apiRepository
     * @param TweetSearchCriteriaMatchStringifier $tweetSearchCriteriaMatchStringifier
     * @param TweetSearcher $tweetSearcher
     */
    public function __construct(
        TweetSearchAggregateResultApiRepository $apiRepository,
        TweetSearchCriteriaMatchStringifier $tweetSearchCriteriaMatchStringifier,
        TweetSearcher $tweetSearcher
    ) {
        $this->apiRepository = $apiRepository;
        $this->tweetSearchCriteriaMatchStringifier = $tweetSearchCriteriaMatchStringifier;
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
        echo $this->tweetSearchCriteriaMatchStringifier->stringify($criteria->getMatch());
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
