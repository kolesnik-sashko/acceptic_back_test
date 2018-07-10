<?php

namespace Acceptic\TestRest\Controller\Adminhtml\Shopper;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

use Acceptic\TestRest\Controller\Adminhtml\AbstractAction;

class Save extends AbstractAction
{
    const ACL_RESOURCE      = 'Acceptic_TestRest::shopper_save';

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
                $model = $this->shopperRepository->getById($id);
            } else {
                $formData[static::QUERY_PARAM_ID] = null;
            }
            $model->setData($formData);
            try {
                $this->shopperRepository->save($model);
                $this->messageManager->addSuccessMessage(__('Shopper has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', [static::QUERY_PARAM_ID => $model->getId(), '_current' => true]);
                }
                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Shopper doesn\'t save' ));
            }
            $this->_getSession()->setFormData($formData);
            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', [static::QUERY_PARAM_ID => $model->getId()])
                : $this->_redirect('*/*/create');
        }
        return $this->doRefererRedirect();
    }    
}
