<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 12:50 PM
 */

namespace bank\models\request;


class TransactionListRequest extends TransactionAddRequest {

    public $date;
    public $offset;
    public $limit;

    //------------------------------------------------------------------------------------------------------------------
    public function rules(){
        return [
            [['customerId',],'required'],
            [['amount','date','offset','limit'],'safe'],
            [['customerId','amount','offset','limit'],'integer'],
            [['amount'],'integer','min'=>1],
            [['offset'],'default','value'=>self::OFFSET],
            [['limit'],'default','value'=>self::PAGE_SIZE],
            [['date'], 'date', 'format' => 'php:Y-m-d'],

        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function attributeLabels(){
        return [
            'customerId'=> 'customerId',
            'amount' => 'Amount',
            'date' => 'date',
            'offset' => 'offset',
            'limit' => 'limit',
        ];

    }

}