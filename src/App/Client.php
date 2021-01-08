<?php

namespace Cblink\Service\PosServiceSdk\App;

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
     * @param int $page
     * @param int $pageSize
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function lists($page = 1, $pageSize = 15)
    {
        return $this->get('api/app', [
            'page_size' => $pageSize,
            'page' => $page
        ]);
    }

    /**
     * 查看应用详情
     *
     * @param string $id
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function show($id)
    {
        return $this->get(sprintf('api/app/%s', $id));
    }

    /**
     * 创建应用
     *
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function create($params = [])
    {
        return $this->post('api/app', $params);
    }

    /**
     * 修改应用
     *
     * @param $id
     * @param array $params
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function update($id, $params = [])
    {
        return $this->put(sprintf('api/app/%s', $id), $params);
    }

    /**
     * 获取通知地址
     *
     * @param $id
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function notifies($id)
    {
        return $this->get(sprintf('api/app/queryNotifyUrl/%s', $id));
    }

    /**
     * 创建或修改通知地址
     *
     * @param $id
     * @param $event
     * @param $notifyUrl
     * @return \Cblink\Service\Kennel\HttpResponse
     */
    public function createNotify($id, $event, $notifyUrl)
    {
        return $this->post(sprintf('api/app/saveNotifyUrl/%s', $id), [
            'event' => $event,
            'url' => $notifyUrl
        ]);
    }

}