<?php

declare(strict_types=1);

namespace App\Domain\Account;

use App\Domain\Contracts\FinancialAccount;
use App\Domain\Transaction\DepositInternalTransaction;
use App\Domain\Transaction\External\TransferExternalTransaction;
use App\Domain\Transaction\WithdrawalInternalTransaction;
use App\Infrastructure\Account\AccountRepository;
use JetBrains\PhpStorm\Pure;

class AccountService
{
    private AccountRepository $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * Add an account to the system
     */
    public function addAccount(AccountNumber $accountNumber, FinancialAccountWallet $wallet): void
    {
        if ($this->accountRepository->findByAccountNumber($accountNumber)) {
            throw new \RuntimeException("Account with number {$accountNumber->getNumber()} already exists");
        }

        $this->accountRepository->add(new Account($accountNumber, $wallet));
    }


    #[Pure] public function getAccount(AccountNumber $accountNumber): FinancialAccount
    {
        return $this->accountRepository->find($accountNumber);
    }

    /**
     * Get all accounts in the system
     */
    #[Pure] public function getAccounts(): array
    {
        return $this->accountRepository->findAll();
    }

    /**
     * Get the wallet of a specific account
     */
    public function getWallet(AccountNumber $accountNumber): float
    {
        $account = $this->accountRepository->findByAccountNumber($accountNumber);
        if (!$account) {
            throw new \Exception("Account with number {$accountNumber} does not exist");
        }

        return $account->getWallet()->getAmount();
    }

    public function deposit(AccountNumber $accountNumber, float $amount, string $comment): void
    {
        $account = $this->accountRepository->findByAccountNumber($accountNumber);
        if (!$account) {
            throw new \Exception("Account not found.");
        }

        $wallet = $account->getWallet();
        $wallet->increaseAmount($amount);
        $account->setWallet($wallet);

        $transaction = new DepositInternalTransaction(
            $accountNumber,
            $amount,
            $comment
        );

        $account->addTransaction($transaction);
    }

    public function withdraw(AccountNumber $accountNumber, float $amount, string $comment): void
    {
        $account = $this->accountRepository->findByAccountNumber($accountNumber);
        if (!$account) {
            throw new \Exception("Account not found.");
        }

        $wallet = $account->getWallet();
        if ($wallet->getAmount() < $amount) {
            throw new \Exception("Insufficient funds.");
        }

        $wallet->decreaseAmount($amount);
        $account->setWallet($wallet);

        $transaction = new WithdrawalInternalTransaction(
            $accountNumber,
            $amount,
            $comment
        );
        $account->addTransaction($transaction);
    }


    public function transfer(AccountNumber $sourceAccountNumber, AccountNumber $destinationAccountNumber, float $amount, string $comment): void
    {
        $sourceAccount = $this->accountRepository->findByAccountNumber($sourceAccountNumber);
        if (!$sourceAccount) {
            throw new \Exception("Source account not found.");
        }

        $destinationAccount = $this->accountRepository->findByAccountNumber($destinationAccountNumber);
        if (!$destinationAccount) {
            throw new \Exception("Destination account not found.");
        }

        $sourceAccountWallet = $sourceAccount->getWallet();
        if ($sourceAccountWallet->getAmount() < $amount) {
            throw new \Exception("Insufficient funds.");
        }
        $destinationAccountWallet = $destinationAccount->getWallet();


        $sourceAccountWallet->decreaseAmount($amount);
        $sourceAccount->setWallet($sourceAccountWallet);

        $destinationAccountWallet->increaseAmount($amount);
        $destinationAccount->setWallet($destinationAccountWallet);

        $transaction = new TransferExternalTransaction(
            $sourceAccountNumber,
            $destinationAccountNumber,
            $amount,
            $comment
        );
        $sourceAccount->addTransaction($transaction);
        $destinationAccount->addTransaction($transaction);
    }
}