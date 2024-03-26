<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{

    public function getRoles()
    {
        $req_record['data'] = array();
        if (!empty($_GET['search']['value'])) {
            $req_record['data'] = Role::where('role_name', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $roles = Role::where('role_name', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->get()->toArray();
        } else {
            $req_record['data'] = Role::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $roles = Role::orderBy('id', 'desc')->get()->toArray();
        }
        if (!empty($roles))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($roles);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $role1) {
                $edit_page = 'role/' . $role1['id'] . '/edit';
                $del_page = route('role.destroy', ['role' => $role1['id']]);

                $req_role_id = '"' . $role1['id'] . '"';
                if ($role1['id'] == 1) {
                    $req_record['data'][$i]['action'] = "";
                } else {
                    $req_record['data'][$i]['action'] = "<a href='" . url($edit_page) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_role(" . $del_msg . "," . $req_role_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' " . $del_page . " ' class='form-delete' style='display: none;' id='role_form_" . $role1['id'] . "'>
                        <input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $role1['id'] . "'>
                    </form>";
                }
                $i++;
            }
        }
        return $req_record;
    }
}
