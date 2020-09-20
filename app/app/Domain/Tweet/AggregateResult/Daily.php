<?php

declare(strict_type=1);

namespace App\Domain\Tweet\AggregateResult;

use App\Domain\Tweet\Date\Date;
use DomainException;

/**
 * Class Daily
 * @package App\Domain\Tweet\AggregateResult
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
            throw new DomainException('$count must be positive');
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
