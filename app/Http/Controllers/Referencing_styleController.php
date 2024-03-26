<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Referencing_style;

class Referencing_styleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            if(!empty($_GET['search']['value'])){
                $req_record['data'] = Referencing_style::where('style','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $styles = Referencing_style::where('style','LIKE','%'.$_GET['search']['value'].'%')->orderBy('id', 'desc')->get()->toArray();
            }
            else{
                $req_record['data'] = Referencing_style::orderBy('id', 'desc')->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
                $styles = Referencing_style::orderBy('id', 'desc')->get()->toArray();

            }
            if(!empty($styles))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($styles);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $style){
                    $edit_page = 'referencing/'.$style['id'].'/edit';
                    $del_page = route('referencing.destroy', ['referencing' => $style['id']]);
                    
                    $req_style_id = '"'.$style['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='fas fa-edit' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_style(".$del_msg.",".$req_style_id.")' ><i class='fas fa-trash'  title='Delete'></i></a><form method='POST' action=' ".$del_page." ' class='form-delete' style='display: none;' id='style_form_".$style['id']."'>
                        <input type='hidden' value='".csrf_token() ."'  id='csrf_".$style['id']."'>
                    </form>";
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('style/view');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('style/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'style' => 'required',
        ]);
        if($validator->fails()){
            return redirect('referencing/create')->withErrors($validator)->withInput();     
        }
        Referencing_style::create(['style'=>$request->style]);
        return redirect('/referencing')->with('status', 'Referencing Style Created Successfully');
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
        $datas = Referencing_style::where('id',$id)->first();
        return view('style/edit',array('formAction' => route('referencing.update', ['referencing' => $id]),'data'=>$datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'style' => 'required',
        ]);
        if($validator->fails()){
            return redirect('referencing/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        Referencing_style::where('id', $id)->update([
            'style' => $request->style
        ]);
        return redirect('/referencing')->with('status', 'Referencing Style Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $referencing=Referencing_style::find($id);
        if(!empty($referencing)){
            $referencing->delete();
            return redirect('/referencing')->with('status', 'Referencing Style Deleted Successfully');
        }
        else{
            return redirect('/referencing');
        }
    }
}
