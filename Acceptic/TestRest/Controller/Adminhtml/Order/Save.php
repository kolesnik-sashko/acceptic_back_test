<?php

namespace Acceptic\TestRest\Controller\Adminhtml\Order;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

use Acceptic\TestRest\Controller\Adminhtml\AbstractAction;

class Save extends AbstractAction
{
    const ACL_RESOURCE      = 'Acceptic_TestRest::order_save';
    const QUERY_PARAM_ID    = 'order_id';

    /**
     * @return ResponseInterface | ResultInterface
     */
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();
        if ($isPost) {
            $model = $this->getOrderModel();
            $formData = $this->getRequest()->getParams();
            if(!empty($formData[static::QUERY_PARAM_ID])) {
                $id = $formData[static::QUERY_PARAM_ID];
                $model = $this->orderRepository->get($id);
            } else {
                $formData[static::QUERY_PARAM_ID] = null;
            }
            $model->setData($formData);
            try {
                $this->orderRepository->save($model);
                $this->messageManager->addSuccessMessage(__('Order has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', [static::QUERY_PARAM_ID => $model->getId(), '_current' => true]);
                }
                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Order doesn\'t save' ));
            }
            $this->_getSession()->setFormData($formData);
            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', [static::QUERY_PARAM_ID => $model->getId()])
                : $this->_redirect('*/*/create');
        }
        return $this->doRefererRedirect();
    }    
}
