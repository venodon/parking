<?php

namespace app\helpers;

use Yii;

class NumberHelper
{
    /**
     * Проверяем только стандартные номера авто, без всяких транзиток, военных, ведомственных, мото и т.д.
     */
    private const PATTERN = '/^[АВЕКМНОРСТУХ]\d{3}(?<!000)[АВЕКМНОРСТУХ]{2}\d{2,3}$/ui';

    public static function checkNumber(string $number): bool
    {
        $result = preg_match('/^[АВЕКМНОРСТУХ]\d{3}(?<!000)[АВЕКМНОРСТУХ]{2}\d{2,3}$/ui', $number);
        if (!$result) {
            Yii::info('Получено некоррректное значение номера: '.$number);
        }
        return $result;
    }
}