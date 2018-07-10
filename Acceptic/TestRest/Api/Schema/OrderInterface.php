<?php

namespace Acceptic\TestRest\Api\Schema;


interface OrderInterface
{
    const TABLE_NAME         = 'acceptic_order';

    const ID_COLUMN          = 'order_id';
    const SHOPPER_ID_COLUMN  = 'shopper_id';
    const ORDER_TOTAL_COLUMN = 'order_total';
    const TOKEN_COLUMN       = 'order_token';
}