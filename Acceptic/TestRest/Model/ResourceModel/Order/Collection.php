<?php

namespace Acceptic\TestRest\Model\ResourceModel\Order;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Acceptic\TestRest\Model\Order as Model;
use Acceptic\TestRest\Model\ResourceModel\Order as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class,ResourceModel::class);
    }
}
