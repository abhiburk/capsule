<?php

namespace App\Enums;

enum CapsuleVisibilityEnum: string
{
    const PRIVATE = 'Private';
    const PUBLIC = 'Public';

    public static function getValues(): array
    {
        return [
            self::PRIVATE,
            self::PUBLIC,
        ];
    }
}
