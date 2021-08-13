<?php

namespace App\Models;

use CodeIgniter\Model;

class Role extends Model
{
	protected $table                = 'roles';
	protected $primaryKey           = 'id';
/*	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;*/
	protected $allowedFields        = ['group_name','group_status','permissions'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	/*protected $deletedField         = 'deleted_at';*/

	// Validation
	protected $validationRules      = [
			'group_name'   => 'required|alpha|is_unique[roles.group_name,id,{id}]'
	];
	protected $validationMessages   = [
        				'group_name'        => [
            				'is_unique' => 'Sorry this group name has already been taken. Please choose another.'
        				],
			  ];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function hashpassword($data){
			$data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
			return $data;
	}
}
