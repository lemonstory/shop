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
     * @param int $curPage
     * @param int $pageSize
     * @return ReviewInterface[]
     */
    public function getProductReviews($sku,$curPage,$pageSize)
    {
        // TODO: Implement getProductReviews() method.
        $dataReviews = [];
        if(!empty($sku)) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $product = $objectManager->create("Magento\Catalog\Model\Product")->loadByAttribute('sku', $sku); //use load($producID) if you have product id
            if($product) {

                $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
                $reviewsColFactory = $objectManager->get("Magento\Review\Model\ResourceModel\Review\Collection");
                $reviews = $reviewsColFactory->addStoreFilter($storeManager->getStore()->getId())
                    ->addStatusFilter(\Magento\Review\Model\Review::STATUS_APPROVED)
                    ->addEntityFilter('product',$product->getId())
                    ->setCurPage($curPage)
                    ->setPageSize($pageSize)
                    ->setDateOrder()
                    ->addRateVotes();


                foreach ($reviews->getItems() as $key => $review) {

                    $dataReviewsItem['review_id'] = $review->getReviewId();
                    $dataReviewsItem['created_at'] = $review->getCreatedAt();
                    $dataReviewsItem['entity_id'] = $review->getEntityId();
                    $dataReviewsItem['entity_pk_value'] = $review->getEntityPkValue();
                    $dataReviewsItem['status_id'] = $review->getStatusId();
                    $dataReviewsItem['detail_id'] = $review->getDetailId();
                    $dataReviewsItem['title'] = $review->getTitle();
                    $dataReviewsItem['detail'] = $review->getDetail();
                    $dataReviewsItem['nickname'] = $review->getNickname();
                    $dataReviewsItem['customer_id'] = $review->getCustomerId();
                    $dataReviewsItem['entity_code'] = $review->getEntityCode();

                    foreach( $review->getRatingVotes() as $vote) {
                        $dataReviewsItem['rating']   = number_format($vote->getPercent()*5/100);
                    }

                    $dataReviews[] = $dataReviewsItem;
                }
            }
        }
        return $dataReviews;
    }

    /**
     * Get product reviews with productId.
     *
     * @param string $productId
     * @param int $curPage
     * @param int $pageSize
     * @return ReviewInterface[]
     */
    public function getProductReviewsWithProductId($productId,$curPage,$pageSize)
    {
        // TODO: Implement getProductReviewsWithProductId() method.
        $dataReviews = [];
        if(!empty($productId)) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $product = $objectManager->create("Magento\Catalog\Model\Product")->load($productId); //use load($producID) if you have product id
            if($product) {

                $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
                $reviewsColFactory = $objectManager->get("Magento\Review\Model\ResourceModel\Review\Collection");
                $reviews = $reviewsColFactory->addStoreFilter($storeManager->getStore()->getId())
                    ->addStatusFilter(\Magento\Review\Model\Review::STATUS_APPROVED)
                    ->addEntityFilter('product',$product->getId())
                    ->setCurPage($curPage)
                    ->setPageSize($pageSize)
                    ->setDateOrder()
                    ->addRateVotes();

                foreach ($reviews->getItems() as $key => $review) {

                    $dataReviewsItem['review_id'] = $review->getReviewId();
                    $dataReviewsItem['created_at'] = $review->getCreatedAt();
                    $dataReviewsItem['entity_id'] = $review->getEntityId();
                    $dataReviewsItem['entity_pk_value'] = $review->getEntityPkValue();
                    $dataReviewsItem['status_id'] = $review->getStatusId();
                    $dataReviewsItem['detail_id'] = $review->getDetailId();
                    $dataReviewsItem['title'] = $review->getTitle();
                    $dataReviewsItem['detail'] = $review->getDetail();
                    $dataReviewsItem['nickname'] = $review->getNickname();
                    $dataReviewsItem['customer_id'] = $review->getCustomerId();
                    $dataReviewsItem['entity_code'] = $review->getEntityCode();

                    foreach( $review->getRatingVotes() as $vote) {
                        $dataReviewsItem['rating']   = number_format($vote->getPercent()*5/100);
                    }

                    $dataReviews[] = $dataReviewsItem;
                }
            }
        }
        return $dataReviews;
    }
}