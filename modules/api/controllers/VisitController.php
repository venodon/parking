<?php

namespace app\modules\api\controllers;

use app\modules\api\helpers\NumberHelper;
use app\models\Visit;
use yii\rest\Controller;

class VisitController extends Controller
{
    public $modelClass = Visit::class;

    public function actionEnter()
    {
        $status = 'fail';
        $number = \Yii::$app->request->post('number');
        if ($number && NumberHelper::checkNumber($number)) {
            $visit = Visit::findOne(['number' => $number, 'status' => Visit::STATUS_IN]);
            if ($visit) {
                \Yii::info('Автомобиль, который пытаются добавить, уже находится на стоянке. Номер авто '.$number);
            } else {
                $visit = new Visit([
                    'number'     => $number,
                    'entered_at' => date('Y-m-d H:i:s', time()),
                    'status'     => Visit::STATUS_IN
                ]);
                if ($visit->save()) {
                    $status = 'success';
                }
            }
        }
        return ['status' => $status, 'number' => $number, 'type' => 'enter'];
    }

    public function actionExit()
    {
        $status = 'fail';
        $number = \Yii::$app->request->post('number');
        if ($number && NumberHelper::checkNumber($number)) {
            $visit = Visit::findOne(['number' => $number, 'status' => Visit::STATUS_IN]);
            if ($visit) {
                $visit->status = Visit::STATUS_LEFT;
                $visit->left_at = date('Y-m-d H:i:s', time());
                if ($visit->save()) {
                    $status = 'success';
                }
            }else{
                \Yii::info('Попытка выезда автомобиля, который уже числится выехавшим. Номер авто '.$number);
            }
        }
        return ['status' => $status, 'number' => $number, 'type' => 'left'];
    }
}
