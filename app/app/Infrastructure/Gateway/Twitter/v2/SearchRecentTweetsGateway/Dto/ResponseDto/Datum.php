<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDto;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\Common\Id;
use DateTimeInterface;

/**
 * singular of data field
 * Class Datum
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDto
 */
final class Datum
{
    /**
     * @var Id
     */
    private Id $id;

    /**
     * @var DateTimeInterface|null
     */
    private ?DateTimeInterface $createdAt;

    /**
     * Datum constructor.
     * @param Id $id
     * @param DateTimeInterface|null $createdAt
     */
    public function __construct(Id $id, ?DateTimeInterface $createdAt)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }
}
