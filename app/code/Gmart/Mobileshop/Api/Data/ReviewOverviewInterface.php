<?php
/**
 * Created by PhpStorm.
 * User: gaoyong
 * Date: 2018/2/3
 * Time: 下午12:21
 */

namespace Gmart\Mobileshop\Api\Data;

use Gmart\Review\Model\Review;

interface ReviewOverviewInterface {


    /**
     * Get product reviews total
     *
     * @return int|null
     */
    public function getTotal();

    /**
     * Set product reviews total
     *
     * @param int $total
     * @return $this
     * @internal param int $id
     */
    public function setTotal($total);


    /**
     * @return float mixed
     */
    public function getAvg();


    /**
     * @param float $avg
     * @return $this
     */
    public function setAvg($avg);

    /**
     * @return array mixed
     */
    public function getReviewId();

    /**
     * @param  int $reviewId
     * @return $this
     */
    public function setReviewId($reviewId);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $createAt
     * @return mixed
     */
    public function setCreatedAt($createAt);

    /**
     * @return mixed
     */
    public function getEntityId();

    /**
     * @param int $entityId
     * @return mixed
     */
    public function setEntityId($entityId);

    /**
     * @return mixed
     */
    public function getEntityPkValue();

    /**
     * @param int $entityPkValue
     * @return mixed
     */
    public function setEntityPkValue($entityPkValue);

    /**
     * @return mixed
     */
    public function getStatusId();

    /**
     * @param int $statusId
     * @return mixed
     */
    public function setStatusId($statusId);

    /**
     * @return mixed
     */
    public function getDetailId();

    /**
     * @param int $detailId
     * @return mixed
     */
    public function setDetailId($detailId);

    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * @param string $title
     * @return mixed
     */
    public function setTitle($title);

    /**
     * @return mixed
     */
    public function getDetail();

    /**
     * @param string $detail
     * @return mixed
     */
    public function setDetail($detail);

    /**
     * @return mixed
     */
    public function getNickname();

    /**
     * @param string $nickname
     * @return mixed
     */
    public function setNickname($nickname);

    /**
     * @return mixed
     */
    public function getCustomerId();

    /**
     * @param null|int $customerId
     * @return mixed
     */
    public function setCustomerId($customerId);

    /**
     * @return mixed
     */
    public function getEntityCode();

    /**
     * @param string $entityCode
     * @return mixed
     */
    public function setEntityCode($entityCode);


}