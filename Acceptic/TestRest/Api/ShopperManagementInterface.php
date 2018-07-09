<?php

namespace Acceptic\TestRest\Api;


interface ShopperManagementInterface
{
    /**
     * @api
     * @param array $shopper
     * @return $shopperId int | $error array
     */
    public function createNewShopper($shopper);

    /**
     * @api
     * @param array $shopper
     * @return int $shopperId | array $error
     */
    public function updateShopper($shopper);

    /**
     * @api
     * @param int $shopperId
     * @return array $shopper | array $error
     */
    public function getShopperById($shopperId);
}