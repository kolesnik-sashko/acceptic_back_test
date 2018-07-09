<?php

namespace Acceptic\TestRest\Api\Data;

interface OrderInterface 
{
    const CACHE_TAG = 'acceptic_rest_order';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getShopperId();

    /**
     * @param $id int
     * @return OrderInterface
     */
    public function setShopperId($id);

    /**
     * @return int
     */
    public function getOrderTotal();

    /**
     * @param $orderTotal int
     * @return OrderInterface
     */
    public function setOrderTotal($orderTotal);

    /**
     * @return string
     */
    public function getToken();

    /**
     * @param $token string
     * @return OrderInterface
     */
    public function setToken($token);
}