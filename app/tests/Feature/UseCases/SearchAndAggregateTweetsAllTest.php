<?php

declare(strict_types=1);

namespace Tests\Feature\UseCases;

use App\UseCases\SearchAndAggregateTweetsAll;
use Tests\TestCase;

class SearchAndAggregateTweetsAllTest extends TestCase
{
    /**
     * @var SearchAndAggregateTweetsAll
     */
    private SearchAndAggregateTweetsAll $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = $this->app->make(SearchAndAggregateTweetsAll::class);
    }

    public function testRun(): void
    {
        $this->markTestSkipped('driver');

        $this->sut->run();
    }
}
