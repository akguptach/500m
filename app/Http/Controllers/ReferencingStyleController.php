<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Referencing_style;

use App\Http\Requests\ReferencingStyleRequest;
use App\Services\ReferencingStyleService;

class ReferencingStyleController extends Controller
{



    public function __construct(protected ReferencingStyleService $referencingStyleService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->referencingStyleService->getReferencingStyle());
        } else {
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
    public function store(ReferencingStyleRequest $request)
    {
        Referencing_style::create(['style' => $request->style]);
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
        $datas = Referencing_style::where('id', $id)->first();
        return view('style/edit', array('formAction' => route('referencing.update', ['referencing' => $id]), 'data' => $datas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReferencingStyleRequest $request, string $id)
    {
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
        $referencing = Referencing_style::find($id);
        if (!empty($referencing)) {
            $referencing->delete();
            return redirect('/referencing')->with('status', 'Referencing Style Deleted Successfully');
        } else {
            return redirect('/referencing');
        }
    }
}
