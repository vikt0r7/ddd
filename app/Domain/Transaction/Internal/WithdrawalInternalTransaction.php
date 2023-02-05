<?php

namespace App\Domain\Transaction;

use App\Domain\Account\Account;

class WithdrawalInternalTransaction extends InternalTransaction
{
    public function apply(Account $account): void
    {
        $wallet = $account->getWallet();
        $wallet->decreaseAmount($this->getAmount());

        $account->setWallet($wallet);
    }
}