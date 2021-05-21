<?php


namespace Cblink\Service\PosServiceSdk\KingDee;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['kingDee'] = function ($app){
            return new Client($app);
        };
    }
}