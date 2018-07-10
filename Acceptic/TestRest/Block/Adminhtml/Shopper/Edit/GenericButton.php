<?php

namespace Acceptic\TestRest\Block\Adminhtml\Shopper\Edit;

use Magento\Backend\Block\Widget\Context;

use Acceptic\TestRest\Controller\Adminhtml\Shopper\Delete;

class GenericButton
{
    /**
     * GenericButton constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;    
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', [Delete::QUERY_PARAM_ID => $this->getObjectId()]);
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    /**
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->context->getRequest()->getParam(Delete::QUERY_PARAM_ID);
    }     
}
