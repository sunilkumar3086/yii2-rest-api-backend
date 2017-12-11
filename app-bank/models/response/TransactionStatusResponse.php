<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 10:07 PM
 */

namespace bank\models\response;


class TransactionStatusResponse extends BankAPIResponse{

    const SUCCESS = "success";
    const FAIL = "fail";

    public $status;

    public function rules(){
        return [
            [['status'],'required'],
        ];
    }


    //------------------------------------------------------------------------------------------------------------------
    public function fieldMasks(){
        return [];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function responseFields(){
        return [
            'status'
        ];
    }
}