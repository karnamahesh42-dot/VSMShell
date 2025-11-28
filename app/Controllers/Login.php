<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function checkLogin()
    {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userModel = new \App\Models\UserModel();
            $user = $userModel->checkLoginModel($username, $password);

            if (!$user) {
                return redirect()->to('login')->with('error', 'Invalid username or password');
            }

            session()->set([
                'user_id'    => $user->id,
                'username'   =>  $user->username,
                'role_id'    => $user->role_id,
                'isLoggedIn' => true,
            ]);

            // header("Location: " . base_url('/'));
            // return view('dashboard/dashboard');
            return redirect()->to(base_url('/'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/login'));
    
    }
}
