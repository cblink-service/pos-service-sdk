<?php

namespace Cblink\Service\PosServiceSdk;

use Cblink\Service\Kennel\ServiceContainer;

/**
 * Class Application
 * @package Cblink\Service\Shop
 * @property-read KingDee\Client $kingDee
 * @property-read App\Client $app
 */
class Application extends ServiceContainer
{

    /**
     * @return array
     */
    protected function getCustomProviders(): array
    {
        return [
            KingDee\ServiceProvider::class,
            App\ServiceProvider::class,
        ];
    }
}