<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;


use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Exception;
use App\Models\DealCategory;
use App\Http\Requests\DealCategoryRequest;
use App\Models\Deal;
use App\Http\Requests\DealRequest;

class StudentMarketController extends Controller
{
    public function __construct()
    {
        
    }

    public function deals_category()
    {
        $dealCategories = DealCategory::paginate(25);
        return view('studentmarket/category',compact('dealCategories'));
        
    }

    public function store(DealCategoryRequest $request)
    {
        
        $data = $request->all();
        DealCategory::create($data);
        return redirect()->route('studentmarket.student.deals_category')
            ->with('success_message', 'Deal Category was successfully added.');
    }


    public function edit($id)
    {
        $dealCategory = DealCategory::findOrFail($id);
        return view('studentmarket/deal_categories_edit', compact('dealCategory'));
    }


    public function update($id, Request $request)
    {
        $data = $request->all();
        $dealCategory = DealCategory::findOrFail($id);
        $dealCategory->update($data);
        return redirect()->route('studentmarket.student.deals_category')
            ->with('success_message', 'Deal Category was successfully updated.');  
    }


    public function destroyCategory($id, Request $request)
    {
        try {
            $data = $request->all();
            $action = isset($data['action'])?$data['action']:'';
            if($action == 'delete'){
                $dealCategory = DealCategory::findOrFail($id);
                $dealCategory->delete();
                $message = 'Deal Category was successfully deleted.';
            }else if($action == 'active'){
                $dealCategory = DealCategory::findOrFail($id);
                $dealCategory->status = 'active';
                $dealCategory->save();
                $message = 'Deal Category was activated.';
            }
            else if($action == 'inactive'){
                $dealCategory = DealCategory::findOrFail($id);
                $dealCategory->status = 'inactive';
                $dealCategory->save();
                $message = 'Deal Category was inactivated.';
            }
            return redirect()->route('studentmarket.student.deals_category')
            ->with('success_message', $message);

        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    public function add_deals()
    {
        $dealCategories = DealCategory::get();
        return view('studentmarket/add',compact('dealCategories'));
    }

    

    public function storeDeals(DealRequest $request)
    {
        $data = $request->all();
        $image = '';
        if ($request->has("image")) {
            $image = request()->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/uploads/attachment/'), $imageName);
            $image = env('APP_URL') . '/images/uploads/attachment/' . $imageName;
        }
        $data['image'] = $image;
        Deal::create($data);
        return redirect()->route('studentmarket.student.view_deals')
            ->with('success_message', 'Deal was successfully added.');
    }


    public function edit_deals($id)
    {
        $deal = Deal::findOrFail($id);
        $dealCategories = DealCategory::get();
        return view('studentmarket/edit', compact('deal','dealCategories'));
    }

    public function update_deals($id, DealRequest $request)
    {
        
        $data = $request->all();
        
        $deal = Deal::findOrFail($id);

        $image = $deal->image;
        if ($request->has("image")) {
            $image = request()->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/uploads/attachment/'), $imageName);
            $image = env('APP_URL') . '/images/uploads/attachment/' . $imageName;
            
        }
        $data['image'] = $image;
        $deal->update($data);

        return redirect()->route('studentmarket.student.view_deals')
            ->with('success_message', 'Deal was successfully updated.');  
    }


    public function destroy($id)
    {
        try {
            $deal = Deal::findOrFail($id);
            $deal->delete();

            return redirect()->route('studentmarket.student.view_deals')
                ->with('success_message', 'Deal was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    public function view_deals()
    {
        $deals = Deal::paginate(25);
        return view('studentmarket/view',compact('deals'));
        
    }

    
    

    


}