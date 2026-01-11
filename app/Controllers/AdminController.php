<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    private const ADMIN_ROLE_ID = 1002;

    public function index()
    {
        if (session('userId') === null) {
            return redirect()->to('/login')->with('error', 'Log eerst in.');
        }

        // Must be admin
        if ((int) session('roleId') !== self::ADMIN_ROLE_ID) {
            return redirect()->to('/')->with('error', 'Geen toegang.');
        }

        return view('admin/index', [
            'username' => (string) session('username'),
        ]);
    }
}
