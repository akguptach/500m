<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\TaskType;


class TaskTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            if(!empty($_GET['search']['value'])){
                $req_record['data'] = TaskType::where('type_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $tasks = TaskType::where('type_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->get()->toArray();
            }
            else{
                $req_record['data'] = TaskType::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $tasks = TaskType::orderBy('id', 'desc')->get()->toArray();

            }
            if(!empty($tasks))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($tasks);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $task1){
                    $edit_page = 'tasktype/'.$task1['id'].'/edit';
                    $del_page = route('tasktype.destroy', ['tasktype' => $task1['id']]);
                    
                    $req_type_id = '"'.$task1['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_task_type(".$del_msg.",".$req_type_id.")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' ".$del_page." ' class='form-delete' style='display: none;' id='task_type_form_".$task1['id']."'>
                        <input type='hidden' value='".csrf_token() ."'  id='csrf_".$task1['id']."'>
                    </form>";
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('task_type/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task_type/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_name' => 'required',
            'website_type' => 'required',
            'price'     => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return redirect('tasktype/create')->withErrors($validator)->withInput();     
        }
        $task_type                  = new TaskType();
        $task_type->type_name       =   $request->type_name;
        $task_type->website_type    =   $request->website_type;
        $task_type->price           =   $request->price;
        $task_type->status          =   $request->status;
        $task_type->save();
        return redirect('/tasktype')->with('status', 'Task Type Created Successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datas = TaskType::where('id',$id)->first();
        return view('task_type/edit',array('formAction' => route('tasktype.update', ['tasktype' => $id]),'data'=>$datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'type_name' => 'required',
            'website_type' => 'required',
            'price'     => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()){
            return redirect('tasktype/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        $task_type                  =   TaskType::find($id);
        $task_type->type_name       =   $request->type_name;
        $task_type->website_type    =   $request->website_type;
        $task_type->price           =   $request->price;
        $task_type->status          =   $request->status;
        $task_type->save();
        return redirect('/tasktype')->with('status', 'Task Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task_type = TaskType::find($id);
        if(!empty($task_type)){
            $task_type->delete();
            return redirect('/tasktype')->with('status', 'Task Type Deleted Successfully');
        }
        else{
            return redirect('/tasktype');
        }
    }
}
