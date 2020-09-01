<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return $this->showAll($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required', 
            'name' => 'required', 
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $category = Category::create($data);

        return response()->json(['data' => $category], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $this->showOne($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'user_id' => 'required', 
            'name' => 'required', 
        ];

        $this->validate($request, $rules);

        if($request->has('user_id')) {
            $category->user_id = $request->user_id;
        }
        if($request->has('name')) {
            $category->name = $request->name;
        }
        if($request->has('icon')) {
            $category->icon = $request->icon;
        }
        if($category->isClean()) {
            return response()->json(['error' => 'You need to specify different values to update.', 'code' => 422], 422);
        }

        $category->save();

        return response()->json(['data' => $category], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne($category);
    }
}
