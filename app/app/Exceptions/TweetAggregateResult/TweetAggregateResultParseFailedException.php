<?php

declare(strict_types=1);

namespace App\Exceptions\TweetAggregateResult;

use Exception;
use Throwable;

/**
 * Class TweetAggregateResultParseFailedException
 * @package App\Exceptions\TweetAggregateResult
 */
class TweetAggregateResultParseFailedException extends Exception
{
    /**
     * TweetAggregateResultParseFailedException constructor.
     * @param string $rawContent
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $rawContent, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            "failed to parse AggregateResult: ${$rawContent}",
            $code,
            $previous
        );
    }
}
