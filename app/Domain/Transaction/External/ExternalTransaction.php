<?php

declare(strict_types=1);

namespace App\Domain\Transaction\External;

use App\Domain\Account\AccountNumber;
use App\Domain\Contracts\Transaction as TransactionContract;
use DateTimeImmutable;

abstract class ExternalTransaction implements TransactionContract
{
    private AccountNumber $sourceAccountNumber;

    private AccountNumber $destinationAccountNumber;

    private float $amount;

    private string $comment;

    private DateTimeImmutable $createdAt;

    public function __construct(
        AccountNumber      $sourceAccountNumber,
        AccountNumber      $destinationAccountNumber,
        float              $amount,
        string             $comment,
         DateTimeImmutable $createdAt = null
    )
    {
        $this->sourceAccountNumber = $sourceAccountNumber;
        $this->destinationAccountNumber = $destinationAccountNumber;
        $this->amount = $amount;
        $this->comment = $comment;
        $this->createdAt = $createdAt ?: new DateTimeImmutable();
    }

    public function getSourceAccountNumber(): AccountNumber
    {
        return $this->sourceAccountNumber;
    }

    public function getDestinationAccountNumber(): AccountNumber
    {
        return $this->destinationAccountNumber;
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
