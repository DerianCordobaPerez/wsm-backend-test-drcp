<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "demo-db", collection: "accounts")]
class Account
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $accountId;

    #[MongoDB\Field(type: Type::INT)]
    private int $externalAccountId;

    #[MongoDB\Field(type: Type::STRING)]
    private string $currencyCode;

    #[MongoDB\Field(type: Type::STRING)]
    private string $status;

    #[MongoDB\Field(type: Type::STRING)]
    private string $accountName;

    public function __construct(
        string $accountId,
        int $externalAccountId,
        string $currencyCode,
        string $status,
        string $accountName
    ) {
        $this->accountId = $accountId;
        $this->externalAccountId = $externalAccountId;
        $this->currencyCode = $currencyCode;
        $this->status = $status;
        $this->accountName = $accountName;
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
    public function getExternalAccountId(): int
    {
        return $this->externalAccountId;
    }

    /**
     * @param int $externalAccountId
     */
    public function setExternalAccountId(int $externalAccountId): void
    {
        $this->externalAccountId = $externalAccountId;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     */
    public function setCurrencyCode(string $currencyCode): void
    {
        $this->currencyCode = $currencyCode;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getAccountName(): string
    {
        return $this->accountName;
    }

    /**
     * @param string $accountName
     */
    public function setAccountName(string $accountName): void
    {
        $this->accountName = $accountName;
    }

}