<?php

namespace App\Controllers;
use App\Models\Permission;
use App\Models\Module;
use Irsyadulibad\DataTables\DataTables;

class Permissions extends BaseController
{	
	private $session;

	function __construct(){
		$this->session = \Config\Services::session();		
	}
	public function index(){
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}		
		$data['modules'] = (new Module())->select('modules.*')->findAll();
		return view('Permission/index',$data);
	}	

	public function add(){
			if(empty($this->session->get('userData'))){
			return redirect()->to('/');
			}
			if( $this->request->getPost() ){
			$module = new Permission;
			if( $this->request->getPost('permissions_id') ){
			$save = $module->find($this->request->getPost('permissions_id'));
			$save['permission_name'] = $this->request->getPost('permission_name');
			$save['permission_key'] = $this->request->getPost('permission_key');
			$save['module_id'] = $this->request->getPost('module_id');
				if(!$module->save($save)){
					$this->session->setFlashdata('registerError',$module->errors());
				}else{
					$this->session->setFlashdata('success','Permission updated successfully');
				}				
			}else{
				if(!$module->insert($this->request->getPost())){
					$this->session->setFlashdata('registerError',$module->errors());
				}else{
					$this->session->setFlashdata('success','Permission added successfully');
				}	
			}
			return redirect()->back();
		}
	}

	public function delete($id){
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		$module = new Permission;
		$module->delete(['id' => $id ]);
		$this->session->setFlashdata('success','Permission has been deleted successfuly');
		return redirect()->to(base_url('/permissions')); 
	}
	
	public function fetch()
	{
			if(empty($this->session->get('userData'))){
			return redirect()->to('/');
			}
			$id = $this->request->getPost('id');
			$module = new Permission;
			$data = $module->find($id);
			echo json_encode($data);
	}
	
	
	public function getjson()
	{
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		return DataTables::use('permissions')
			->addColumn('module_name', function($data) {
				$m = $data->module_id;
				$mdata = (new Module())->find($m);
				return $mdata['name'];
			})
			->addColumn('action', function($data) {
				$id = $data->id;
				return '<a class="btn editPerPermission btn-primary btn-sm" data-toggle="modal" data-target="#modal-default"  href="javascript:;" onclick="editFunc('.$id.')" > <i class="fas fa-edit"></i> </a> <a class="btn delfunc btn-danger btn-sm" href="'.base_url("permissions/delete/".$id).'" onClick="return delfunc()"> <i class="fas fa-trash"></i> </a>';
			})
			->rawColumns(['action'])
			->make(true);
	}
	
	
} 