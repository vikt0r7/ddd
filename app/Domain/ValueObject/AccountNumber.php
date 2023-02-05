<?php

declare(strict_types=1);

namespace App\Domain\Account;

use App\Domain\Contracts\ValueObject;

final class AccountNumber implements ValueObject
{
    private string $number;

    public function __construct(string $number)
    {
        $this->number = $number;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function equals(ValueObject $valueObject): bool
    {
        return \get_class($this) === \get_class($valueObject) && $this->number === $valueObject->number;
    }
}
