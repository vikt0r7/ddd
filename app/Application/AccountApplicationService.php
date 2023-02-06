<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Account\AccountNumber;
use App\Domain\Account\AccountService;
use App\Domain\Account\FinancialAccountWallet;
use App\Domain\Contracts\FinancialAccount;
use JetBrains\PhpStorm\Pure;

class AccountApplicationService
{
    private AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Add an account to the system
     */
    public function addAccount(AccountNumber $accountNumber, FinancialAccountWallet $wallet): void
    {
        $this->accountService->addAccount($accountNumber, $wallet);
    }

    /**
     * Get an account
     */
    #[Pure] public function getAccount(AccountNumber $accountNumber): FinancialAccount
    {
        return $this->accountService->getAccount($accountNumber);
    }

    /**
     * Get all accounts in the system
     */
    #[Pure] public function getAllAccounts(): array
    {
        return $this->accountService->getAccounts();
    }

    /**
     * Get the wallet of a specific account
     */
    public function getWallet(AccountNumber $accountNumber): float
    {
        return $this->accountService->getWallet($accountNumber);
    }
}