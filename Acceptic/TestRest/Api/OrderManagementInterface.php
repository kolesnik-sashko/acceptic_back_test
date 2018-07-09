<?php

namespace Acceptic\TestRest\Api;


interface OrderManagementInterface
{
    /**
     * @api
     * @param array $order
     * @return int $orderId | array $error
     */
    public function createNewOrder($order);

    /**
     * @api
     * @param int $shopperId
     * @return array $listOfOrders
     */
    public function getOrders($shopperId);
}