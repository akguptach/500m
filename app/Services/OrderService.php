<?php

namespace App\Services;

use App\Models\Orders;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\User;
use App\Models\Tutor;
use App\Models\StudentOrderMessage;
use App\Models\TeacherOrderMessage;
use App\Models\QcOrderMessage;
use App\Models\OrderAssign;
use App\Models\QcAssign;
use App\Models\OrderRequest;
use App\Models\OrderRequestMessage;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 * Class OrderService.
 */
class OrderService
{


    private function addStausCondition($query, $status){


        if($status == 'Failed'){
            $query->where(function($q) {
                $q->where('orders.payment_status', 'Failed');
                $q->orWhereNull('orders.payment_status');
            });
        }
        else if ($status == 'Success') {
            $query->where('orders.payment_status', $status);
        }

        else if ($status == 'New') {
            $query->doesntHave('teacherAssigned')->where('orders.payment_status', 'Success');;
        }
        else if ($status == 'OnGoing') {
            $query->whereHas('teacherAssigned')->where('orders.status','INPROCESS');
        }
        else if ($status == 'Completed') {
            $query->where('orders.status','DELIVERED');
        }

       /* if ($type) {
            $query->where('orders.payment_status', $type);
        }*/
        return $query;
    }

    public function getOrders($studentId = '', $status='')
    {

        $req_record['data'] = array();
        $query = Orders::query();
        if (!empty($_GET['search']['value']) || isset($_GET['columns'][2]['search']['value']) && !empty($_GET['columns'][2]['search']['value'])) {

            

            $query = Orders::with(['teacherAssigned','qcAssigned'])
            ->join('student', function($q) {
                $q->whereNull('student.deleted_at')->whereRaw("student.id = orders.student_id");
            })
                ->join('subjects', 'subjects.id', '=', 'orders.subject_id')
                ->join('websites', 'websites.id', '=', 'orders.website_id')
                ->join('task_types', 'task_types.id', '=', 'orders.task_type_id')
                ->join('level_study', 'level_study.id', '=', 'orders.studylabel_id')
                ->join('grades', 'grades.id', '=', 'orders.grade_id')
                ->join('referencing_style', 'referencing_style.id', '=', 'orders.referencing_style_id');

            if (isset($_GET['columns'][2]['search']['value']) && !empty($_GET['columns'][2]['search']['value'])) {
                $website  = Website::where('website_type', $_GET['columns'][2]['search']['value'])->first();
                $query->where('orders.website_id', $website->id);
            }

            if ($studentId) {
                $query->where('orders.student_id', $studentId);
            }
            
            /*if ($type) {
                $query->where('orders.payment_status', $type);
            }*/
            $query = $this->addStausCondition($query, $status);
            

            if (!empty($_GET['search']['value'])) {
                $query->where(function ($q) {
                    $q->orWhere('subjects.subject_name', 'LIKE', '%' . $_GET['search']['value'] . '%');
                    $q->orWhere('student.first_name', 'LIKE', '%' . $_GET['search']['value'] . '%');
                    $q->orWhere('student.last_name', 'LIKE', '%' . $_GET['search']['value'] . '%');
                });
            }


            $query->select('orders.*', 'subjects.subject_name', 'websites.website_type', 'websites.website_name', 'task_types.type_name', 'level_study.level_name', 'grades.grade_name', 'referencing_style.style', 'student.first_name')
                ->orderBy('id', 'desc');
            if (isset($_GET['start']) && isset($_GET['length'])) {
                $query->skip($_GET['start'])->take($_GET['length'])->orderBy('id', 'desc');
            }
            $arrD = $query->get();

            foreach($arrD as $i=>$row){
                
                if(isset($row['qcAssigned']) && $row['qcAssigned']['status'] == 'COMPLETED'){
                    $arrD[$i]['row_color'] = 'green-bg';
                }
                else if(isset($row['teacherAssigned']) && $row['teacherAssigned']['status'] == 'COMPLETED'){
                    $arrD[$i]['row_color'] = 'red-bg';
                }
                
                else{
                    $arrD[$i]['row_color'] = '';
                }
            }

            $req_record['data'] = json_decode(json_encode($arrD), true);

            //$req_record['data'] = Orders::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            //$pages = Orders::orderBy('id', 'desc')->get()->toArray();
            $pages = $arrD;

            
            $pages = Orders::query();
            // $pages = DB::table('orders');
            $pages = Orders::with(['teacherAssigned','qcAssigned'])
            ->join('student', function($q) {
                $q->whereNull('student.deleted_at')->whereRaw("student.id = orders.student_id");
            })
            //->join('student', 'student.id', '=', 'orders.student_id')
            ->join('subjects', 'subjects.id', '=', 'orders.subject_id')
            ->join('websites', 'websites.id', '=', 'orders.website_id')
            ->join('task_types', 'task_types.id', '=', 'orders.task_type_id')
            ->join('level_study', 'level_study.id', '=', 'orders.studylabel_id')
            ->join('grades', 'grades.id', '=', 'orders.grade_id')
            ->join('referencing_style', 'referencing_style.id', '=', 'orders.referencing_style_id');
            if (isset($_GET['columns'][2]['search']['value']) && !empty($_GET['columns'][2]['search']['value'])) {
                $website  = Website::where('website_type', $_GET['columns'][2]['search']['value'])->first();
                $pages->where('orders.website_id', $website->id);
            }

            if ($studentId) {
                $pages->where('orders.student_id', $studentId);
            }
            /*if ($type) {
                $query->where('orders.payment_status', $type);
            }*/
            $query = $this->addStausCondition($query, $status);

            if (!empty($_GET['search']['value'])) {
                $pages->where(function ($q) {
                    $q->orWhere('subjects.subject_name', 'LIKE', '%' . $_GET['search']['value'] . '%');
                    $q->orWhere('student.first_name', 'LIKE', '%' . $_GET['search']['value'] . '%');
                    $q->orWhere('student.last_name', 'LIKE', '%' . $_GET['search']['value'] . '%');
                });
            }
            if ($studentId) {
                $pages->where('orders.student_id', $studentId);
            }
            /*if ($type) {
                $query->where('orders.payment_status', $type);
            }*/
            $pages = $this->addStausCondition($pages, $status);
            $pages = $pages->get();
        } else {

            $query = Orders::with(['teacherAssigned','qcAssigned'])
            //$query = DB::table('orders')
            ->join('student', function($q) {
                $q->whereNull('student.deleted_at')->whereRaw("student.id = orders.student_id");
            })
                ->join('subjects', 'subjects.id', '=', 'orders.subject_id')
                ->join('websites', 'websites.id', '=', 'orders.website_id')
                ->join('task_types', 'task_types.id', '=', 'orders.task_type_id')
                ->join('level_study', 'level_study.id', '=', 'orders.studylabel_id')
                ->join('grades', 'grades.id', '=', 'orders.grade_id')
                ->join('referencing_style', 'referencing_style.id', '=', 'orders.referencing_style_id')
                ->select('orders.*', 'subjects.subject_name', 'websites.website_type', 'websites.website_name', 'task_types.type_name', 'level_study.level_name', 'grades.grade_name', 'referencing_style.style', 'student.first_name')
                ->orderBy('id', 'desc');

            if ($studentId) {
                $query->where('orders.student_id', $studentId);
            }
            /*if ($type) {
                $query->where('orders.payment_status', $type);
            }*/

            $query = $this->addStausCondition($query, $status);

            if (isset($_GET['start']) && isset($_GET['length'])) {
                $query->skip($_GET['start'])->take($_GET['length'])->orderBy('id', 'desc');
            }


            $arrD = $query->get();

            foreach($arrD as $i=>$row){
                
                if(isset($row['qcAssigned']) && $row['qcAssigned']['status'] == 'COMPLETED'){
                    $arrD[$i]['row_color'] = 'green-bg';
                }
                else if(isset($row['teacherAssigned']) && $row['teacherAssigned']['status'] == 'COMPLETED'){
                    $arrD[$i]['row_color'] = 'red-bg';
                }
                
                else{
                    $arrD[$i]['row_color'] = '';
                }
            }

            $req_record['data'] = json_decode(json_encode($arrD), true);


            //count 
            $pages = Orders::with(['teacherAssigned','qcAssigned'])
            //$pages = DB::table('orders')
            ->join('student', function($q) {
                $q->whereNull('student.deleted_at')->whereRaw("student.id = orders.student_id");
            })
            ->join('subjects', 'subjects.id', '=', 'orders.subject_id')
            ->join('websites', 'websites.id', '=', 'orders.website_id')
            ->join('task_types', 'task_types.id', '=', 'orders.task_type_id')
            ->join('level_study', 'level_study.id', '=', 'orders.studylabel_id')
            ->join('grades', 'grades.id', '=', 'orders.grade_id')
            ->join('referencing_style', 'referencing_style.id', '=', 'orders.referencing_style_id');
            if ($studentId) {
                $pages->where('orders.student_id', $studentId);
            }
            /*if ($type) {
                $pages->where('orders.payment_status', $type);
            }*/
            $pages = $this->addStausCondition($pages, $status);

            $pages = $pages->get();
            //    echo "<pre>".var_export($pages,true);die();
            //$req_record['data'] = Orders::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            //$pages = Orders::orderBy('id', 'desc')->get()->toArray();
            // $pages = $arrD;
        }
        if (!empty($pages))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($pages);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $page) {
                $req_record['data'][$i]['action'] = $this->generateActionLinks($page);
                $i++;
            }
        }
        return $req_record;
    }


    public function generateActionLinks($page)
    {

        $edit_page = 'orders/' . $page['id'] . '/view';
        //$req_page_id = '"' . $page['id'] . '"';

        if ($page['status'] == 'ENQUIRIES') {
            $actionsLinks = '<div class="dropdown">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ENQUIRIES
        </button></div>';
        } else {
            $tutorCompleted = OrderAssign::where('order_id', $page['id'])
                ->where('status', 'COMPLETED')
                ->count();

            $tutorOrderRequest = OrderRequest::where('order_id', $page['id'])->where('type', 'TUTOR')->orderBy('id', 'desc')->first();


            $qcOrderRequest = OrderRequest::where('order_id', $page['id'])->where('type', 'QC')->orderBy('id', 'desc')->first();

            $actionsLinks = '<div class="dropdown">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Actions
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
            $actionsLinks .= '<a class="dropdown-item" href="' . url($edit_page) . '">Order Details</a>';

            if ($tutorOrderRequest && $tutorOrderRequest->status != 'REJECTED') {
                $actionsLinks .= '<a class="dropdown-item" href="' . route('tutor_request_sent', ['id' => $page['id']]) . '">Tutor Request</a>';
            } else {
                $actionsLinks .= '<a class="dropdown-item assign-teacher" href="#" data-bs-toggle="modal" data-student-id="' . $page['student_id'] . '" data-order-id="' . $page['id'] . '" data-ajax-url="' . route('get_teachers', ['student_id' => $page['student_id'], 'order_id' => $page['id'], 'type' => 'tutor']) . '" data-modal-id="modal-assign-teacher" data-model-body="teachers-modal-body">Send Tutor Request</a>';
            }

            if ($tutorCompleted > 0) {
                if ($qcOrderRequest && $qcOrderRequest->status != 'REJECTED') {
                    $actionsLinks .= '<a class="dropdown-item" href="' . route('qc_request_sent', ['id' => $page['id']]) . '">Qc Request</a>';
                } else {
                    $actionsLinks .= '<a class="dropdown-item assign-teacher" href="#" data-bs-toggle="modal"  data-student-id="' . $page['student_id'] . '" data-order-id="' . $page['id'] . '" data-ajax-url="' . route('get_teachers', ['student_id' => $page['student_id'], 'order_id' => $page['id'], 'type' => 'qc']) . '" data-modal-id="modal-assign-teacher" data-model-body="teachers-modal-body">Send Qc Request</a>';
                }
            }
            $actionsLinks .= '</div></div>';
        }
        return $actionsLinks;
    }


    public function orderDetails($id)
    {
        $result = [];
        $result['data'] = Orders::with(['website', 'student', 'subject', 'teacherAssigned.teacher', 'teacherAssigned.student', 'qcAssigned.qc'])->where('id', $id)->first();

        $result['orderAssign'] = OrderAssign::where('order_id', $id)->first();
        $result['qcAssign'] = QcAssign::where('order_id', $id)->first();
        $result['studentMessages'] = StudentOrderMessage::whereHas('sendertable')->with(['sendertable', 'receivertable'])->where('order_id', $id)->get();

        DB::table('qc_order_messages')
            ->where('order_id', $id)
            ->where('receivertable_type', User::class)
            ->where('receivertable_id', Auth::user()->id)
            ->update(array('read' => 1));

        DB::table('student_order_messages')
            ->where('order_id', $id)
            ->where('receivertable_type', User::class)
            ->where('receivertable_id', Auth::user()->id)
            ->update(array('read' => 1));

        DB::table('teacher_order_messages')
            ->where('order_id', $id)
            ->where('receivertable_type', User::class)
            ->where('receivertable_id', Auth::user()->id)
            ->update(array('read' => 1));

        if ($result['orderAssign']) {

            $result['teacherOrderMessage'] = TeacherOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $id)->get();
        }
        if ($result['qcAssign']) {
            $result['qcOrderMessage'] = QcOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $id)->get();
        }



        $result['tutorRequestAccepted'] = OrderRequest::with(['tutor'])->where('order_id', $id)
            ->where('type', 'TUTOR')
            ->where('status', 'ACCEPTED')
            ->first();

        $result['qcRequestAccepted'] = OrderRequest::with(['tutor'])->where('order_id', $id)
            ->where('status', 'ACCEPTED')
            ->where('type', 'QC')->first();



        if ($result['tutorRequestAccepted']) {
            $result['teacherRequestMessage'] = OrderRequestMessage::with(['sendertable', 'receivertable'])->where('request_id', $result['tutorRequestAccepted']->id)->get();
        }
        if ($result['qcRequestAccepted']) {
            $result['qcRequestMessage'] = OrderRequestMessage::with(['sendertable', 'receivertable'])->where('request_id', $result['qcRequestAccepted']->id)->get();
        }

        return $result;
    }


    public function saveOrder($request, $id = null)
    {
        $Orders = ($id) ? Orders::findOrFail($id) : new Orders();
        $Orders->website_id     = $request->website_id;
        $Orders->subject_id     = $request->subject_id;
        $Orders->task_type_id   = $request->task_type_id;
        $Orders->studylabel_id  = $request->studylabel_id;
        $Orders->grade_id       = $request->grade_id;
        $Orders->referencing_style_id       = $request->referencing_style_id;
        $Orders->no_of_words              = $request->no_of_words;
        $Orders->rate                  = $request->rate;
        $Orders->additional_word_rate  = $request->additional_word_rate;
        $Orders->save();
    }

    public function saveOrderMessages($request)
    {

        try {
            $attachment = '';
            if ($request->has("attachment")) {

                $attachment = request()->file('attachment');
                $attachmentName = time() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move(public_path('images/uploads/attachment/'), $attachmentName);
                $attachment = env('APP_URL', '/') . '/images/uploads/attachment/' . $attachmentName;
            }
            if ($request->type == 'STUDENT') {

                $receiver = Student::find($request->receiver_id);
                $toEmail = $receiver->email;
                $url = env('EDUCRAFTER_URL', 'https://mywriters.in') . '/vieworder/' . $request->order_id;
                StudentOrderMessage::Create([
                    'order_id' => $request->order_id,
                    'sendertable_id' => Auth::user()->id,
                    'sendertable_type' => User::class,
                    'receivertable_id' => $request->receiver_id,
                    'receivertable_type' => Student::class,
                    'message' => $request->message,
                    'attachment' => $attachment,
                    'url' => $url
                ]);
            } else if ($request->type == 'TUTOR') {

                $receiver = Tutor::find($request->receiver_id);
                $toEmail = $receiver->tutor_email;
                $orderAssign = OrderAssign::where('order_id', $request->order_id)
                    ->where('tutor_id', $request->receiver_id)->first();
                $url = env('TUTOR_URL', 'https://mywriters.in') . '/open/order/details/' . $orderAssign->id;
                TeacherOrderMessage::Create([
                    'order_id' => $request->order_id,
                    'sendertable_id' => Auth::user()->id,
                    'sendertable_type' => User::class,
                    'receivertable_id' => $request->receiver_id,
                    'receivertable_type' => Tutor::class,
                    'message' => $request->message,
                    'attachment' => $attachment,
                    'url' => $url
                ]);
            } else if ($request->type == 'QC') {

                $receiver = Tutor::find($request->receiver_id);
                $toEmail = $receiver->tutor_email;
                $orderAssign = QcAssign::where('order_id', $request->order_id)
                    ->where('qc_id', $request->receiver_id)->first();
                $url = env('TUTOR_URL', 'https://mywriters.in') . '/qc/open/order/details/' . $orderAssign->id;
                QcOrderMessage::Create([
                    'order_id' => $request->order_id,
                    'sendertable_id' => Auth::user()->id,
                    'sendertable_type' => User::class,
                    'receivertable_id' => $request->receiver_id,
                    'receivertable_type' => Tutor::class,
                    'message' => $request->message,
                    'attachment' => $attachment,
                    'url' => $url
                ]);
            }





            $data = ['url' => $url, 'messageContent' => $request->message];
            try {
                Mail::send('emails.mywriters.message', $data, function ($message) use ($data, $toEmail) {
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $message->subject("Message Received");
                    $message->to(env('APP_TEST_EMAIL', $toEmail));
                });
            } catch (\Exception $e) {
                //echo $e; die;
            }




            return ['message' => 'Message sent', 'status' => 'success'];
        } catch (\Exception $e) {
            return ['message' => $e->getMessage(), 'status' => 'error'];
        }
    }

    public function sendRequestMessage($request)
    {

        try {
            $attachment = '';
            if ($request->has("attachment")) {

                $attachment = request()->file('attachment');
                $attachmentName = time() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move(public_path('images/uploads/attachment/'), $attachmentName);
                $attachment = env('APP_URL') . '/images/uploads/attachment/' . $attachmentName;
            }
            $url = env('TUTOR_URL', 'https://mywriters.in') . '/request/details/' . $request->request_id;
            OrderRequestMessage::Create([
                'request_id' => $request->request_id,
                'sendertable_id' => Auth::user()->id,
                'sendertable_type' => User::class,
                'receivertable_id' => $request->receiver_id,
                'receivertable_type' => Tutor::class,
                'message' => $request->message,
                'attachment' => $attachment,
                'url'=>$url
            ]);

            $tutor = Tutor::find($request->receiver_id);
            $url = env('TUTOR_URL', 'https://mywriters.in') . '/request/details/' . $request->request_id;
            $data = ['url' => $url, 'messageContent' => $request->message];
            try {
                Mail::send('emails.mywriters.message', $data, function ($message) use ($data, $tutor) {
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $message->subject("Message received");
                    $message->to(env('APP_TEST_EMAIL', $tutor->tutor_email));
                });
            } catch (\Exception $e) {
                echo $e;
                die;
            }


            return ['message' => 'Message sent', 'status' => 'success'];
        } catch (\Exception $e) {
            return ['message' => $e->getMessage(), 'status' => 'error'];
        }
    }

    public function submitFinalBudget($request)
    {

        $orderRequest = OrderRequest::find($request->id);
        $budget = $request->final_budget_amount;
        if ($orderRequest->type == 'TUTOR') {
            $assigned = OrderAssign::Create([
                'order_id' => $orderRequest->order_id,
                'student_id' => $orderRequest->student_id,
                'tutor_id' => $orderRequest->tutor_id,
                'tutor_price' => $budget,
                'message' => ''
            ]);
            $url = env('TUTOR_URL', 'https://mywriters.in') . '/open/order/details/' . $assigned->id;
            $tutor = Tutor::find($orderRequest->tutor_id);
        } else if ($orderRequest->type == 'QC') {
            $assigned = QcAssign::Create([
                'order_id' => $orderRequest->order_id,
                'student_id' => $orderRequest->student_id,
                'qc_id' => $orderRequest->tutor_id,
                'qc_price' => $budget,
            ]);
            $url = env('TUTOR_URL', 'https://mywriters.in') . '/qc/open/order/details/' . $assigned->id;
            $tutor = Tutor::find($orderRequest->tutor_id);
        }

        // print_r($tutor['tutor_email ']); die;
        OrderRequestMessage::Create([
            'request_id' => $orderRequest->id,
            'sendertable_id' => Auth::user()->id,
            'sendertable_type' => \App\Models\User::class,
            'receivertable_id' => $tutor->id,
            'receivertable_type' => Tutor::class,
            'message' => 'You are assigned on order',
            'url' => $url,
            'type' => 'notification'
        ]);


        $data = ['url' => $url, 'messageContent' => 'You are assigned on order'];
        try {
            Mail::send('emails.mywriters.message', $data, function ($message) use ($data, $tutor) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->subject("Order assigned");
                $message->to(env('APP_TEST_EMAIL', $tutor['tutor_email']));
            });
        } catch (\Exception $e) {
            echo $e;
            die;
        }


        return ['message' => 'Order assigned', 'status' => 'success'];
    }

    public function getTutorRequestSent($id = null)
    {
        $result = [];


        $result['type'] = 'TUTOR';
        $result['data'] = Orders::with(['website', 'student', 'subject', 'teacherAssigned.teacher', 'teacherAssigned.student', 'qcAssigned.qc'])->where('id', $id)->first();

        $result['orderAssign'] = $result['qcAssign'] = $result['tutorRequestAccepted'] = $result['qcRequestAccepted'] = '';
        $result['studentMessages'] = StudentOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $id)->get();
        $result['orderRequestSent'] = OrderRequest::with(['tutor'])->where('order_id', $id)
            ->where('type', 'TUTOR')
            ->orderBy('id', 'desc')
            ->first();

        if ($result['orderRequestSent'] && $result['orderRequestSent']->status == 'ACCEPTED') {
            $result['teacherRequestMessage'] = OrderRequestMessage::with(['sendertable', 'receivertable'])->where('request_id', $result['orderRequestSent']->id)->get();
            $result['orderAssign'] = OrderAssign::where('order_id', $id)->first();
        }


        DB::table('order_request_messages')
            ->where('request_id', $result['orderRequestSent']->id)
            ->where('receivertable_type', User::class)
            ->where('receivertable_id', Auth::user()->id)
            ->update(array('read' => 1));

        /*if ($result['orderAssign']) {
            $result['studentMessages'] = StudentOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $id)->get();
            $result['teacherOrderMessage'] = TeacherOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $id)->get();
        }
        if ($result['qcAssign']) {
            $result['qcOrderMessage'] = QcOrderMessage::with(['sendertable', 'receivertable'])->where('order_id', $id)->get();
        }*/


        /*$result['qcRequestAccepted'] = OrderRequest::with(['tutor'])->where('order_id', $id)
            ->where('status', 'ACCEPTED')
            ->where('type', 'QC')->first();


        
        if ($result['qcRequestAccepted']) {
            $result['qcRequestMessage'] = OrderRequestMessage::with(['sendertable', 'receivertable'])->where('request_id', $result['qcRequestAccepted']->id)->get();
        }*/
        //$result['orderRequestSent'] = OrderRequest::where('order_id', $id)->where('type', 'TUTOR')->first();
        return $result;
    }


    public function getQcRequestSent($id = null)
    {
        $result = [];
        $result['type'] = 'QC';
        $result['data'] = Orders::with(['website', 'student', 'subject', 'teacherAssigned.teacher', 'teacherAssigned.student', 'qcAssigned.qc'])->where('id', $id)->first();
        $result['orderAssign'] = $result['qcAssign'] = $result['tutorRequestAccepted'] = $result['qcRequestAccepted'] = '';
        $result['orderRequestSent'] = OrderRequest::with(['tutor'])->where('order_id', $id)
            ->where('type', 'QC')
            ->orderBy('id', 'desc')
            ->first();
        if ($result['orderRequestSent'] && $result['orderRequestSent']->status == 'ACCEPTED') {
            $result['teacherRequestMessage'] = OrderRequestMessage::with(['sendertable', 'receivertable'])->where('request_id', $result['orderRequestSent']->id)->get();
            $result['orderAssign'] = QcAssign::where('order_id', $id)->first();
        }

        DB::table('order_request_messages')
            ->where('request_id', $result['orderRequestSent']->id)
            ->where('receivertable_type', User::class)
            ->where('receivertable_id', Auth::user()->id)
            ->update(array('read' => 1));


        return $result;
    }


    public function deliverToStudent($id)
    {
        $order = Orders::find($id);
        $order->status = 'DELIVERED';
        $order->save();


        $receiver = Student::find($order->student_id);
        $toEmail = $receiver->email;
        $url = env('EDUCRAFTER_URL', 'https://mywriters.in') . '/vieworder/' . $id;
        StudentOrderMessage::Create([
            'order_id' => $id,
            'sendertable_id' => Auth::user()->id,
            'sendertable_type' => User::class,
            'receivertable_id' => $receiver->id,
            'receivertable_type' => Student::class,
            'message' => 'Your order has been delivered',
            'url' => $url,
            'type' => 'notification'
        ]);


        $data = ['url' => $url, 'messageContent' => 'Your order has been delivered'];
        try {
            Mail::send('emails.mywriters.message', $data, function ($message) use ($data, $toEmail) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $message->subject("Order Delivered");
                $message->to(env('APP_TEST_EMAIL', $toEmail));
            });
        } catch (\Exception $e) {
            echo $e;
            die;
        }


        return ['message' => 'Order Delivered to student', 'status' => 'success'];
    }
}
