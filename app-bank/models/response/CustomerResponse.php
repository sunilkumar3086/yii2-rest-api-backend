<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 11:46 AM
 */

namespace bank\models\response;


class CustomerResponse extends BankAPIResponse{

    public $customerId;
    public $authKey;

    //------------------------------------------------------------------------------------------------------------------
    public function rules(){
        return [
            [['customerId'],'required'],
            [['customerId'],'integer'],
            [['authKey'],'safe'],
            [['authKey'],'string'],
        ];
    }


    //------------------------------------------------------------------------------------------------------------------
    public function fieldMasks(){
        return [
            'customerId' => 'customerId',
        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function responseFields(){
        return [
            'customerId',
        ];
    }


}