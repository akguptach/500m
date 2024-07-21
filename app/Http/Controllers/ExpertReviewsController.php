<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\ExpertReview;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests\ExpertReviewRequest;

class ExpertReviewsController extends Controller
{

    /**
     * Display a listing of the expert reviews.
     *
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        $expertReviews = ExpertReview::where('expert_id', $id)->orderBy('id','desc')->paginate(5);
        return view('expert_reviews.index', compact('expertReviews','id'));
    }

    /**
     * Show the form for creating a new expert review.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $experts = Expert::pluck('subject','id')->all();
        
        return view('expert_reviews.create', compact('experts'));
    }

    /**
     * Store a new expert review in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store($id, ExpertReviewRequest $request)
    {
        $data = $request->all();
        $data['expert_id'] = $id;
        //print_r($data); die;
        ExpertReview::create($data);
        return redirect()->route('expert_reviews.expert_review.index',$id)
            ->with('success_message', 'Expert Review was successfully added.');
    }

    /**
     * Display the specified expert review.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $expertReview = ExpertReview::with('expert')->findOrFail($id);

        return view('expert_reviews.show', compact('expertReview'));
    }

    /**
     * Show the form for editing the specified expert review.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $expertReview = ExpertReview::findOrFail($id);
        $experts = Expert::pluck('id')->all();

        return view('expert_reviews.edit', compact('expertReview','experts'));
    }

    /**
     * Update the specified expert review in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, ExpertReviewRequest $request)
    {
        
        $data = $request->all();
        $expertReview = ExpertReview::findOrFail($id);
        $expertReview->update($data);
        return redirect()->route('expert_reviews.expert_review.index',$expertReview->expert_id)
            ->with('success_message', 'Expert Review was successfully updated.');  
    }

    /**
     * Remove the specified expert review from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $expertReview = ExpertReview::findOrFail($id);
            $expertReview->delete();

            return redirect()->back()
                ->with('success_message', 'Expert Review was successfully deleted.');
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
        $rules = [
                'title' => 'string|min:1|max:255|nullable',
            'description' => 'string|min:1|max:1000|nullable',
            'expert_id' => 'nullable',
            'review_date' => 'date_format:j/n/Y|nullable',
            'review_code' => 'string|min:1|nullable',
            'status' => 'string|min:1|nullable', 
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

    public function change($id, Request $request)
    {
        try {
            $expertReview = ExpertReview::findOrFail($id);
            $expertReview->status = $request->status;
            $expertReview->save();
            return redirect()->back()
                ->with('status', 'Expert review was successfully activated.');
        } catch (\Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
