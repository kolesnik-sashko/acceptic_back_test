<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.07.18
 * Time: 17:39
 */

namespace Acceptic\TestRest\Model\Source;

use Magento\Framework\Option\ArrayInterface;

use Acceptic\TestRest\Model\ResourceModel\Shopper\CollectionFactory;

class ShoppersSelect implements ArrayInterface
{
    protected $shoppersCollection;

    public function __construct(
        CollectionFactory $factory
    )
    {
        $this->shoppersCollection = $factory->create();
    }
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->shoppersCollection->getData() as $item)
        {
            $result[] = ['value' => $item['shopper_id'], 'label' => $item['name'] . ' ' . $item['last_name']];
        }
        return $result;
    }
}