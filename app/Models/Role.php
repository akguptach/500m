<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table= 'roles';
    protected $fillable = [
        'role_name',
    ];

    public function rolePermissions()
    {
        return $this->hasMany('App\Models\RolePermission', 'role_id');
    }
}
