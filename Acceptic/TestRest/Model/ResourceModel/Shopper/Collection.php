<?php
namespace Acceptic\TestRest\Model\ResourceModel\Shopper;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Acceptic\TestRest\Model\Shopper as Model;
use Acceptic\TestRest\Model\ResourceModel\Shopper as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class,ResourceModel::class);
    }
}