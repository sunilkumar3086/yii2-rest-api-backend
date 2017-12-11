<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 12:50 PM
 */

namespace bank\models\request;


class TransactionUpdateRequest extends BankAPIRequest{

    public $transactionId;
    public $amount;

    //------------------------------------------------------------------------------------------------------------------
    public function rules(){
        return [
            [['transactionId','amount'],'required'],
            [['transactionId','amount'],'integer'],
            [['amount'],'integer','min'=>1],
        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function attributeLabels(){
        return [
            'transactionId'=> 'transactionId',
            'amount' => 'Amount',
        ];

    }

}