<?php

namespace app\modules\api\controllers;
use yii\data\Pagination;
use Yii;
use app\helpers\HtmlHelper;
use app\components\MubActiveController;
use app\models\AppUser;

class UserController extends MubActiveController
{
    public $modelClass = 'app\models\AppUser';

    public function actionLogin(){
        $appUser = new AppUser();
        $postParams = Yii::$app->request->getBodyParams();
        $postParams['mobile'] = filter_var($postParams['mobile'], FILTER_SANITIZE_NUMBER_INT);
        //p($postParams);
        $user = $appUser->find()->where(['mobile' => $postParams['mobile'],'del_status' => '0','status' => 'Active'])->andWhere(['like binary','password',$postParams['password']])->one();
        if(!empty($user)){
            // Generate and update token
            $access_token = rand(1111111111, 99999999999);
            $user->access_token = strval($access_token);
            if($user->save(false)){
                $output["Name"] = $user->name;
                $output["user_image"] = 'https://bootdey.com/img/Content/user_1.jpg'; 
                $output["result"] = true;
                $output["message"] = "Login success";
                $output["token"] = $access_token;
            }
            else
            {
               $output["result"] = false;
               $output["message"] = current(current($user->getErrors()));  
            }
        }
        else
        {
            $output["result"] = false;
            $output["message"] = "Mobile or password wrong!!";
        }
        return $output;
    }

    public function actionRegister(){
        $postData['AppUser'] = Yii::$app->request->getBodyParams();
        if(isset($postData['AppUser']['name']) && 
            isset($postData['AppUser']['email']) &&
            isset($postData['AppUser']['mobile']) &&
            isset($postData['AppUser']['password'])){
        // Sanitize inputs
            $postData['AppUser']['name'] = filter_var($postData['AppUser']['name'], FILTER_SANITIZE_STRING);

            $postData['AppUser']['email'] = filter_var($postData['AppUser']['email'], FILTER_SANITIZE_EMAIL);

            $postData['AppUser']['mobile'] = filter_var($postData['AppUser']['mobile'], FILTER_SANITIZE_NUMBER_INT);

            $appUser = new AppUser();
            //$access_token = rand(1111111111, 9999999999); 
            $appUser->load($postData);
            //validate data received by user against DB
            if($appUser->validate()){

                $api_key = '6d7cf952a3204449b0830b8c314895dc';
                $emailToValidate = $postData['AppUser']['email'];

                $ip = HtmlHelper::get_client_ip();

                $url = 'https://api.zerobounce.net/v2/validate?api_key='.$api_key.'&email='.urlencode($emailToValidate).'&ip_address='.$ip;

                $ch = curl_init($url);
                //PHP 5.5.19 and higher has support for TLS 1.2
                curl_setopt($ch, CURLOPT_SSLVERSION, 6);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
                curl_setopt($ch, CURLOPT_TIMEOUT, 150);
                $zb_response = curl_exec($ch);
                curl_close($ch);
                    
                //decode the json response
                $zb_response = json_decode($zb_response, true);
                //print_r($zb_response);
                $verified_status = $zb_response['status'];  

                $output["email_status"] = $verified_status;

                // Send OTP
                $otp = rand(111111, 999999);
                $smsformat = $otp." is your OTP to continue registration on DoubtsApp";

                $sms_text = urlencode($smsformat);
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL, "http://nimbusit.co.in/api/swsendSingle.asp");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"username=t1praveen2&password=30640199&sender=HAKVED&sendto=".$postData['AppUser']['mobile']."&message=".$sms_text);
                $response = curl_exec($ch);
                curl_close($ch);

                if($verified_status === "valid"){
                    //$access_token = rand(1111111111, 9999999999);
                    $appUser->otp = strval($otp);
                    if(!$appUser->save()){
                        $output["result"] = false;
                        $output["message"] = current(current($appUser->getErrors()));
                    }else{ 
                        $output["result"] = true;
                        $output["message"] = "Account created";
                        if(!file_exists(\Yii::$app->params['uploadPath']."/users/".$postData['AppUser']['email']))
                        {
                            mkdir(\Yii::$app->params['uploadPath']."/users/".$postData['AppUser']['email'], 0777, true);
                        }
                    }
                } 
                else
                {
                    $output["result"] = false;
                    $output["message"] = "Entered Email is not valid, Please try with valid email";
                } 
            }
            else
            {
                $output["result"] = false;
                $output["message"] = current(current($appUser->getErrors()));
            }
        }
        else{
            $output["result"] = false;
            $output["message"] = "All Parameters required for registartion were not sent";
        }
        return $output;
    }
       
}