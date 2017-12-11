<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 1:11 PM
 */

namespace bank\models\response;


class TransactionAddResponse extends BankAPIResponse{

    public $transactionId;
    public $customerId;
    public $amount;
    public $date;

    //------------------------------------------------------------------------------------------------------------------
    public function rules(){
        return [
            [['transactionId','customerId','amount','date'],'required'],
            [['transactionId','customerId','amount'],'integer']
        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function loadFromApiResponse($data){
        if(!$data || !is_object($data)){
            return null;
        }

        $this->transactionId = $data->id;
        $this->customerId= $data->customer_id;
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
            'transactionId','customerId','amount','date'
        ];
    }

}