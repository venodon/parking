<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "visit".
 *
 * @property int $id
 * @property string|null $number
 * @property int|null $status
 * @property string|null $entered_at
 * @property string|null $left_at
 */
class Visit extends ActiveRecord
{
    public const STATUS_IN = 1;
    public const STATUS_LEFT = 2;

    public const STATUS_LIST = [
        self::STATUS_IN   => 'На стоянке',
        self::STATUS_LEFT => 'Выехала'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visit';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['entered_at', 'left_at'], 'safe'],
            [['number'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'number'     => 'Номер',
            'status'     => 'Статус',
            'entered_at' => 'Въезд',
            'left_at'    => 'Выезд',
        ];
    }
}
