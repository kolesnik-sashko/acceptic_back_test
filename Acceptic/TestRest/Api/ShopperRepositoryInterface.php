<?php
namespace Acceptic\TestRest\Api;

use Acceptic\TestRest\Api\Data\ShopperInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface ShopperRepositoryInterface 
{
    public function save(ShopperInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(ShopperInterface $page);

    public function deleteById($id);
}
