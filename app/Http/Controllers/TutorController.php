<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Tutor;
use App\Models\Subject;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            $query = Tutor::query();
            $searchValue = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';
            if(!empty($_GET['status'])){
                $query = $query->where('profile_status',$_GET['status']);
            }
            if(!empty($searchValue)){
                $query->where(function ($subquery) use ($searchValue) {
                    $subquery->orwhere('tutor_name', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('tutor_email', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('tutor_mobile', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('tutor_subject', 'LIKE', '%' . $searchValue . '%');
                });
            }
            $query->orderBy('id', 'desc');
            $req_record['data'] = $query->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $tutors = $query->get()->toArray();
            if(!empty($tutors))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($tutors);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $status_msg = '"'.'Are you want to change status?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $tutor){
                    $edit_page = 'tutor/'.$tutor['id'].'/edit';
                    $del_page = route('tutor.destroy', ['tutor' => $tutor['id']]);
                    
                    $req_tutor_id = '"'.$tutor['id'].'"';
                    $req_status = ($tutor['status'] == 'active')?'inactive':'active';
                    /*if($tutor['status'] == 'active'){
                        
                        $status_page = route('tutor.status', ['id' => $tutor['id'],'status'=>'inactive']);

                        $update_status = '<a href="'.$status_page.'"><i class="fas fa-check" title="Change status"></i></a>&nbsp;&nbsp;&nbsp;';
                    }
                    else{
                        $status_page = route('tutor.status', ['id' => $tutor['id'],'status'=>'active']);

                        $update_status = '<a href="'.$status_page.'" ><i class="fas fa-lock" title="Change status"></i></a>&nbsp;&nbsp;&nbsp;';
                    }*/
                    //$address_url = 'address/'.$tutor['id'];
                    $address_url = '"'.'address'.'"';
                    //$bank_url = 'bank/'.$tutor['id'];
                    $bank_url = '"'.'bank'.'"';
                    //$kyc_url = 'kyc/'.$tutor['id'];
                    $kyc_url = '"'.'kyc'.'"';
                    //$education_url = 'education/'.$tutor['id'];
                    $education_url = '"'.'education'.'"';
                    $req_record['data'][$i]['views'] = "<a href='javascript:void(0)' data-toggle='modal' data-target='#myModal' onclick='addressData(".$address_url.",".$tutor['id'].")' ><i class='fas fa-address-card' title='Address' ></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' title='Bank' data-toggle='modal' data-target='#myModal' onclick='addressData(".$bank_url.",".$tutor['id'].")' ><i class='fas fa-piggy-bank'  ></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' title='Education' data-toggle='modal' data-target='#myModal' onclick='addressData(".$education_url.",".$tutor['id'].")'><i class='fas fa-book'  ></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' data-toggle='modal' data-target='#myModal'  title='KYC' onclick='addressData(".$kyc_url.",".$tutor['id'].")'><i class='fas fa-file' ></i></a>&nbsp;&nbsp;&nbsp;";

                    $req_record['data'][$i]['status'] = ucfirst($tutor['status']);
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_tutor(".$del_msg.",".$req_tutor_id.")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' ".$del_page." ' class='form-delete' style='display: none;' id='tutor_form_".$tutor['id']."'>
                        <input type='hidden' value='".csrf_token() ."'  id='csrf_".$tutor['id']."'>
                    </form>";
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            
            return view('tutor/view');
        }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('tutor/create',array('subjects'=>$subjects));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tutor_first_name' => 'required|max:150|min:2',
            'tutor_last_name' => 'required|max:150|min:2',
            'tutor_email' => 'required|email|unique:tutor,tutor_email',
            'tutor_contact_no' => 'required|numeric|unique:tutor,tutor_contact_no',
            'tutor_subject' => 'required',
            'status' => 'required',
            'password' => 'required|min:5',
        ]);
        if($validator->fails()){
            return redirect('tutor/create')->withErrors($validator)->withInput();     
        }
        $tutor                      = new Tutor();
        $tutor->tutor_first_name    = $request->tutor_first_name;
        $tutor->tutor_last_name     = $request->tutor_last_name;
        $tutor->tutor_email         = $request->tutor_email;
        $tutor->tutor_contact_no    = $request->tutor_contact_no;
        $tutor->tutor_subject       = $request->tutor_subject;
        $tutor->status              = $request->status;
        if($request->status == 'baned'){
            $tutor->profile_status  = 'baned';
        }
        else{
            $tutor->profile_status  = 'incompelte';
        }
        $tutor->password            = bcrypt($request->password);
        $tutor->save();
        return redirect('/tutor_view/'.$tutor->profile_status)->with('status', 'Tutor Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subjects = Subject::all();
        $datas = Tutor::find($id);
        return view('tutor/edit',array('formAction' => route('tutor.update', ['tutor' => $id]),'data'=>$datas,'subjects'=>$subjects));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tutor_first_name' => 'required|max:150|min:2',
            'tutor_last_name' => 'required|max:150|min:2',
            'tutor_email' => 'required|email|unique:tutor,tutor_email,'.$id,
            'tutor_contact_no' => 'required|numeric|unique:tutor,tutor_contact_no,'.$id,
            'tutor_subject' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return redirect('tutor/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        $tutor                      = Tutor::find($id);
        $tutor->tutor_first_name    = $request->tutor_first_name;
        $tutor->tutor_last_name     = $request->tutor_last_name;
        $tutor->tutor_email         = $request->tutor_email;
        $tutor->tutor_contact_no    = $request->tutor_contact_no;
        $tutor->tutor_subject       = $request->tutor_subject;
        $tutor->status              = $request->status;
        if(!empty($request->password)){
            $tutor->password        = bcrypt($request->password);
        }
        if($request->status == 'baned'){
            $tutor->profile_status  = 'baned';
        }
        else if($request->status == 'active'){
            $tutor->profile_status  = 'approved';
        }
        else{
            if($tutor->profile_status  == 'baned'){
                $tutor->profile_status  = 'incompelte';
            }
        }
        $tutor->save();
        return redirect('/tutor_view/'.$tutor->profile_status)->with('status', 'Tutor Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tutor = Tutor::find($id);
        $profile_status = $tutor->profile_status;
        if(!empty($tutor)){
            $tutor->delete();
            return redirect('/tutor_view/'.$profile_status)->with('status', 'Tutor Deleted Successfully');
        }
        else{
            return redirect('/tutor_view/incompelte');
        }
    }
}
