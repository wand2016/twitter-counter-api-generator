<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchCriteria;

interface TweetSearchCriteriaStringifier
{
    /**
     * @param TweetSearchCriteria $criteria
     * @return string
     */
    public function stringify(TweetSearchCriteria $criteria): string;
}
