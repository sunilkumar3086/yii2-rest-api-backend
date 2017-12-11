<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 12:50 PM
 */

namespace bank\models\response;


class CustomerTransactionsResponse extends TransactionsResponse {


    //------------------------------------------------------------------------------------------------------------------
    public function rules(){
        return [
            [['transactionId','amount','date'],'required'],
            [['transactionId','amount'],'integer']
        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function loadFromApiResponse($data){
        if(!$data || !is_object($data)){
            return null;
        }

        $this->transactionId = $data->id;
        $this->amount = $data->amount;
        $this->date = $data->created_at;

    }

    //------------------------------------------------------------------------------------------------------------------
    public function fieldMasks(){
        return [];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function responseFields(){
        return [
            'transactionId','amount','date'
        ];
    }

}