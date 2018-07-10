<?php

namespace Acceptic\TestRest\Model\Shopper;

use Acceptic\TestRest\Model\ResourceModel\Shopper\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $shopperCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $shopperCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $shopperCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /** {@inheritdoc} */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $shopper) {
            $this->_loadedData[$shopper->getId()] = $shopper->getData();
        }
        return $this->_loadedData;
    }
}