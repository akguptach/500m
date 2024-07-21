<?php

namespace App\Services;

use App\Models\Level_study;

/**
 * Class LevelStudyService.
 */
class LevelStudyService
{

    public function getLavelStudy()
    {
        $req_record['data'] = array();
        if (!empty($_GET['search']['value']) || isset($_GET['columns'][1]['search']['value']) && !empty($_GET['columns'][1]['search']['value'])) {

            $req_record['data'] = Level_study::where(function ($q) {
                if (!empty($_GET['search']['value'])) {
                    $q->where('level_name', 'LIKE', '%' . $_GET['search']['value'] . '%');
                }
                if (isset($_GET['columns'][1]['search']['value']) && !empty($_GET['columns'][1]['search']['value'])) {
                    $q->where('website_type', $_GET['columns'][1]['search']['value']);
                }
            })->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();


            $levels = Level_study::where(function ($q) {
                if (!empty($_GET['search']['value'])) {
                    $q->where('level_name', 'LIKE', '%' . $_GET['search']['value'] . '%');
                }
                if (isset($_GET['columns'][1]['search']['value']) && !empty($_GET['columns'][1]['search']['value'])) {
                    $q->where('website_type', $_GET['columns'][1]['search']['value']);
                }
            })->orderBy('id', 'desc')->get()->toArray();
        } else {
            $req_record['data'] = Level_study::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $levels = Level_study::orderBy('id', 'desc')->get()->toArray();
        }
        if (!empty($levels))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($levels);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $level) {
                $edit_page = 'level_study/' . $level['id'] . '/edit';
                $del_page = route('level_study.destroy', ['level_study' => $level['id']]);

                $req_level_id = '"' . $level['id'] . '"';

                $req_record['data'][$i]['action'] = "<a class='btn btn-xs sharp btn-primary' href='" . url($edit_page) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='btn btn-xs sharp btn-danger' onclick='delete_level(" . $del_msg . "," . $req_level_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' " . $del_page . " ' class='form-delete' style='display: none;' id='level_form_" . $level['id'] . "'>
                        <input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $level['id'] . "'>
                    </form>";

                $i++;
            }
        }
        return $req_record;
    }
}