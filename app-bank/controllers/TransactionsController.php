<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 11:16 AM
 */

namespace bank\controllers;


use bank\components\TransactionsHelper;
use bank\models\request\TransactionAddRequest;
use bank\models\response\TransactionAddResponse;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\ConflictHttpException;

class TransactionsController extends RestController{
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
        $request = new TransactionAddRequest();
        $request->load(\Yii::$app->request->post(),null);

        if(!$request->validate()){
            throw new ConflictHttpException("Invalid Request");
        }

        $helper = TransactionsHelper::getInstance();
        $transactions = $helper->saveTransactions($request->customerId,$request->amount);
        if(!$transactions){
            throw new ConflictHttpException("Transactions not saved Please try again");
        }

        $response = new TransactionAddResponse();
        $response->loadFromApiResponse($transactions);

        if(!$response->validate()){
            throw new ConflictHttpException("Transactions response invalid");
        }

        return $this->sendResponse($response);

    }

}