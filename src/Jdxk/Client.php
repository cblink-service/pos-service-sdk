<?php

namespace Cblink\Service\PosServiceSdk\Jdxk;

use Cblink\Service\Kennel\AbstractApi;

/**
 * Class Client
 * @package Cblink\Service\Shop\App
 */
class Client extends AbstractApi
{

    /**
     * 查看应用列表
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function queryBalance(array $params)
    {
        return $this->post('api/jdxk/member/queryBalance', $params);
    }

    /**
     * 创建应用
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function createMember($params = [])
    {
        return $this->post('api/jdxk/member', $params);
    }

    /**
     * 修改应用
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function updateMemberBalance($params = [])
    {
        return $this->post('api/jdxk/member/changeBalance', $params);
    }


}