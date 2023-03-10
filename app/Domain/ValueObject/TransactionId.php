<?php

declare(strict_types=1);

namespace App\Domain\Transaction;

use App\Domain\Contracts\ValueObject;
use JetBrains\PhpStorm\Pure;

final class TransactionId implements ValueObject
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    #[Pure] public function equals(ValueObject $valueObject): bool
    {
        return get_class($valueObject) === self::class && $valueObject->getId() === $this->getId();
    }

    public function getId(): string
    {
        return $this->id;
    }
}
