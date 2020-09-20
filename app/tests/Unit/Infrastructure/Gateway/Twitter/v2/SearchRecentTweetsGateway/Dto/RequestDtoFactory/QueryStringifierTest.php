<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDtoFactory;

use App\Domain\Tweet\TweetSearcher\Criteria\Match;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDtoFactory\QueryStringifier;
use PHPUnit\Framework\TestCase;

class QueryStringifierTest extends TestCase
{
    /**
     * @var QueryStringifier
     */
    private QueryStringifier $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new QueryStringifier();
    }

    /**
     * @param Match $match
     * @param string $queryStringExpected
     * @dataProvider dataProvider
     */
    public function testStringifyMatch(
        Match $match,
        string $queryStringExpected
    ): void {
        $this->assertSame(
            $queryStringExpected,
            $this->sut->stringifyMatch($match)
        );
    }

    /**
     * @return iterable
     */
    public function dataProvider(): iterable
    {
        yield 'simple' => [
            'match' => new Match\LogicalAnd(
                new Match\Account('d_horiyama_ota'),
                new Match\Keyword('#しこにっき')
            ),
            'queryStringExpected' => 'from:d_horiyama_ota #しこにっき',
        ];

        yield 'only single keyword' => [
            'match' => new Match\Keyword('syaroshico'),
            'queryStringExpected' => 'syaroshico',
        ];

        yield 'only multiple keyword' => [
            'match' => new Match\LogicalOr(
                new Match\Keyword('syaroshico'),
                new Match\Keyword('シャロシコ')
            ),
            'queryStringExpected' => 'syaroshico OR シャロシコ',
        ];

        yield 'multiple tweeters' => [
            'match' => new Match\LogicalAnd(
                new Match\LogicalOr(
                    new Match\Account('d_horiyama_ota'),
                    new Match\Account('d_horiyama_core'),
                ),
                new Match\Keyword('#しこにっき'),
            ),
            'queryStringExpected' => '(from:d_horiyama_ota OR from:d_horiyama_core) #しこにっき',
        ];

        yield 'multiple keywords' => [
            'match' => new Match\LogicalAnd(
                new Match\Account('d_horiyama_ota'),
                new Match\LogicalOr(
                    new Match\Keyword('syaroshico'),
                    new Match\Keyword('シャロシコ')
                )
            ),
            'queryStringExpected' => 'from:d_horiyama_ota (syaroshico OR シャロシコ)',
        ];

        yield 'complex keywords' => [
            'match' => new Match\LogicalAnd(
                new Match\Account('d_horiyama_ota'),
                new Match\LogicalAnd(
                    new Match\Keyword('ごちうさ'),
                    new Match\LogicalOr(
                        new Match\Keyword('チヤシコ'),
                        new Match\Keyword('chiyashico')
                    )
                )
            ),
            'queryStringExpected' => 'from:d_horiyama_ota ごちうさ (チヤシコ OR chiyashico)',
        ];
    }
}
