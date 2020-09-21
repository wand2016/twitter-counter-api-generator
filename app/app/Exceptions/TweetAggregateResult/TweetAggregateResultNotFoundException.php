<?php

declare(strict_types=1);

namespace App\Exceptions\TweetAggregateResult;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use Exception;
use Throwable;

/**
 * Class TweetAggregateResultNotFoundException
 * @package App\Exceptions\TweetAggregateResult
 */
class TweetAggregateResultNotFoundException extends Exception
{
    public function __construct(
        EndpointName $endpointName,
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(
            "TweetAggregateResultNotFound: {$endpointName->getValue()}",
            $code,
            $previous
        );
    }
}
