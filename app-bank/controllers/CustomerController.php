<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 11:16 AM
 */

namespace bank\controllers;


use bank\components\UserHelper;
use bank\models\request\CustomerRequest;
use bank\models\response\CustomerResponse;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\ConflictHttpException;

class CustomerController extends RestController{
    public function behaviors(){
        $behaviors = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index'  => ['post'],
                ],
            ],
        ];
        return ArrayHelper::merge(parent::behaviors(),$behaviors);
    }



    //------------------------------------------------------------------------------------------------------------------
    public function actionIndex(){
        $_post = \Yii::$app->request->post();

        $request = new CustomerRequest();
        $request->loadFromRequest($_post);

        if(!$request->validate()){
            throw new ConflictHttpException("Invalid Request");
        }

        $userHelper = new UserHelper();
        $user = $userHelper->saveUser($request);
        if(!$user){
            throw new ConflictHttpException("Customer not register");
        }

        $response = new CustomerResponse();
        $response->customerId = $user->id;
        $response->authKey = $user->auth_key;

        if(!$response->validate()){
            throw new ConflictHttpException("Customer response invalid");
        }

        return $this->sendResponse($response);

    }

}