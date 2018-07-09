<?php
namespace Acceptic\TestRest\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

use Acceptic\TestRest\Api\Data\ShopperInterface;
use Acceptic\TestRest\Api\Schema\ShopperInterface as SchemaInterface;
use Acceptic\TestRest\Model\ResourceModel\Shopper as ResourceModel;

class Shopper extends AbstractModel implements ShopperInterface, IdentityInterface
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [ShopperInterface::CACHE_TAG . '_' . $this->getId()];
    }

    /** {@inheritdoc} */
    public function getEmail()
    {
        return $this->_getData(SchemaInterface::EMAIL_COLUMN);
    }

    /** {@inheritdoc} */
    public function setEmail($email)
    {
        $this->setData(SchemaInterface::EMAIL_COLUMN, $email);
        return $this;
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return $this->_getData(SchemaInterface::NAME_COLUMN);
    }

    /** {@inheritdoc} */
    public function setName($name)
    {
        $this->setData(SchemaInterface::NAME_COLUMN, $name);
        return $this;
    }

    /** {@inheritdoc} */
    public function getLastName()
    {
        return $this->_getData(SchemaInterface::LAST_NAME_COLUMN);
    }

    /** {@inheritdoc} */
    public function setLastName($lastName)
    {
        $this->setData(SchemaInterface::LAST_NAME_COLUMN, $lastName);
        return $this;
    }

    /** {@inheritdoc} */
    public function getPhone()
    {
        return $this->_getData(SchemaInterface::PHONE_COLUMN);
    }

    /** {@inheritdoc} */
    public function setPhone($phone)
    {
        $this->setData(SchemaInterface::PHONE_COLUMN, $phone);
        return $this;
    }

    /** {@inheritdoc} */
    public function getCity()
    {
        return $this->_getData(SchemaInterface::CITY_COLUMN);
    }

    /** {@inheritdoc} */
    public function setCity($city)
    {
        $this->setData(SchemaInterface::CITY_COLUMN, $city);
        return $this;
    }

    /** {@inheritdoc} */
    public function getStreet()
    {
        return $this->_getData(SchemaInterface::STREET_COLUMN);
    }

    /** {@inheritdoc} */
    public function setStreet($street)
    {
        $this->setData(SchemaInterface::STREET_COLUMN, $street);
        return $this;
    }

    /** {@inheritdoc} */
    public function getHouseNumber()
    {
        return $this->_getData(SchemaInterface::HOUSE_NUMBER_COLUMN);
    }

    /** {@inheritdoc} */
    public function setHouseNumber($houseNumber)
    {
        $this->setData(SchemaInterface::HOUSE_NUMBER_COLUMN, $houseNumber);
        return $this;
    }
}
