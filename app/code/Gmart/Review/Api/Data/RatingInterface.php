<?php
/**
 * Created by PhpStorm.
 * User: gaoyong
 * Date: 2018/1/24
 * Time: 下午8:15
 */

namespace Gmart\Review\Api\Data;

interface RatingInterface
{
    /**
     * Get rating id.
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get review id.
     *
     * @return int
     */
    public function getReviewId();

    /**
     * Get rating code.
     *
     * @return string
     */
    public function getAttributeCode();

    /**
     * Get rating value.
     *
     * @return int
     */
    public function getValue();

    /**
     * Set rating id.
     *
     * @param int|null $value
     * @return void
     */
    public function setId($value);

    /**
     * Set review id.
     *
     * @param int $value
     * @return void
     */
    public function setReviewId($value);

    /**
     * Set rating code.
     *
     * @param string $value
     * @return void
     */
    public function setAttributeCode($value);

    /**
     * Set rating value.
     *
     * @param int $value
     * @return void
     */
    public function setValue($value);
}