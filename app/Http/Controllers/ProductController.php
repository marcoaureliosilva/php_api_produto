<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Product API",
 *     version="1.0.0"
 * )
 * @OA\Server(
 *     url="http://localhost:8000/api",
 *     description="API Server"
 * )
 */
class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/products",
     *     summary="Get a list of products",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $products = Product::all();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($products);
        }

        return view('products.index', compact('products'));
    }

    /**
     * @OA\Get(
     *     path="/products/create",
     *     summary="Show form to create a new product",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * @OA\Post(
     *     path="/products",
     *     summary="Create a new product",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","description","price"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($request->all());

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($product, 201);
        }

        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * @OA\Get(
     *     path="/products/{product}",
     *     summary="Get a single product",
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function show(Request $request, Product $product)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($product);
        }

        return view('products.show', compact('product'));
    }

    /**
     * @OA\Get(
     *     path="/products/{product}/edit",
     *     summary="Show form to edit an existing product",
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * @OA\Put(
     *     path="/products/{product}",
     *     summary="Update an existing product",
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","description","price"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product updated successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($product);
        }

        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * @OA\Delete(
     *     path="/products/{product}",
     *     summary="Delete a product",
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Product deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso!');
    }

   /**
     * @OA\Get(
     *     path="/products/search",
     *     summary="Search products by description",
     *     @OA\Parameter(
     *         name="q",
     *         in="query",
     *         description="Search query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        if (empty($query)) {
            return response()->json(['error' => 'Query parameter is required'], 400);
        }

        $products = Product::where('description', 'like', '%' . $query . '%')->get();

        return response()->json($products);
    }    
}
