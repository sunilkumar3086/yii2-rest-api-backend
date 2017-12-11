<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 3:23 PM
 */

namespace bank\models\response;


class ListAPIResponse extends BankAPIResponse {

    public $data = [];

    public function rules(){
        return [
            [['data'],'required'],
        ];
    }
    //------------------------------------------------------------------------------------------------------------------
    public function attributeLabels(){
        return [
            'data' => 'data',
        ];
    }
    //------------------------------------------------------------------------------------------------------------------
    public function addData(BankAPIResponse $data){
        if(!$data || !$data->validate()){
            return;
        }
        array_push($this->data,$data);
    }
    //------------------------------------------------------------------------------------------------------------------
    public function fieldMasks(){
        return [
            'data' => 'dt',
        ];
    }
    //------------------------------------------------------------------------------------------------------------------
    public function responseFields(){
        return [
            'data' => 'data',
        ];
    }
}