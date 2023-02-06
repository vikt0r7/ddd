<?php

declare(strict_types=1);

namespace App\Domain\Transaction\External;

final class TransferExternalTransaction extends ExternalTransaction
{
    public function getTransactionType(): string
    {
        return self::class;
    }
}
