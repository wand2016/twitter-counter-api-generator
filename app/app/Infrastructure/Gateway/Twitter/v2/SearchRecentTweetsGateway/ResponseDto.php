<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway;

/**
 * Class ResponseDto
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway
 */
class ResponseDto
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
     * @return static
     */
    public static function createFromResponseContents(string $raw): self
    {
        return new self(
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
