<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth:api');
    }

    /**
     * Show Products
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return DB::table('products')
            ->select([
                'products.id as id',
                'products.title as title',
                'providers.name as provider',
                'products.provider_id as provider_id',
                'storages.address as storage',
                'products.storage_id as storage_id',
            ])
            ->leftJoin('providers', 'products.provider_id', '=', DB::raw('providers.id::TEXT'))
            ->leftJoin('storages', 'products.storage_id', '=', DB::raw('storages.id::TEXT'))
            ->paginate(10);
    }



    /**
     * Show Product by id
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Store Product
     *
     * @param Request $request
     * @return ProductResource|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'price' => 'required|numeric',
            'provider_id' => 'required|string',
            'storage_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::create([
            'title' => $request->title,
            'price' => $request->price,
            'provider_id' => $request->provider_id,
            'storage_id' => $request->storage_id,
        ]);

        return new ProductResource($product);
    }

    /**
     * Update Product by id
     *
     * @param Request $request
     * @param Product $product
     * @return ProductResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'price' => 'required|numeric',
            'provider_id' => 'required|string',
            'storage_id' => 'required|string',
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $product->update([
            'title' => $request->title,
            'price' => $request->price,
            'provider_id' => $request->provider_id,
            'storage_id' => $request->storage_id,
        ]);

        return new ProductResource($product);
    }

    /**
     * Destroy Product by id
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
