<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 11:17 AM
 */

namespace bank\controllers;


use bank\filters\AuthFilter;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class RestController extends \common\controllers\RestController {

    public function behaviors()
    {
        return [
            "contentNegotiator" => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ]
            ],
            'auth' => [
                'class' => AuthFilter::className(),
            ],


        ];
    }

}