<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $amount
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property User $customer
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'amount', 'created_at', 'updated_at'], 'required'],
            [['customer_id', 'amount'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::className(), ['id' => 'customer_id']);
    }
}