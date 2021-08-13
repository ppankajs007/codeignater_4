<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
	protected $table                = 'users';
	protected $primaryKey           = 'id';
/*	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;*/
	protected $allowedFields        = ['first_name','last_name','username','email','phone','password','profile','role_id'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	/*protected $deletedField         = 'deleted_at';*/

	// Validation
	protected $validationRules      = [
			'first_name'   => 'required|alpha',
			'last_name'   => 'required|alpha',
			'username'     => 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
	];
	protected $validationMessages   = [
        				'username'        => [
            				'is_unique' => 'Sorry. That username has already been taken. Please choose another.'
        				],
			  ];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = ['hashpassword'];
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
