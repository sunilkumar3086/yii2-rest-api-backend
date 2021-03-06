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
     * @param int $offset
     * @param int $limit
     * @param null $customerId
     * @param null $amount
     * @param null $date
     * @return array|bool|null|\yii\db\ActiveRecord[]
     */
    public function getTransactionsCustomer($offset=self::DEFAULT_OFFSET, $limit = self::DEFAULT_LIMIT,$customerId=null, $amount=null, $date=null){
        if(!$customerId || !is_numeric($customerId)){
            return false;
        }

        $query = Transactions::find();
        $query->andFilterWhere(['customer_id'=>$customerId]);
        $query->andFilterWhere(['amount'=>$amount]);
        $query->andFilterWhere(['DATE(created_at)'=>$date]);

        $transactionList = $query->offset($offset)->limit($limit)->all();

        if(!$transactionList || !is_array($transactionList) || count($transactionList)==0){
            return null;
        }

        return $transactionList;
    }

    /**
     * @param $transactionId
     * @param $amount
     * @return array|Transactions|null
     */
    public function updateTransactions($transactionId, $amount){
        if(!$transactionId || !is_numeric($transactionId) && !$amount || !is_numeric($amount)){
            return null;
        }
        $transactions = $this->getTransactions($transactionId);
        if(!$transactions){
            return null;
        }

        $transactions->amount = $amount;
        if(!$transactions->save()){
            return null;
        }

        return $transactions;

    }


    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param $transactionId
     * @return array|null|Transactions
     */
    private function getTransactions($transactionId){
        if(!$transactionId || !is_numeric($transactionId)){
            return null;
        }

        $transactions = Transactions::find()->where(['id'=>$transactionId])->one();
        if(empty($transactions)){
            return null;
        }

        return $transactions;

    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param $customerId
     * @param $transactionId
     * @return array|null|Transactions
     */
    public function getCustomerTransaction($customerId,$transactionId){
        if(!$customerId || !is_numeric($customerId) || !$transactionId || !is_numeric($transactionId)){
            return null;
        }

        $transactions = Transactions::find()->where(['id'=>$transactionId])->andWhere(['customer_id'=>$customerId])->one();
        if(empty($transactions)){
            return null;
        }

        return $transactions;
    }

}