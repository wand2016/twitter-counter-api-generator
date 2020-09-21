<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\UseCases\SearchAndAggregateTweetsAll;
use Illuminate\Console\Command;

class SearchAndAggregateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aggregate:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'search and aggregate tweets for all registered APIs.';

    /**
     * @var SearchAndAggregateTweetsAll
     */
    private SearchAndAggregateTweetsAll $searchAndAggregateTweetsAll;

    /**
     * SearchAndAggregateCommand constructor.
     * @param SearchAndAggregateTweetsAll $searchAndAggregateTweetsAll
     */
    public function __construct(SearchAndAggregateTweetsAll $searchAndAggregateTweetsAll)
    {
        parent::__construct();
        $this->searchAndAggregateTweetsAll = $searchAndAggregateTweetsAll;
    }


    /**
     * @return int
     * @throws \App\Exceptions\TweetAggregateResult\TweetAggregateResultParseFailedException
     * @throws \App\Exceptions\TweetAggregateResult\TweetAggregateResultPersistFailedException
     * @throws \App\Exceptions\Tweet\TweetSearchFailedException
     */
    public function handle()
    {
        $this->searchAndAggregateTweetsAll->run();
        return 0;
    }
}
