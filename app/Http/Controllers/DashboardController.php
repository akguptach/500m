<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Payment;
use App\Models\OrderAssign;
use App\Models\QcAssign;
use App\Models\ContactUs;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    public function __construct()
    {
    }
    

    public function index()
    {

        $data = [];

        $query = DB::table('orders')
            ->join('student', 'student.id', '=', 'orders.student_id')
            ->join('subjects', 'subjects.id', '=', 'orders.subject_id')
            ->join('websites', 'websites.id', '=', 'orders.website_id')
            ->join('task_types', 'task_types.id', '=', 'orders.task_type_id')
            ->join('level_study', 'level_study.id', '=', 'orders.studylabel_id')
            ->join('grades', 'grades.id', '=', 'orders.grade_id')
            ->join('referencing_style', 'referencing_style.id', '=', 'orders.referencing_style_id');
        $query1 = clone $query;
        $query2 = clone $query;

        $data['total_orders'] = $query1->where('payment_status','Success')->count();
        $data['total_enqury'] = $query2->where('payment_status','Failed')
        ->orWhereNull('payment_status')
        ->count();


        $totalOrderSale = Payment::where('payment_status','Success')->sum('amount');

        $totalAmountPaidToTutor = OrderAssign::where('status','COMPLETED')->sum('tutor_price');
        $totalAmountPaidToQc = QcAssign::where('status','COMPLETED')->sum('qc_price');
        $totalExpence = $totalAmountPaidToTutor+$totalAmountPaidToQc;
        $data['total_expence'] = $totalExpence;
        $totalProfit =  $totalOrderSale - $totalExpence;
        $data['total_profit'] = $totalProfit;
        $data['total_payment'] = $totalOrderSale;


        $tutorDue = $tutorDue = Orders::whereHas('teacherAssigned')
        ->join('student', 'student.id', '=', 'orders.student_id')
            ->join('subjects', 'subjects.id', '=', 'orders.subject_id')
            ->join('websites', 'websites.id', '=', 'orders.website_id')
            ->join('task_types', 'task_types.id', '=', 'orders.task_type_id')
            ->join('level_study', 'level_study.id', '=', 'orders.studylabel_id')
            ->join('grades', 'grades.id', '=', 'orders.grade_id')
            ->join('referencing_style', 'referencing_style.id', '=', 'orders.referencing_style_id')
            ->where('orders.status','INPROCESS')
            ->count();
        $data['total_due'] = $tutorDue;


        $data['new_orders'] = Orders::doesntHave('teacherAssigned')
        ->join('student', 'student.id', '=', 'orders.student_id')
            ->join('subjects', 'subjects.id', '=', 'orders.subject_id')
            ->join('websites', 'websites.id', '=', 'orders.website_id')
            ->join('task_types', 'task_types.id', '=', 'orders.task_type_id')
            ->join('level_study', 'level_study.id', '=', 'orders.studylabel_id')
            ->join('grades', 'grades.id', '=', 'orders.grade_id')
            ->join('referencing_style', 'referencing_style.id', '=', 'orders.referencing_style_id')->where('orders.payment_status', 'Success')
        ->count();


        $data['total_pending_enquiry'] = ContactUs::where('customer_attendant',0)->count();

        return view('dashboard',$data);
    }

    
}
