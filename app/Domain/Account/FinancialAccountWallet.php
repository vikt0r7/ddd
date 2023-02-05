<?php

declare(strict_types=1);

namespace App\Domain\Account;

use App\Domain\Contracts\Wallet as WalletContract;

final class FinancialAccountWallet implements WalletContract
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function increaseAmount(float $amount): void
    {
        $this->amount += $amount;
    }

    public function decreaseAmount(float $amount): void
    {
        $this->amount -= $amount;
    }
}