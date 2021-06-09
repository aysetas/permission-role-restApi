<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Category::paginate(5),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        if(! auth('api')->user()->isAbleTo('category-create')){
            abort(403, 'yetkiniz yok');
        }
        $category=Category::create($request->validated());
        return response([
            'data' => $category,
            'message' => 'category created'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(! auth('api')->user()->isAbleTo('category-read')){
            abort(403, 'yetkiniz yok');
        }
        try {
            $category = Category::findOrFail($id);
            return response([
                'data' => $category,
                'message' => 'Category Found'
            ],200);
        }
        catch(ModelNotFoundException $exception) {
            return response(['message' => 'Category Not Found!'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        if(! auth('api')->user()->isAbleTo('category-update')){
            abort(403, 'yetkiniz yok');
        }
        $category=Category::find($id);
        $category->update($request->validated());
        return response([
            'data' => $category,
            'message' => 'category updated'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(! auth('api')->user()->isAbleTo('category-delete')){
            abort(403, 'yetkiniz yok');
        }
        Category::destroy($id);
        return response([
            "message" =>"category deleted"
        ],200);
    }
}
