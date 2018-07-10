<?php

namespace Acceptic\TestRest\Model\Api;

use Magento\Framework\Api\SearchCriteriaBuilder;

use Acceptic\TestRest\Api\OrderManagementInterface;
use Acceptic\TestRest\Api\Data\OrderInterfaceFactory;
use Acceptic\TestRest\Api\OrderRepositoryInterface;
use Acceptic\TestRest\Api\Schema\OrderInterface as Schema;

class OrderManagement implements OrderManagementInterface
{
    /**
     * @var OrderInterfaceFactory
     */
    protected $factory;

    /**
     * @var OrderRepositoryInterface
     */
    protected $repository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * OrderManagement constructor.
     * @param OrderInterfaceFactory $factory
     * @param OrderRepositoryInterface $repository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        OrderInterfaceFactory $factory,
        OrderRepositoryInterface $repository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ){
        $this->factory               = $factory;
        $this->repository            = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /** {@inheritdoc} */
    public function createNewOrder($order)
    {
        $obj = $this->factory->create();
        $obj->setShopperId($order[Schema::SHOPPER_ID_COLUMN])
            ->setOrderTotal($order[Schema::ORDER_TOTAL_COLUMN])
            ->setToken($order[Schema::TOKEN_COLUMN]);
        try{
            $this->repository->save($obj);
            return json_encode($obj->getId());
        }catch (\Exception $e){
            $returnArray['errorMsg'] = $e->getMessage();
            $returnArray['errorCode'] = $e->getCode();
            return json_encode($returnArray);
        }
    }

    /** {@inheritdoc} */
    public function getOrders($shopperId)
    {
        try{
            $searchCriteria = $this->searchCriteriaBuilder->addFilter(Schema::SHOPPER_ID_COLUMN, $shopperId)->create();
            $result = $this->repository->getList($searchCriteria);
            return json_encode($result);
        }catch (\Exception $e){
            $returnArray['errorMsg'] = $e->getMessage();
            $returnArray['errorCode'] = $e->getCode();
            return json_encode($returnArray);
        }
    }
}