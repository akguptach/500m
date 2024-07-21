<?php

namespace App\Services;

use App\Models\Tutor;

class TutorService
{

    public function getTutors()
    {
        $req_record['data'] = array();
        $query = Tutor::query();
        $searchValue = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';
        if (!empty($_GET['status'])) {
            $query = $query->where('profile_status', $_GET['status']);
        }
        if (!empty($searchValue)) {
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
        if (!empty($tutors))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($tutors);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $status_msg = '"' . 'Are you want to change status?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $tutor) {
                $edit_page = 'tutor/' . $tutor['id'] . '/edit';
                $del_page = route('tutor.destroy', ['tutor' => $tutor['id']]);

                $req_tutor_id = '"' . $tutor['id'] . '"';
                $req_status = ($tutor['status'] == 'active') ? 'inactive' : 'active';
                /*if($tutor['status'] == 'active'){
                        
                        $status_page = route('tutor.status', ['id' => $tutor['id'],'status'=>'inactive']);

                        $update_status = '<a href="'.$status_page.'"><i class="fas fa-check" title="Change status"></i></a>&nbsp;&nbsp;&nbsp;';
                    }
                    else{
                        $status_page = route('tutor.status', ['id' => $tutor['id'],'status'=>'active']);

                        $update_status = '<a href="'.$status_page.'" ><i class="fas fa-lock" title="Change status"></i></a>&nbsp;&nbsp;&nbsp;';
                    }*/
                //$address_url = 'address/'.$tutor['id'];
                $address_url = '"' . 'address' . '"';
                //$bank_url = 'bank/'.$tutor['id'];
                $bank_url = '"' . 'bank' . '"';
                //$kyc_url = 'kyc/'.$tutor['id'];
                $kyc_url = '"' . 'kyc' . '"';
                //$education_url = 'education/'.$tutor['id'];
                $education_url = '"' . 'education' . '"';
                $req_record['data'][$i]['views'] = "<a href='javascript:void(0)' data-bs-toggle='modal' data-bs-target='#myModal' onclick='addressData(" . $address_url . "," . $tutor['id'] . ")' ><i class='fas fa-address-card' title='Address' ></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' title='Bank' data-bs-toggle='modal' data-bs-target='#myModal' onclick='addressData(" . $bank_url . "," . $tutor['id'] . ")' ><i class='fas fa-piggy-bank'  ></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' title='Education' data-bs-toggle='modal' data-bs-target='#myModal' onclick='addressData(" . $education_url . "," . $tutor['id'] . ")'><i class='fas fa-book'  ></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' data-bs-toggle='modal' data-bs-target='#myModal'  title='KYC' onclick='addressData(" . $kyc_url . "," . $tutor['id'] . ")'><i class='fas fa-file' ></i></a>&nbsp;&nbsp;&nbsp;";

                $req_record['data'][$i]['status'] = ucfirst($tutor['status']);
                $req_record['data'][$i]['action'] = "<a class='btn btn-xs sharp btn-primary' href='" . url($edit_page) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='btn btn-xs sharp btn-danger' onclick='delete_tutor(" . $del_msg . "," . $req_tutor_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' " . $del_page . " ' class='form-delete' style='display: none;' id='tutor_form_" . $tutor['id'] . "'>
                        <input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $tutor['id'] . "'>
                    </form>";
                $i++;
            }
        }
        return $req_record;
    }

    public function saveTutor($request, $id = null)
    {

        $tutor                      = ($id) ? Tutor::find($id) : new Tutor();
        $tutor->tutor_first_name    = $request->tutor_first_name;
        $tutor->tutor_last_name     = $request->tutor_last_name;
        $tutor->tutor_email         = $request->tutor_email;
        $tutor->tutor_contact_no    = $request->tutor_contact_no;
        $tutor->tutor_subject       = $request->tutor_subject;
        $tutor->status              = $request->status;
        if (!empty($request->password)) {
            $tutor->password        = bcrypt($request->password);
        }
        if ($request->status == 'baned') {
            $tutor->profile_status  = 'baned';
        } else if ($request->status == 'active') {
            $tutor->profile_status  = 'approved';
        } else {
            if ($tutor->profile_status  == 'baned') {
                $tutor->profile_status  = 'incompelte';
            }
        }
        $tutor->save();
        return $tutor;
    }
}
