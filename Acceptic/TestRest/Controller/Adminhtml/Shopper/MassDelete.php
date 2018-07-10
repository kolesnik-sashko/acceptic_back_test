<?php

namespace Acceptic\TestRest\Controller\Adminhtml\Shopper;

use Magento\Framework\App\ResponseInterface;

use Acceptic\TestRest\Controller\Adminhtml\AbstractAction;

class MassDelete extends AbstractAction
{
    const ACL_RESOURCE = 'Acceptic_TestRest::shopper_delete';

    /**
     * @return ResponseInterface
     */
    public function execute()
    {
        $ids = $this->getRequest()->getParam('selected');
        if (count($ids)) {
            try {
                foreach ($ids as $id) {
                    $this->shopperRepository->deleteById($id);
                }
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 record(s) has been deleted.', count($ids))
                );
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->logger->critical(
                    sprintf("Can't delete shopper: %d", $id)
                );
                $this->messageManager->addErrorMessage(__('Shopper with id %1 not deleted', $id));
            }
        } else {
            $this->logger->error("Parameter ids must be array and not empty");
            $this->messageManager->addWarningMessage("Please select items to delete");
        }
        return $this->redirectToGrid();
    }
}