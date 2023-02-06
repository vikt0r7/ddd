<?php

declare(strict_types=1);

namespace App\Domain\Transaction;

use App\Domain\Contracts\FinancialAccount;

class DepositInternalTransaction extends InternalTransaction
{
    public function apply(FinancialAccount $account): void
    {
        $wallet = $account->getWallet();
        $wallet->increaseAmount($this->getAmount());

        $account->setWallet($wallet);
    }

    public function getTransactionType(): string
    {
        return self::class;
    }
}