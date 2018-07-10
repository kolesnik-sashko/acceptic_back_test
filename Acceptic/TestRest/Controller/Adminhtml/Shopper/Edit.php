<?php

namespace Acceptic\TestRest\Controller\Adminhtml\Shopper;

use Magento\Framework\Exception\NoSuchEntityException;

use Acceptic\TestRest\Api\Data\ShopperInterface;
use Acceptic\TestRest\Controller\Adminhtml\AbstractAction;

class Edit extends AbstractAction
{
    const PAGE_TITLE        = 'Edit Shopper';
    const BREADCRUMB_TITLE  = 'Edit Shopper';

    /** {@inheritdoc} */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        if (!empty($id)) {
            try {
                $model = $this->shopperRepository->getById($id);
            } catch (NoSuchEntityException $exception) {
                $this->logger->error($exception->getMessage());
                $this->messageManager->addErrorMessage(__('Entity with id %1 not found', $id));
                return $this->redirectToGrid();
            }
        } else {
            $this->logger->error(
                sprintf("Require parameter `%s` is missing", static::QUERY_PARAM_ID)
            );
            $this->messageManager->addErrorMessage("Shopper not found");
            return $this->redirectToGrid();
        }
        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->registry->register(ShopperInterface::REGISTRY_KEY, $model);
        return parent::execute();
    }
}
