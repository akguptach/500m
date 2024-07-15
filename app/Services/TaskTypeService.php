<?php

namespace App\Services;

use App\Models\TaskType;

class TaskTypeService
{

    public function getTaskTypes()
    {
        $req_record['data'] = array();
        if (!empty($_GET['search']['value']) || isset($_GET['columns'][0]['search']['value']) && !empty($_GET['columns'][0]['search']['value'])) {

            $req_record['data'] = TaskType::where('type_name', 'LIKE', '%' . $_GET['search']['value'] . '%')
                ->where(function ($q) {
                    if (isset($_GET['columns'][0]['search']['value']) && !empty($_GET['columns'][0]['search']['value'])) {
                        $q->where('website_type', $_GET['columns'][0]['search']['value']);
                    }
                })
                ->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $tasks = TaskType::where('type_name', 'LIKE', '%' . $_GET['search']['value'] . '%')
                ->where(function ($q) {
                    if (isset($_GET['columns'][0]['search']['value']) && !empty($_GET['columns'][0]['search']['value'])) {
                        $q->where('website_type', $_GET['columns'][0]['search']['value']);
                    }
                })
                ->orderBy('id', 'desc')->get()->toArray();
        } else {
            $req_record['data'] = TaskType::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $tasks = TaskType::orderBy('id', 'desc')->get()->toArray();
        }
        if (!empty($tasks))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($tasks);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $task1) {
                $edit_page = 'tasktype/' . $task1['id'] . '/edit';
                $del_page = route('tasktype.destroy', ['tasktype' => $task1['id']]);

                $req_type_id = '"' . $task1['id'] . '"';

                $req_record['data'][$i]['action'] = "<a href='" . url($edit_page) . "' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_task_type(" . $del_msg . "," . $req_type_id . ")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' " . $del_page . " ' class='form-delete' style='display: none;' id='task_type_form_" . $task1['id'] . "'>
                        <input type='hidden' value='" . csrf_token() . "'  id='csrf_" . $task1['id'] . "'>
                    </form>";
                $i++;
            }
        }
        return $req_record;
    }

    public function saveTaskType($request, string $id = null)
    {
        if ($id) {
            $task_type                  =   TaskType::find($id);
        } else {
            $task_type                  = new TaskType();
        }
        $task_type->type_name       =   $request->type_name;
        $task_type->website_type    =   $request->website_type;
        $task_type->price           =   $request->price;
        $task_type->status          =   $request->status;
        $task_type->save();
    }

    public function getTaskTypesByWebsite($websiteType)
    {
        $taskTypes = TaskType::where('website_type',$websiteType)->orderBy('id', 'desc')->get();
        return $taskTypes;
    }
}