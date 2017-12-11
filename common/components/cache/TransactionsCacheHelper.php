<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 7:03 PM
 */

namespace common\components\cache;

use common\components\Utils;
use common\models\cache\TransactionsCache;
use common\models\Transactions;
use Yii;
use yii\caching\DbDependency;

class TransactionsCacheHelper{

    private static $obj = null;

    const TRANSACTION_CACHE_DATA_CACHE_KEY = "__transaction_data_cache_key";

    const CACHE_KEY = "__trax";

    //------------------------------------------------------------------------------------------------------------------
    public static function getInstance(){
        if(!self::$obj || !(self::$obj instanceof TransactionsCacheHelper)){
            self::$obj = new TransactionsCacheHelper();
        }
        return self::$obj = new TransactionsCacheHelper();
    }

    //------------------------------------------------------------------------------------------------------------------
    private function __construct() {
    }
    //------------------------------------------------------------------------------------------------------------------
    private function __clone() {
        // Stopping Clonning of Object
    }
    //------------------------------------------------------------------------------------------------------------------
    private function __wakeup() {
        // Stopping unserialize of object
    }



    //------------------------------------------------------------------------------------------------------------------
    /**
     * @return array|bool
     */
    private function getAllTransactions(){
        $allTransactions = Yii::$app->dataCache->get(self::TRANSACTION_CACHE_DATA_CACHE_KEY);
        if($allTransactions===false){
            $dependency = new DbDependency([
                'sql' => 'SELECT MAX(updated_at) FROM transactions',
            ]);
            $transactionsData = Transactions::find()->where(['cron_status'=>Transactions::CRON_STATUS_DEFAULT])->andWhere(['<','DATE(created_at)',Utils::subtractDays(1)])->all();
            $allTransactions = [];
            foreach ($transactionsData as $trax) {
                $_transactions = [];

                $key = $this->getCacheKey();
                array_push($_transactions,$trax);
                $allTransactions[$key]=$_transactions;
            }
            Yii::$app->dataCache->set(self::TRANSACTION_CACHE_DATA_CACHE_KEY, $allTransactions,7200, $dependency); //FOR 2 HOURS
        }
        return $allTransactions;
    }


    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param string $keys
     * @return string
     */
    private function getCacheKey($keys=self::CACHE_KEY){
        return sprintf("%s",$keys);
    }

    //------------------------------------------------------------------------------------------------------------------
    public function getTransactionsData(){
        $transactionsData = $this->getAllTransactions();
        $key = $this->getCacheKey();
        if(!$transactionsData || !is_array($transactionsData) || !isset($transactionsData[$key])){
            return [];
        }
        return $transactionsData[$key];
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param $trax
     * @return TransactionsCache
     */
    private function loadCacheData($trax){
        $_data = new TransactionsCache();
        $_data->id = $trax->id;
        $_data->amount = $trax->amount;
        return $_data;

    }


}