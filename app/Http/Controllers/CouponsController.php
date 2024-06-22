<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests\CouponsRequest;

class CouponsController extends Controller
{

    /**
     * Display a listing of the coupons.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
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
        $coupons = Coupon::orderBy('id','desc')->where('website_type', $websiteType)->paginate($limit);
        else
        $coupons = Coupon::orderBy('id','desc')->paginate($limit);
        return view('coupons.index', compact('coupons','limit','websiteType'));
    }

    /**
     * Show the form for creating a new coupon.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('coupons.create');
    }

    /**
     * Store a new coupon in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(CouponsRequest $request)
    {
        
        $data = $this->getData($request);
        
        Coupon::create($data);

        return redirect()->route('coupons.coupon.index')
            ->with('success_message', 'Coupon was successfully added.');
    }


    /**
     * Display the specified coupon.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified coupon.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        

        return view('coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified coupon in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, CouponsRequest $request)
    {
        
        $data = $request->all();
        
        $coupon = Coupon::findOrFail($id);
        $coupon->update($data);

        return redirect()->route('coupons.coupon.index')
            ->with('success_message', 'Coupon was successfully updated.');  
    }

    /**
     * Remove the specified coupon from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id,Request $request)
    {
       /*try {
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();

            return redirect()->route('coupons.coupon.index')
                ->with('success_message', 'Coupon was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }*/
        try {
            $data = $request->all();
            $action = isset($data['action'])?$data['action']:'';
            if($action == 'delete'){
                $deal = Coupon::findOrFail($id);
                $deal->delete();
                $message = 'Coupon was deleted successfully.';
            }else if($action == 'active'){
                $deal = Coupon::findOrFail($id);
                $deal->status = 'active';
                $deal->save();
                $message = 'Coupon was activated.';
            }
            else if($action == 'inactive'){
                
                $deal = Coupon::findOrFail($id);
                $deal->status = 'inactive';
                $deal->save();
                $message = 'Coupon was inactivated.';
            }
            return redirect()->route('coupons.coupon.index')
            ->with('success_message', $message);

        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $data = $request->all();
        return $data;
    }

}
