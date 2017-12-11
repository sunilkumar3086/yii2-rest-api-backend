<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransactionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer_id',
            'amount',


            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d'],
                'filter' => DateT::widget([]),

            ],

            'updated_at',
            // 'deleted_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'

            ],
        ],
    ]); ?>
</div>
