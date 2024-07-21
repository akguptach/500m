<?php

namespace App\Services;

use App\Models\Grades;

/**
 * Class GradesService.
 */
class GradesService
{
    public function getGrades()
    {
        $req_record['data'] = array();
        if (!empty($_GET['search']['value'])) {
            $req_record['data'] = Grades::where('grade_name', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $grades = Grades::where('grade_name', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->get()->toArray();
        } else {
            $req_record['data'] = Grades::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $grades = Grades::orderBy('id', 'desc')->get()->toArray();
        }
        if (!empty($grades))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($grades);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $grade) {
                $edit_page = 'grade/' . $grade['id'] . '/edit';
                $del_page = route('grade.destroy', ['grade' => $grade['id']]);

                $req_grade_id = '"' . $grade['id'] . '"';

                $req_record['data'][$i]['action'] = "<a class='btn btn-xs sharp btn-primary' href='" . url($edit_page) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='btn btn-xs sharp btn-danger' onclick='delete_grade(" . $del_msg . "," . $req_grade_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' " . $del_page . " ' class='form-delete' style='display: none;' id='grade_form_" . $grade['id'] . "'>
                    <input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $grade['id'] . "'>
                </form>";

                $i++;
            }
        }
        return $req_record;
    }
}
