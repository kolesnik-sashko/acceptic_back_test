<?php

namespace Acceptic\TestRest\Api;

use Acceptic\TestRest\Api\Data\OrderInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface OrderRepositoryInterface 
{
    public function save(OrderInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(OrderInterface $page);

    public function deleteById($id);
}
