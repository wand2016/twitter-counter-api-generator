<?php

declare(strict_types=1);

namespace App\Exceptions\TwitterApi;

use Exception;
use Throwable;

/**
 * Class SearchRecentResponseParseFailedException
 * @package App\Exceptions\TwitterApi
 */
class SearchRecentResponseParseFailedException extends Exception
{
    public function __construct(string $rawResponseContents, $code = 0, Throwable $previous = null)
    {
        $message = 'failed to parse tweet search results: ' . $rawResponseContents;

        parent::__construct($message, $code, $previous);
    }
}
