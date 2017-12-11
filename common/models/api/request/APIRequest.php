<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 11:24 AM
 */

namespace common\models\api\request;
use Yii;
use yii\base\Model;
abstract class APIRequest extends Model {
    public abstract function loadFromRequest();//return request data in required format
    //------------------------------------------------------------------------------------------------------------------
    protected function getArrValue($data,$key,$defaultValue = ''){
        if(!is_array($data) || !isset($data[$key])){
            return $defaultValue;
        }
        return $data[$key];
    }
    //------------------------------------------------------------------------------------------------------------------
    protected function getObjectValue($obj, $name, $default = false){
        if(!isset($obj->$name)){
            return $default;
        }
        return $obj->$name;
    }
}