<?php

/*
 * This file is part of the cblink-service/shop.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Tests\Unit\KingDee;



use App\Services\KingDeeSSPosService;
use Cblink\Service\PosServiceSdk\AppPos;
use PHPUnit\Framework\MockObject\Api;

class SyncShopTeat extends \PHPUnit\Framework\TestCase
{
    protected $pos;

    private $appId;

    protected function setUp(): void
    {
        $config = [
            'private' => true,
            'debug' => true,
            'base_url' => "",
            'app_id' => 0,
            'secret' => "",
            'key' => "",
            'uuid' => "",
        ];

        $fileName = __DIR__ . '/../../../BaseConfig.php';

        if (file_exists($fileName)){
            $config = include $fileName;
        }
        $this->appId = $config['uuid'];

        $this->pos = new AppPos($config['config']);
    }

    /**
     * 同步门店
     */
    public function testSyncShop()
    {
        $data = [
            'uuid' => $this->appId
        ];
        $res = $this->pos->kingDee->syncShop($data);
        var_dump($res->origin());exit;
        $result = [
            'err_code' => '0',
            'data' => [],
        ];
        // 模拟类
        $client = \Mockery::mock($this->pos->kingDee);
        $client->expects()
            ->syncShop($data)
            ->andReturn($result);
        $this->assertSame($client->syncShop($data),$result);
    }

    /**
     * 同步门店商品
     *
     * @throws \Cblink\ElemeDispatch\Exceptions\InvalidConfigException\
     */
    public function testSyncProduct()
    {
        $data= [
            'shop_id' => '1',
            'uuid' => $this->appId
        ];
//        $res = $this->pos->kingDee->syncShopGoods($data);var_dump($res->origin());exit;
        // 模拟类
        $client = \Mockery::mock($this->pos->kingDee);
        $result = [
            'err_code' => '0',
            'data' => [],
        ];
        $client->expects()
            ->syncShopGoods($data)
            ->andReturn($result);
        $this->assertSame($client->syncShopGoods($data), $result);
    }

    /**
     * 关联门店
     */
    public function testRelevanceShop()
    {
        $data= [
            'shop_id' => 9,
            'outer_shop_id' => 120512,
            'pos_shop_no' => '2000020000120512',
            'uuid' => $this->appId
        ];
//        $res = $this->pos->kingDee->relevanceShop($data);
//        var_dump($res->origin());exit;
        // 模拟类
        $client = \Mockery::mock($this->pos->kingDee);

        $result = [
            "err_code" => 0,
            "data" => [
                "shop_id" => 9,
                "outer_shop_id" => "120512",
                "pos_shop_no" => "2000020000120512",
            ]
        ];
        $client->expects()
            ->relevanceShop($data)
            ->andReturn($result);
        $this->assertSame($client->relevanceShop($data),$result);
    }


}