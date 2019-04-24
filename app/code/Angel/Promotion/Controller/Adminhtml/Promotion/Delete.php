<?php


namespace Angel\Promotion\Controller\Adminhtml\Promotion;

class Delete extends \Angel\Promotion\Controller\Adminhtml\Promotion
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('promotion_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Angel\Promotion\Model\Promotion::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Promotion.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['promotion_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Promotion to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
