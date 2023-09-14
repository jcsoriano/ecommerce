<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ProductResource::collection(
            Product::paginate($request->perPage)
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // store the file
        $path = $request->file('photo')->store('products');

        // create the Product
        return new ProductResource(
            Product::create([
                'photo' => $path,
                ...$request->only('name', 'content', 'price', 'stock_level'),
            ])
        );
    }

    /**
     * Upload a file for a Product
     */
    public function uploadFile(Request $request, Product $product)
    {
        $product->update([
            'photo' => $request->file('photo')->store(),
        ]);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // get updated data
        $data = $request->only('name', 'content', 'price', 'stock_level');

        // handle file upload if photo was re-uploaded
        // keep old file if photo wasn't re-uploaded
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store();
        }

        // update product fields
        $product->update($data);

        // respond
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}
