<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 12:30 PM
 */

namespace common\components;

class Utils{
    //------------------------------------------------------------------------------------------------------------------
    /**
     * @return array
     */
    public static function getYesNoList(){
        $list=[0=>'No',1=>'Yes'];
        return $list;
    }
    //------------------------------------------------------------------------------------------------------------------
    /**
     * @return string
     */
    public static function getNow(){
        return \Yii::$app->formatter->asDatetime("NOW", "php:Y-m-d H:i:s");
    }

    //------------------------------------------------------------------------------------------------------------------
    public static function subtractDays($days)
    {
        if(!is_numeric($days) && $days != ''){
            self::getNow();
        }
        return \Yii::$app->formatter->asDatetime(strtotime(self::getNow() . "-$days days"),'php:Y-m-d H:i:s');
    }
}