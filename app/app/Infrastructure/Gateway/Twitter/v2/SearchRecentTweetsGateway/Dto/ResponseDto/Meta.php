<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDto;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\Common\Id;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\Common\Token;

/**
 * Class Meta
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDto
 */
final class Meta
{
    /**
     * @var Id
     */
    private Id $newestId;

    /**
     * @var Id
     */
    private Id $oldestId;

    /**
     * @var int
     */
    private int $resultCount;

    /**
     * non-null when chunked
     * @var Token|null
     */
    private ?Token $nextToken;

    /**
     * Meta constructor.
     * @param Id $newestId
     * @param Id $oldestId
     * @param int $resultCount
     * @param Token|null $nextToken
     */
    public function __construct(Id $newestId, Id $oldestId, int $resultCount, ?Token $nextToken)
    {
        $this->newestId = $newestId;
        $this->oldestId = $oldestId;
        $this->resultCount = $resultCount;
        $this->nextToken = $nextToken;
    }

    /**
     * @return Id
     */
    public function getNewestId(): Id
    {
        return $this->newestId;
    }

    /**
     * @return Id
     */
    public function getOldestId(): Id
    {
        return $this->oldestId;
    }

    /**
     * @return int
     */
    public function getResultCount(): int
    {
        return $this->resultCount;
    }

    /**
     * @return Token|null
     */
    public function getNextToken(): ?Token
    {
        return $this->nextToken;
    }
}
