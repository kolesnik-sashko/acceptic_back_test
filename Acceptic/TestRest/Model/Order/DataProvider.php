<?php

namespace Acceptic\TestRest\Model\Order;

use Acceptic\TestRest\Model\ResourceModel\Order\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $orderCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $orderCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $order) {
            $this->_loadedData[$order->getId()] = $order->getData();
        }
        return $this->_loadedData;
    }
}