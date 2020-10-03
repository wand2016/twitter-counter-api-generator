<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\TweetSearchAggregateResultApi;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\Id;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApiRepository as RepositoryInterface;
use App\Domain\TweetSearchCriteria\TweetSearchCriteria;
use App\Exceptions\TweetAggregateResultApi\TweetAggregateResultApiNotFoundException;

/**
 * Class TweetSearchAggregateResultApiRepository
 * @package App\Infrastructure\Domain\TweetSearchAggregateResultApi
 */
class TweetSearchAggregateResultApiRepository implements RepositoryInterface
{
    /**
     * まだ仮実装のmock
     * @var TweetSearchAggregateResultApi[]
     */
    private array $apis = [];

    /**
     * TweetSearchAggregateResultApiRepository constructor.
     */
    public function __construct()
    {
        $this->putSyaroshico();
        $this->putCocoshico();
        $this->putRizeshico();
        $this->putChiyashico();
        $this->putChinoshico();
        $this->putSyamishico();
        $this->putPinoshico();
        $this->putPoposhico();
        $this->putShicoDiary();
        $this->putAhigochi();
    }


    /**
     * @inheritDoc
     */
    public function findByEndpointName(EndpointName $endpointName): TweetSearchAggregateResultApi
    {
        $ret = collect($this->apis)
            ->first(
                function (TweetSearchAggregateResultApi $api) use ($endpointName) {
                    return $api->getEndpointName()->equals($endpointName);
                }
            );

        if (!$ret) {
            throw new TweetAggregateResultApiNotFoundException($endpointName);
        }

        return $ret;
    }

    /**
     * @inheritDoc
     */
    public function findAll(): iterable
    {
        return $this->apis;
    }

    protected function putSyaroshico(): void
    {
        $id = new Id('11111111-1111-1111-1111-111111111111');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('syaroshico'),
            new TweetSearchCriteria(
                new TweetSearchCriteria\Match\LogicalAnd(
                    new TweetSearchCriteria\Match\LogicalOr(
                        new TweetSearchCriteria\Match\Keyword('シャロシコ'),
                        new TweetSearchCriteria\Match\Keyword('ｼｬﾛｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('syaroshico'),
                        new TweetSearchCriteria\Match\Keyword('#シャロシコ'),
                        new TweetSearchCriteria\Match\Keyword('#ｼｬﾛｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('#syaroshico')
                    ),
                    new TweetSearchCriteria\Match\NotRetweet()
                ),
                TweetSearchCriteria\Period::unbound()
            )
        );
    }

    protected function putCocoshico(): void
    {
        $id = new Id('22222222-2222-2222-2222-222222222222');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('cocoshico'),
            new TweetSearchCriteria(
                new TweetSearchCriteria\Match\LogicalAnd(
                    new TweetSearchCriteria\Match\LogicalOr(
                        new TweetSearchCriteria\Match\Keyword('ココシコ'),
                        new TweetSearchCriteria\Match\Keyword('ｺｺｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('シココア'),
                        new TweetSearchCriteria\Match\Keyword('ｼｺｺｱ'),
                        new TweetSearchCriteria\Match\Keyword('shicocoa'),
                        new TweetSearchCriteria\Match\Keyword('#ココシコ'),
                        new TweetSearchCriteria\Match\Keyword('#ｺｺｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('#シココア'),
                        new TweetSearchCriteria\Match\Keyword('#ｼｺｺｱ'),
                        new TweetSearchCriteria\Match\Keyword('#shicocoa'),
                    ),
                    new TweetSearchCriteria\Match\NotRetweet()
                ),
                TweetSearchCriteria\Period::unbound()
            )
        );
    }

    protected function putRizeshico(): void
    {
        $id = new Id('33333333-3333-3333-3333-333333333333');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('rizeshico'),
            new TweetSearchCriteria(
                new TweetSearchCriteria\Match\LogicalAnd(
                    new TweetSearchCriteria\Match\LogicalOr(
                        new TweetSearchCriteria\Match\Keyword('リゼシコ'),
                        new TweetSearchCriteria\Match\Keyword('ﾘｾﾞｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('rizeshico'),
                        new TweetSearchCriteria\Match\Keyword('#リゼシコ'),
                        new TweetSearchCriteria\Match\Keyword('#ﾘｾﾞｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('#rizeshico'),
                    ),
                    new TweetSearchCriteria\Match\NotRetweet()
                ),
                TweetSearchCriteria\Period::unbound()
            )
        );
    }

    protected function putChiyashico(): void
    {
        $id = new Id('44444444-4444-4444-4444-444444444444');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('chiyashico'),
            new TweetSearchCriteria(
                new TweetSearchCriteria\Match\LogicalAnd(
                    new TweetSearchCriteria\Match\LogicalOr(
                        new TweetSearchCriteria\Match\Keyword('チヤシコ'),
                        new TweetSearchCriteria\Match\Keyword('ﾁﾔｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('千夜シコ'),
                        new TweetSearchCriteria\Match\Keyword('千夜ｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('chiyashico'),
                        new TweetSearchCriteria\Match\Keyword('#チヤシコ'),
                        new TweetSearchCriteria\Match\Keyword('#ﾁﾔｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('#千夜シコ'),
                        new TweetSearchCriteria\Match\Keyword('#千夜ｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('#chiyashico'),
                    ),
                    new TweetSearchCriteria\Match\NotRetweet()
                ),
                TweetSearchCriteria\Period::unbound()
            )
        );
    }

    protected function putChinoshico(): void
    {
        $id = new Id('55555555-5555-5555-5555-555555555555');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('chinoshico'),
            new TweetSearchCriteria(
                new TweetSearchCriteria\Match\LogicalAnd(
                    new TweetSearchCriteria\Match\LogicalOr(
                        new TweetSearchCriteria\Match\Keyword('チノシコ'),
                        new TweetSearchCriteria\Match\Keyword('ﾁﾉｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('chinoshico'),
                        new TweetSearchCriteria\Match\Keyword('#チノシコ'),
                        new TweetSearchCriteria\Match\Keyword('#ﾁﾉｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('#chinoshico'),
                    ),
                    new TweetSearchCriteria\Match\NotRetweet()
                ),
                TweetSearchCriteria\Period::unbound()
            )
        );
    }

    protected function putSyamishico(): void
    {
        $id = new Id('66666666-6666-6666-6666-666666666666');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('syamishico'),
            new TweetSearchCriteria(
                new TweetSearchCriteria\Match\LogicalAnd(
                    new TweetSearchCriteria\Match\LogicalOr(
                        new TweetSearchCriteria\Match\Keyword('シャミシコ'),
                        new TweetSearchCriteria\Match\Keyword('ｼｬﾐｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('syamishico'),
                        new TweetSearchCriteria\Match\Keyword('#シャミシコ'),
                        new TweetSearchCriteria\Match\Keyword('#ｼｬﾐｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('#syamishico'),
                    ),
                    new TweetSearchCriteria\Match\NotRetweet()
                ),
                TweetSearchCriteria\Period::unbound()
            )
        );
    }

    protected function putPinoshico(): void
    {
        $id = new Id('77777777-7777-7777-7777-777777777777');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('pinoshico'),
            new TweetSearchCriteria(
                new TweetSearchCriteria\Match\LogicalAnd(
                    new TweetSearchCriteria\Match\LogicalOr(
                        new TweetSearchCriteria\Match\Keyword('ぴのシコ'),
                        new TweetSearchCriteria\Match\Keyword('ぴのｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('pinoshico'),
                        new TweetSearchCriteria\Match\Keyword('#ぴのシコ'),
                        new TweetSearchCriteria\Match\Keyword('#ぴのｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('#pinoshico'),
                    ),
                    new TweetSearchCriteria\Match\NotRetweet()
                ),
                TweetSearchCriteria\Period::unbound()
            )
        );
    }

    protected function putPoposhico(): void
    {
        $id = new Id('88888888-8888-8888-8888-888888888888');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('poposhico'),
            new TweetSearchCriteria(
                new TweetSearchCriteria\Match\LogicalAnd(
                    new TweetSearchCriteria\Match\LogicalOr(
                        new TweetSearchCriteria\Match\Keyword('ぽぽろんシコ'),
                        new TweetSearchCriteria\Match\Keyword('ぽぽろんｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('ぽぽシコ'),
                        new TweetSearchCriteria\Match\Keyword('ぽぽｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('poporonshico'),
                        new TweetSearchCriteria\Match\Keyword('poposhico'),
                        new TweetSearchCriteria\Match\Keyword('#ぽぽろんシコ'),
                        new TweetSearchCriteria\Match\Keyword('#ぽぽろんｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('#ぽぽシコ'),
                        new TweetSearchCriteria\Match\Keyword('#ぽぽｼｺ'),
                        new TweetSearchCriteria\Match\Keyword('#poporonshico'),
                        new TweetSearchCriteria\Match\Keyword('#poposhico'),
                    ),
                    new TweetSearchCriteria\Match\NotRetweet()
                ),
                TweetSearchCriteria\Period::unbound()
            )
        );
    }

    protected function putAhigochi(): void
    {
        $id = new Id('eeeeeeee-eeee-eeee-eeee-eeeeeeeeeeee');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('ahigochi'),
            new TweetSearchCriteria(
                new TweetSearchCriteria\Match\LogicalAnd(
                    new TweetSearchCriteria\Match\LogicalOr(
                        new TweetSearchCriteria\Match\Keyword('あひごち'),
                        new TweetSearchCriteria\Match\Keyword('#あひごち'),
                        new TweetSearchCriteria\Match\Keyword('ahigochi'),
                        new TweetSearchCriteria\Match\Keyword('#ahigochi'),
                    ),
                    new TweetSearchCriteria\Match\NotRetweet()
                ),
                TweetSearchCriteria\Period::unbound()
            )
        );
    }

    protected function putShicoDiary(): void
    {
        $id = new Id('99999999-9999-9999-9999-999999999999');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('shico-diary'),
            new TweetSearchCriteria(
                new TweetSearchCriteria\Match\LogicalAnd(
                    new TweetSearchCriteria\Match\LogicalOr(
                        new TweetSearchCriteria\Match\Account('d_horiyama_core'),
                        new TweetSearchCriteria\Match\Account('d_horiyama_ota'),
                    ),
                    new TweetSearchCriteria\Match\Keyword('#しこにっき'),
                ),
                TweetSearchCriteria\Period::unbound()
            )
        );
    }
}
