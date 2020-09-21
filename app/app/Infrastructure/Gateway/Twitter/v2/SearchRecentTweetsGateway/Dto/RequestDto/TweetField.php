<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto;

/**
 * Interface TweetField
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto
 */
interface TweetField
{
    /**
     * @return string
     */
    public function getValue(): string;
}
