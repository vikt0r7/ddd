<?php

declare(strict_types=1);

namespace App\Infrastructure\Account;

use App\Domain\Account\Account;
use App\Domain\Account\AccountNumber;
use JetBrains\PhpStorm\Pure;

class AccountRepository
{
    /**
     * @var Account[]
     */
    private array $accounts = [];

    /**
     * Add an account to the repository
     *
     * @param Account $account
     */
    public function add(Account $account): void
    {
        $this->accounts[] = $account;
    }

    /**
     * Find an account by its account number
     *
     * @param AccountNumber $accountNumber
     * @return Account|null
     */
    #[Pure] public function findByAccountNumber(AccountNumber $accountNumber): ?Account
    {
        foreach ($this->accounts as $account) {
            if ($account->getAccountNumber()->equals($accountNumber)) {
                return $account;
            }
        }

        return null;
    }

    /**
     * Find an account by its ID
     *
     * @param AccountNumber $accountNumber
     * @return Account|null
     */
    #[Pure] public function find(AccountNumber $accountNumber): ?Account
    {
        foreach ($this->accounts as $account) {
            if ($account->getAccountNumber()->equals($accountNumber)) {
                return $account;
            }
        }

        return null;
    }

    /**
     * Get all accounts in the repository
     *
     * @return Account[]
     */
    public function findAll(): array
    {
        return $this->accounts;
    }
}

