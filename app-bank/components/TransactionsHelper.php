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

    const DEFAULT_OFFSET = 0;
    const DEFAULT_LIMIT = 10;

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

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param $customerId
     * @param null $amount
     * @param null $date
     * @param int $offset
     * @param int $limit
     * @return array|bool|null|Transactions[]
     */
    public function getTransactionsCustomer($customerId, $amount=null, $date=null, $offset=self::DEFAULT_OFFSET, $limit = self::DEFAULT_LIMIT){
        if(!$customerId || !is_numeric($customerId)){
            return false;
        }

        $query = Transactions::find()->where(['customer_id'=>$customerId]);
        $query->andFilterWhere(['amount'=>$amount]);
        $query->andFilterWhere(['DATE(created_at)'=>$date]);

        $transactionList = $query->offset($offset)->limit($limit)->all();

        if(!$transactionList || !is_array($transactionList) || count($transactionList)==0){
            return null;
        }

        return $transactionList;
    }


    private function _transactionQuery(){
        return Transactions::find();
    }


}