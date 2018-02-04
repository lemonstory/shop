<?php
/**
 * Created by PhpStorm.
 * User: gaoyong
 * Date: 2018/2/3
 * Time: 上午10:27
 */

namespace Gmart\Mobileshop\Observer;

use Gmart\Mobileshop\Model\ReviewOverview;
use Magento\Framework\Event\ObserverInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class CatalogProductLoadAfter implements ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {

//        $log = new Logger('gmart');
//        $log->pushHandler(new StreamHandler('/data/wwwroot/shop.xiaoningmeng.net/var/log/test.log', Logger::DEBUG));

        $product = $observer->getProduct();  // get product object
        //set the the attribute vale

        $itemExtAttr = $product->getExtensionAttributes();
        if ($itemExtAttr === null) {
            $itemExtAttr = $this->extensionFactory->create();
        }
        $productId = $product->getId(); // Product ID

//        $log->addDebug($productId);
//        $log->addDebug("=================");

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $reviewsColFactory = $objectManager->get("Magento\Review\Model\ResourceModel\Review\Collection");
        //->addStoreFilter($storeManager->getStore()->getId())
        $reviews = $reviewsColFactory
            ->addStatusFilter(\Magento\Review\Model\Review::STATUS_APPROVED)
            ->addEntityFilter('product',$product->getId())
            ->setDateOrder()
            ->addRateVotes();

        $avg = 0;
        $ratings = array();
        $goodRatings = array();
        $dataReviewsItem = array();
        $total = count($reviews);
        $overReview = new ReviewOverview();
        $overReview->setTotal($total);

        if (count($reviews) > 0)
        {
            foreach ($reviews->getItems() as $key => $review) {

                foreach( $review->getRatingVotes() as $vote )
                {
                    if($vote->getPercent() >= 60) {
                        $goodRatings[] = $vote->getPercent();
                    }
                    $ratings[] = $vote->getPercent();

                    //显示四星以上最新的评论
                    if(empty($dataReviewsItem) && $vote->getPercent() >= 80) {
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
                    }
                }
            }
//            $avg = array_sum($ratings)/count($ratings);

            $avg = count($goodRatings)/count($ratings);
            $overReview->setAvg($avg);
            $overReview->setReviewId($dataReviewsItem['review_id']);
            $overReview->setCreatedAt($dataReviewsItem['created_at']);
            $overReview->setEntityId($dataReviewsItem['entity_id']);
            $overReview->setEntityPkValue($dataReviewsItem['entity_pk_value']);
            $overReview->setStatusId($dataReviewsItem['status_id']);
            $overReview->setDetailId($dataReviewsItem['detail_id']);
            $overReview->setTitle($dataReviewsItem['title']);
            $overReview->setDetail($dataReviewsItem['detail']);
            $overReview->setNickname($dataReviewsItem['nickname']);
            $overReview->setCustomerId($dataReviewsItem['customer_id']);
            $overReview->setEntityCode($dataReviewsItem['entity_code']);
        }

        $itemExtAttr->setReview($overReview);
        $product->setExtensionAttributes($itemExtAttr);
    }
}