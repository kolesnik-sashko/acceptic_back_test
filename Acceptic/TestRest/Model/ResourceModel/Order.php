<?php
namespace Acceptic\TestRest\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use Acceptic\TestRest\Api\Schema\OrderInterface;

class Order extends AbstractDb
{
    protected function _construct()
    {
        $this->_init(OrderInterface::TABLE_NAME,OrderInterface::ID_COLUMN);
    }
}
