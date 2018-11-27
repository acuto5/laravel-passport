<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

/**
 * Class ProductController
 * @package App\Http\Controllers\API
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        /** @var User $user */
        $user = Auth::user();

        $discount = $user->roles()->max('discount');

        $products = Product::query()->paginate();

        /** @var Product $product */
        foreach ($products->items() as &$product) {
            $product->price = number_format(($product->price * (100 - $discount)) / 100, 2);
        }

        return response($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return Response
     */
    public function store(ProductRequest $request): Response
    {
        return response(Product::query()->create($request->toArray()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id): Response
    {
        try {
            $product = Product::query()->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => "Product by ID: $id not found."], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        /*
        $product = Product::query()->find($id);

        return response((string)$product->update([
            'title' => $request->title,
            'price' => $request->price,
        ], ['id' => $id]));*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy(int $id): Response
    {
        try {
            $product = Product::query()->findOrFail($id)->delete();
        } catch (ModelNotFoundException $exception) {
            return response(['message' => "No product by ID: $id found."], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response((string)$product);
    }
}
