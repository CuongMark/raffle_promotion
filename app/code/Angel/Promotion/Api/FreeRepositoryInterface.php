<?php


namespace Angel\Promotion\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface FreeRepositoryInterface
{

    /**
     * Save free
     * @param \Angel\Promotion\Api\Data\FreeInterface $free
     * @return \Angel\Promotion\Api\Data\FreeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Angel\Promotion\Api\Data\FreeInterface $free
    );

    /**
     * Retrieve free
     * @param string $freeId
     * @return \Angel\Promotion\Api\Data\FreeInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($freeId);

    /**
     * Retrieve free matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Angel\Promotion\Api\Data\FreeSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete free
     * @param \Angel\Promotion\Api\Data\FreeInterface $free
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Angel\Promotion\Api\Data\FreeInterface $free
    );

    /**
     * Delete free by ID
     * @param string $freeId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($freeId);
}
