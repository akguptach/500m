<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Http\Requests\AffiliateUserRequest;
use App\Http\Requests\AffiliateUserUpdateRequest;

use App\Models\Student;


class AffiliateUserController extends Controller
{
    public function __construct()
    { 
        
    }

    public function index()
    {
        return view('affiliateuser/add');
        
    }

    public function store(AffiliateUserRequest $request)
    {
        $data = $request->all();
        $data['user_type'] = 'AFFILIATE';
        $data['password'] = Hash::make($data['password']);
        Student::Create($data);
        return redirect()->route('affiliateuser.affiliate.view')
            ->with('status', 'Affiliate was successfully created.');
    }

    public function edit($id)
    {
        $user = Student::findOrFail($id);
        return view('affiliateuser/edit',compact('user'));
    }

    public function update($id, AffiliateUserUpdateRequest $request)
    {
        $data = $request->all();
        $student = Student::findOrFail($id);
        $student->update($data);
        return redirect()->route('affiliateuser.affiliate.view')
            ->with('status', 'Affiliate was successfully updated.');
    }


    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();

            return redirect()->route('affiliateuser.affiliate.view')
                ->with('status', 'Affiliate user was successfully deleted.');
        } catch (\Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function change($id, Request $request)
    {
        try {
            $student = Student::findOrFail($id);
            $student->status = $request->status;
            $student->save();
            return redirect()->route('affiliateuser.affiliate.view')
                ->with('status', 'Affiliate user was successfully activated.');
        } catch (\Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function view()
    {
        $query = Student::where('user_type','AFFILIATE')->orderBy('first_name','asc');
        
        $affiliateUsers = $query->paginate(15);
        
        return view('affiliateuser/view',compact('affiliateUsers'));
        
    }

    


}