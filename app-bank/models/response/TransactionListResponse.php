<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 1:11 PM
 */

namespace bank\models\response;


class TransactionListResponse extends TransactionsResponse{



    //------------------------------------------------------------------------------------------------------------------
    public function rules(){
        return [
            [['transactionId','customerId','amount','date'],'required'],
            [['transactionId','customerId','amount'],'integer']
        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function fieldMasks(){
        return [];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function responseFields(){
        return [
            'transactionId','customerId','amount','date'
        ];
    }

}