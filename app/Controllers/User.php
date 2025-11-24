<?php


namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class User extends BaseController
{
    public function index()
    {
        return view('dashboard/user');
    }

    public function create()
    {
        $userModel = new UserModel();

        // Read form input
        $data = [
            'company_name'  => $this->request->getPost('company_name'),
            'department_id' => $this->request->getPost('department_id'),
            'username'      => $this->request->getPost('username'),
            'password'      => md5($this->request->getPost('password').'HASHKEY123'), // store md5
            'role_id'       => $this->request->getPost('role_id'),
            'hash_key'      => 'HASHKEY123', // random hash
            'created_by'    => session()->get('user_id'), // current logged user
            'created_at'    => date('Y-m-d H:i:s')
        ];

        // Insert into DB
        if ($userModel->insert($data)) {
            return redirect()->back()->with('success', 'User created successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }


      public function userListData()
    {
        $userModel = new UserModel();

        // Read form input
        $data['users'] = $userModel
        ->select('users.*, departments.department_name, roles.role_name')
        ->join('departments', 'departments.id = users.department_id')
        ->join('roles', 'roles.id = users.role_id')
        ->findAll();

    return view('dashboard/userlist', $data);
      
    }
  

}
