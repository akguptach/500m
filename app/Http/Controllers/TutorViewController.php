<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Address;
use App\Models\Bank;
use App\Models\Kyc;
use App\Models\Education;
use App\Models\Tutor;

class TutorViewController extends Controller
{
    public function address($tutor_id){
        $data['tutor']   = Tutor::find($tutor_id);
        $data['address'] = Address::where('tutor_id',$tutor_id)->first();
        return view('tutor/address',$data);

    }
    public function bank($tutor_id){
        $data['tutor']   = Tutor::find($tutor_id);
        $data['bank'] = Bank::where('tutor_id',$tutor_id)->first();
        return view('tutor/bank',$data);
    }
    public function education($tutor_id){
        $data['tutor']   = Tutor::find($tutor_id);
        $data['education'] = Education::where('tutor_id',$tutor_id)->first();
        return view('tutor/education',$data);
    }
    public function kyc($tutor_id){
        $data['tutor']   = Tutor::find($tutor_id);
        $data['kyc'] = Kyc::where('tutor_id',$tutor_id)->first();
        return view('tutor/kyc',$data);
    }
    public function profile_status($status){
        $data['status'] = strtolower($status);
        return view('tutor/view',$data);
    }
}
