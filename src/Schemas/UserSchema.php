<?php

namespace Amethyst\Schemas;

use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class UserSchema extends Schema
{
    /**
     * Get all the attributes.
     *
     * @var array
     */
    public function getAttributes()
    {
        return [
            Attributes\IdAttribute::make(),
            Attributes\TextAttribute::make('name')
                ->setUnique(true)
                ->setRequired(true),
            Attributes\EmailAttribute::make('email')
                ->setRequired(true)
                ->setUnique(true),
            Attributes\PasswordAttribute::make('password')
                ->setRequired(true),
            Attributes\BooleanAttribute::make('enabled'),
            Attributes\TextAttribute::make('token')
                ->setDefault(function ($entity, $attribute) {
                    return $attribute->getManager()->getRepository()->generateToken();
                })
                ->setFillable(false),
            Attributes\EnumAttribute::make('role', ['user', 'admin']),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
