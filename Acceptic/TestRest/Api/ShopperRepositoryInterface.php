<?php

namespace Acceptic\TestRest\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

use Acceptic\TestRest\Api\Data\ShopperInterface;

interface ShopperRepositoryInterface 
{
    /**
     * @param ShopperInterface $shopper
     * @return mixed
     */
    public function save(ShopperInterface $shopper);

    /**
     * @param int $id
     * @return ShopperInterface
     */
    public function getById($id);

    /**
     * @param SearchCriteriaInterface $criteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param ShopperInterface $shopper
     * @return ShopperRepositoryInterface
     */
    public function delete(ShopperInterface $shopper);

    /**
     * @param int $id
     * @return ShopperRepositoryInterface
     */
    public function deleteById($id);
}
