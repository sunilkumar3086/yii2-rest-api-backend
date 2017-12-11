<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 11:41 AM
 */

namespace bank\components;

use bank\models\request\CustomerRequest;
use common\models\Role;
use common\models\User;
use yii\base\Component;

class UserHelper extends Component{


    const TEST_EMAIL="test@example.com";

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param CustomerRequest $request
     * @return User|null
     */
    public function saveUser(CustomerRequest $request){

        $user = new User();
        $user->username = $request->name;
        $user->email = self::TEST_EMAIL;
        $user->role = Role::CUSTOMER_ROLE;
        $user->setPassword($request->password);
        $user->generateAuthKey();

        if(!$user->save()){
            print_r($user->getErrors());die;
            return null;
        }

        return $user;

    }

}