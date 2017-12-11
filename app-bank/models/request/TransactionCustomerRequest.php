<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 12:50 PM
 */

namespace bank\models\request;


class TransactionCustomerRequest extends BankAPIRequest{

    public $transactionId;
    public $customerId;

    //------------------------------------------------------------------------------------------------------------------
    public function rules(){
        return [
            [['transactionId','customerId'],'required'],
            [['transactionId','customerId'],'integer'],

        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function attributeLabels(){
        return [
            'transactionId'=> 'transactionId',
            'customerId' => 'customerId',
        ];

    }

}