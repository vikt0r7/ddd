<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Account\AccountNumber;
use App\Domain\Account\AccountService;
use App\Infrastructure\Repository\TransactionRepository;

class TransactionApplicationService
{
    private AccountService $accountService;

    private TransactionRepository $transactionRepository;

    public function __construct(AccountService $accountService, TransactionRepository $transactionRepository)
    {
        $this->accountService = $accountService;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Deposit money into an account
     */
    public function deposit(AccountNumber $accountNumber, float $amount, string $comment): void
    {
        $this->accountService->deposit($accountNumber, $amount, $comment);
    }

    /**
     * Withdraw money from an account
     */
    public function withdraw(AccountNumber $accountNumber, float $amount, string $comment): void
    {
        $this->accountService->withdraw($accountNumber, $amount, $comment);
    }

    /**
     * Transfer money from an account to other one
     */
    public function transfer(
        AccountNumber $sourceAccountNumber,
        AccountNumber $destinationAccountNumber,
        float         $amount,
        string        $comment
    ): void
    {
        $this->accountService->transfer($sourceAccountNumber, $destinationAccountNumber, $amount, $comment);
    }

    public function getTransactionsSortedByComment(AccountNumber $accountNumber): array
    {
        return $this->transactionRepository->getAllSortedByCommentByAccountNumber($accountNumber);
    }

    public function getTransactionsSortedByDate(AccountNumber $accountNumber): array
    {
        return $this->transactionRepository->getAllSortedByDateByAccountNumber($accountNumber);
    }
}