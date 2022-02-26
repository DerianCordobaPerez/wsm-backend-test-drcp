<?php

namespace App\Document;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "demo-db", collection: "metrics")]
class Metric
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::DATE)]
    private DateTime $date;

    #[MongoDB\Field(type: Type::STRING)]
    private string $accountId;

    #[MongoDB\Field(type: Type::INT)]
    private int $impressions;

    #[MongoDB\Field(type: Type::INT)]
    private int $clicks;

    #[MongoDB\Field(type: Type::INT)]
    private int $ctr;

    #[MongoDB\Field(type: Type::INT)]
    private int $conversions;

    #[MongoDB\Field(type: Type::DECIMAL128)]
    private float $costPerClick;

    #[MongoDB\Field(type: Type::DECIMAL128)]
    private float $spend;

    public function __construct(
        DateTime $date,
        string $accountId,
        int $impressions,
        int $clicks,
        int $ctr,
        int $conversions,
        float $costPerClick,
        float $spend
    ) {
        $this->date = $date;
        $this->accountId = $accountId;
        $this->impressions = $impressions;
        $this->clicks = $clicks;
        $this->ctr = $ctr;
        $this->conversions = $conversions;
        $this->costPerClick = $costPerClick;
        $this->spend = $spend;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     */
    public function setAccountId(string $accountId): void
    {
        $this->accountId = $accountId;
    }

    /**
     * @return int
     */
    public function getImpressions(): int
    {
        return $this->impressions;
    }

    /**
     * @param int $impressions
     */
    public function setImpressions(int $impressions): void
    {
        $this->impressions = $impressions;
    }

    /**
     * @return int
     */
    public function getClicks(): int
    {
        return $this->clicks;
    }

    /**
     * @param int $clicks
     */
    public function setClicks(int $clicks): void
    {
        $this->clicks = $clicks;
    }

    /**
     * @return int
     */
    public function getCtr(): int
    {
        return $this->ctr;
    }

    /**
     * @param int $ctr
     */
    public function setCtr(int $ctr): void
    {
        $this->ctr = $ctr;
    }

    /**
     * @return int
     */
    public function getConversions(): int
    {
        return $this->conversions;
    }

    /**
     * @param int $conversions
     */
    public function setConversions(int $conversions): void
    {
        $this->conversions = $conversions;
    }

    /**
     * @return float
     */
    public function getCostPerClick(): float
    {
        return $this->costPerClick;
    }

    /**
     * @param float $costPerClick
     */
    public function setCostPerClick(float $costPerClick): void
    {
        $this->costPerClick = $costPerClick;
    }

    /**
     * @return float
     */
    public function getSpend(): float
    {
        return $this->spend;
    }

    /**
     * @param float $spend
     */
    public function setSpend(float $spend): void
    {
        $this->spend = $spend;
    }

}