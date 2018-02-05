<?php
namespace Gmart\Mobileshop\Model;
use Gmart\Mobileshop\Api\Data\ReviewOverviewInterface;

class ReviewOverview implements ReviewOverviewInterface
{

    protected $total;
    protected $avg;
    protected $reviewId;
    protected $createdAt;
    protected $entityId;
    protected $entityPkValue;
    protected $statusId;
    protected $detailId;
    protected $title;
    protected $detail;
    protected $nickname;
    protected $customerId;
    protected $entityCode;
    protected $rating;


    /**
     * Get product reviews total
     *
     * @return int|null
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set product reviews total
     *
     * @param int $total
     * @return $this
     * @internal param int $id
     */
    public function setTotal($total)
    {
        $this->total = $total;

    }


    /**
     * @return float mixed
     */
    public function getAvg()
    {
        return $this->avg;
    }

    /**
     * @param float $avg
     * @return $this
     */
    public function setAvg($avg)
    {
        $this->avg = $avg;
    }


    /**
     * @return int mixed
     */
    public function getReviewId()
    {
        return $this->reviewId;
    }

    /**
     * @param  int $value
     * @return $this
     */
    public function setReviewId($value)
    {
        $this->reviewId = $value;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createAt
     * @return mixed|void
     */
    public function setCreatedAt($createAt)
    {
        $this->createdAt = $createAt;
    }

    /**
     * @return mixed
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @param int $entityId
     * @return mixed|void
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;
    }

    /**
     * @return mixed
     */
    public function getEntityPkValue()
    {
        return $this->entityPkValue;
    }

    /**
     * @param int $entityPkValue
     * @return mixed|void
     */
    public function setEntityPkValue($entityPkValue)
    {
        $this->entityPkValue = $entityPkValue;
    }

    /**
     * @return mixed
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @param int $statusId
     * @return mixed|void
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
    }

    /**
     * @return mixed
     */
    public function getDetailId()
    {
        return $this->detailId;
    }

    /**
     * @param int $detailId
     * @return mixed|void
     */
    public function setDetailId($detailId)
    {
        $this->detailId = $detailId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return mixed|void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     * @return mixed|void
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param string $detail
     * @return mixed|void
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     * @return mixed|void
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param int|null $customerId
     * @return mixed|void
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return mixed
     */
    public function getEntityCode()
    {
        return $this->entityCode;
    }

    /**
     * @param string $entityCode
     * @return mixed|void
     */
    public function setEntityCode($entityCode)
    {
        $this->entityCode = $entityCode;
    }
}