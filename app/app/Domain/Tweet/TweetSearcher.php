<?php

declare(strict_types=1);

namespace App\Domain\Tweet;

use App\Domain\TweetSearchCriteria\TweetSearchCriteria;
use App\Exceptions\Tweet\TweetSearchFailedException;

/**
 * Interface TweetSearcher
 * @package App\Domain\Tweet
 */
interface TweetSearcher
{
    /**
     * @param TweetSearchCriteria $criteria
     * @return TweetSearchResult
     * @throws TweetSearchFailedException
     */
    public function search(TweetSearchCriteria $criteria): TweetSearchResult;
}
