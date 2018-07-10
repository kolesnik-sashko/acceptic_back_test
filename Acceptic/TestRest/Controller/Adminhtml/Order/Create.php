<?php

namespace Acceptic\TestRest\Controller\Adminhtml\Order;

use Acceptic\TestRest\Api\Data\OrderInterface;
use Acceptic\TestRest\Controller\Adminhtml\AbstractAction;

class Create extends AbstractAction
{
    const ACL_RESOURCE      = 'Acceptic_TestRest::order_create';
    const PAGE_TITLE        = 'Add Order';
    const BREADCRUMB_TITLE  = 'Add Order';

    /** {@inheritdoc} */
    public function execute()
    {
        $model = $this->getOrderModel();
        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->registry->register(OrderInterface::REGISTRY_KEY, $model);
        return parent::execute();
    }
}
