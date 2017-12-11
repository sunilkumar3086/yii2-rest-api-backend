<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 6:30 PM
 */

namespace console\components;

use common\components\Utils;
use common\models\Transactions;
use common\models\TransactionsSum;

class TransactionsHelper{


    private static $obj = null;

    const DEFAULT_OFFSET = 0;
    const DEFAULT_LIMIT = 10;

    //------------------------------------------------------------------------------------------------------------------
    public static function getInstance()
    {
        if (!self::$obj || !(self::$obj instanceof TransactionsHelper)) {
            self::$obj = new TransactionsHelper();
        }
        return self::$obj = new TransactionsHelper();
    }

    public function updateTransactionSum(){
        $amountSum = $this->getTransactionsPrevious();
        $models = new TransactionsSum();
        $models->amount = $amountSum;
        if(!$models->save()){
            return null;
        }
        return $models;
    }

    //-----------------------------------------------------------------------------------------------------------

    /**
     * @return mixed|null
     */
    private function getTransactionsPrevious(){

        $transactionsSum = Transactions::find()->where(['cron_status'=>Transactions::CRON_STATUS_DEFAULT])->andWhere(['<','DATE(created_at)',Utils::subtractDays(1)])->sum('amount');
        if(!$transactionsSum){
            return null;
        }
        return $transactionsSum;
    }

    //---------------------------------------------------------------------------------------------------------
    public function transactionCronUpdate(){
        $condition =['AND',
            ['deleted_at'=>null],
            ['cron_status'=>Transactions::CRON_STATUS_DEFAULT],
            ['<','DATE(created_at)', Utils::subtractDays(1)],
        ];
        return Transactions::updateAll(['cron_status'=>Transactions::CRON_STATUS_SUM],$condition);
    }


}