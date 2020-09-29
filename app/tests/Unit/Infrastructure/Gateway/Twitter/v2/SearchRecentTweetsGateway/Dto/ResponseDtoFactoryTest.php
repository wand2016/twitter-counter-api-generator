<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDtoFactory;
use PHPUnit\Framework\TestCase;

class ResponseDtoFactoryTest extends TestCase
{
    private ResponseDtoFactory $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new ResponseDtoFactory();
    }

    public function testParseResponseBodyContentsEmpty(): void
    {
        $result = $this->sut->parseResponseBodyContents(
            '{"meta":{"result_count":0}}'
        );

        $this->assertCount(
            0,
            $result->getData()
        );
    }

    public function testParseResponseBodyContents(): void
    {
        $result = $this->sut->parseResponseBodyContents(
        // phpcs:ignore Generic.Files.LineLength
            '{"data":[{"created_at":"2020-09-29T15:00:03.000Z","id":"1310957520228429833","text":"2020年9月30日\nごちうさキャラ&amp;中の人カウントダウン\n#青山ブルーマウンテン生誕祭2020 まであと27日\n#水瀬いのり生誕祭2020 まであと63日"}],"meta":{"newest_id":"1310957520228429833","oldest_id":"1310957520228429833","result_count":1}}'
        );

        $this->assertCount(
            1,
            $result->getData()
        );
    }
}
