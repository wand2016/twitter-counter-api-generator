<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto;

use App\Exceptions\TwitterApi\SearchRecentResponseParseFailedException;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\Common\Id;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDto\Datum;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDto\Meta;
use DateTimeImmutable;
use Psr\Http\Message\ResponseInterface;
use stdClass;

/**
 * Class ResponseDtoFactory
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto
 */
class ResponseDtoFactory
{
    /**
     * @param ResponseInterface $psrResponse
     * @return ResponseDto
     * @throws SearchRecentResponseParseFailedException
     */
    public function parsePsrResponseContents(ResponseInterface $psrResponse): ResponseDto
    {
        $raw = $psrResponse->getBody()->getContents();
        var_export($raw);

        $contents = json_decode($raw);

        $data = collect($contents->data)
            ->map(
                function (stdClass $tuple): Datum {
                    return new Datum(
                        new Id($tuple->id),
                        $tuple->created_at ? new DateTimeImmutable($tuple->created_at) : null
                    );
                }
            );
        $meta = new Meta(
            new Id($contents->meta->newest_id),
            new Id($contents->meta->oldest_id),
            $contents->meta->result_count
        );

        return new ResponseDto($data, $meta);
    }
}
