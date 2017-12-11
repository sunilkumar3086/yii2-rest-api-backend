<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 5:57 PM
 */

namespace backend\components;



use common\models\Role;
use yii\web\User;

class Backend extends User {

    public function getRole(){
        if($this->getIdentity()!=null && !empty($this->getIdentity()->role)){
            return $this->getIdentity()->role;
        }
        return null;
    }

    //------------------------------------------------------------------------------------------------------------------
    public function getIsAdmin()
    {
        return $this->getRole() === Role::ROLE_ADMIN;
    }

    //------------------------------------------------------------------------------------------------------------------
    public function getIsCustomer()
    {
        return $this->getRole() === Role::ROLE_CUSTOMER;
    }



}