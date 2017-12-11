<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 12:50 PM
 */

namespace bank\models\request;


class TransactionAddRequest extends BankAPIRequest{

    public $customerId;
    public $amount;

    //------------------------------------------------------------------------------------------------------------------
    public function rules(){
        return [
            [['customerId','amount'],'required'],
            [['customerId','amount'],'integer'],
            [['amount'],'integer','max'=>0],
        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function attributeLabels(){
        return [
            'customerId'=> 'customerId',
            'amount' => 'Amount',
        ];

    }

}