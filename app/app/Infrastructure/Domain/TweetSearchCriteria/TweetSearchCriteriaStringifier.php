<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\TweetSearchCriteria;

use App\Domain\TweetSearchCriteria\TweetSearchCriteria;
use App\Domain\TweetSearchCriteria\TweetSearchCriteriaStringifier as TweetSearchCriteriaStringifierInterface;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDtoFactory\QueryStringifier;

/**
 * Class TweetSearchCriteriaStringifier
 * @package App\Infrastructure\Domain\TweetSearchCriteria
 */
class TweetSearchCriteriaStringifier implements TweetSearchCriteriaStringifierInterface
{
    /**
     * @var QueryStringifier
     */
    private QueryStringifier $stringifier;

    /**
     * TweetSearchCriteriaStringifier constructor.
     * @param QueryStringifier $stringifier
     */
    public function __construct(QueryStringifier $stringifier)
    {
        $this->stringifier = $stringifier;
    }

    /**
     * @param TweetSearchCriteria $criteria
     * @return string
     */
    public function stringify(TweetSearchCriteria $criteria): string
    {
        return $this->stringifier->stringifyMatch($criteria->getMatch());
    }
}
