<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Level_study;

class LevelStudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            if(!empty($_GET['search']['value'])){
                $req_record['data'] = Level_study::where('level_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $levels = Level_study::where('level_name','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->get()->toArray();
            }
            else{
                $req_record['data'] = Level_study::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $levels = Level_study::orderBy('id', 'desc')->get()->toArray();

            }
            if(!empty($levels))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($levels);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $level){
                    $edit_page = 'level_study/'.$level['id'].'/edit';
                    $del_page = route('level_study.destroy', ['level_study' => $level['id']]);
                    
                    $req_level_id = '"'.$level['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_level(".$del_msg.",".$req_level_id.")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' ".$del_page." ' class='form-delete' style='display: none;' id='level_form_".$level['id']."'>
                        <input type='hidden' value='".csrf_token() ."'  id='csrf_".$level['id']."'>
                    </form>";
                    
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('level_study/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('level_study/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level_name' => 'required',
			'price' => 'required',
			'website_type' => 'required',
			
        ]);
        if($validator->fails()){
            return redirect('level_study/create')->withErrors($validator)->withInput();     
        }
        Level_study::create([
		'level_name'  => $request->level_name,
		'price'       => $request->price,
		'website_type'=> $request->website_type
		
		]);
        return redirect('/level_study')->with('status', 'Level Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datas = Level_study::find($id);
        return view('level_study/edit',array('formAction' => route('level_study.update', ['level_study' => $id]),'data'=>$datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'level_name' => 'required',
			'price' => 'required',
			'website_type' => 'required',
        ]);
        if($validator->fails()){
            return redirect('level_study/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        Level_study::where('id', $id)->update([
            'level_name' => $request->level_name,
			'price' => $request->price,
			'website_type'=> $request->website_type
        ]);
        return redirect('/level_study')->with('status', 'Level Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $level=Level_study::find($id);
        if(!empty($level)){
            $level->delete();
            return redirect('/level_study')->with('status', 'Level Deleted Successfully');
        }
        else{
            return redirect('/level_study');
        }
    }
}
