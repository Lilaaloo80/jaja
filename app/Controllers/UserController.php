<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        // Later you can join Role to show RoleName; start simple:
        $users = $userModel->findAll();

        return view('users/index', ['users' => $users]);
    }

    public function create()
    {
        $roleModel = new RoleModel();

        $roles = $roleModel->orderBy('RoleName', 'ASC')->findAll();

        return view('users/create', ['roles' => $roles]);
    }

    public function store()
    {
        // Read + normalize
        $name     = trim((string) $this->request->getPost('Name'));
        $email    = trim((string) $this->request->getPost('Email'));
        $password = (string) $this->request->getPost('Password');
        $roleId   = (int) $this->request->getPost('RoleId');

        // Validate (minimal)
        if ($name === '' || $email === '' || $password === '' || $roleId <= 0) {
            return redirect()->back()->withInput()->with('error', 'Vul alle velden correct in.');
        }

        // Hash password (never store plaintext)
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $userModel = new UserModel();
        $userModel->insert([
            'Name'         => $name,
            'Email'        => $email,
            'PasswordHash' => $passwordHash,
            'RoleId'       => $roleId,
        ]);

        return redirect()->to('/users')->with('success', 'Gebruiker aangemaakt.');
    }

    public function edit(int $userId)
    {
        $userModel = new UserModel();
        $roleModel = new RoleModel();

        $user = $userModel->find($userId);
        if ($user === null) {
            return redirect()->to('/users')->with('error', 'Gebruiker niet gevonden.');
        }

        $roles = $roleModel->orderBy('RoleName', 'ASC')->findAll();

        return view('users/edit', [
            'user'  => $user,
            'roles' => $roles,
        ]);
    }

    public function update(int $userId)
    {
        $name   = trim((string) $this->request->getPost('Name'));
        $email  = trim((string) $this->request->getPost('Email'));
        $roleId = (int) $this->request->getPost('RoleId');

        // Optional: password can be empty to keep existing password
        $password = (string) $this->request->getPost('Password');

        if ($name === '' || $email === '' || $roleId <= 0) {
            return redirect()->back()->withInput()->with('error', 'Vul alle velden correct in.');
        }

        $data = [
            'Name'   => $name,
            'Email'  => $email,
            'RoleId' => $roleId,
        ];

        if ($password !== '') {
            $data['PasswordHash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel = new UserModel();
        $userModel->update($userId, $data);

        return redirect()->to('/users')->with('success', 'Gebruiker aangepast.');
    }

    public function delete(int $userId)
    {
        $userModel = new UserModel();
        $userModel->delete($userId);

        return redirect()->to('/users')->with('success', 'Gebruiker verwijderd.');
    }
}
