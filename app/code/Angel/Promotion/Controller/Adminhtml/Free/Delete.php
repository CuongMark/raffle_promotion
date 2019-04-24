<?php


namespace Angel\Promotion\Controller\Adminhtml\Free;

class Delete extends \Angel\Promotion\Controller\Adminhtml\Free
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
        $id = $this->getRequest()->getParam('free_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Angel\Promotion\Model\Free::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Free.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['free_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Free to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
