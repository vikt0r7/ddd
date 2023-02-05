<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

use DateTimeImmutable;

interface Transaction
{
    public function getTransactionType(): string;

    public function getAmount(): float;

    public function getComment(): string;

    public function getCreatedAt(): DateTimeImmutable;
}