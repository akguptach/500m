<?php

namespace App\Services;

use App\Models\Orders;
use Illuminate\Support\Facades\DB;

/**
 * Class OrderService.
 */
class OrderService
{
    public function getOrders()
    {
        $req_record['data'] = array();
        if (!empty($_GET['search']['value'])) {
            $req_record['data'] = Orders::where('page_title', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $pages = Orders::where('page_title', 'LIKE', '%' . $_GET['search']['value'] . '%')->orderBy('id', 'desc')->get()->toArray();
        } else {

            $arrD = DB::table('orders')
                ->join('student', 'student.id', '=', 'orders.student_id')
                ->join('subjects', 'subjects.id', '=', 'orders.subject_id')
                ->join('websites', 'websites.id', '=', 'orders.website_id')
                ->join('task_types', 'task_types.id', '=', 'orders.task_type_id')
                ->join('level_study', 'level_study.id', '=', 'orders.studylabel_id')
                ->join('grades', 'grades.id', '=', 'orders.grade_id')
                ->join('referencing_style', 'referencing_style.id', '=', 'orders.referencing_style_id')
                ->select('orders.*', 'subjects.subject_name', 'websites.website_name', 'task_types.type_name', 'level_study.level_name', 'grades.grade_name', 'referencing_style.style', 'student.first_name')
                ->orderBy('id', 'desc')
                ->get();

            $req_record['data'] = json_decode(json_encode($arrD), true);

            //$req_record['data'] = Orders::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            //$pages = Orders::orderBy('id', 'desc')->get()->toArray();
            $pages = $arrD;
        }
        if (!empty($pages))
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($pages);
        else
            $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
        $del_msg = '"' . 'Are you want to delete?' . '"';
        $i = 0;
        if (!empty($req_record['data'])) {
            foreach ($req_record['data'] as $page) {
                $edit_page = 'orders/' . $page['id'] . '/view';

                $req_page_id = '"' . $page['id'] . '"';

                $req_record['data'][$i]['action'] = "<a href='" . url($edit_page) . "' ><i class='fas fa-eye' title='View'></i></a>";
                $i++;
            }
        }
        return $req_record;
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
}
