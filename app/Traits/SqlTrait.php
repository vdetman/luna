<?php

namespace App\Traits;

trait SqlTrait
{
    public function whereLikeRaw(array $fields, $str = ''): string
    {
        $sql = [];
        foreach ($fields as $field) {
            $sql[] = "{$field} LIKE '%{$str}%'";
        }

        return '('.implode(' OR ', $sql).')';
    }
}
