<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 7:24 PM
 */

namespace common\models\cache;

use yii\base\Model;

class TransactionsCache extends Model{

    public $id;
    public $amount;

    public function rules(){
        return [
            [['id', 'amount'], 'required'],
            [['id','amount'],'integer'],
        ];
    }

}