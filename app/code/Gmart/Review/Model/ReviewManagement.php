<?php
/**
 * Created by PhpStorm.
 * User: gaoyong
 * Date: 2018/1/24
 * Time: 下午8:45
 */

namespace Gmart\Review\Model;

use Gmart\Review\Api\ReviewInterface;
use Gmart\Review\Api\ReviewManagementInterface;
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
class ReviewManagement implements ReviewManagementInterface
{

    /**
     * Get customer's reviews.
     *
     * @param int $customerId
     * @return ReviewInterface[]
     */
    public function getCustomerReviews($customerId)
    {
        // TODO: Implement getCustomerReviews() method.
    }

    /**
     * Get product reviews.
     *
     * @param string $sku
     * @return ReviewInterface[]
     */
    public function getProductReviews($sku)
    {
        // TODO: Implement getProductReviews() method.
        $data = [];
        if(!empty($sku)) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $product = $objectManager->create("Magento\Catalog\Model\Product")->loadByAttribute('sku', $sku); //use load($producID) if you have product id
            if($product) {

                $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
                $currentStoreId = $storeManager->getStore()->getId();
                $rating = $objectManager->get("Magento\Review\Model\ResourceModel\Review\Collection");

                $collection = $rating->addStoreFilter(
                    $currentStoreId
                )->addStatusFilter(
                    \Magento\Review\Model\Review::STATUS_APPROVED
                )->addEntityFilter(
                    'product',
                    $product->getId()
                )->setDateOrder();

                $data = $collection->getData(); //Get all review data of product
            }
        }
        return $data;
    }

    /**
     * Get product reviews with productId.
     *
     * @param string $productId
     * @return ReviewInterface[]
     */
    public function getProductReviewsWithProductId($productId)
    {
        // TODO: Implement getProductReviewsWithProductId() method.
        $data = [];
        if(!empty($productId)) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $product = $objectManager->create("Magento\Catalog\Model\Product")->load($productId); //use load($producID) if you have product id
            if($product) {

                $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
                $currentStoreId = $storeManager->getStore()->getId();
                $rating = $objectManager->get("Magento\Review\Model\ResourceModel\Review\Collection");

                $collection = $rating->addStoreFilter(
                    $currentStoreId
                )->addStatusFilter(
                    \Magento\Review\Model\Review::STATUS_APPROVED
                )->addEntityFilter(
                    'product',
                    $product->getId()
                )->setDateOrder();

                $data = $collection->getData(); //Get all review data of product
            }
        }
        return $data;

    }
}