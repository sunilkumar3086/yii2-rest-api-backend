<?php
/**
 * Created by PhpStorm.
 * User: cashify
 * Date: 11/12/17
 * Time: 11:51 AM
 */
namespace common\controllers;

use common\models\api\response\APIResponse;
use Yii;
use yii\rest\Controller;

class RestController extends Controller{

    //------------------------------------------------------------------------------------------------------------------
    public function sendResponse(APIResponse $response,$validate= true){
        if($response == null || ($validate && !$response->validate())){
            return $this->sendError($response);
        }
        $cache_control = "public max-age=3600";
        \Yii::$app->response->headers->add("Cache-Control",$cache_control);
        return $response;
    }
    //------------------------------------------------------------------------------------------------------------------
    protected function sendError(APIResponse $response){
        $_resp = \Yii::$app->getResponse();
        $_resp->setStatusCode(204);
        return $response->getErrorFields();
    }
    //------------------------------------------------------------------------------------------------------------------
    protected function sendResponseError($status = 200){
        $message  = $this->getStatusCodeMessage($status);
        return array("code" => $status, "message"=>$message);
    }
    //------------------------------------------------------------------------------------------------------------------
    protected function getStatusCodeMessage($status){
        $codes = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Invalid Credentials.',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            1104=>"Auth Failed",
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

}