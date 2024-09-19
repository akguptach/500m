<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StaffUserRequest;
use App\Http\Requests\StaffUserUpdateRequest;
use App\Models\User;
use App\Models\Role;


class StaffUserController extends Controller
{
    public function __construct()
    { 
        
    }

    public function index()
    {
        $roles = Role::all();
        return view('staffuser/add',compact('roles'));
        
    }

    public function store(StaffUserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        User::Create($data);
        return redirect()->route('staffuser.list')->with('status', 'User was successfully created.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('staffuser/edit',compact('user','roles'));
    }

    public function update($id, StaffUserUpdateRequest $request)
    {
        $data = $request->all();
        if($data['password']){
            $data['password'] = Hash::make($data['password']);
        }else{
            unset($data['password']);
        }
        $user = User::findOrFail($id);
        $user->update($data);
        return redirect()->route('staffuser.list')->with('status', 'User was successfully updated.');
    }


    public function destroy($id)
    {
        try {
            $User = User::findOrFail($id);
            $User->delete();

            return redirect()->route('staffuser.list')
                ->with('status', 'User was successfully deleted.');
        } catch (\Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function change($id, Request $request)
    {
        try {
            $User = User::findOrFail($id);
            $User->status = $request->status;
            $User->save();
            if($request->status == "active"){
                return redirect()->route('staffuser.list')
                    ->with('status', 'User user was successfully activated.');
            }else{
                return redirect()->route('staffuser.list')
                ->with('status', 'User user was successfully Deactivated.');
            }
        } catch (\Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function view()
    {
        $query = User::where('role_id','!=', '1')->orderBy('name','asc');
        
        $staffusers = $query->paginate(15);
        
        return view('staffuser/view',compact('staffusers'));
        
    }

    


}