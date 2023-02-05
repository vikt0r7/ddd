<?php

declare(strict_types=1);

namespace App\Domain\Account;

use App\Domain\Contracts\FinancialAccount;
use App\Domain\Contracts\Wallet;
use App\Domain\Contracts\Transaction;

class Account implements FinancialAccount
{
    private AccountNumber $accountNumber;

    private Wallet $wallet;

    private array $transactions;

    public function __construct(AccountNumber $accountNumber, Wallet $wallet)
    {
        $this->accountNumber = $accountNumber;
        $this->wallet = $wallet;
        $this->transactions = [];
    }

    public function getAccountNumber(): AccountNumber
    {
        return $this->accountNumber;
    }

    public function getWallet(): Wallet
    {
        return $this->wallet;
    }

    public function setWallet(Wallet $wallet): void
    {
        $this->wallet = $wallet;
    }

    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
