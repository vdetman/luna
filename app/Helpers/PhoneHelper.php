<?php

namespace App\Helpers;

class PhoneHelper
{
    public static function clean(?string $phone): string
    {
        return preg_replace('[\D]', '', $phone);
    }

    public static function isValid(string $phone): bool
    {
        $phone = self::clean($phone);

        return strlen($phone) > 10;
    }

    /**
     * Преобразует номер телефона в нужный формат
     *
     * @param  string  $phone  +79998887766 или +380112223344
     * @return string +7 (999) 888-77-66 или +380 (62) 253-37-82
     */
    public static function phoneFormat(string $phone): string
    {
        $phone = self::clean($phone);
        switch (true) {
            // Russia
            case (strlen($phone) == 11) && (str_starts_with($phone, '7')):
                $format = [1 => '-', 3 => '-', 6 => ' )', 9 => '( '];
                break;
            default:
                return $phone;
        }

        // номер позиции с конца (начиная с 0) => символ
        $modify_phone = [];
        foreach (str_split(strrev($phone)) as $index => $symbol) {
            $modify_phone[] = $symbol.(array_key_exists($index, $format) ? $format[$index] : '');
        }

        return '+'.strrev(implode('', $modify_phone));
    }
}
