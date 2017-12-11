<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 3:23 PM
 */

namespace bank\models\response;


class EmptyListAPIResponse extends ListAPIResponse {



    public function rules(){
        return [
            [['data'],'safe'],
        ];
    }
    //------------------------------------------------------------------------------------------------------------------
    public function attributeLabels(){
        return [
            'data' => 'data',
        ];
    }
}