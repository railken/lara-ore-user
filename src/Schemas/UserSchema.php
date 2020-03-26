<?php

namespace Amethyst\Schemas;

use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class UserSchema extends Schema
{
    /**
     * Get all the attributes.
     *
     * @return array<Attributes\BaseAttribute>
     */
    public function getAttributes(): array
    {
        return [
            Attributes\IdAttribute::make(),
            Attributes\UuidAttribute::make(),
            Attributes\TextAttribute::make('name')
                ->setUnique(true)
                ->setRequired(true),
            Attributes\EmailAttribute::make('email')
                ->setRequired(true)
                ->setUnique(true),
            Attributes\PasswordAttribute::make('password')
                ->setRequired(true),
            Attributes\BooleanAttribute::make('enabled'),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
