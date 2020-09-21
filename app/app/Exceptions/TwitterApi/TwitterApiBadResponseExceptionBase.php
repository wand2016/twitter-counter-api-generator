<?php

declare(strict_types=1);

namespace App\Exceptions\TwitterApi;

use Exception;
use GuzzleHttp\Exception\BadResponseException;

/**
 * Class TwitterApiBadResponseExceptionBase
 * @package App\Exceptions\TwitterApi
 */
abstract class TwitterApiBadResponseExceptionBase extends Exception
{
    /**
     * TwitterApiBadResponseExceptionBase constructor.
     * @param BadResponseException $exception
     */
    public function __construct(BadResponseException $exception)
    {
        $response = $exception->getResponse();

        $message = $response ? $response->getBody()->getContents() : 'no response';
        $code = $response ? $response->getStatusCode() : 0;

        parent::__construct($message, $code, $exception);
    }
}
