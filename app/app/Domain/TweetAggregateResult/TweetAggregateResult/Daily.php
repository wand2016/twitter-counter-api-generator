<?php

declare(strict_types=1);

namespace App\Domain\TweetAggregateResult\TweetAggregateResult;

use App\Domain\TweetAggregateResult\TweetAggregateResult\Daily\Date;
use DomainException;

/**
 * Class Daily
 * @package App\Domain\TweetAggregateResult\TweetAggregateResult
 */
class Daily
{
    /**
     * @var Date
     */
    private Date $date;

    /**
     * invariant: positive
     * @var int
     */
    private int $count;

    /**
     * Daily constructor.
     * @param Date $date
     * @param int $count
     */
    public function __construct(Date $date, int $count)
    {
        if ($count < 0) {
            throw new DomainException('$count must be zero or positive');
        }

        $this->date = $date;
        $this->count = $count;
    }

    /**
     * @return Date
     */
    public function getDate(): Date
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}
