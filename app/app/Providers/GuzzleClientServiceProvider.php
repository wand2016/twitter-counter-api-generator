<?php

declare(strict_types=1);

namespace App\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleClientServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            ClientInterface::class,
            function () {
                $handlerStack = HandlerStack::create(new CurlHandler());
                $handlerStack->push(
                    Middleware::retry(
                        function (
                            $retries,
                            RequestInterface $request,
                            ResponseInterface $response = null,
                            RequestException $exception = null
                        ) {
                            // Limit the number of retries to 5
                            if ($retries >= 5) {
                                return false;
                            }

                            // Retry connection exceptions
                            if ($exception instanceof ConnectException) {
                                return true;
                            }

                            if ($response) {
                                // Retry on server errors
                                if ($response->getStatusCode() >= 500) {
                                    return true;
                                }
                            }

                            return false;
                        },
                        function () {
                            return function ($numberOfRetries) {
                                return 500 * (1 << $numberOfRetries);
                            };
                        }
                    )
                );
                return new Client(array('handler' => $handlerStack));
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
    }

    /**
     * @return string[]
     */
    public function provides(): array
    {
        return [
            ClientInterface::class,
        ];
    }
}
