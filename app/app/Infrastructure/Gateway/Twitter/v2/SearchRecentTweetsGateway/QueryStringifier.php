<?php

declare(strict_type=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway;

use App\Domain\Tweet\TweetSearcher\Criteria\Match;
use InvalidArgumentException;

/**
 * TODO: percent encoding ?
 * Class QueryStringifier
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway
 */
class QueryStringifier
{
    /**
     * @param Match $match
     * @return string
     */
    public function stringifyMatch(Match $match): string
    {
        if ($match instanceof Match\LogicalAnd) {
            return $this->stringifyLogicalAnd($match);
        }
        if ($match instanceof Match\LogicalOr) {
            return $this->stringifyLogicalOr($match);
        }
        if ($match instanceof Match\Keyword) {
            return $this->stringifyKeyword($match);
        }
        if ($match instanceof Match\Account) {
            return $this->stringifyAccount($match);
        }

        throw new InvalidArgumentException('unprocessable Match object: ' . get_class($match));
    }

    /**
     * @param Match\LogicalAnd $logicalAnd
     * @return string
     */
    private function stringifyLogicalAnd(Match\LogicalAnd $logicalAnd): string
    {
        return collect($logicalAnd->getChildren())
            ->map(
                function (Match $child): string {
                    return $this->stringifyMatch($child);
                }
            )
            ->join(' ');
    }

    /**
     * @param Match\LogicalOr $logicalOr
     * @return string
     */
    private function stringifyLogicalOr(Match\LogicalOr $logicalOr): string
    {
        return collect($logicalOr->getChildren())
            ->map(
                function (Match $child): string {
                    return sprintf('(%s)', $this->stringifyMatch($child));
                }
            )
            ->join(' OR ');
    }

    /**
     * @param Match\Keyword $keyword
     * @return string
     */
    private function stringifyKeyword(Match\Keyword $keyword): string
    {
        return $keyword->getValue();
    }

    /**
     * @param Match\Account $account
     * @return string
     */
    private function stringifyAccount(Match\Account $account): string
    {
        return "from:{$account->getValue()}";
    }
}
