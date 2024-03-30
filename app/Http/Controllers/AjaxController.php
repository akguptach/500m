<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\OrderRequest;
use App\Models\QcOrderRequest;;

use App\Models\Tutor;

use App\Http\Requests\QcAssignRequest;
use App\Http\Requests\TutorAssignRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AjaxController extends Controller
{


    public function __construct()
    {
    }

    public function getTeacherList($order_id, $student_id, $type = 'tutor')
    {
        $teachers = Tutor::get();
        $title = ($type == 'tutor') ? 'Assign Tutuor' : 'Assign QC';
        $actionUrl = ($type == 'tutor') ? route('tutor_assign_request') : route('qc_assign_request');
        return view('ajax.teacher_list', compact('teachers', 'order_id', 'student_id', 'title', 'actionUrl'));
    }



    public function tutorAssignRequest(TutorAssignRequest $request)
    {
        try {
            OrderRequest::Create([
                'order_id' => $request->order_id,
                'student_id' => $request->student_id,
                'tutor_id' => $request->teacher_id,
                'admin_id' => Auth::user()->id,
                'message' => '',
                'delivery_date' => $request->delivery_date
            ]);
            return response(['Request send successfully']);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function qcAssignRequest(QcAssignRequest $request)
    {
        try {
            QcOrderRequest::Create([
                'order_id' => $request->order_id,
                'student_id' => $request->student_id,
                'qc_id' => $request->teacher_id,
                'admin_id' => Auth::user()->id,
                'message' => '',
                'delivery_date' => $request->delivery_date
            ]);
            return response(['Request send successfully']);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }
}
