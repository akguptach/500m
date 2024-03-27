<?php

namespace App\Services;

use App\Models\Referencing_style;

/**
 * Class ReferencingStyleService.
 */
class ReferencingStyleService
{



    public function getReferencingStyle(): array
    {
        $req_record['data'] = array();
        if (!empty($_GET['search']['value'])) {
            $req_record['data'] = Referencing_style::where('style', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $styles = Referencing_style::where('style', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->get()->toArray();
        } else {
            $req_record['data'] = Referencing_style::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $styles = Referencing_style::orderBy('id', 'desc')->get()->toArray();
        }
        if (!empty($styles))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($styles);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $style) {
                $edit_page = 'referencing/' . $style['id'] . '/edit';
                $del_page = route('referencing.destroy', ['referencing' => $style['id']]);

                $req_style_id = '"' . $style['id'] . '"';

                $req_record['data'][$i]['action'] = "<a href='" . url($edit_page) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_style(" . $del_msg . "," . $req_style_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' " . $del_page . " ' class='form-delete' style='display: none;' id='style_form_" . $style['id'] . "'>
                        <input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $style['id'] . "'>
                    </form>";
                $i++;
            }
        }
        return $req_record;
    }
}
