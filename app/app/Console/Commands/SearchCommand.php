<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\UseCases\SearchTweets;
use Illuminate\Console\Command;

class SearchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search-tweets {endpointName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'search tweets for given endpointName.';

    /**
     * @var SearchTweets
     */
    private SearchTweets $searchTweets;

    /**
     * SearchCommand constructor.
     * @param SearchTweets $searchTweets
     */
    public function __construct(SearchTweets $searchTweets)
    {
        parent::__construct();
        $this->searchTweets = $searchTweets;
    }


    /**
     * @return int
     * @throws \App\Exceptions\TweetAggregateResultApi\TweetAggregateResultApiNotFoundException
     * @throws \App\Exceptions\Tweet\TweetSearchFailedException
     */
    public function handle()
    {
        $endpointNameArgument = $this->argument('endpointName');
        if (!is_string($endpointNameArgument)) {
            throw new \Exception('endpointName must be string');
        }
        $endpointName = new EndpointName($endpointNameArgument);
        $this->searchTweets->run($endpointName);
        return 0;
    }
}
