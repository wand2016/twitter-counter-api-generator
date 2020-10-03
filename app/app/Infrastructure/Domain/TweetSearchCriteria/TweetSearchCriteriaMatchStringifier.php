<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\TweetSearchCriteria;

use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match;
use App\Domain\TweetSearchCriteria\TweetSearchCriteriaMatchStringifier as TweetSearchCriteriaStringifierInterface;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDtoFactory\QueryStringifier;

/**
 * Class TweetSearchCriteriaMatchStringifier
 * @package App\Infrastructure\Domain\TweetSearchCriteria
 */
class TweetSearchCriteriaMatchStringifier implements TweetSearchCriteriaStringifierInterface
{
    /**
     * @var QueryStringifier
     */
    private QueryStringifier $stringifier;

    /**
     * TweetSearchCriteriaMatchStringifier constructor.
     * @param QueryStringifier $stringifier
     */
    public function __construct(QueryStringifier $stringifier)
    {
        $this->stringifier = $stringifier;
    }

    /**
     * @param Match $match
     * @return string
     */
    public function stringify(Match $match): string
    {
        return $this->stringifier->stringifyMatch($match);
    }
}
