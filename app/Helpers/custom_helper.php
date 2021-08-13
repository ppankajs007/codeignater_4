<?php 



function pr($data,$die=""){

	echo '<pre>';

	print_r($data);

	echo '</pre>';

	if( $die ) die;

}



function roleName($role_id){

		$role = "";

		switch ($role_id) {

			case 1:

			$role = 'Super Admin';

				break;

			case 2:

			$role =	'Vendor';

				break;

			case 3:

			$role =	'User';

				break;

		}

		return $role;

}



function encode($data){

	$encrypter = \Config\Services::encrypter();

	return $encrypter->encrypt($data);

}



function decode($data){

	$encrypter = \Config\Services::encrypter();

	return $encrypter->decrypt($data);		

}



function getUserData(){

	$session = \Config\Services::session();

	return $session->get('userData');

}



function profileUpdateCheck($userId){

	if( getUserData()['userId'] != $userId ){

		return false;

	}

	return true;

}



function sendEmail($data){

	$emailService = \Config\Services::email();

	$emailService->setFrom('demogsWeb.com', 'Demo Gsweb');

	$emailService->setTo($data['email']);

	$emailService->setSubject($data['subject']);

	$emailService->setMessage($data['body']);

	return $emailService->send();

}



function isSuperAdmin(){

	$session = \Config\Services::session();

	if($session->get('userData')['role_id'] == 1 ){

		return true;

	}

	return false;

}



function currentUserId(){

	$session = \Config\Services::session();

	return $session->get('userData')['userId'];

}



function checkAccessUsers($data,$value){



	if( !empty($data) ){

		$data = json_decode($data);

		if( in_array($value,$data) ){

			return true;

		}

	}

	return false;

}



function permissionUsers($userId,$value){

	if( empty($userId) ){

		$userId = 0;

	}

	$user       = (new \App\Models\User);

	$data     = $user->where(['id'=>$userId])->get()->getRowArray();

	if( isSuperAdmin() ){

		return true;

	}else{

		if( $data ){

	   		return checkAccessUsers($data['permission'],$value);	

		}else{

			return false;

		}

	}

}



function activeMenu($url,$active){

	$uri = new \CodeIgniter\HTTP\URI($url);

	if( in_array($active,$uri->getSegments()) ){

		return "active";

	}

	return "";

}



function getOldValueUser($userId,$coulmn){

	$db       = \Config\Database::connect();

	$user  = $db->table('users');

	if($user->where(['id' => $userId])->where($coulmn)->get()->getNumRows() == 1){

		return false;

	}

	return true;

}



function getSingleColumn($userId,$coulmn){

	$db       = \Config\Database::connect();

	$user  = $db->table('users');

	$data = $user->where(['id' => $userId])->where($coulmn)->get()->getRowArray();

	$columnName = array_keys($coulmn);

	if($data){

		return $data[$columnName[0]];

	}

	return "";		

}


