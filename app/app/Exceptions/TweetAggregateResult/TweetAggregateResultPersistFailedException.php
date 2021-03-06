<?php

declare(strict_types=1);

namespace App\Exceptions\TweetAggregateResult;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use Exception;
use Throwable;

/**
 * Class TweetAggregateResultPersistFailedException
 * @package App\Exceptions\TweetAggregateResult
 */
class TweetAggregateResultPersistFailedException extends Exception
{
    /**
     * TweetAggregateResultPersistFailedException constructor.
     * @param EndpointName $endpointName
     * @param string $rawContent
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        EndpointName $endpointName,
        string $rawContent,
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(
            'failed to persist AggregateResult.' .
            "EndpointName: {$endpointName->getValue()}," .
            "RawContent: {$rawContent}",
            $code,
            $previous
        );
    }
}
