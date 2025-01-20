<?php

namespace App\Enums;

enum CapsuleStatusEnum: string
{
    const DRAFT = 'Draft';
    const PUBLISHED = 'Published';
    const PENDING = 'Pending';


    public static function getValues(): array
    {
        return [
            self::DRAFT,
            self::PUBLISHED,
            self::PENDING,
        ];
    }
}
