<?php
/**
 * Created by PhpStorm.
 * User: XPS
 * Date: 6/4/2015
 * Time: 11:29 AM
 */
namespace bank\filters;


use yii\base\ActionFilter;
use yii\web\HttpException;

class AuthFilter extends ActionFilter {

    const AUTH_HEADER = "X-AUTHORIZATION";
    const ERROR_CODE = 403;
    const ERROR_MESSAGE = "Access Denied";
    //------------------------------------------------------------------------------------------------------------------
    public function beforeAction($action){

        $authKey = \Yii::$app->request->headers->get(self::AUTH_HEADER,false);
        if(!$authKey || !$this->valid($authKey)){
            throw new HttpException(self::ERROR_CODE,self::ERROR_MESSAGE);
        }
        return parent::beforeAction($action);
    }
    //------------------------------------------------------------------------------------------------------------------
    private function valid($authKey){
        return ($authKey == '2fffc582-1ed2-4f17-80cf-458cvdfdfec'); /*TODO HARD CODED FOR NOW*/
    }
    //------------------------------------------------------------------------------------------------------------------
}