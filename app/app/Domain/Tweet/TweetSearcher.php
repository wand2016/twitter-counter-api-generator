<?php

declare(strict_types=1);

namespace App\Domain\Tweet;

use App\Domain\Tweet\TweetSearcher\Criteria;
use App\Exceptions\Tweet\TweetSearchException;

/**
 * Interface TweetSearcher
 * @package App\Domain\Tweet
 */
interface TweetSearcher
{
    /**
     * @param Criteria $criteria
     * @return TweetCollection
     * @throws TweetSearchException
     */
    public function search(Criteria $criteria): TweetCollection;
}
