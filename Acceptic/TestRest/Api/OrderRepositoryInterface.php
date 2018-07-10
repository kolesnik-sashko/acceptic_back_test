<?php

namespace Acceptic\TestRest\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

use Acceptic\TestRest\Api\Data\OrderInterface;

interface OrderRepositoryInterface 
{
    /**
     * @param OrderInterface $order
     * @return OrderInterface
     */
    public function save(OrderInterface $order);

    /**
     * @param int $id
     * @return OrderInterface
     */
    public function getById($id);

    /**
     * @param SearchCriteriaInterface $criteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria);

    /***
     * @param OrderInterface $order
     * @return OrderRepositoryInterface
     */
    public function delete(OrderInterface $order);

    /**
     * @param int $id
     * @return OrderRepositoryInterface
     */
    public function deleteById($id);
}
