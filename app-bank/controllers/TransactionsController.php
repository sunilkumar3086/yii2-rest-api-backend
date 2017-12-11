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
use bank\models\request\TransactionListRequest;
use bank\models\response\EmptyListAPIResponse;
use bank\models\response\ListAPIResponse;
use bank\models\response\TransactionAddResponse;
use bank\models\response\TransactionListResponse;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\ConflictHttpException;

class TransactionsController extends RestController{
    public function behaviors(){
        $behaviors = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add'  => ['post'],
                    'list'  => ['post'],
                ],
            ],
        ];
        return ArrayHelper::merge(parent::behaviors(),$behaviors);
    }



    //------------------------------------------------------------------------------------------------------------------
    public function actionAdd(){
        $request = new TransactionAddRequest();
        $request->load(\Yii::$app->request->post(),'');

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

    //------------------------------------------------------------------------------------------------------------------
    public function actionList(){
        $request = new TransactionListRequest();
        $request->load(\Yii::$app->request->post(),'');

        if(!$request->validate()){
            throw new ConflictHttpException("Invalid Request");
        }

        $emptyResponse = new EmptyListAPIResponse();

        $helper = TransactionsHelper::getInstance();
        $transactions = $helper->getTransactionsCustomer($request->customerId,$request->amount,$request->date,$request->offset,$request->limit);
        if(!$transactions || !is_array($transactions) || count($transactions)==0){
            return $this->sendResponse($emptyResponse);
        }

        $_response = new ListAPIResponse();

        foreach ($transactions as $_tax){
            $response = new TransactionListResponse();
            $response->loadFromApiResponse($_tax);
            if($response->validate()){
               $_response->addData($response);
            }
        }

        if(!$_response->validate()){
            return $this->sendResponse($emptyResponse);
        }

        return $this->sendResponse($_response);


    }
}