<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

interface Wallet
{
    public function getAmount(): float;

    public function increaseAmount(float $amount): void;

    public function decreaseAmount(float $amount): void;
}