<?php
/**
 * Created by PhpStorm.
 * User: gaoyong
 * Date: 2018/1/24
 * Time: 下午8:10
 */

namespace Gmart\Review\Api;

interface ReviewManagementInterface
{
    /**
     * Get customer's reviews.
     *
     * @param int $customerId
     * @return ReviewInterface[]
     */
    public function getCustomerReviews($customerId);

    /**
     * Get product reviews.
     *
     * @param string $sku
     * @return ReviewInterface[]
     */
    public function getProductReviews($sku);
}