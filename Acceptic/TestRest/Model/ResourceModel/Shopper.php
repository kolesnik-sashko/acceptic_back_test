<?php

namespace Acceptic\TestRest\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Acceptic\TestRest\Api\Schema\ShopperInterface;

class Shopper extends AbstractDb
{
    protected function _construct()
    {
        $this->_init(ShopperInterface::TABLE_NAME,ShopperInterface::ID_COLUMN);
    }
}
