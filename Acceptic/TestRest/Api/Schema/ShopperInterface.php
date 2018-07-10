<?php

namespace Acceptic\TestRest\Api\Schema;


interface ShopperInterface
{
    const TABLE_NAME         = 'acceptic_shopper';

    const ID_COLUMN           = 'shopper_id';
    const EMAIL_COLUMN        = 'email';
    const NAME_COLUMN         = 'name';
    const LAST_NAME_COLUMN    = 'last_name';
    const PHONE_COLUMN        = 'phone';
    const CITY_COLUMN         = 'city';
    const STREET_COLUMN       = 'street';
    const HOUSE_NUMBER_COLUMN = 'house_number';
}