<?php

use app\models\Visit;
use yii\grid\SerialColumn;
use app\models\VisitSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel VisitSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Просмотр парковки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'options'      => ['class' => 'table-responsive'],
        'tableOptions' => ['class' => 'table table-condensed table-striped'],
        'columns'      => [
            ['class' => SerialColumn::class],

            [
                'attribute' => 'id',
                'options'   => ['style' => 'width:50px'],
                'filter'    => false
            ],
            'number',
            'entered_at',
            [
                'attribute' => 'left_at',
                'value'     => static function ($model) {
                    return $model->left_at ?? 'Минут на стоянке: '.(int)((time() - strtotime($model->entered_at))/60);
                },
            ],
            [
                'attribute' => 'status',
                'value'     => static function ($model) {
                    return ArrayHelper::getValue(Visit::STATUS_LIST, $model->status);
                },
                'filter'    => Visit::STATUS_LIST
            ],
        ],
        'layout'       => '{items}{pager}'
    ]); ?>
    <?php Pjax::end(); ?>
</div>
