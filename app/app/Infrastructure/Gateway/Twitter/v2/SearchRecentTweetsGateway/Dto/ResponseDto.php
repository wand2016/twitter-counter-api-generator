<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDto\Datum;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDto\Meta;

/**
 * Class ResponseDto
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto
 */
final class ResponseDto
{
    /**
     * @var iterable|Datum[]
     */
    private iterable $data;

    /**
     * @var Meta
     */
    private Meta $meta;

    /**
     * ResponseDto constructor.
     * @param Datum[]|iterable $data
     * @param Meta $meta
     */
    public function __construct($data, Meta $meta)
    {
        $this->data = $data;
        $this->meta = $meta;
    }

    /**
     * @return Datum[]|iterable
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return Meta
     */
    public function getMeta(): Meta
    {
        return $this->meta;
    }
}
