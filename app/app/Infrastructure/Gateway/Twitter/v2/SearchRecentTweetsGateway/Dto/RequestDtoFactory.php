<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto;

use App\Domain\Tweet\TweetSearcher\Criteria;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto\MaxResults;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto\TweetField\CreatedAt;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDtoFactory\QueryStringifier;

/**
 * Class RequestDtoFactory
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto
 */
class RequestDtoFactory
{
    /**
     * @var QueryStringifier
     */
    private QueryStringifier $queryStringifier;

    /**
     * RequestDtoFactory constructor.
     * @param QueryStringifier $queryStringifier
     */
    public function __construct(QueryStringifier $queryStringifier)
    {
        $this->queryStringifier = $queryStringifier;
    }

    /**
     * @param Criteria $criteria
     * @return RequestDto
     */
    public function createFromCriteria(Criteria $criteria): RequestDto
    {
        $query = $this->queryStringifier->stringifyMatch($criteria->getMatch());

        // TODO: impl
        return new RequestDto(
            $query,
            null,
            null,
            [new CreatedAt()],
            MaxResults::max(),
            null
        );
    }
}
