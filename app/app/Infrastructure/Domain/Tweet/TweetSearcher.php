<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\Tweet;

use App\Domain\Tweet\TweetCollection;
use App\Domain\Tweet\TweetSearcher as TweetSearcherInterface;
use App\Domain\Tweet\TweetSearcher\Criteria;

/**
 * Class TweetSearcher
 * @package App\Infrastructure\Domain\Tweet
 */
class TweetSearcher implements TweetSearcherInterface
{
    /**
     * @inheritDoc
     */
    public function search(Criteria $criteria): TweetCollection
    {
        // stub
        // TODO: impl
        return new TweetCollection();
    }
}
