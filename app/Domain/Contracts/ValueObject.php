<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

interface ValueObject
{
    public function equals(ValueObject $valueObject): bool;
}
