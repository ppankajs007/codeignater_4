<?php

namespace App\Controllers;
use App\Models\Role;
use Irsyadulibad\DataTables\DataTables;
use App\Models\Module;
use App\Models\Permission;

class Roles extends BaseController 
{	
	private $session;

	function __construct(){
		$this->
session = \Config\Services::session();		
	}
	public function index(){		
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		return view('Role/index');
	}	

	public function add(){
			if(empty($this->session->get('userData'))){
			return redirect()->to('/');
			}
			if( $this->request->getPost() ){
			$module = new Role;
			
				$roles = $this->request->getPost();
				$roles['permissions'] = implode('|',$roles['permissions']);
				if(!$module->insert($roles)){
					$this->session->setFlashdata('registerError',$module->errors());
				}else{
					$this->session->setFlashdata('success','Role added successfully');
				}	
			
			return redirect()->back();
		}
		else
		{
		$modules = (new Module())->findAll();
		
		if(!empty($modules))
		{
		$i=0;
		foreach($modules as $module)
		{
		$permissions = (new Permission())->where('module_id',$module['id'])->findAll();
		$modules[$i]['permissions'] = $permissions;
		$i++;
		}
		}
		
		$data['modules'] = $modules; 
		return view('Role/add',$data);
		}
	}
	
	
	public function edit($id){
			if(empty($this->session->get('userData'))){
			return redirect()->to('/');
			}
			if( $this->request->getPost() ){
			$module = new Role;
			
			$save = $module->find($this->request->getPost('roles_id'));
			$save['group_name'] = $this->request->getPost('group_name');
			$save['group_status'] = $this->request->getPost('group_status');
			$save['permissions'] = implode('|',$this->request->getPost('permissions'));
			
			
			
				if(!$module->save($save)){
					$this->session->setFlashdata('registerError',$module->errors());
				}else{
					$this->session->setFlashdata('success','Role updated successfully');
				}				
			
			
			return redirect()->to(base_url('/roles'));
		}
		else
		{
		$modules = (new Module())->findAll();
		
		if(!empty($modules))
		{
		$i=0;
		foreach($modules as $module)
		{
		$permissions = (new Permission())->where('module_id',$module['id'])->findAll();
		$modules[$i]['permissions'] = $permissions;
		$i++;
		}
		}
		$data['role'] = (new Role())->where('id',$id)->first();
		$data['modules'] = $modules; 
		return view('Role/edit',$data);
		}
	}

	public function delete($id){
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		$module = new Role;
		$module->delete(['id' => $id ]);
		$this->session->setFlashdata('success','Role has been deleted successfuly');
		return redirect()->to(base_url('/roles')); 
	}
	
	public function fetch()
	{
			if(empty($this->session->get('userData'))){
			return redirect()->to('/');
			}
			$id = $this->request->getPost('id');
			$module = new Role;
			$data = $module->find($id);
			echo json_encode($data);
	}
	
	
	public function getjson()
	{
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		return DataTables::use('roles')
			->addColumn('group_status', function($data) {
				if($data->group_status=='Active'){ $status='success'; } else { $status='danger'; }
				return '
<label class="badge badge-'.$status.'">'.$data->group_status.'</label>
';
			})
			->addColumn('action', function($data) {
				$id = $data->id;
				return '<a class="btn editPerRole btn-primary btn-sm" href="'.base_url("roles/edit/".$id).'"> <i class="fas fa-edit"></i> </a> <a class="btn delfunc btn-danger btn-sm" href="'.base_url("roles/delete/".$id).'" onClick="return delfunc()"> <i class="fas fa-trash"></i> </a>';
			})
			->rawColumns(['group_status','action'])
			->make(true);
	}
	
	
} 