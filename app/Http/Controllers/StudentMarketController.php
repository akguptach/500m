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
use App\Http\Requests\DealUpdateRequest;


class StudentMarketController extends Controller
{
    public function __construct()
    {
        
    }

    public function deals_category(Request $request)
    {
        $dealCategories = DealCategory::orderBy('id','desc')->paginate(25);


        $limit = 10;
        $websiteType = '';
        if ($request->has('limit')) {
            $limit = $request->input('limit');
        }
        if ($request->has('website_type')) {
            $websiteType = $request->input('website_type');
        }

        if($websiteType)
        $dealCategories = DealCategory::orderBy('id','desc')->where('website_type', $websiteType)->paginate($limit);
        else
        $dealCategories = DealCategory::orderBy('id','desc')->paginate($limit);
        return view('studentmarket/category',compact('dealCategories','limit','websiteType'));
        
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

        $dealLogo = '';
        if ($request->has("deal_logo")) {
            $dealLogo = request()->file('deal_logo');
            $dealLogoImageName = time() . '.' . $dealLogo->getClientOriginalExtension();
            $dealLogo->move(public_path('images/uploads/attachment/'), $dealLogoImageName);
            $dealLogo = env('APP_URL') . '/images/uploads/attachment/' . $dealLogoImageName;
        }
        $data['deal_logo'] = $dealLogo;

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

    public function update_deals($id, DealUpdateRequest $request)
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

        $dealLogo = $deal->deal_logo;
        if ($request->has("deal_logo")) {
            $dealLogo = request()->file('deal_logo');
            $dealLogoImageName = time() . '.' . $dealLogo->getClientOriginalExtension();
            $dealLogo->move(public_path('images/uploads/attachment/'), $dealLogoImageName);
            $dealLogo = env('APP_URL') . '/images/uploads/attachment/' . $dealLogoImageName;
        }
        $data['deal_logo'] = $dealLogo;


        $deal->update($data);

        return redirect()->route('studentmarket.student.view_deals')
            ->with('success_message', 'Deal was successfully updated.');  
    }


    public function destroy($id, Request $request)
    {
        /*try {
            $deal = Deal::findOrFail($id);
            $deal->delete();

            return redirect()->route('studentmarket.student.view_deals')
                ->with('success_message', 'Deal was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }*/

        try {
            $data = $request->all();
            $action = isset($data['action'])?$data['action']:'';
            if($action == 'delete'){
                $deal = Deal::findOrFail($id);
                $deal->delete();
                $message = 'Deal was deleted successfully.';
            }else if($action == 'active'){
                $deal = Deal::findOrFail($id);
                $deal->status = 'active';
                $deal->save();
                $message = 'Deal was activated.';
            }
            else if($action == 'inactive'){
                
                $deal = Deal::findOrFail($id);
                $deal->status = 'inactive';
                $deal->save();
                $message = 'Deal was inactivated.';
            }
            return redirect()->route('studentmarket.student.view_deals')
            ->with('success_message', $message);

        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    


    public function view_deals(Request $request)
    {

        $limit = 10;
        $websiteType = '';
        if ($request->has('limit')) {
            $limit = $request->input('limit');
        }
        if ($request->has('website_type')) {
            $websiteType = $request->input('website_type');
        }
        

        if($websiteType)
            $deals = Deal::orderBy('id','desc')->where('website_type', $websiteType)->paginate($limit);
        else
            $deals = Deal::orderBy('id','desc')->paginate($limit);

        return view('studentmarket/view',compact('deals','limit','websiteType'));
        
    }

    
    

    


}