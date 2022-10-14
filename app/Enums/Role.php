<?php /** @noinspection PhpUndefinedConstantInspection */


namespace App\Enums;


enum Role: string
{
    case ADMIN = 'admin';
    case USER = 'user';
}
