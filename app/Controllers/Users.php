<?php

namespace App\Controllers;
use App\Models\User;
use App\Models\Userrole;
use Irsyadulibad\DataTables\DataTables;
use App\Models\Role;

class Users extends BaseController
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
		$data['users'] = (new User())->select('users.*,users.id as userId,user_roles.*')->join('user_roles','user_roles.user_id = users.id')->where('users.id !=',1)->findAll();
		return view('Admin/usersList',$data);
	}

	public function edit($userId){
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		$data = [];
		if( $this->request->getMethod() == 'get' ){
		//echo 'userid='.$userId;
			//$users = (new User())->select('users.*,users.id as userId,user_roles.*')->join('user_roles','user_roles.user_id = users.id')->where('users.id',$userId)->find();
			$users = (new User())->find($userId);
			//print_r($users);
			$data['users'] = $users;
			$data['roles'] = (new Role())->findAll();
			return view('Admin/usersEdit',$data);
		}
		if( $this->request->getMethod() == 'post' ){
			$db       = \Config\Database::connect();
			$builder  = $db->table('users');

			$validation =  \Config\Services::validation();
			$dataPost = $this->request->getPost();
			$allEmpty = [];
			$phoneNEmpty = [];
			$emailNEmpty = [];
			$userName = [];
			
			$rules =[ 'first_name'   => 'required|alpha',
					   'last_name'   => 'required|alpha' ];

			if( getOldValueUser($dataPost['user_id'],['username' => $dataPost['username']] ) ){
				$userName = ['username' => 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]'];				
			}
			if( empty($dataPost['email']) && empty($dataPost['phone']) ){
				$allEmpty = ['email' => 'required'];
			}
			if( !empty($dataPost['email']) ){
				if(getOldValueUser($dataPost['user_id'],['email' => $dataPost['email']] ) ){
					$emailNEmpty = ['email' => 'valid_email|is_unique[users.email]' ];
				}
			}
			if( !empty($dataPost['phone']) ){
				if(getOldValueUser($dataPost['user_id'],['phone' => $dataPost['phone']] ) ){
					$phoneNEmpty = ['phone' => 'is_unique[users.phone]' ];
				}
			}
			$rules = array_merge($rules,$allEmpty,$emailNEmpty,$phoneNEmpty,$userName);
			if(!$this->validate($rules)){
				$this->session->setFlashdata('editError',$validation->getErrors());
				return redirect()->back();
			}

			/*if( isSuperAdmin() ){
				if( $this->request->getPost('role_id') ){
					$userRole = new Userrole;
					$userRole->where('user_id', $this->request->getPost('user_id') )
					->set(['role_id' => $this->request->getPost('role_id') ])->update();	
				}
			}*/

			$user = new User;
			$data = $this->request->getPost();
			if($imagefile = $this->request->getFiles())
			{	
			  $img = $imagefile['profile'];
		      if ($img->isValid() && ! $img->hasMoved())
		      {
		           $newName = $img->getRandomName();
		           $img->move('uploads/', $newName);
		           $data = array_merge($data,['profile' => '/uploads/'.$newName]);
		      }
			   
			}
			if( !empty( $data['permission'] ) ){
				$data['permission'] = json_encode($data['permission']);
			}else{
				$data['permission'] = "";
			}
			
			if( !empty( $data['role_id'] ) ){
			$data['role_id'] = implode(',',$data['role_id']);
			}
			
			//unset($data['role_id']);
			unset($data['user_id']);
			unset($data['email']);
			$builder->set($data);
			$builder->where('id',$this->request->getPost('user_id'));
			$builder->update();
			if( getOldValueUser($dataPost['user_id'],['email' => $dataPost['email']] ) ){
				$this->updateEmailProfile($dataPost);
				return redirect('/');
			}
			$this->session->setFlashdata('success','User profile updated successfully');
			return redirect('users');
		}
	}

	function updateEmailProfile($dataPost){
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		$db       = \Config\Database::connect();
		$builder  = $db->table('users');
		if( currentUserId() == $dataPost['user_id'] ){
			$emailHex = bin2hex($dataPost['email']);
			$base_url = base_url();
			$emailBody = "<a href='{$base_url}/admin/emailVerfy/{$emailHex}'>Verify Account</a>";
			$sendEmailData = ['email' => $dataPost['email'],'subject' => 'Verify Email','body' => $emailBody ];
			if( sendEmail($sendEmailData) ){
				$this->session->setFlashdata('success','Email Change successfully.Please verify your email');
			}else{
				$this->session->setFlashdata('error','Email Change successfully.But Email not send contact support');
			}
			$builder->set(['active' => 0,'email' => $dataPost['email'] ]);
			$builder->where('id',$dataPost['user_id']);
			$builder->update();
			$this->session->destroy();
		}

	}

	public function changePassword(){
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		if( $this->request->getMethod() == 'get'  ){
			return view('comman/changePassword');
		}
		if( $this->request->getMethod() == 'post'  ){
			$id = currentUserId();
			$user = new User;
			$data = $user->find($id);
			if( !password_verify($this->request->getPost('old_password'),$data['password']) ){
				$this->session->setFlashdata('error','Old Password is wrong');
			}else{
				if( $this->request->getPost('new_password') == $this->request->getPost('confirm_password')  ){
					$password = ['password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)];
					$user->update($id,$password);
					$this->session->setFlashdata('success','Password has been successfult updated');
				}else{
					$this->session->setFlashdata('error','New Password And Confirm Password Not Match');
				}
			}
			return redirect('users/change-password');
		}
	}

	public function add(){
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		if( $this->request->getMethod() == 'get'  ){
			$data['roles'] = (new Role())->findAll();
			return view('comman/usersAdd',$data);
		}

		if( $this->request->getMethod() == 'post' ){
			$user = new User();
			
			
			
				$sdata1 = $this->request->getPost();
				$sdata1['role_id'] = implode(',',$sdata1['role_id']);
				
				print_r($sdata1);
				
				
				if(!$user->insert($sdata1)){
					$this->session->setFlashdata('registerError',$user->errors());
				}else{
					$this->session->setFlashdata('success','User added successfully');
				}	
			
			return redirect()->back();
			
			
			
			/*$userRole = new Userrole();
			$dataUser = $this->request->getPost();
			$user->TransBegin();
			if( !empty($dataUser['permission']) ){
				$dataUser['permission'] = json_encode($dataUser['permission']);
			}
			if( !$user->insert($dataUser) ){
				$this->session->setFlashdata('registerError',$user->errors());
			}
			//$data = ['user_id' => $user->getInsertId(),'role_id' => $this->request->getPost('role_id') ];
			if( !$userRole->insert($data) ){
				$user->transRollback();
				$this->session->setFlashdata('error','Something want wrong.Please try again');
			}
			if( !empty($dataUser['role_id']) ){
			$role_id = implode(',',$dataUser['role_id']);
			}
			//echo 'role_id='.$role_id;
			//exit();
			$dataUser['role_id'] = $role_id;
			
			$user->transCommit();
			if( $user->getInsertId() ){
				$this->session->setFlashdata('success','User has been added');
				return redirect()->back();
			}else{
				return redirect()->back()->withInput();
			}*/
		}

	}

	public function delete($userId){
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		$user = new User;
		$userRole = new Userrole;
		$user->delete(['id' => $userId ]);
		$userRole->delete(['user_id' => $userId ]);
		$this->session->setFlashdata('success','User has been deleted successfuly');
		return redirect('users');
	}
	
	public function getjson()
	{
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		return DataTables::use('users')
			->addColumn('name', function($data) {
				return $data->first_name.' '.$data->last_name;
			})
			->addColumn('action', function($data) {
				$id = $data->id;
				return '<a class="btn editPerModule btn-primary btn-sm" href="users/edit/'.$id.'" > <i class="fas fa-edit"></i> </a> <a class="btn delfunc btn-danger btn-sm" href="'.base_url("users/delete/".$id).'" onClick="return delfunc()"> <i class="fas fa-trash"></i> </a>';
			})
			->rawColumns(['name','action'])
			->make(true);
	}
}
