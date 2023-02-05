<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Account\AccountNumber;
use App\Domain\Contracts\Transaction;
use App\Domain\Contracts\TransactionRepository as TransactionRepositoryContract;

final class TransactionRepository implements TransactionRepositoryContract
{
    private array $transactions = [];

    public function add(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    public function allSortedByComment(): array
    {
        $sortedTransactions = $this->transactions;

        usort($sortedTransactions, static function (Transaction $a, Transaction $b) {
            return strcmp($a->getComment(), $b->getComment());
        });

        return $sortedTransactions;
    }

    public function allSortedByDate(): array
    {
        $sortedTransactions = $this->transactions;

        usort($sortedTransactions, static function (Transaction $a, Transaction $b) {
            return $a->getCreatedAt() <=> $b->getCreatedAt();
        });

        return $sortedTransactions;
    }

    public function getAllSortedByCommentByAccountNumber(AccountNumber $accountNumber): array
    {
        $transactions = $this->getAllByAccountNumber($accountNumber);

        usort($transactions, static function (Transaction $a, Transaction $b) {
            return strcmp($a->getComment(), $b->getComment());
        });

        return $transactions;
    }

    public function getAllByAccountNumber(AccountNumber $accountNumber): array
    {
        $transactions = [];

        foreach ($this->transactions as $transaction) {
            if ($transaction->getAccountNumber()->equals($accountNumber)) {
                $transactions[] = $transaction;
            }
        }

        return $transactions;
    }

    public function getAllSortedByDateByAccountNumber(AccountNumber $accountNumber): array
    {
        $transactions = $this->getAllByAccountNumber($accountNumber);

        usort($transactions, static function (Transaction $a, Transaction $b) {
            return $a->getCreatedAt() <=> $b->getCreatedAt();
        });

        return $transactions;
    }
}
