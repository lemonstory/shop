<?php
/**
 * Created by PhpStorm.
 * User: gaoyong
 * Date: 2018/1/24
 * Time: 下午8:12
 */

namespace Gmart\Review\Api\Data;

interface ReviewInterface
{
    /**
     * Get review id.
     *
     * @return int
    */
    public function getId();

    /*
     * Get Review title.
     *
     * @return string
     */
    public function getTitle();

    /*
     * Get Review detail.
     *
     * @return string
    */
    public function getDetail();

    /*
     * Get author nickname.
     *
     * @return string
    */
    public function getNickname();

    /*
     * Get customer id.
     *
     * @return int|null
    */
    public function getCustomerId();

    /*
     * Get review ratings.
     *
     * @return RatingInterface[]
    */
    public function getRatings();

    /*
     * Get review entity type.
     *
     * @return string
    */
    public function getReviewEntity();

    /*
     * Get reviewer type.
     * Possible values: 1 - Customer, 2 - Guest, 3 - Administrator.
     *
     * @return int
     */
    public function getReviewType();

    /*
     * Get review status.
     * Possible values: 1 - Approved, 2 - Pending, 3 - Not Approved.
     *
     * @return int
     */
    public function getReviewStatus();

    /*
     * Set review id.
     *
     * @param int $value
     * @return void
     */
    public function setId($value);

    /*
     * Set Review title.
     *
     * @param string $value
     * @return void
     */
    public function setTitle($value);

    /*
     * Set Review detail.
     *
     * @param void $value
     * @return void
     */
    public function setDetail($value);

    /*
     * Set author nickname.
     *
     * @param string $value
     * @return void
     */
    public function setNickname($value);

    /*
     * Set customer id.
     *
     * @param int|null $value
     * @return void
     */
    public function setCustomerId($value);

    /*
     * Set review ratings.
     *
     * @param RatingInterface[] $value
     * @return void
     */
    public function setRatings($value);

    /*
     * Set review entity type.
     *
     * @param string $value
     * @return void
     */
    public function setReviewEntity($value);

    /*
     * Set review status.
     * Possible values: 1 - Approved, 2 - Pending, 3 - Not Approved.
     *
     * @param int $value
     * @return void
     */
    public function setReviewStatus($value);

    /*
     * Set reviewer type.
     * Possible values: 1 - Customer, 2 - Guest, 3 - Administrator.
     *
     * @param int $value
     * @return string
     */
    public function setReviewType($value);
}

