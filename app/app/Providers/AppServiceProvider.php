<?php

namespace App\Providers;

use App\Infrastructure\Gateway\Twitter\OAuth2TokenGateway;
use App\Infrastructure\Gateway\Twitter\v2\BearerTokenPool;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            BearerTokenPool::class,
            function (Container $container) {
                $oAuth2TokenGateway = $container->get(OAuth2TokenGateway::class);
                assert($oAuth2TokenGateway instanceof OAuth2TokenGateway);
                $consumerKey = config()->get('twitter.credentials.consumerKey');
                $consumerSecret = config()->get('twitter.credentials.consumerSecret');
                return new BearerTokenPool(
                    $oAuth2TokenGateway,
                    $consumerKey,
                    $consumerSecret
                );
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
            BearerTokenPool::class,
        ];
    }
}
