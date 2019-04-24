<?php


namespace Angel\Promotion\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PromotionRepositoryInterface
{

    /**
     * Save promotion
     * @param \Angel\Promotion\Api\Data\PromotionInterface $promotion
     * @return \Angel\Promotion\Api\Data\PromotionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Angel\Promotion\Api\Data\PromotionInterface $promotion
    );

    /**
     * Retrieve promotion
     * @param string $promotionId
     * @return \Angel\Promotion\Api\Data\PromotionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($promotionId);

    /**
     * Retrieve promotion matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Angel\Promotion\Api\Data\PromotionSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete promotion
     * @param \Angel\Promotion\Api\Data\PromotionInterface $promotion
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Angel\Promotion\Api\Data\PromotionInterface $promotion
    );

    /**
     * Delete promotion by ID
     * @param string $promotionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($promotionId);
}
