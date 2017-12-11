<?php

namespace common\models;

use common\components\Utils;
use common\models\reglobe\TransactionsFilter;
use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property integer $id
 * @property integer $amount
 * @property string $created_at
 *
 */
class TransactionsSum extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transactions_sum';
    }

    public function beforeSave($insert)
    {
        $now = Utils::getNow();
        if($this->isNewRecord){
            $this->created_at = $now;
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount'], 'required'],
            [['amount'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'created_at' => 'Created At',
        ];
    }

}
