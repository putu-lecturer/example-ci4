<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'user';

    protected $allowedFields = ['user', 'password'];
}