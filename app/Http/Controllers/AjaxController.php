<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\OrderRequest;
use App\Models\QcOrderRequest;;

use App\Models\Tutor;

use App\Http\Requests\QcAssignRequest;
use App\Http\Requests\TutorAssignRequest;
use App\Services\OrderRequestService;

class AjaxController extends Controller
{


    public function __construct(protected OrderRequestService $orderRequestService)
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
}
