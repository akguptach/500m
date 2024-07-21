<?php

namespace App\Services;

use App\Models\Subject;

class CouponService
{

    public function getSubjects()
    {
        $req_record['data'] = array();

        if (!empty($_GET['search']['value'])) {
            $subjects = Subject::where('subject_name', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->get()->toArray();
            $req_record['data'] = Subject::where('subject_name', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
        } else {
            $subjects = Subject::orderBy('id', 'desc')->get()->toArray();

            $req_record['data'] = Subject::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
        }
        if (!empty($subjects))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($subjects);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $index => $subject1) {

                $req_record['data'][$i]['srno'] = $index + 1;
                $req_record['data'][$i]['status'] = ($subject1['status'] == '1') ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-success">Deactive</span>';
                $edit_page = 'subject/' . $subject1['id'] . '/edit';
                $del_page = route('subject.destroy', ['subject' => $subject1['id']]);
                $req_subject_id = '"' . $subject1['id'] . '"';

                $req_record['data'][$i]['action'] = "<a href='" . url($edit_page) . "' class='btn btn-xs sharp btn-primary' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='btn btn-xs sharp btn-danger' onclick='delete_subject(" . $del_msg . "," . $req_subject_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' " . $del_page . " ' class='form-delete' style='display: none;' id='subject_form_" . $subject1['id'] . "'>
                    <input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $subject1['id'] . "'>
                </form>";
                $i++;
            }
        }
        return $req_record;
    }
}