<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 6:30 PM
 */

namespace console\components;

use common\models\Transactions;

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

    private function transactionSum(){
        $transaction = Transactions::find()->where([''])->sum();
    }




}