<?php
/**
 * Created by PhpStorm.
 * User: gaoyong
 * Date: 2018/1/24
 * Time: 下午8:08
 */

namespace Gmart\Review\Api;

interface ReviewRepositoryInterface
{
    /**
     * Save review.
     *
     * @param \Gmart\Review\Api\Data\ReviewInterface $review
     * @return \Gmart\Review\Api\Data\ReviewInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Gmart\Review\Api\Data\ReviewInterface $review);

    /**
     * Get review by id.
     *
     * @param int $id
     * @return \Gmart\Review\Api\Data\ReviewInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id);

    /**
     * Delete review.
     *
     * @param \Gmart\Review\Api\Data\ReviewInterface $review
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Gmart\Review\Api\Data\ReviewInterface $review);

    /**
     * Delete review by id.
     *
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($id);


    /**
     * Lists the review items that match specified search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteria $searchCriteria
     * @return \Gmart\Review\Api\Data\ReviewSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteria $searchCriteria);
}