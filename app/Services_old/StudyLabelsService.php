<?php

namespace App\Services;

use App\Models\StudyLabelsModel;

/**
 * Class StudyLabelsService.
 */
class StudyLabelsService
{

    public function getStudyLavels()
    {
        $req_record['data'] = array();
        if (!empty($_GET['search']['value'])) {
            $req_record['data'] = StudyLabelsModel::where('label_name', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $labels = StudyLabelsModel::where('label_name', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->get()->toArray();
        } else {
            $req_record['data'] = StudyLabelsModel::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $labels = StudyLabelsModel::orderBy('id', 'desc')->get()->toArray();
        }
        if (!empty($labels))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($labels);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $label) {
                $edit_page = 'studylabel/' . $label['id'] . '/edit';
                $del_page = route('studylabel.destroy', ['studylabel' => $label['id']]);

                $req_label_id = '"' . $label['id'] . '"';

                $req_record['data'][$i]['action'] = "<a class='btn btn-xs sharp btn-primary' href='" . url($edit_page) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='btn btn-xs sharp btn-danger' onclick='delete_label(" . $del_msg . "," . $req_label_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' " . $del_page . " ' class='form-delete' style='display: none;' id='study_label_form_" . $label['id'] . "'>
                        <input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $label['id'] . "'>
                    </form>";
                $i++;
            }
        }
        return $req_record;
    }
}
