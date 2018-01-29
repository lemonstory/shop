<?php
/**
 * Created by PhpStorm.
 * User: gaoyong
 * Date: 2018/1/24
 * Time: 下午8:45
 */

namespace Gmart\Review\Model;

use Gmart\Review\Api\ReviewRepositoryInterface;
use Gmart\Review\Model\Review as GmartReview;
use Magento\Framework\App\ObjectManager;
use Magento\Review\Model\Review as Review;
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
     * @param int $productId
     * @param int $customerId
     * @param int $ratings
     * @param string $nickname
     * @param string $title
     * @param string $detail
     * @return mixed|void
     * @throws InputException
     * @internal param int $rating
     */
    public function post($productId,$customerId,$ratings,$nickname,$title,$detail) {

        //这里搞的挫了
        //没明白api 中array类型该如何传递和接收,故先硬编码来处理
        //1颗星:$optionId = 16
        //2颗星:$optionId = 17
        //3颗星:$optionId = 18
        //4颗星:$optionId = 19
        //5颗星:$optionId = 20

        if(intval($customerId) <= 0) {
            $customerId = null;
        }

        $postData['ratings'][4] = $ratings + 15;
        $postData['validate_rating'] = '';

        $postData['nickname'] = $nickname;
        $postData['title'] = $title;
        $postData['detail'] = $detail;


        $objectManager = ObjectManager::getInstance();
        $product = $objectManager->create("Magento\Catalog\Model\Product")->load($productId);


        if ($postData) {
            $ratingArr = [];
            if (isset($data['ratings']) && is_array($postData['ratings'])) {
                $ratingArr = $postData['ratings'];
            }
        }

        if ($product && !empty($postData)) {
            /** @var \Magento\Review\Model\Review $review */
            $review = $objectManager->create("Magento\Review\Model\Review")->setData($postData);
            $review->unsetData('review_id');

            $validate = $review->validate();
            if ($validate === true) {
                try {

                    $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
                    $rating = $objectManager->create("Magento\Review\Model\Rating");

                    $review->setEntityId($review->getEntityIdByCode(Review::ENTITY_PRODUCT_CODE))
                        ->setEntityPkValue($product->getId())
                        ->setStatusId(Review::STATUS_PENDING)
                        ->setCustomerId($customerId)
                        ->setStoreId($storeManager->getStore()->getId())
                        ->setStores([$storeManager->getStore()->getId()])
                        ->save();

                    foreach ($ratingArr as $ratingId => $optionId) {
                        $rating->setRatingId($ratingId)
                            ->setReviewId($review->getId())
                            ->setCustomerId($customerId)
                            ->addOptionVote($optionId, $product->getId());
                    }
                    $review->aggregate();

                    $data['message'] = "success";
                    return $data;

                } catch (\Exception $e) {
                    throw new InputException(__('We can\'t post your review right now.',$e));
                }
            } else {
                throw new InputException(__('Not a valid data'));
            }
        }else{
            throw new InputException(__('Not a valid post data'));
        }
    }


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