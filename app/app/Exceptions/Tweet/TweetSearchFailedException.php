<?php

declare(strict_types=1);

namespace App\Exceptions\Tweet;

use Exception;
use Throwable;

/**
 * Class TweetSearchFailedException
 * @package App\Exceptions\Tweet
 */
class TweetSearchFailedException extends Exception
{
    /**
     * TweetSearchFailedException constructor.
     * @param Throwable $previous
     */
    public function __construct(Throwable $previous)
    {
        parent::__construct('tweet search failed', 0, $previous);
    }
}
