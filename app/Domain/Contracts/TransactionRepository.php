<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

interface TransactionRepository
{
    public function add(Transaction $transaction): void;

    public function allSortedByComment(): array;

    public function allSortedByDate(): array;
}
