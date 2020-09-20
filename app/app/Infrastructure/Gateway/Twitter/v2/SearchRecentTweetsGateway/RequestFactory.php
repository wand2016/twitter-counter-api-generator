<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway;

use App\Domain\Tweet\TweetSearcher\Criteria;

/**
 * Class RequestFactory
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway
 */
class RequestFactory
{
    /**
     * @var QueryStringifier
     */
    private QueryStringifier $queryStringifier;

    /**
     * RequestFactory constructor.
     * @param QueryStringifier $queryStringifier
     */
    public function __construct(QueryStringifier $queryStringifier)
    {
        $this->queryStringifier = $queryStringifier;
    }

    /**
     * @param Criteria $criteria
     * @return Request
     */
    public function createFromCriteria(Criteria $criteria): Request
    {
        $query = $this->queryStringifier->stringifyMatch($criteria->getMatch());

        // TODO: impl
        return new Request(
            $query,
            null,
            null,
            null
        );
    }
}
