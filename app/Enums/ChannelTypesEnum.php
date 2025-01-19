<?php

namespace App\Enums;

enum ChannelTypesEnum: string
{
    const EMAIL = 'email';
    const SMS = 'sms';

    public static function getValues(): array
    {
        return [
            self::EMAIL,
            self::SMS,
        ];
    }
}
