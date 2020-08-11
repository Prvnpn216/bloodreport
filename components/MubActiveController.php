<?php 
namespace app\components;
use yii\rest\ActiveController;
use app\components\MubActiveController;    
use app\models\AppUser;

date_default_timezone_set('Asia/Kolkata'); 

class MubActiveController extends ActiveController{

	protected function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['POST'],
        ];
    }

	// public $serverIp = Yii::$app->getUrlManager()->getBaseUrl();

  //  	public function makeCurlCall($url,$method,$params=[]){
  //  		$curl = curl_init();
		// // Set some options - we are passing in a useragent too here
		// curl_setopt_array($curl, [
		//     CURLOPT_RETURNTRANSFER => 1,
		//     CURLOPT_URL => $url,
		//     CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		//     CURLOPT_POST => ($method === 'POST')?1 :0,
		//     CURLOPT_POSTFIELDS => $params
		// ]);
		// // Send the request & save response to $resp
		// if (!curl_exec($curl)) {
		//     die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
		// }
		// $response = curl_exec($curl);
		// // p($response);
		// $resp = json_decode($response,true);
		// // if(($resp->result == '') && $resp->message === 'Authentication failed'){
		// // 	$callerFunction = debug_backtrace()[1];
		// // 	$resp = json_decode(call_user_func_array(array($this,$callerFunction['function']),$callerFunction['args']));
		// // p($resp);
		// // }
		// // Close request to clear up some resources
		// curl_close($curl);

		// return $resp;
  //   }

	protected function authenticateUser($accessToken){
		$appUser = new AppUser();
		return $appUser->find()->where(['del_status' => '0','status' => 'Active'])->andWhere(['like binary','access_token',$accessToken])->one();
	}
}