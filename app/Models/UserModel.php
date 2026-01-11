<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'User';
    protected $primaryKey = 'UserId';

    protected $returnType = 'array';
    protected $useTimestamps = false;

    // Only fields you allow to be inserted/updated
    protected $allowedFields = [
        'Name',
        'Email',
        'PasswordHash',
        'RoleId',
    ];
}
