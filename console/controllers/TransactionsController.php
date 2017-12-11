<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 6:28 PM
 */

namespace console\controllers;

use console\components\TransactionsHelper;
use yii\console\Controller;

class TransactionsController extends Controller{

    public function actionSum(){
        $helper = TransactionsHelper::getInstance();
        $helper->updateTransactionSum();
    }

    public function actionCron(){
        $helper = TransactionsHelper::getInstance();
        $helper->transactionCronUpdate();
    }

}