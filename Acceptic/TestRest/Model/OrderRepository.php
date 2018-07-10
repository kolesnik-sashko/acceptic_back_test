<?php

namespace Acceptic\TestRest\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

use Acceptic\TestRest\Api\OrderRepositoryInterface;
use Acceptic\TestRest\Api\Data\OrderInterface;
use Acceptic\TestRest\Model\OrderFactory;
use Acceptic\TestRest\Model\ResourceModel\Order\CollectionFactory;
use Acceptic\TestRest\Model\ResourceModel\Order as ResourceModel;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var OrderFactory
     */
    protected $objectFactory;

    /*
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * OrderRepository constructor.
     * @param OrderFactory $objectFactory
     * @param CollectionFactory $collectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param ResourceModel $resourceModel
     */
    public function __construct(
        OrderFactory $objectFactory,
        CollectionFactory $collectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory,
        ResourceModel $resourceModel
    )
    {
        $this->objectFactory        = $objectFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->resourceModel        = $resourceModel;
    }

    /** {@inheritdoc} */
    public function save(OrderInterface $object)
    {
        try
        {
            $this->resourceModel->save($object);
        }
        catch(\Exception $e)
        {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $object;
    }

    /** {@inheritdoc} */
    public function getById($id)
    {
        $object = $this->getOrderObject();
        $this->resourceModel->load($object, $id);
        if (!$object->getId()) {
            throw new NoSuchEntityException(__('Object with id "%1" does not exist.', $id));
        }
        return $object;        
    }

    /** {@inheritdoc} */
    public function delete(OrderInterface $object)
    {
        try {
            $this->resourceModel->delete($object);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return $this;   
    }

    /** {@inheritdoc} */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
    
    /** {@inheritdoc} */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);  
        $collection = $this->collectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }  
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $objects = [];                                     
        foreach ($collection as $objectModel) {
            $objects[] = $objectModel;
        }
        $searchResults->setItems($objects);
        return $searchResults;        
    }

    /**
     * @return Order
     */
    protected function getOrderObject()
    {
        return $this->objectFactory->create();
    }
}
