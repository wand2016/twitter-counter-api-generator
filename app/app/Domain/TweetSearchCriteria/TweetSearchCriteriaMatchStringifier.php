<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchCriteria;

use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match;

interface TweetSearchCriteriaMatchStringifier
{
    /**
     * @param Match $match
     * @return string
     */
    public function stringify(Match $match): string;
}
