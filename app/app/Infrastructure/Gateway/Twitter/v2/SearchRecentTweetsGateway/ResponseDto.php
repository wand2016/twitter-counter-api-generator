<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway;

use App\Exceptions\TwitterApi\SearchRecentResponseParseFailedException;

/**
 * Class ResponseDto
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway
 */
final class ResponseDto
{
    /**
     * @var string
     */
    private string $raw;

    /**
     * ResponseDto constructor.
     * @param string $raw
     */
    private function __construct(string $raw)
    {
        $this->raw = $raw;
    }

    /**
     * @param string $raw
     * @return static
     * @throws SearchRecentResponseParseFailedException
     */
    public static function createFromResponseContents(string $raw): self
    {
        return new static(
            $raw
        );
    }

    /**
     * TODO: delete
     * @return string
     */
    public function getRaw(): string
    {
        return $this->raw;
    }
}
