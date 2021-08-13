<?php

namespace App\Controllers;
use App\Models\Module;
use Irsyadulibad\DataTables\DataTables;

class Modules extends BaseController
{	
	private $session;

	function __construct(){
		$this->session = \Config\Services::session();	
		
		
	}
	
	public function index(){		
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		return view('Module/index');
	}	

	public function add(){
			if(empty($this->session->get('userData'))){
			return redirect()->to('/');
			}
			if( $this->request->getPost() ){
			$module = new Module;
			if( $this->request->getPost('modules_id') ){
			$save = $module->find($this->request->getPost('modules_id'));
			$save['name'] = $this->request->getPost('name');
				if(!$module->save($save)){
					$this->session->setFlashdata('registerError',$module->errors());
				}else{
					$this->session->setFlashdata('success','Module updated successfully');
				}				
			}else{
				if(!$module->insert($this->request->getPost())){
					$this->session->setFlashdata('registerError',$module->errors());
				}else{
					$this->session->setFlashdata('success','Module added successfully');
				}	
			}
			return redirect()->back();
		}
	}

	public function delete($id){
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		$module = new Module;
		$module->delete(['id' => $id ]);
		$this->session->setFlashdata('success','Module has been deleted successfuly');
		return redirect()->to(base_url('/modules')); 
	}
	
	public function fetch()
	{
			if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
			$id = $this->request->getPost('id');
			$module = new Module;
			$data = $module->find($id);
			echo json_encode($data);
	}
	
	
	public function getjson()
	{
		if(empty($this->session->get('userData'))){
			return redirect()->to('/');
		}
		return DataTables::use('modules')
			->addColumn('action', function($data) {
				$id = $data->id;
				return '<a class="btn editPerModule btn-primary btn-sm" data-toggle="modal" data-target="#modal-default"  href="javascript:;" onclick="editFunc('.$id.')" > <i class="fas fa-edit"></i> </a> <a class="btn delfunc btn-danger btn-sm" href="'.base_url("modules/delete/".$id).'" onClick="return delfunc()"> <i class="fas fa-trash"></i> </a>';
			})
			->rawColumns(['action'])
			->make(true);
	}
	
	
} 