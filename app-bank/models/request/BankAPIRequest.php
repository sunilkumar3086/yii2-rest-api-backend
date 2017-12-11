<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 11:25 AM
 */

namespace bank\models\request;


use common\models\api\request\APIRequest;

class BankAPIRequest extends APIRequest
{
    const OFFSET  = 0;
    const PAGE_SIZE = 10;

    public function loadFromRequest(){
        // TODO: Implement loadFromRequest() method.
    }

}