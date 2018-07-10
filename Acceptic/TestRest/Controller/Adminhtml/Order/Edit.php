<?php

namespace Acceptic\TestRest\Controller\Adminhtml\Order;

use Magento\Framework\Exception\NoSuchEntityException;

use Acceptic\TestRest\Api\Data\OrderInterface;
use Acceptic\TestRest\Controller\Adminhtml\AbstractAction;

class Edit extends AbstractAction
{
    const PAGE_TITLE        = 'Edit Order';
    const BREADCRUMB_TITLE  = 'Edit Order';
    const QUERY_PARAM_ID    = 'order_id';

    /** {@inheritdoc} */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        if (!empty($id)) {
            try {
                $model = $this->orderRepository->getById($id);
            } catch (NoSuchEntityException $exception) {
                $this->logger->error($exception->getMessage());
                $this->messageManager->addErrorMessage(__('Entity with id %1 not found', $id));
                return $this->redirectToGrid();
            }
        } else {
            $this->logger->error(
                sprintf("Require parameter `%s` is missing", static::QUERY_PARAM_ID)
            );
            $this->messageManager->addErrorMessage("Post not found");
            return $this->redirectToGrid();
        }
        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->registry->register(OrderInterface::REGISTRY_KEY, $model);
        return parent::execute();
    }
}
