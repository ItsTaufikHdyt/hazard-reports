<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
    public function index()
    {
        return view('admin/login');
    }

    public function process()
    {
        $users = new UsersModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $users->where([
            'username' => $username,
        ])->first();
        if ($dataUser) {
            if (password_verify($password, $dataUser->password) && $dataUser->role == 1) {
                session()->set([
                    'id' => $dataUser->id,
                    'username' => $dataUser->username,
                    'name' => $dataUser->name,
                    'logged_in' => TRUE,
                    'role' => $dataUser->role
                ]);
                return redirect()->to(url_to('adminDashboard'));
            } else if (password_verify($password, $dataUser->password) && $dataUser->role == 2) {
                session()->set([
                    'id' => $dataUser->id,
                    'username' => $dataUser->username,
                    'name' => $dataUser->name,
                    'logged_in' => TRUE,
                    'role' => $dataUser->role
                ]);
                return redirect()->to(url_to('userDashboard'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to(url_to('home'));
    }
}
