<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\Role;
use App\Models\UserPermission;
use Auth;
use DB;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('is_authorized', ['except' => ['userPermission', 'updateUserPermission']]);
    }

    public function index($id = null)
    {
        //config(['site.page' => 'permission']);
        //$roles = Role::where('slug', 'store_admin')->get();
        $roleId = $id;
        $permissions = Permission::withCount(['rolePermission' => function ($q) use ($roleId) {
            $q->where('role_id', '=', $roleId);
        }])
        ->where('by_pass', 0)
        ->get();

        $permissionsLabels = [];
        if ($roleId)
            foreach ($permissions as $permission) {
                $permissionsLabels[$permission['label']][] = $permission;
            }
        return view('permission.index', compact('permissionsLabels','id'));
    }


    public function userPermission($id = null)
    {
        $user = Auth::user();
        $permissionsLabels = [];
        /*if ($user->hasRole('admin')) {
            $permissions = Permission::withCount(['userPermission' => function ($q) use ($id) {
                $q->where('user_id', '=', $id);
            }])->get();
            if ($id) {
                foreach ($permissions as $permission) {
                    $permissionsLabels[$permission['label']][] = $permission;
                }
            }
        } else {
            $permissions = Permission::withCount(['userPermission' => function ($q) use ($id) {
                $q->where('user_id', '=', $id);
            }])
                ->withCount(['rolePermission as current_role_permission' => function ($q) use ($user) {
                    $q->where('role_id', '=', $user->role_id);
                }])
                ->withCount(['userPermission as current_user_permission' => function ($q) use ($user) {
                    $q->where('user_id', '=', $user->id);
                }])->get();
            $permissionsLabels = [];
            if ($id) {
                foreach ($permissions as $permission) {
                    if ($permission['current_role_permission'] > 0 || $permission['current_user_permission'] > 0)
                        $permissionsLabels[$permission['label']][] = $permission;
                }
            }
        }*/

        $permissions = Permission::withCount(['userPermission' => function ($q) use ($id) {
            $q->where('user_id', '=', $id);
        }])
        ->where('by_pass', 0)
        ->get();
        if ($id) {
            foreach ($permissions as $permission) {
                $permissionsLabels[$permission['label']][] = $permission;
            }
        }
        return view('permission.user', compact('permissionsLabels', 'id'));
    }

    public function updateUserPermission(Request $request)
    {
        try {
            $this->validate($request, [
                'user_id' => 'required|numeric|gt:0',
                'permission_id' => 'required|numeric|gt:0',
            ]);
            $permission = UserPermission::where('user_id', '=', $request->user_id)
                ->where('permission_id', '=', $request->permission_id)->first();
            if ($permission) {
                $permission->delete();
                DB::table('user_permissions')
                    ->where('parent_user_id', $request->user_id)
                    ->delete();
            } else {
                $user = Auth::user();
                $data = $request->all();
                $data['parent_user_id'] = $user->id;
                $data['parent_role_id'] = $user->role_id;
                UserPermission::create($data);
            }
        } catch (\Exception $e) {
            echo $e;
            die;
        }
    }

    public function update(Request $request)
    {
        try {
            $this->validate($request, [
                'role_id' => 'required|numeric|gt:0',
                'permission_id' => 'required|numeric|gt:0',
            ]);
            $permission = RolePermission::where('role_id', '=', $request->role_id)
                ->where('permission_id', '=', $request->permission_id)->first();
            if ($permission) {
                $permission->delete();
                DB::table('user_permissions')
                    ->where('parent_role_id', $request->role_id)
                    ->delete();
            } else {

                RolePermission::create($request->all());
            }
        } catch (\Exception $e) {
            echo $e;
            die;
        }
    }
}
