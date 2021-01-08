<?php

/*
 * This file is part of the cblink-service/shop.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Tests\Unit;



use Cblink\Service\PosServiceSdk\Application;
use PHPUnit\Framework\MockObject\Api;

class AppTeat extends \PHPUnit\Framework\TestCase
{
    protected $pos;

    private $appId;

    private $uuid;

    protected function setUp(): void
    {
//        $config = [
//            'private' => true,
//            'debug' => true,
//            'base_url' => "http://dev-pos.service.cblink.net",
//            'app_id' => 45799194,
//            'secret' => "9Y6SjBWd2XHzVMWQbnkCJsiXllFh1p",
//            'key' => "aSKqxSMg3M",
//        ];

        $fileName = __DIR__ . '/../../BaseConfig.php';
        if (file_exists($fileName)){
            $config = include $fileName;
        }

        $this->uuid = $config['uuid'];

        $this->pos = new Application($config['config']);
    }

    public function testCreateApp()
    {
        $data = [
            'owner_id' => 45799194,
            'name' => '金蝶星空云',
            'platform' => 'jindiexingkong',
            'config' => ['user_name' => 'super', 'password' => '123456'],
            'app_key' => 'super',
        ];

        // $res = $this->pos->app->create($data);

        $client = \Mockery::mock($this->pos->app);

        $client->expects()
            ->create($this->appId, $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [],
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request('api/app', $data)
            ->andReturn([
                'err_code' => '0',
                'data' => [],
            ]);

        $this->assertSame(
            $ApiClient->request(sprintf('api/dispatch/meituan/%s/check', $this->appId), $data),
            $client->create($this->appId, $data)
        );


        var_dump($res->errMsg());exit;

    }

    /**
     * 更新 app
     */
    public function testUpdate()
    {
        $data = [
            'owner_id' => 45799194,
            'name' => '金蝶星空',
            'platform' => 'jindiexingkong',
            'config' => ['user_name' => 'super11', 'password' => '123456'],
            'app_key' => 'super11',
        ];

        $res = $this->pos->app->update($this->uuid, $data);

        var_dump($res->toArray());exit;
    }
}