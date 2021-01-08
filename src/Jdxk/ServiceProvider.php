<?php


namespace Cblink\Service\PosServiceSdk\Jdxk;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['jdxk'] = function ($app){
            return new Client($app);
        };
    }
}