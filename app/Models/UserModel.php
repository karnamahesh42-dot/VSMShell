<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
    'name',
    'company_name',
    'department_id',
    'email',
    'employee_code',
    'username',
    'password',
    'role_id',
    'active',
    'hash_key',
    'created_by',
    'created_at'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();  // <--- FIX
    }

    // Secure Login Function
    public function checkLoginModel($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = ?  AND active = 1 LIMIT 1";
        $query = $this->db->query($sql, [$username]);
        $user = $query->getRow();

        if (!$user) {
            return false;
        }

        $userPassword = md5($password."HASHKEY123");
     
        if ($userPassword !== $user->password) {
        return false; // wrong password
        }

        return $user;
        
    }
    
    public function get($id)
    {
        $model = new UserModel();
        return $this->response->setJSON($model->find($id));
    }
}
