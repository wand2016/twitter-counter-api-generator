<?php

declare(strict_types=1);

namespace App\Exceptions\TwitterApi;

use Exception;
use Throwable;

/**
 * Class AuthorizationTokenParseFailedException
 * @package App\Exceptions\TwitterApi
 */
class AuthorizationTokenParseFailedException extends Exception
{
    public function __construct(string $rawResponseContents, $code = 0, Throwable $previous = null)
    {
        $message = 'failed to parse authorization token: ' . $rawResponseContents;

        parent::__construct($message, $code, $previous);
    }
}
