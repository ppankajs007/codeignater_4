<?php

namespace App\Models;

use CodeIgniter\Model;

class Permission extends Model
{
	protected $table                = 'permissions';
	protected $primaryKey           = 'id';
/*	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;*/
	protected $allowedFields        = ['module_id','permission_name','permission_key'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	/*protected $deletedField         = 'deleted_at';*/

	// Validation
	protected $validationRules      = [
			'permission_name'   => 'required|alpha_space|is_unique[permissions.permission_name]',
	];
	
	
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	//protected $beforeInsert         = ['hashpassword'];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

}
