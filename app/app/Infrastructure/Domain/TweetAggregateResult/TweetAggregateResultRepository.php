<?php

declare(strict_types=1);

namespace App\Infrastructure\Domain\TweetAggregateResult;

use App\Domain\TweetAggregateResult\TweetAggregateResult;
use App\Domain\TweetAggregateResult\TweetAggregateResultRepository as TweetAggregateResultRepositoryInterface;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Exceptions\TweetAggregateResult\TweetAggregateResultNotFoundException;
use App\Exceptions\TweetAggregateResult\TweetAggregateResultParseFailedException;
use App\Exceptions\TweetAggregateResult\TweetAggregateResultPersistFailedException;
use Carbon\CarbonImmutable;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use stdClass;

/**
 * Class TweetAggregateResultRepository
 * @package App\Infrastructure\Domain\TweetAggregateResult
 */
class TweetAggregateResultRepository implements TweetAggregateResultRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findByEndpointName(EndpointName $endpointName): TweetAggregateResult
    {
        try {
            $s3Object = $this->tryFetch($endpointName);
        } catch (FileNotFoundException $e) {
            throw new TweetAggregateResultNotFoundException($endpointName, 0, $e);
        }

        try {
            $dailyAggregateResults = $this->tryHydrate($s3Object);
        } catch (Exception $e) {
            throw new TweetAggregateResultParseFailedException($s3Object, 0, $e);
        }

        return TweetAggregateResult::create($endpointName, $dailyAggregateResults);
    }

    /**
     * @inheritDoc
     */
    public function persist(TweetAggregateResult $tweetAggregateResult): void
    {
        $dailyAggregateResults = $tweetAggregateResult->getDailyAggregateResults();

        $data = collect($dailyAggregateResults)
            ->map(
                function (TweetAggregateResult\Daily $dailyResult): array {
                    return [
                        'date' => $dailyResult->getDate()->format('Y-m-d'),
                        'count' => $dailyResult->getCount(),
                    ];
                }
            )
            ->toArray();
        $content = json_encode($data);
        assert($content !== false);

        try {
            Storage::cloud()->put(
                $tweetAggregateResult->getEndpointName()->getJsonName(),
                $content
            );
            Storage::cloud()->setVisibility(
                $tweetAggregateResult->getEndpointName()->getJsonName(),
                'public'
            );
        } catch (Exception $e) {
            throw new TweetAggregateResultPersistFailedException(
                $tweetAggregateResult->getEndpointName(),
                $content,
                0,
                $e
            );
        }
    }


    /**
     * @param EndpointName $endpointName
     * @return string
     * @throws FileNotFoundException
     */
    private function tryFetch(EndpointName $endpointName): string
    {
        return Storage::cloud()->get($endpointName->getJsonName());
    }

    /**
     * @param string $s3Object
     * @return Collection
     */
    private function tryHydrate(string $s3Object): Collection
    {
        return collect(json_decode($s3Object))
            ->map(
                function (stdClass $tuple): TweetAggregateResult\Daily {
                    return new TweetAggregateResult\Daily(
                        new TweetAggregateResult\Daily\Date(
                            CarbonImmutable::createFromFormat('Y-m-d', $tuple->date)
                                ->startOfDay()
                        ),
                        $tuple->count
                    );
                }
            );
    }
}
