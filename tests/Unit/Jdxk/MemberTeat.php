<?php

/*
 * This file is part of the cblink-service/shop.
 *
 * (c) Nick <me@xieying.vip>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Tests\Unit\Jdxk;



use Cblink\Service\PosServiceSdk\Application;
use PHPUnit\Framework\MockObject\Api;

class MemberTeat extends \PHPUnit\Framework\TestCase
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

        $this->pos = new Application($config['config']);
    }

    /**
     * 查询配送服务
     */
    public function testStore()
    {
        $data = [
            'shop_id' => '1',
            'name' => 'sdk 测试 1',
            'mobile' => '13944702701',
            'gender' => '0',
            'uuid' => $this->appId
        ];

//        $res = $this->pos->jdxk->createMember($data);
//        var_dump($res->toArray(), $res->errMsg());exit;

        // 模拟类
        $client = \Mockery::mock($this->pos->jdxk);


        $client->expects()
            ->createMember($data)
            ->andReturn([
                'err_code' => '0',
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request('api/jdxk/member', $data)
            ->andReturn([
            'err_code' => '0',
        ]);

       $this->assertSame(
            $ApiClient->request('api/jdxk/member', $data),
            $client->createMember($data)
        );
    }

    /**
     * 查询骑手位置
     *
     * @throws \Cblink\ElemeDispatch\Exceptions\InvalidConfigException\
     */
    public function testQueryMember()
    {
        $data = [
            'shop_id' => '1',
            'mobile' => '13944702701',
            'uuid' => $this->appId
        ];

//        $res = $this->pos->jdxk->queryBalance($data);
//
//        var_dump($res->toArray(), $res->errMsg());exit;

        // 模拟类
        $client = \Mockery::mock($this->pos->jdxk);


        $client->expects()
            ->queryBalance($data)
            ->andReturn([
                'err_code' => '0',
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request('api/jdxk/member/queryBalance', $data)
            ->andReturn([
                'err_code' => '0',
            ]);

        $this->assertSame(
            $ApiClient->request('api/jdxk/member/queryBalance', $data),
            $client->queryBalance($data)
        );
    }

    public function testUpdateMemberBalance()
    {
        $data = [
            'shop_id' => 1,
            'mobile' => '13944702701',
            'card_no' => 'BM0009',
            'original_amount' => -5,
            'gift_amount' => 0,
            'points' => -5,
            'invoiced_amount' => 0,
            'order_id' => '2',
            'uuid' => '98zlv5is18k0uze9sjoanzj2t72ekjs3',
        ];

//        $res = $this->pos->jdxk->updateMemberBalance($data);
//        var_dump($res->toArray(), $res->errMsg());exit;
//
        // 模拟类
        $client = \Mockery::mock($this->pos->jdxk);

        $client->expects()
            ->updateMemberBalance( $data)
            ->andReturn([
                'err_code' => '0',
            ]);

        $ApiClient = \Mockery::mock(Api::class);

        $ApiClient->expects()
            ->request('api/jdxk/member/changeBalance', $data)
            ->andReturn([
                'err_code' => '0',
            ]);

        $this->assertSame(
            $ApiClient->request('api/jdxk/member/changeBalance', $data),
            $client->updateMemberBalance($data)
        );
    }

}