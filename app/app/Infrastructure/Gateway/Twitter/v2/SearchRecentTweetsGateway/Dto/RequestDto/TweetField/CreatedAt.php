<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto\TweetField;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto\TweetField;

/**
 * Class CreatedAt
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto\TweetField
 */
class CreatedAt implements TweetField
{
    /**
     * @return string
     */
    public function getValue(): string
    {
        return 'created_at';
    }
}
