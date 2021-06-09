<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */

    public function index()
    {
        return response(Product::with(['categories'=>function($q){
            $q->select('name');
        }])->paginate(10), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        if(! auth('api')->user()->isAbleTo('product-create')){
            abort(403, 'yetkiniz yok');
        }
        $product = Product::create($request->validated());
        $category=$request->input('categories');
        $product->categories()->sync($category);

        return response([
            'data' => $product,
            'message' => 'product created'
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
        if(! auth('api')->user()->isAbleTo('product-read')){
            abort(403, 'yetkiniz yok');
        }
        try {

            $product = Product::with('categories')->findOrFail($id);
            return response([
                'data' => $product,
                'message' => 'Product Found'
            ],200);
        }
        catch(ModelNotFoundException $exception) {
            return response(['message' => 'Product Not Found!'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        if(! auth('api')->user()->isAbleTo('product-update')){
            abort(403, 'yetkiniz yok');
        }
        $product=Product::find($id);
        $product->update($request->validated());

        $category=$request->input('categories');
        $product->categories()->sync($category);

        return response([
            'data' => $product,
            'message' => 'product updated'
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
        if(! auth('api')->user()->isAbleTo('product-delete')){
            abort(403, 'yetkiniz yok');
        }
        Product::destroy($id);
        return response([
            "message" =>"product deleted"
        ],200);
    }
}
