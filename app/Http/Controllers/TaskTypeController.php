<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Models\TaskType;
use App\Models\Website;
use App\Http\Requests\TaskTypeRequest;
use App\Services\TaskTypeService;


class TaskTypeController extends Controller
{

    public function __construct(protected TaskTypeService $taskTypeService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->taskTypeService->getTaskTypes());
        } else {
            return view('task_type/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		$data['websites']   = Website::all();
        return view('task_type/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskTypeRequest $request)
    {
        $this->taskTypeService->saveTaskType($request);
        return redirect('/tasktype')->with('status', 'Task Type Created Successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
		$websites   = Website::all();
        $datas = TaskType::where('id', $id)->first();
        return view('task_type/edit', array('formAction' => route('tasktype.update', ['tasktype' => $id]), 'data' => $datas,'websites'=>$websites));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskTypeRequest $request, string $id)
    {
        $this->taskTypeService->saveTaskType($request, $id);
        return redirect('/tasktype')->with('status', 'Task Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task_type = TaskType::find($id);
        if (!empty($task_type)) {
            $task_type->delete();
            return redirect('/tasktype')->with('status', 'Task Type Deleted Successfully');
        } else {
            return redirect('/tasktype');
        }
    }
}
