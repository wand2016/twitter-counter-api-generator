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
        return $this->doStringifyMatch($match, true);
    }

    /**
     * @param Match $match
     * @param bool $topLevel
     * @return string
     */
    private function doStringifyMatch(Match $match, bool $topLevel = false): string
    {
        if ($match instanceof Match\LogicalAnd) {
            return $this->stringifyLogicalAnd($match, $topLevel);
        }
        if ($match instanceof Match\LogicalOr) {
            return $this->stringifyLogicalOr($match, $topLevel);
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
     * @param bool $topLevel
     * @return string
     */
    private function stringifyLogicalAnd(Match\LogicalAnd $logicalAnd, bool $topLevel = false): string
    {
        $ret = collect($logicalAnd->getChildren())
            ->map(
                function (Match $child): string {
                    return $this->doStringifyMatch($child);
                }
            )
            ->join(' ');

        return $topLevel ? $ret : sprintf('%s', $ret);
    }

    /**
     * @param Match\LogicalOr $logicalOr
     * @param bool $topLevel
     * @return string
     */
    private function stringifyLogicalOr(Match\LogicalOr $logicalOr, bool $topLevel = false): string
    {
        $ret = collect($logicalOr->getChildren())
            ->map(
                function (Match $child): string {
                    return $this->doStringifyMatch($child);
                }
            )
            ->join(' OR ');

        return $topLevel ? $ret : sprintf('(%s)', $ret);
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
