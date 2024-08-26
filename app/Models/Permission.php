<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    public function rolePermission()
    {
        return $this->hasMany('App\Models\RolePermission', 'permission_id');
    }

    public function userPermission()
    {
        return $this->hasMany('App\Models\UserPermission', 'permission_id');
    }
}
