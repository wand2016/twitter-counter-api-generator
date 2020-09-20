<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Request;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Response;

/**
 * Class SearchRecentTweetsGateway
 * @package App\Infrastructure\Gateway\Twitter\v2
 */
class SearchRecentTweetsGateway
{
    /**
     * @param Request $request
     * @return Response
     * TODO: specify throws
     */
    public function call(Request $request): Response
    {
        // TODO: impl
        return new Response();
    }
}
