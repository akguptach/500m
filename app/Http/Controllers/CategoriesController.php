<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Categories;
use App\Services\CategoriesService;
use App\Http\Requests\CategoriesRequest;

class CategoriesController extends Controller
{


    public function __construct(protected CategoriesService $categoriesService)
    {
    }


    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->categoriesService->getCategories());
        } else {
            return view('categories/view');
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories/create');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesRequest $request)
    {
        $this->categoriesService->save($request);
        return redirect('/categories')->with('status', 'Category Created Successfully');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datas = Categories::find($id);
        return view('categories/edit', array('formAction' => route('categories.update', ['categories' => $id]), 'data' => $datas));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriesRequest $request, string $id)
    {
        $this->categoriesService->save($request, $id);
        return redirect('/categories')->with('status', 'Category Updated Successfully');
    }
}
