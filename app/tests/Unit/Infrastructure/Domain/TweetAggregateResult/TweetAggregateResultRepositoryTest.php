<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Domain\TweetAggregateResult;

use App\Domain\TweetAggregateResult\TweetAggregateResult;
use App\Domain\TweetAggregateResult\TweetAggregateResult\Daily;
use App\Domain\TweetAggregateResult\TweetAggregateResult\Daily\Date;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match\Keyword;
use App\Exceptions\TweetAggregateResult\TweetAggregateResultNotFoundException;
use App\Infrastructure\Domain\TweetAggregateResult\TweetAggregateResultRepository;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TweetAggregateResultRepositoryTest extends TestCase
{
    private const FIXTURE_FILENAME = 'syaroshico.json';

    /**
     * @var TweetAggregateResultRepository
     */
    private TweetAggregateResultRepository $sut;

    /**
     * @var S3Client
     */
    private S3Client $s3client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = $this->app->make(TweetAggregateResultRepository::class);

        $this->s3client = new S3Client(
            [
                'version' => '2006-03-01',
            ] + config()->get('filesystems.disks.s3')
        );

        $this->createBucketIfMissing();
    }

    protected function tearDown(): void
    {
        Storage::cloud()->delete(self::FIXTURE_FILENAME);
        $this->deleteBucket();

        parent::tearDown();
    }

    public function testFindById(): void
    {
        $this->setupSyaroshicoFile();

        $tweetAggregateResult = $this->sut->findByEndpointName(new EndpointName('syaroshico'));

        $dailyAggregateResults = [...$tweetAggregateResult->getDailyAggregateResults()];
        $this->assertCount(
            2,
            $dailyAggregateResults
        );
        $this->assertDailyAggregateResult(
            Date::create(2020, 10, 1),
            10,
            $dailyAggregateResults[0]
        );
        $this->assertDailyAggregateResult(
            Date::create(2020, 10, 2),
            5,
            $dailyAggregateResults[1]
        );
    }

    public function testFindByIdLegacy(): void
    {
        $this->setupSyaroshicoFileLegacy();

        $tweetAggregateResult = $this->sut->findByEndpointName(new EndpointName('syaroshico'));

        $dailyAggregateResults = [...$tweetAggregateResult->getDailyAggregateResults()];
        $this->assertCount(
            2,
            $dailyAggregateResults
        );
        $this->assertDailyAggregateResult(
            Date::create(2020, 10, 1),
            10,
            $dailyAggregateResults[0]
        );
        $this->assertDailyAggregateResult(
            Date::create(2020, 10, 2),
            5,
            $dailyAggregateResults[1]
        );
    }

    public function testFindByIdNotFound(): void
    {
        $this->setupSyaroshicoFile();

        $this->expectException(TweetAggregateResultNotFoundException::class);

        $this->sut->findByEndpointName(new EndpointName('chiyashico'));
    }

    public function testPersist(): void
    {
        $this->assertFalse(
            Storage::cloud()->exists(self::FIXTURE_FILENAME)
        );

        $tweetAggregateResult = TweetAggregateResult::create(
            new EndpointName('syaroshico'),
            [
                new Daily(
                    Date::create(2020, 7, 15),
                    4545
                ),
            ]
        );

        $this->sut->persist(
            $tweetAggregateResult,
            new Keyword('syaroshico')
        );

        $this->assertTrue(
            Storage::cloud()->exists(self::FIXTURE_FILENAME)
        );
        $this->assertSame(
            '{"data":[{"date":"2020-07-15","count":4545}],"_embedded":{"query":"syaroshico"}}',
            Storage::cloud()->get(self::FIXTURE_FILENAME)
        );
    }

    public function testPersistOverwrite(): void
    {
        $this->setupSyaroshicoFile();

        $tweetAggregateResult = TweetAggregateResult::create(
            new EndpointName('syaroshico'),
            [
                new Daily(
                    Date::create(2020, 7, 15),
                    4545
                ),
            ]
        );

        $this->sut->persist(
            $tweetAggregateResult,
            new Keyword('syaroshico')
        );

        $this->assertTrue(
            Storage::cloud()->exists(self::FIXTURE_FILENAME)
        );
        $this->assertSame(
            '{"data":[{"date":"2020-07-15","count":4545}],"_embedded":{"query":"syaroshico"}}',
            Storage::cloud()->get(self::FIXTURE_FILENAME)
        );
    }

    public function testPersistOverwriteLegacy(): void
    {
        $this->setupSyaroshicoFileLegacy();

        $tweetAggregateResult = TweetAggregateResult::create(
            new EndpointName('syaroshico'),
            [
                new Daily(
                    Date::create(2020, 7, 15),
                    4545
                ),
            ]
        );

        $this->sut->persist(
            $tweetAggregateResult,
            new Keyword('syaroshico')
        );

        $this->assertTrue(
            Storage::cloud()->exists(self::FIXTURE_FILENAME)
        );
        $this->assertSame(
            '{"data":[{"date":"2020-07-15","count":4545}],"_embedded":{"query":"syaroshico"}}',
            Storage::cloud()->get(self::FIXTURE_FILENAME)
        );
    }

    /**
     * @param Date $dateExpected
     * @param int $countExpected
     * @param Daily $aDailyAggregateResult
     */
    private function assertDailyAggregateResult(
        Date $dateExpected,
        int $countExpected,
        Daily $aDailyAggregateResult
    ): void {
        $this->assertEquals(
            $dateExpected,
            $aDailyAggregateResult->getDate()
        );
        $this->assertEquals(
            $countExpected,
            $aDailyAggregateResult->getCount()
        );
    }

    private function setupSyaroshicoFile(): void
    {
        $data = [
            [
                'date' => '2020-10-01',
                'count' => 10,
            ],
            [
                'date' => '2020-10-02',
                'count' => 5,
            ],
        ];
        $object = [
            'data' => $data,
            '_embedded' => [
                'query' => 'syaroshico',
            ],
        ];
        $content = json_encode($object);
        assert($content !== false);
        Storage::cloud()->put(self::FIXTURE_FILENAME, $content);
    }

    private function setupSyaroshicoFileLegacy(): void
    {
        $data = [
            [
                'date' => '2020-10-01',
                'count' => 10,
            ],
            [
                'date' => '2020-10-02',
                'count' => 5,
            ],
        ];
        $content = json_encode($data);
        assert($content !== false);
        Storage::cloud()->put(self::FIXTURE_FILENAME, $content);
    }

    protected function createBucketIfMissing(): void
    {
        if (!$this->s3client->doesBucketExist(config()->get('filesystems.disks.s3.bucket'))) {
            $this->s3client->createBucket(
                [
                    'Bucket' => config()->get('filesystems.disks.s3.bucket'),
                ]
            );
        }
    }

    protected function deleteBucket(): void
    {
        $this->s3client->deleteBucket(
            [
                'Bucket' => config()->get('filesystems.disks.s3.bucket'),
                'Force' => true,
            ]
        );
    }
}
