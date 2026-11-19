<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $validated = $request->validate([
            'search' => ['sometimes', 'nullable', 'string', 'max:100'],
            'sort' => ['sometimes', Rule::in([
                'id',
                'name',
                'price',
                'stock',
                'category',
                'created_at',
            ])],
            'direction' => ['sometimes', Rule::in(['asc', 'desc'])],
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:50'],
        ]);

        $query = Product::query();

        if (! empty($validated['search'])) {
            $search = $validated['search'];

            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $sort = $validated['sort'] ?? 'id';
        $direction = $validated['direction'] ?? 'asc';
        $perPage = $validated['per_page'] ?? 5;

        $products = $query
            ->orderBy($sort, $direction)
            ->paginate($perPage)
            ->withQueryString();

        return ProductResource::collection($products);
    }

    public function show(int $product): JsonResponse|ProductResource
    {
        $productData = Product::find($product);

        if (! $productData) {
            return response()->json([
                'message' => 'Product not found',
                'errors' => null,
            ], 404);
        }

        return new ProductResource($productData);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateProductRequest $request, int $product): JsonResponse|ProductResource
    {
        $productData = Product::find($product);

        if (! $productData) {
            return response()->json([
                'message' => 'Product not found',
                'errors' => null,
            ], 404);
        }

        $productData->update($request->validated());

        return new ProductResource($productData);
    }

    public function destroy(int $product): JsonResponse|Response
    {
        $productData = Product::find($product);

        if (! $productData) {
            return response()->json([
                'message' => 'Product not found',
                'errors' => null,
            ], 404);
        }

        $productData->delete();

        return response()->noContent();
    }
}
