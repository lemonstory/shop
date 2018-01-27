<?php
/**
 * Created by PhpStorm.
 * User: gaoyong
 * Date: 2018/1/24
 * Time: 下午8:45
 */

namespace Gmart\Review\Model;

use Gmart\Review\Api\ReviewRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product\Gallery\MimeTypeExtensionMap;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Framework\Api\Data\ImageContentInterface;
use Magento\Framework\Api\Data\ImageContentInterfaceFactory;
use Magento\Framework\Api\ImageContentValidatorInterface;
use Magento\Framework\Api\ImageProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\DB\Adapter\ConnectionException;
use Magento\Framework\DB\Adapter\DeadlockException;
use Magento\Framework\DB\Adapter\LockWaitException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class ReviewRepository implements ReviewRepositoryInterface
{

    /**
     * Save review.
     *
     * @param \Gmart\Review\Api\Data\ReviewInterface $review
     * @return \Gmart\Review\Api\Data\ReviewInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Gmart\Review\Api\Data\ReviewInterface $review)
    {
        // TODO: Implement save() method.
    }

    /**
     * Get review by id.
     *
     * @param int $id
     * @return \Gmart\Review\Api\Data\ReviewInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id)
    {
        // TODO: Implement get() method.
    }

    /**
     * Delete review.
     *
     * @param \Gmart\Review\Api\Data\ReviewInterface $review
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Gmart\Review\Api\Data\ReviewInterface $review)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Delete review by id.
     *
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }

    /**
     * Lists the review items that match specified search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteria $searchCriteria
     * @return \Gmart\Review\Api\Data\ReviewSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteria $searchCriteria)
    {
        // TODO: Implement getList() method.
    }
}