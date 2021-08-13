<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModules extends Model
{
	protected $table                = 'permission_modules';
	protected $primaryKey           = 'pmodules_id';
	//protected $useAutoIncrement     = true;
	protected $allowedFields        = ['name','created_at'];
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
			'name' => 'required|is_unique[permission_modules.name]'
	];
	protected $validationMessages   = [
			'name' => [
				'required'  => 'Permission Modules name is required',
				'is_unique' => 'Permission Modules name is already exist'
			]
	];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
}
