<?php

namespace Acceptic\TestRest\Model\Api;

use Acceptic\TestRest\Api\Data\ShopperInterfaceFactory;
use Acceptic\TestRest\Api\ShopperManagementInterface;
use Acceptic\TestRest\Api\ShopperRepositoryInterface;
use Acceptic\TestRest\Api\Schema\ShopperInterface as Schema;

class ShopperManagement implements ShopperManagementInterface
{
    protected $factory;

    protected $repository;

    public function __construct(
        ShopperInterfaceFactory    $factory,
        ShopperRepositoryInterface $repository
    ){
        $this->factory    = $factory;
        $this->repository = $repository;
    }

    /** {@inheritdoc} */
    public function createNewShopper($shopper)
    {
        try{
            $obj = $this->factory->create();
            $this->setObjectData($obj, $shopper);
            $this->repository->save($obj);
            return json_encode($obj->getId());
        }catch (\Exception $e){
            $returnArray['error'] = $e->getMessage();
            $returnArray['status'] = 0;
            return json_encode($returnArray);
        }
    }

    /** {@inheritdoc} */
    public function updateShopper($shopper)
    {
        try{
            $obj = $this->repository->getById($shopper[Schema::ID_COLUMN]);
            $this->setObjectData($obj, $shopper);
            $this->repository->save($obj);
            return json_encode($obj->getId());
        }catch (\Exception $e){
            $returnArray['error'] = $e->getMessage();
            $returnArray['status'] = 0;
            return json_encode($returnArray);
        }
    }

    /** {@inheritdoc} */
    public function getShopperById($shopperId)
    {
        try{
            $obj = $this->repository->getById($shopperId);
            return json_encode($obj);
        }catch (\Exception $e){
            $returnArray['error'] = $e->getMessage();
            $returnArray['status'] = 0;
            return json_encode($returnArray);
        }
    }

    private function setObjectData($obj, $data)
    {
        $obj->setEmail($data[Schema::EMAIL_COLUMN])
            ->setName($data[Schema::NAME_COLUMN])
            ->setLastName($data[Schema::LAST_NAME_COLUMN])
            ->setPhone($data[Schema::PHONE_COLUMN])
            ->setCity($data[Schema::CITY_COLUMN])
            ->setStreet($data[Schema::STREET_COLUMN])
            ->setHouseNumber($data[Schema::HOUSE_NUMBER_COLUMN]);
    }
}