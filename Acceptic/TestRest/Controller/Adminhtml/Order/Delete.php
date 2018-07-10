<?php

namespace Acceptic\TestRest\Controller\Adminhtml\Order;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

use Acceptic\TestRest\Controller\Adminhtml\AbstractAction;

class Delete extends AbstractAction
{
    const ACL_RESOURCE    = 'Acceptic_TestRest::order_delete';
    const QUERY_PARAM_ID  = 'order_id';

    /**
     * @return ResponseInterface | ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);
        if (!empty($id)) {
            try {
                $this->orderRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('Order has been deleted.'));
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(_('Order can\'t delete'));
                return $this->doRefererRedirect();
            }
        } else {
            $this->logger->error(
                sprintf("Require parameter `%s` is missing", static::QUERY_PARAM_ID)
            );
            $this->messageManager->addMessage(__('No item to delete'));
        }
        return $this->redirectToGrid();
    }
}
