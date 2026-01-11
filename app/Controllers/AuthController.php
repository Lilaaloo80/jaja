<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        // Shows the login form
        return view('auth/login');
    }

    public function loginPost()
    {
        // 1) Read + normalize
        $username = trim((string) $this->request->getPost('Username'));
        $password = (string) $this->request->getPost('Password');

        // 2) Basic validation
        if ($username === '' || $password === '') {
            return redirect()->back()->withInput()->with('error', 'Vul username en password in.');
        }

        // 3) Fetch user by username
        $db = db_connect();

        // If "User" causes issues (reserved word), use '[User]' or 'dbo.[User]'
        $user = $db->table('User')
            ->select('UserId, Username, PasswordHash, RoleId')
            ->where('Username', $username)
            ->get()
            ->getRowArray();

        // 4) Verify password
        if ($user === null || !password_verify($password, $user['PasswordHash'])) {
            return redirect()->back()->withInput()->with('error', 'Onjuiste login.');
        }

        // 5) Set session (needed for your controller guard)
        session()->set([
            'userId'   => (int) $user['UserId'],
            'roleId'   => (int) $user['RoleId'],
            'username' => (string) $user['Username'],
        ]);

        // 6) Redirect after success
        return redirect()->to('/admin');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
