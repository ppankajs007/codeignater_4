<?php 
namespace App\Controllers;
use App\Models\User;
use App\Models\Userrole;
use Session;
class Admin extends BaseController
{	
	function __construct(){
		$this->session = \Config\Services::session();		
	}
	public function index()
	{		
		if(!empty($this->session->get('userData'))){
			return redirect()->to('dashboard');
		}
		return view('login');
	}
	public function login(){
		if($this->request->getPost() ){
		    $session = \Config\Services::session();
			$db       = \Config\Database::connect();
			$builder  = $db->table('users');
			$builder->select('users.*,user_roles.*,users.id as userId')->join('user_roles','user_roles.user_id = users.id','left');
			$query = $builder->where('email',$this->request->getPost('email'))
					->orWhere('phone',$this->request->getPost('email'))
					->orWhere('username',$this->request->getPost('email'))->get()->getRowArray();
			if( !empty( $query ) ){
				if( !$query['active'] ){
					$session->setFlashdata('error','Please verfy your account');
					return redirect('/');
				}
				if( password_verify($this->request->getPost('password'),$query['password']) ){
					unset($query['password']);
		    		$session->set(['userData' => $query ,'role' => $query['role_id'] ]);
		    		return redirect('dashboard');						
				}else{
					$session->setFlashdata('error','Invalid Credentials');
					return redirect('/');
				}
			}else{
				$session->setFlashdata('error','Invalid Credentials');
				return redirect('/');
			}
		}
	}
	public function register(){
		if( !ACTIVE_REGISTER ){
			return redirect('/');
		}
		if(!empty($this->session->get('userData'))){
				return redirect()->to('dashboard');
		}
		return view('register');
	}
	public function registerUser(){
		if( $this->request->getPost() ){
			$db       = \Config\Database::connect();
			$userActive = $db->table('users');
			$getOtp  = $db->table('phoneotp');
			$user = new User();
			$userRole = new Userrole();
			$user->TransBegin();
			$phoneNumber['otp'] = "";
			if( $this->request->getPost('phone') ){
				$phoneNumber = $getOtp->select('otp')->where('phone',$this->request->getPost('phone'))->get()->getRowArray();
				if( $this->request->getPost('otp') != $phoneNumber['otp'] ){
					$this->session->setFlashdata('error','Otp is wrong try again');
					return redirect()->back();
				}
			}
			if( !$user->insert($this->request->getPost()) ){
				$this->session->setFlashdata('registerError',$user->errors());
				return redirect()->to('register')->withInput();
			}
			$data = ['user_id' => $user->getInsertId(),'role_id' => 3 ];
			if( !$userRole->insert($data) ){
				$user->transRollback();
				$this->session->setFlashdata('error','Something want wrong.Please try again');
				return redirect()->to('register')->withInput();
			}
			$user->transCommit();
			if( !empty($this->request->getPost('otp')) ){	
				$userActive->set(['active' => 1]);
				$userActive->where('id',$data['user_id']);
				$userActive->update();
				//$getOtp->where('phone',$this->request->getPost('phone'))->delete();
				$this->session->setFlashdata('success','Register successfully');
				return redirect('/');
			}else{
				$base_url = base_url();
				$emailHex = bin2hex($this->request->getPost('email'));
				$emailBody  = "<a href='{$base_url}/admin/emailVerfy/{$emailHex}' >Activate Your Account</a>";
				$sendEmailData = ['email' => $this->request->getPost('email'),'subject' => 'Verify Email','body' => $emailBody ];
				if( sendEmail($sendEmailData) ){
					$this->session->setFlashdata('success','Register successfully.Please verify your email');
				}else{
					$this->session->setFlashdata('error','Register successfully.But Email not send contact support');
				}	
				return redirect('/');
			}
			
			
		}
	}
	public function logout(){
		$session = \Config\Services::session();
		$session->destroy();
		return redirect('/');
	}
	public function emailVerfy($email){
			$db       = \Config\Database::connect();
			$builder  = $db->table('users');
			$builder->set(['active' => 1]);
			$builder->where('email',hex2bin($email));
			$builder->update();
			$this->session->setFlashdata('success','Your account has been verified');
			return redirect('/');
	}
	public function forgetpassword(){
		if( $this->request->getMethod() == 'get' ){
			return view('forgetpassword');
		}
		if( $this->request->getMethod() == 'post' ){
			$otp = 123456;
			$db       = \Config\Database::connect();
			$builder  = $db->table('users');
			$restOtp  = $db->table('phoneotp');
			$user = $builder->where('email',$this->request->getPost('email'))->orWhere('phone',$this->request->getPost('phone'))->get()->getRowArray();
			if( !empty($user) ){
				if( !empty($this->request->getPost('email')) ){
					$emailHex = bin2hex($this->request->getPost('email'));
					$base_url = base_url();
					$emailBody = "<a href='{$base_url}/admin/resetpassword/{$emailHex}'>Reset Password</a>";
					$sendEmailData = ['email' => $this->request->getPost('email'),'subject' => 'Verify Email','body' => $emailBody ];
					if( sendEmail($sendEmailData) ){
						$this->session->setFlashdata('success','Register successfully.Please verify your email');
					}else{
						$this->session->setFlashdata('error','Register successfully.But Email not send contact support');
					}
					return redirect('/');
				}elseif( !empty($this->request->getPost('phone')) ){
						$restOtp->delete(['phone' => $user['phone'] ]);
						$restOtp->insert(['phone' => $user['phone'],'otp' => $otp ]);
						$phonehex = bin2hex($user['phone']);
					return redirect()->to("/admin/resetByPhone/{$phonehex}");
				}
			}else{
				$this->session->setFlashdata('error','Account Not Exist');
				return redirect()->back();
			}
			
		}
	}
	public function resetByPhone($phone){
		if( $this->request->getMethod() == 'get' ){
			$data['phone'] = $phone;
			return view('resetByPhone',$data);
		}
	}
	public function resetpassword($email){
		
		if( $this->request->getMethod() == 'get' ){
			$data['emailhas'] = $email;
			return view('resetpassword',$data);
		}
		if( $this->request->getMethod() == 'post' ){
			$db       = \Config\Database::connect();
			
			$builder  = $db->table('users');
			
			$user = $builder->where('email',hex2bin($this->request->getPost('emailhas')))->get()->getRowArray();
			if( $this->request->getPost('new_password') != $this->request->getPost('confirm_password')  ){
				$this->session->setFlashdata('error','Confirm Password not match');
				return redirect()->back();
			}
			if( !empty($user) ){
				$builder->set(['password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)]);			
				//$data  = ['password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)];
			
				$builder->where('email',hex2bin($email));
				$builder->update();
				
				$this->session->setFlashdata('success','Password Reset successfuly');
				return redirect('/');
			}
		}	
	}
	function existPhone(){
		$user = (new User)->where('phone',$_GET['phone'])->get()->getNumRows();
		if( $user > 0 ){
			echo "false";
		}else{
			echo "true";
		}
	}
	function generateOtp(){
			$user = (new User)->where('phone',$_GET['phone'])->get()->getRowArray();
			$otp = rand(100000,999999);
			if( !empty($user) ){
				echo false;
			}else{
				$db       = \Config\Database::connect();
				$builder  = $db->table('phoneotp');
				$builder->delete(['phone' => $_GET['phone'] ]);
				$builder->insert(['phone' => $_GET['phone'],'otp' => $otp ]);
				echo $otp;
			}
	}
	function forgetByOtp(){
			$db        = \Config\Database::connect();
			$data      = $this->request->getPost();
			$phoneOtp  = $db->table('phoneotp');
			$users     = $db->table('users');
			if( $data['phone'] ){
				$query = $phoneOtp->where(['phone' => $data['phone'], 'otp' => $data['otp'] ])->get()->getRowArray();
				if( !empty($query) ){
					$html = '<div class="input-group mb-3">
				          <input type="password" class="form-control new_password" placeholder="Password" name="new_password">
				          <div class="input-group-append">
				            <div class="input-group-text">
				              <span class="fas fa-lock"></span>
				            </div>
				          </div>
				        </div>
				        <div class="input-group mb-3">
				          <input type="password" class="form-control confirm_password" placeholder="Confirm Password" name="confirm_password">
				          <div class="input-group-append">
				            <div class="input-group-text">
				              <span class="fas fa-lock"></span>
				            </div>
				          </div>
				        </div>';
						echo $html;
				}
			}else{
				echo '';
			}
	}
	function resetPasswordByotp(){
	    $db        = \Config\Database::connect();
		$data      = $this->request->getPost();
		$phoneOtp  = $db->table('phoneotp');
		$users     = $db->table('users');
		if( $data['phone'] ){
			$query = $phoneOtp->where(['phone' => $data['phone'], 'otp' => $data['otp'] ])->get()->getRowArray();
			if( !empty($query) ){
				$pass = password_hash($data['password'], PASSWORD_DEFAULT);
				if($users->set(['password' => $pass ])->where('phone',$data['phone'])->update()){
					$phoneOtp->where(['phone' => $data['phone'], 'otp' => $data['otp'] ])->delete();
					echo json_encode(['error' => 0,'message' => 'Password Reset successfuly']);
				}else{
					echo json_encode(['error' => 1,'message' => 'Something want wrong.Try again']);
				}
			}else{
				echo json_encode(['error' => 2,'message' => 'Otp is wrong.Try again']);
			}
		}else{
			echo json_encode(['error' => 1,'message' => 'Something want wrong.Try again']);
		}
	}
	function checkEmailExist(){
		$db       = \Config\Database::connect();
		
		if(!empty($_GET['email']))
		{
		$builder  = $db->table('users');
		$user = $builder->where('email',$_GET['email'])->get()->getNumRows();
		if( $user > 0 ){
			echo "false";
		}else{
			echo "true";
		}
		}
		else{
			echo "true";
		}
	}
}