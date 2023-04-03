<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StudentStatusEnum extends Enum
{
    const DI_HOC =   0;
    const BO_HOC =   1;
    const BAO_LUU =  2;

    public static function getArrayView()
    {
        return [
            'Đi học' => self::DI_HOC,
            'Bỏ học' => self::BO_HOC,
            'Bảo lưu' => self::BAO_LUU,
        ];
    }

    public static function getKeyByValues($value){
        return array_search($value, self::getArrayView(), true);
    }
}
