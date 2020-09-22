<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\TweetSearchAggregateResultApi;

use App\Domain\Tweet\TweetSearcher\Criteria;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\Id;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApiRepository as RepositoryInterface;
use BadMethodCallException;

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
        $this->putShicoDiary();
        $this->putAhigochi();
    }


    /**
     * @inheritDoc
     */
    public function findById(Id $id): TweetSearchAggregateResultApi
    {
        // TODO: Implement findById() method.
        throw new BadMethodCallException('not implemented yet');
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
            new Criteria(
                new Criteria\Match\LogicalAnd(
                    new Criteria\Match\LogicalOr(
                        new Criteria\Match\Keyword('シャロシコ'),
                        new Criteria\Match\Keyword('syaroshico')
                    ),
                    new Criteria\Match\NotRetweet()
                ),
                Criteria\Period::unbound()
            )
        );
    }

    protected function putCocoshico(): void
    {
        $id = new Id('22222222-2222-2222-2222-222222222222');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('cocoshico'),
            new Criteria(
                new Criteria\Match\LogicalAnd(
                    new Criteria\Match\LogicalOr(
                        new Criteria\Match\Keyword('ココシコ'),
                        new Criteria\Match\Keyword('シココア'),
                        new Criteria\Match\Keyword('shicocoa'),
                    ),
                    new Criteria\Match\NotRetweet()
                ),
                Criteria\Period::unbound()
            )
        );
    }

    protected function putRizeshico(): void
    {
        $id = new Id('33333333-3333-3333-3333-333333333333');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('rizeshico'),
            new Criteria(
                new Criteria\Match\LogicalAnd(
                    new Criteria\Match\LogicalOr(
                        new Criteria\Match\Keyword('リゼシコ'),
                        new Criteria\Match\Keyword('rizeshico'),
                    ),
                    new Criteria\Match\NotRetweet()
                ),
                Criteria\Period::unbound()
            )
        );
    }

    protected function putChiyashico(): void
    {
        $id = new Id('44444444-4444-4444-4444-444444444444');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('chiyashico'),
            new Criteria(
                new Criteria\Match\LogicalAnd(
                    new Criteria\Match\LogicalOr(
                        new Criteria\Match\Keyword('チヤシコ'),
                        new Criteria\Match\Keyword('千夜シコ'),
                        new Criteria\Match\Keyword('chiyashico'),
                    ),
                    new Criteria\Match\NotRetweet()
                ),
                Criteria\Period::unbound()
            )
        );
    }

    protected function putChinoshico(): void
    {
        $id = new Id('55555555-5555-5555-5555-555555555555');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('chinoshico'),
            new Criteria(
                new Criteria\Match\LogicalAnd(
                    new Criteria\Match\LogicalOr(
                        new Criteria\Match\Keyword('チノシコ'),
                        new Criteria\Match\Keyword('chinoshico'),
                    ),
                    new Criteria\Match\NotRetweet()
                ),
                Criteria\Period::unbound()
            )
        );
    }

    protected function putSyamishico(): void
    {
        $id = new Id('66666666-6666-6666-6666-666666666666');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('syamishico'),
            new Criteria(
                new Criteria\Match\LogicalAnd(
                    new Criteria\Match\LogicalOr(
                        new Criteria\Match\Keyword('シャミシコ'),
                        new Criteria\Match\Keyword('syamishico'),
                    ),
                    new Criteria\Match\NotRetweet()
                ),
                Criteria\Period::unbound()
            )
        );
    }

    protected function putAhigochi(): void
    {
        $id = new Id('eeeeeeee-eeee-eeee-eeee-eeeeeeeeeeee');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('ahigochi'),
            new Criteria(
                new Criteria\Match\LogicalAnd(
                    new Criteria\Match\LogicalOr(
                        new Criteria\Match\Keyword('あひごち'),
                        new Criteria\Match\Keyword('#あひごち'),
                        new Criteria\Match\Keyword('ahigochi'),
                        new Criteria\Match\Keyword('#ahigochi'),
                    ),
                    new Criteria\Match\NotRetweet()
                ),
                Criteria\Period::unbound()
            )
        );
    }

    protected function putShicoDiary(): void
    {
        $id = new Id('99999999-9999-9999-9999-999999999999');
        $this->apis[$id->getValue()] = new TweetSearchAggregateResultApi(
            $id,
            new TweetSearchAggregateResultApi\EndpointName('shico-diary'),
            new Criteria(
                new Criteria\Match\LogicalAnd(
                    new Criteria\Match\LogicalOr(
                        new Criteria\Match\Account('d_horiyama_core'),
                        new Criteria\Match\Account('d_horiyama_ota'),
                    ),
                    new Criteria\Match\Keyword('#しこにっき'),
                ),
                Criteria\Period::unbound()
            )
        );
    }
}
