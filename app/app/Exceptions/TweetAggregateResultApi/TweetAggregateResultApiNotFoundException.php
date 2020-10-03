<?php

declare(strict_types=1);

namespace App\Exceptions\TweetAggregateResultApi;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use Exception;
use Throwable;

/**
 * Class TweetAggregateResultApiNotFoundException
 * @package App\Exceptions\TweetAggregateResultApi
 */
class TweetAggregateResultApiNotFoundException extends Exception
{
    public function __construct(
        EndpointName $endpointName,
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(
            "TweetAggregateResultApiNotFound: {$endpointName->getValue()}",
            $code,
            $previous
        );
    }
}
