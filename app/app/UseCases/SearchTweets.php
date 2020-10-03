<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Domain\Tweet\TweetSearcher;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApiRepository;
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
     * @var TweetSearcher
     */
    private TweetSearcher $tweetSearcher;

    /**
     * SearchTweets constructor.
     * @param TweetSearchAggregateResultApiRepository $apiRepository
     * @param TweetSearcher $tweetSearcher
     */
    public function __construct(TweetSearchAggregateResultApiRepository $apiRepository, TweetSearcher $tweetSearcher)
    {
        $this->apiRepository = $apiRepository;
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

        // todo: stringify
        var_dump($criteria);

        $tweetSearchResult = $this->tweetSearcher->search($criteria);

        echo $tweetSearchResult->count();
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
