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

class OrderTeat extends \PHPUnit\Framework\TestCase
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
     * 查询配送服务
     */
    public function testPushOrder()
    {
        $data = [
            'uuid' => $this->appId,
            'pos_shop_no' => '1',
            "business_oid" => '6671', // 订单 id(全局唯一)
            "business_sid" => '6671', // 订单 id(全局唯一)
            "trade_no" => '6671', // 平台订单号
            "take_no" => '5',  // 流水号   取餐号
            "shop_id" => '34',   // 统一门店 id
            "shop_name" => '上上签火锅店',  // 门店名称
            "num" => 1,  // 购买数量
            "longitude" => '116.478140',    // 经度
            "latitude" => '40.007662',  // 纬度
            "receiver_name" => 'test',    // 收货人姓名
            "receiver_mobile" => '1',   // 手机号
            "receiver_address" => '深圳',   // 地址
            "type" => 1,   // 1：外卖；2：自取；3：堂食；4：外卖预约；5：新零售；6：打包/外带
            "send_at" => date('Y-m-d H:i:s', time()),    // 预定时间
            "from_type" => 'mtdp',        // 下单渠道
            "status" => 1, // 7：商家待接单；10：商家已接单；12：备餐中；14：配送中；16：就餐中；18：待取餐；20：取餐超时；100：订单完成；-1：订单取消；21：备餐完成
            "pay_at" => date('Y-m-d H:i:s', time()),   // 下订单时间
            "pay_type" => 2, // 支付类型 1 微信
            "is_payed" => true,  // 是否已支付
            // "invoice" => "金蝶软件（中国）有限公司",    // 发票抬头
            // "invoiceType" => 2,  // 发票类型
            // "taxNo" => "91440101088569460X", // 税号
            // "peopleNum" => 0,    // 就餐人数
//                "isThirdDistribute" => false, // false 自配送
            "payment_amount" => "2000",  // 订单支付总金额
            "total_amount" => "2000",   // 下单实时餐品总金额
            "delivery_amount" => "500", // 配送费
            "box_amount" => "0", // 餐盒费
            "discount_amount" => "500", // 优惠总金额
            "member_id" => '36',
            "outer_member_id" => '127957',//'127957',  // 会员 id
            "mobile_phone" => '1', // 用户注册电话号码
            "driver_status" => 1, // 配送状态
            "remark" => '',
            'items' => [
                [
                    'outer_goods_id' => '0701',
                    'goods_id' => 1,
                    'sku_id' => 1,
                    'goods_title' => '火锅套餐',
                    'price' => "2000",
                    'total_amount' => "2000",
                    'num' => 1,
                    'box_amount' => 0,
                    'is_combos' => 2,
                    'is_discount' => false,
                    'specifications' => [
                        [
                            'title' => '甜度',
                            'name' => '三分糖',
                        ]
                    ],
                    'combos' => [
                        [
                            'outer_goods_id' => '001',
                            'goods_id' => 1,
                            'sku_id' => 1,
                            'goods_title' => '米饭',
                            'price' => 0,
                            'total_amount' => 0,
                            'num' => 2,
                            'box_amount' => 0,
                            'specifications' => [
                                [
                                    'title' => '甜度',
                                    'name' => '三分糖',
                                ]
                            ],
                        ]
                    ]
                ]
            ],

        ];
//        $res = $this->pos->kingDee->pushOrder($data);
//        var_dump($res->origin());exit;
        $result = [
            'err_code' => '0',
            'data' => [],
        ];
        // 模拟类
        $client = \Mockery::mock($this->pos->kingDee);
        $client->expects()
            ->pushOrder($data)
            ->andReturn($result);
        $this->assertSame($client->pushOrder($data),$result);
    }

    /**
     * 订单状态变更
     *
     * @throws \Cblink\ElemeDispatch\Exceptions\InvalidConfigException\
     */
    public function testUpdateStatus()
    {
        $data= [
            "business_oid" => "6671",
            'business_sid' => 6671,
            "trade_no" => "6671",
            'order_id' => 1,
            "pos_shop_no" => "1",
            "status" => 2,
            "cancel_reason" => 0,
            'uuid' => $this->appId
        ];
//        $res = $this->pos->kingDee->saveStatus($data);var_dump($res->origin());exit;
        // 模拟类
        $client = \Mockery::mock($this->pos->kingDee);
        $result = [
            'err_code' => '0',
            'data' => [],
        ];
        $client->expects()
            ->saveStatus($data)
            ->andReturn($result);
        $this->assertSame($client->saveStatus($data), $result);
    }

    /**
     * 会员卡冲正
     */
    public function testReversalBalance()
    {
        $data= [
            "business_oid" => "6671",
            'business_rid' => "6671",
            "refund_no" => "6671",
            'business_sid' => '6671',
            'order_id' => 1,
            "pos_shop_no" => "1",
            "status" => 1,
            'type' => 1,
            'refund_amount' => "2000",
            'remark' => '卖完了',
            'refund_at' => date('Y-m-d H:i:s', time()),
            "mobile_phone" => "1",
            'uuid' => $this->appId
        ];
//        $res = $this->pos->kingDee->pushRefund($data);
//        var_dump($res->origin());exit;
        // 模拟类
        $client = \Mockery::mock($this->pos->kingDee);
        $result = [
            "err_code" => 0,
            "data" => []
        ];
        $client->expects()
            ->pushRefund($data)
            ->andReturn($result);
        $this->assertSame($client->pushRefund($data),$result);
    }


}