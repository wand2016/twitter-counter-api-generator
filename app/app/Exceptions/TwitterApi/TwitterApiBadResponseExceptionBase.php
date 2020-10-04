<?php

declare(strict_types=1);

namespace App\Exceptions\TwitterApi;

use Exception;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class TwitterApiBadResponseExceptionBase
 * @package App\Exceptions\TwitterApi
 */
abstract class TwitterApiBadResponseExceptionBase extends Exception
{
    /**
     * @param GuzzleException $e
     * @return static
     */
    final public static function createFromGuzzleException(GuzzleException $e): self
    {
        if ($e instanceof BadResponseException) {
            return self::createFromBadResponseException($e);
        }

        /** @phpstan-ignore-next-line */
        return new static(
            $e->getMessage(),
            $e->getCode(),
            $e
        );
    }

    /**
     * @param BadResponseException $e
     * @return static
     */
    private static function createFromBadResponseException(
        BadResponseException $e
    ): self {
        $response = $e->getResponse();

        /** @phpstan-ignore-next-line */
        return new static(
            $response ? $response->getBody()->getContents() : 'no response',
            $response ? $response->getStatusCode() : 0,
            $e
        );
    }
}
