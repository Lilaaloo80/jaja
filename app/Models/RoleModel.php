<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'Role';
    protected $primaryKey = 'RoleId';

    protected $returnType = 'array';

    protected $allowedFields = ['RoleName'];
}
