<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 11:30 AM
 */

namespace bank\models\request;


class CustomerRequest extends BankAPIRequest{

    public $name;
    public $password;

    //------------------------------------------------------------------------------------------------------------------
    public function rules(){
        return [
            [['name','cnp'],'required'],
            ['name', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This name has already been taken.'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6],

        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function attributeLabels(){
        return [
            'name' => 'Name',
            'password' => 'Password',
        ];
    }

    //------------------------------------------------------------------------------------------------------------------
    public function loadFromRequest($data=null){

        $this->name = $this->getArrValue($data,'name',null);
        $this->password = $this->getArrValue($data,'cnp',null);
    }

    //------------------------------------------------------------------------------------------------------------------

}