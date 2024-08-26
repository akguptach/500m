<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{

    protected $fillable = [
        'permission_id', 'user_id', 'parent_role_id', 'parent_user_id'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
