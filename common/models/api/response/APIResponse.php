<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 11:24 AM
 */

namespace common\models\api\response;
use Yii;
use yii\base\Model;
abstract class APIResponse extends Model {
    //------------------------------------------------------------------------------------------------------------------
    public function fields(){
        $responseFields = $this->responseFields();
        return $this->doMasking($responseFields);
    }
    //------------------------------------------------------------------------------------------------------------------
    public function getErrorFields(){
        $responseFields = $this->getErrors();
        return $this->doMasking($responseFields);
    }
    //------------------------------------------------------------------------------------------------------------------
    private function doMasking($fields){
        $fieldMasks = $this->fieldMasks();
        $allFields = parent::fields();
        if(!is_array($fields) || count($fields) == 0){
            $fields = $allFields;
        }
        if(!is_array($fieldMasks) || count($fieldMasks) == 0){
            return $fields;
        }
        $fieldMasks = array_merge($allFields,$fieldMasks);
        $_fields = [];
        foreach($fields as $key=>$value){
            $_key = $key;
            if(!is_string($key) && is_string($value)){
                $_key = $value;
            }
            if(isset($fieldMasks[$_key])){
                $_key = $fieldMasks[$_key];
            }
            $_fields[$_key] = $value;
        }
        return $_fields;
    }
    //------------------------------------------------------------------------------------------------------------------
    public function fieldMasks(){
        return [];
    }
    //------------------------------------------------------------------------------------------------------------------
    public function responseFields(){
        return [];
    }
    //------------------------------------------------------------------------------------------------------------------
    public function getArrayValue($array,$key,$default = null){
        if(!is_array($array) || !isset($array[$key])){
            return $default;
        }
        return $array[$key];
    }
}