<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\OrderRequest;
use App\Models\QcOrderRequest;;
use Illuminate\Http\Request;
use App\Models\Tutor;

use App\Http\Requests\QcAssignRequest;
use App\Http\Requests\TutorAssignRequest;
use App\Services\OrderRequestService;
use App\Services\TaskTypeService;

class AjaxController extends Controller
{


    public function __construct(protected OrderRequestService $orderRequestService,
    protected TaskTypeService $taskTypeService)
    {
    }

    public function getTeacherList($order_id, $student_id, $type = 'tutor')
    {
        $teachers = Tutor::get();
        $title = ($type == 'tutor') ? 'Send Request to Tutor' : 'Send Request to QC';
        $actionUrl = ($type == 'tutor') ? route('tutor_assign_request') : route('qc_assign_request');
        return view('ajax.teacher_list', compact('teachers', 'order_id', 'student_id', 'title', 'actionUrl'));
    }



    public function tutorAssignRequest(TutorAssignRequest $request)
    {
        try {
            return response($this->orderRequestService->sendRequest($request, 'tutor'));
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function qcAssignRequest(QcAssignRequest $request)
    {
        try {
            return response($this->orderRequestService->sendRequest($request, 'qc'));
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function getTaskTypes(Request $request)
    {
        try {
            $dataList = $this->taskTypeService->getTaskTypesByWebsite($request->website_type);
            $competences = $request->competences;
            return view('ajax.task_type_multiselect', compact('dataList','competences'));
            /*$html = '';
            foreach($dataList as $list){
                $html .=  '<option value="'.$list->id.'">'.$list->type_name.'</option>';
            }
            echo $html;*/
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }
}
