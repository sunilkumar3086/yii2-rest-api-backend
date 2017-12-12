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
                'class' => \common\widgets\grid\DatePickerColumn::className(),
                'header' => 'Original Pickup Date',
                'column' => 'created_at',
                'containerOptions' => ['class' => 'drp-container input-group',],
                'filterAttribute' => 'created_at',
            ],

            //'updated_at',
            // 'deleted_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'

            ],
        ],
    ]); ?>
</div>
