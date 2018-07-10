<?php

namespace Acceptic\TestRest\Controller\Adminhtml\Shopper;

use Acceptic\TestRest\Api\Data\ShopperInterface;
use Acceptic\TestRest\Controller\Adminhtml\AbstractAction;

class Create extends AbstractAction
{
    const ACL_RESOURCE      = 'Acceptic_TestRest::shopper_create';
    const PAGE_TITLE        = 'Add Shopper';
    const BREADCRUMB_TITLE  = 'Add Shopper';

    /** {@inheritdoc} */
    public function execute()
    {
        $model = $this->getShopperModel();
        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->registry->register(ShopperInterface::REGISTRY_KEY, $model);
        return parent::execute();
    }
}
