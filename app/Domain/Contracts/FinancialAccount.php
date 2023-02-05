<?php
declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Domain\Account\AccountNumber;

interface FinancialAccount
{
    public function getAccountNumber(): AccountNumber;

    public function getWallet(): Wallet;

    public function addTransaction(Transaction $transaction): void;
}