<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto;

use App\Exceptions\TwitterApi\SearchRecentResponseParseFailedException;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\Common\Id;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\Common\Token;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDto\Datum;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDto\Meta;
use DateTimeImmutable;
use Exception;
use stdClass;

/**
 * Class ResponseDtoFactory
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto
 */
class ResponseDtoFactory
{
    /**
     * @param string $rawResponseBodyContents
     * @return ResponseDto
     * @throws SearchRecentResponseParseFailedException
     */
    public function parseResponseBodyContents(string $rawResponseBodyContents): ResponseDto
    {
        try {
            $contents = json_decode($rawResponseBodyContents);

            $data = collect($contents->data ?? [])
                ->map(
                    function (stdClass $tuple): Datum {
                        return new Datum(
                            new Id($tuple->id),
                            $tuple->text,
                            isset($tuple->created_at) ? new DateTimeImmutable($tuple->created_at) : null
                        );
                    }
                );
            $meta = new Meta(
                new Id($contents->meta->newest_id ?? ''),
                new Id($contents->meta->oldest_id ?? ''),
                $contents->meta->result_count,
                isset($contents->meta->next_token) ? (new Token($contents->meta->next_token)) : null
            );

            return new ResponseDto($data, $meta);
        } catch (Exception $e) {
            throw new SearchRecentResponseParseFailedException($rawResponseBodyContents, 0, $e);
        }
    }
}
