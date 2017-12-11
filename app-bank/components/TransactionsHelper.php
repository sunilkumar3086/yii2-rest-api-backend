<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 11:41 AM
 */

namespace bank\components;

use bank\models\request\CustomerRequest;
use bank\models\request\TransactionAddRequest;
use common\models\Role;
use common\models\Transactions;
use common\models\User;
use yii\base\Component;

class TransactionsHelper{


    private static $obj = null;

    //------------------------------------------------------------------------------------------------------------------
    public static function getInstance(){
        if(!self::$obj || !(self::$obj instanceof TransactionsHelper)){
            self::$obj = new TransactionsHelper();
        }
        return self::$obj = new TransactionsHelper();
    }


    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param $customerId
     * @param $amount
     * @return Transactions|null
     */
    public function saveTransactions($customerId, $amount){
        if(!$customerId || !is_numeric($customerId) && !$amount || !is_numeric($amount)){
            return null;
        }

        $transactions = new Transactions();
        $transactions->customer_id = $customerId;
        $transactions->amount = $amount;
        if(!$transactions->save()){
            return null;
        }

        return $transactions;

    }


}