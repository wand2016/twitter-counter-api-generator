<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\TweetSearchAggregateResultApi;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
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
        $endpointName = new TweetSearchAggregateResultApi\EndpointName('syaroshico');
        $this->apis[$endpointName->getValue()] = new TweetSearchAggregateResultApi(
            $endpointName,
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
        $endpointName = new TweetSearchAggregateResultApi\EndpointName('cocoshico');
        $this->apis[$endpointName->getValue()] = new TweetSearchAggregateResultApi(
            $endpointName,
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
        $endpointName = new TweetSearchAggregateResultApi\EndpointName('rizeshico');
        $this->apis[$endpointName->getValue()] = new TweetSearchAggregateResultApi(
            $endpointName,
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
        $endpointName = new TweetSearchAggregateResultApi\EndpointName('chiyashico');
        $this->apis[$endpointName->getValue()] = new TweetSearchAggregateResultApi(
            $endpointName,
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
        $endpointName = new TweetSearchAggregateResultApi\EndpointName('chinoshico');
        $this->apis[$endpointName->getValue()] = new TweetSearchAggregateResultApi(
            $endpointName,
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
        $endpointName = new TweetSearchAggregateResultApi\EndpointName('syamishico');
        $this->apis[$endpointName->getValue()] = new TweetSearchAggregateResultApi(
            $endpointName,
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
        $endpointName = new TweetSearchAggregateResultApi\EndpointName('pinoshico');
        $this->apis[$endpointName->getValue()] = new TweetSearchAggregateResultApi(
            $endpointName,
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
        $endpointName = new TweetSearchAggregateResultApi\EndpointName('poposhico');
        $this->apis[$endpointName->getValue()] = new TweetSearchAggregateResultApi(
            $endpointName,
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
        $endpointName = new TweetSearchAggregateResultApi\EndpointName('ahigochi');
        $this->apis[$endpointName->getValue()] = new TweetSearchAggregateResultApi(
            $endpointName,
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
        $endpointName = new TweetSearchAggregateResultApi\EndpointName('shico-diary');
        $this->apis[$endpointName->getValue()] = new TweetSearchAggregateResultApi(
            $endpointName,
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
