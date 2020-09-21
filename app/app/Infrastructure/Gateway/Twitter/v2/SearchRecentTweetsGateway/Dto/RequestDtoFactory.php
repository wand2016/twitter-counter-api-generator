<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto;

use App\Domain\Tweet\TweetSearcher\Criteria;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\Common\Token;
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
     * @param Token|null $nextToken
     * @return RequestDto
     */
    public function createFromCriteria(
        Criteria $criteria,
        ?Token $nextToken
    ): RequestDto {
        $query = $this->queryStringifier->stringifyMatch($criteria->getMatch());

        return new RequestDto(
            $query,
            $criteria->getPeriod()->getStartDate(),
            $criteria->getPeriod()->getEndDate(),
            [new CreatedAt()],
            MaxResults::max(),
            $nextToken
        );
    }
}
