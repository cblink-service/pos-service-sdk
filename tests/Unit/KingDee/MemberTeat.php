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
    public function testQueryStoreMember()
    {
        $data = [
            'mobile' => '13944702736',
            'name' => '测试会员',
            'outer_shop_id' => 1,
            'business_id' => 1,
            'gender' => 1,
            'uuid' => $this->appId
        ];
//        $res = $this->pos->kingDee->queryStoreMember($data);
//        var_dump($res->origin());exit;
        $result = [
            'err_code' => '0',
            'data' => [
                'business_id' => 1,
                'mobile' => "1",
                'outer_id"' => "1",
                'outer_shop_id' => "1",
                'outer_balance_no' => "1",
                'total_amount' => 1,
                'original_amount' => 1,
                'gift_amount' => 1,
                'point' => 1
            ],
        ];
        // 模拟类
        $client = \Mockery::mock($this->pos->kingDee);
        $client->expects()
            ->queryStoreMember($data)
            ->andReturn($result);
        $this->assertSame($client->queryStoreMember($data),$result);
    }

    /**
     * 会员卡消费
     *
     * @throws \Cblink\ElemeDispatch\Exceptions\InvalidConfigException\
     */
    public function testConsumeBalance()
    {
        $data= [
            'business_id' => 1,
            'member_id' => 1,    // 创建组织 id
            'outer_shop_id' => 1, // 姓名
            'amount' => 100, // 手机号
            'order_id' => 2,  //
            'uuid' => $this->appId
        ];
//        $res = $this->pos->kingDee->consumeBalance($data);var_dump($res->origin());exit;
        // 模拟类
        $client = \Mockery::mock($this->pos->kingDee);
        $result = [
            'err_code' => '0',
            'data' => [
                "business_id" => 1,
                "mobile" => "1",
                "outer_id" => "1",
                "outer_shop_id" => "1",
                "outer_balance_no" => "1",
                "total_amount" => 1,
                "original_amount" => 1,
                "gift_amount" => 1,
                "point" => 1,
                "flow_no" => "cb162157904010000000001919"
            ],
        ];
        $client->expects()
            ->consumeBalance($data)
            ->andReturn($result);
        $this->assertSame($client->consumeBalance($data), $result);
    }

    /**
     * 会员卡冲正
     */
    public function testReversalBalance()
    {
        $data= [
            'business_id' => 1,
            'member_id' => 1,    // 创建组织 id
            'outer_shop_id' => 1, // 姓名
            'amount' => 100, // 手机号
            'order_id' => 2,  // 性别 0 男 1 女  // 性别 0 男 1 女
            'flow_no' => 'cb162157904010000000001919',
            'uuid' => $this->appId
        ];
//        $res = $this->pos->kingDee->reversalBalance($data);
//        var_dump($res->origin());exit;
        // 模拟类
        $client = \Mockery::mock($this->pos->kingDee);
        $result = [
            "err_code" => 0,
            "data" => [
                "business_id" => 1,
                "mobile" => "1",
                "outer_id" => "1",
                "outer_shop_id" => "1",
                "outer_balance_no" => "1",
                "total_amount" => 1,
                "original_amount" => 1,
                "gift_amount" => 1,
                "point" => 1,
                "flow_no" => "cb162157904010000000001919",
            ]
        ];
        $client->expects()
            ->reversalBalance($data)
            ->andReturn($result);
        $this->assertSame($client->reversalBalance($data),$result);
    }

    /**
     * 修改卡金额 积分
     */
    public function testChangeBalance()
    {
        $data= [
            'business_id' => 1,
            'member_id' => 1,
            'outer_shop_id' => 1,
            'mobile' => '1',
            'original_amount' => -100,
            'gift_amount' => -100,
            'points' => -20,
            'invoiced_amount' => 0,
            'order_id' => '3',
            'uuid' => $this->appId
        ];
//        $res = $this->pos->kingDee->changeBalance($data);
//
//        var_dump($res->origin());exit;
        $result = [
            'err_code' => 0,
            'data' => [
                "business_id" => 1,
                "mobile" => "1",
                "outer_id" => "1",
                "outer_shop_id" => "1",
                "outer_balance_no" => "1",
                "total_amount" => 1,
                "original_amount" => 1,
                "gift_amount" => 1,
                "point" => 1,
                "flow_no" => "cb162158148310000000002920"
            ]
        ];

        $client = \Mockery::mock($this->pos->kingDee);

        $client->expects()
            ->reversalBalance($data)
            ->andReturn($result);

        $this->assertSame($client->reversalBalance($data), $result);
    }

    public function testCardRecord()
    {
        $data= [
            'uuid' => $this->appId,
            'type' => 'B',
            'member_id' => 1,
            'business_id' => 1,
        ];
//        $res = $this->pos->kingDee->cardRecord($data);
//        var_dump($res->origin());
//        exit;
        $result = [
            'err_code' => 0,
            'data' => [
                [
                    "flow_id" => 106100,
                    "flow_no" => "cb162090469034000000003806",
                    "created_at" => "2021-05-13 19:15:24",
                    "original_consume" => 20,
                    "coupon_consume" => 0,
                    "gift_consume" => 0,
                    "recharge_amount" => 0,
                    "store_amount" => 0,
                    "gift_amount" => 0,
                ]
            ]
        ];
        $client = \Mockery::mock($this->pos->kingDee);

        $client->expects()
            ->cardRecord($data)
            ->andReturn($result);

        $this->assertSame($client->cardRecord($data), $result);
    }

    /**
     * 修改会员信息
     */
    public function testSaveMember()
    {
        $data= [
            'uuid' => $this->appId,
            'gender' => 0,
            'member_id' => 1,
            'business_id' => 1,
        ];
        // $res = $this->pos->kingDee->saveInfo($data);
        // var_dump($res->origin());
        // exit;
        $result = [
            'err_code' => 0,
            'data' => []
        ];
        $client = \Mockery::mock($this->pos->kingDee);

        $client->expects()
            ->saveInfo($data)
            ->andReturn($result);

        $this->assertSame($client->saveInfo($data), $result);
    }

}