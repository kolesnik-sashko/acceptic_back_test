<?php

namespace Acceptic\TestRest\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

use Acceptic\TestRest\Api\Data\OrderInterface;
use Acceptic\TestRest\Api\Schema\OrderInterface as SchemaInterface;
use Acceptic\TestRest\Model\ResourceModel\Order as ResourceModel;

class Order extends AbstractModel implements OrderInterface, IdentityInterface
{

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getIdentities()
    {
        return [OrderInterface::CACHE_TAG . '_' . $this->getId()];
    }

    /** {@inheritdoc} */
    public function getShopperId()
    {
        return $this->_getData(SchemaInterface::SHOPPER_ID_COLUMN);
    }

    /** {@inheritdoc} */
    public function setShopperId($id)
    {
        $this->setData(SchemaInterface::SHOPPER_ID_COLUMN, $id);
        return $this;
    }

    /** {@inheritdoc} */
    public function getOrderTotal()
    {
        return $this->_getData(SchemaInterface::ORDER_TOTAL_COLUMN);
    }

    /** {@inheritdoc} */
    public function setOrderTotal($orderTotal)
    {
        $this->setData(SchemaInterface::ORDER_TOTAL_COLUMN, $orderTotal);
        return $this;
    }

    /** {@inheritdoc} */
    public function getToken()
    {
        return $this->_getData(SchemaInterface::TOKEN_COLUMN);
    }

    /** {@inheritdoc} */
    public function setToken($token)
    {
        $this->setData(SchemaInterface::TOKEN_COLUMN, $token);
        return $this;
    }
}
