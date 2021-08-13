<?php

namespace App\Controllers;
use App\Models\User;

class Dashboard extends BaseController
{	
	private $session;

	function __construct(){
		$this->session = \Config\Services::session();		
	}
	public function index(){
		$data = [];
		if(empty($this->session->get('userData'))){
			return redirect()->to('register');
		}
		if( isSuperAdmin() ){
			$data['users'] = (new User())->countAll();
			return view('Admin/dashboard',$data);
		}else{
			return view('User/dashboard');
		}
	}
}
