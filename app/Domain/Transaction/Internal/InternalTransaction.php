<?php

declare(strict_types=1);

namespace App\Domain\Transaction;

use App\Domain\Account\AccountNumber;
use App\Domain\Contracts\Transaction as TransactionContract;
use DateTimeImmutable;

abstract class InternalTransaction implements TransactionContract
{
    private AccountNumber $accountNumber;

    private float $amount;

    private string $comment;

    private DateTimeImmutable $createdAt;

    public function __construct(
        AccountNumber     $accountNumber,
        float             $amount,
        string            $comment,
        DateTimeImmutable $createdAt = null
    )
    {
        $this->accountNumber = $accountNumber;
        $this->amount = $amount;
        $this->comment = $comment;
        $this->createdAt = $createdAt ?: new DateTimeImmutable();
    }

    public function getAccountNumber(): AccountNumber
    {
        return $this->accountNumber;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
