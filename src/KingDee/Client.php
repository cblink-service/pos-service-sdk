<?php

namespace Cblink\Service\PosServiceSdk\KingDee;

use Cblink\Service\Kennel\AbstractApi;

/**
 * Class Client
 * @package Cblink\Service\Shop\App
 */
class Client extends AbstractApi
{

    /**
     *  查询同步会员信息
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function queryStoreMember(array $params)
    {
        return $this->post('api/kingdee/member/queryStoreMember', $params);
    }

    /**
     * 会员卡消费
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function consumeBalance($params = [])
    {
        return $this->post('api/kingdee/member/consumeBalance', $params);
    }

    /**
     * 冲正
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function reversalBalance($params = [])
    {
        return $this->post('api/kingdee/member/reversalBalance', $params);
    }

    /**
     * 会员卡储值积分
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function changeBalance($params = [])
    {
        return $this->post('api/kingdee/member/changeBalance', $params);
    }

    /**
     * 会员信息修改
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function saveInfo($params = [])
    {
        return $this->post('api/kingdee/member/saveInfo', $params);
    }

    /**
     * 流水获取
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function cardRecord($params = [])
    {
        return $this->post('api/kingdee/member/cardRecord', $params);
    }

    /**
     * 同步门店
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function syncShop($params = [])
    {
        return $this->post('api/kingdee/sync/shop', $params);
    }

    /**
     * 同步门店商品
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function syncShopGoods($params = [])
    {
        return $this->post('api/kingdee/sync/goods', $params);
    }

    /**
     * 关联门店
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function relevanceShop($params = [])
    {
        return $this->post('api/kingdee/sync/shop/relevance', $params);
    }

    /**
     * 推送订单
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function pushOrder($params = [])
    {
        return $this->post('api/kingdee/order/push', $params);
    }

    /**
     * 修改订单状态
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function saveStatus($params = [])
    {
        return $this->post('api/kingdee/order/saveStatus', $params);
    }

    /**
     * 修改退款单
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function pushRefund($params = [])
    {
        return $this->post('api/kingdee/order/refund', $params);
    }


}