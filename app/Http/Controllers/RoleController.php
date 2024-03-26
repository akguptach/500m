<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Http\Requests\RoleRequest;
use App\Services\RoleService;


class RoleController extends Controller
{
    public function __construct(protected RoleService $roleService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            echo $this->roleService->getRoles();
        } else {
            return view('role/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        Role::create(['role_name' => $request->role_name]);
        return redirect('/role')->with('status', 'Role Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datas = Role::where('id', $id)->first();
        return view('role/edit', array('formAction' => route('role.update', ['role' => $id]), 'data' => $datas));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        Role::where('id', $id)->update([
            'role_name' => $request->role_name
        ]);
        return redirect('/role')->with('status', 'Role Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if (!empty($role)) {
            $role->delete();
            return redirect('/role')->with('status', 'Role Deleted Successfully');
        } else {
            return redirect('/role');
        }
    }
}
