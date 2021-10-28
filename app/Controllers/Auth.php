<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getPost()) {
            $session = session();
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $user = $userModel->find($username);

            if(password_verify($password, $user['password'])) {
                
                $ses_data = [
                    'username' => $username,
                    'auth' => true
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } 

            $session->setFlashdata('msg', 'Username/Password Not Match');
            return redirect()->to('/login');
        }

        helper('form');
        return view('auth\login');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}