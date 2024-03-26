<?php namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Orders;
use App\Models\Subject;
use App\Models\WebsiteModel;
use App\Models\TaskType;
use App\Models\Level_study;
use App\Models\Grades;
use App\Models\Referencing_style;

class OrdersController extends Controller{
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            if(!empty($_GET['search']['value'])){
                $req_record['data'] = Orders::where('page_title','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $pages = Orders::where('page_title','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->get()->toArray();
            }
            else{
				
				 $arrD= DB::table('orders')
				->join('student', 'student.id', '=', 'orders.student_id')
				->join('subjects', 'subjects.id', '=', 'orders.subject_id')
				->join('websites', 'websites.id', '=', 'orders.website_id')
				->join('task_types', 'task_types.id', '=', 'orders.task_type_id')
				->join('level_study', 'level_study.id', '=', 'orders.studylabel_id')
				->join('grades', 'grades.id', '=', 'orders.grade_id')
				->join('referencing_style', 'referencing_style.id', '=', 'orders.referencing_style_id')
				->select('orders.*', 'subjects.subject_name', 'websites.website_name','task_types.type_name','level_study.level_name','grades.grade_name','referencing_style.style','student.first_name')
				->orderBy('id', 'desc')
				->get();
				
				$req_record['data']=json_decode(json_encode($arrD), true);
               
                //$req_record['data'] = Orders::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                //$pages = Orders::orderBy('id', 'desc')->get()->toArray();
				$pages =$arrD;

            }
            if(!empty($pages))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($pages);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $page){
                    $edit_page = 'orders/'.$page['id'].'/view';
                    
                    $req_page_id = '"'.$page['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-eye' title='View'></i></a>";
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('orders/view');
        }
    }
    
	/**
     * Show the form for editing the specified resource.
     */
    public function view(string $id)
    {
        $datas = Orders::find($id);
		
        return view('orders/details',array('data'=>$datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'website_id' => 'required',
        ]);
        if($validator->fails()){
            return redirect('Orders/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        //$Orders = Orders::find($id);
		$Orders = Orders::findOrFail($id);
		//$Orders                      = new Orders();

        $Orders->website_id     = $request->website_id;

        $Orders->subject_id     = $request->subject_id;

        $Orders->task_type_id   = $request->task_type_id;

        $Orders->studylabel_id  = $request->studylabel_id;

        $Orders->grade_id       = $request->grade_id;
        $Orders->referencing_style_id       = $request->referencing_style_id;
		
		$Orders->no_of_words  			= $request->no_of_words;
		$Orders->rate  				= $request->rate;
		$Orders->additional_word_rate  = $request->additional_word_rate;
        

        $Orders->save();
		
        return redirect('/Orders')->with('status', 'Price Updated Successfully');
    }
	
	

    

    /**

     * Store a newly created resource in storage.

     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website_id' => 'required',
        ]);

        if($validator->fails()){
            return redirect('Orders/create')->withErrors($validator)->withInput();     
        }

        Orders::create(
		[
		'website_id'=>$request->website_id,
		'subject_id'=>$request->subject_id,
		'task_type_id'=>$request->task_type_id,
		'studylabel_id'=>$request->studylabel_id,
		'grade_id'=>$request->grade_id,
		'referencing_style_id'=>$request->referencing_style_id,
		
		'no_of_words'=>$request->no_of_words,
		'rate'=>$request->rate,
		'additional_word_rate'=>$request->additional_word_rate
		
		]
		);

        return redirect('/Orders')->with('status', 'Orders Created Successfully');

    }


}
