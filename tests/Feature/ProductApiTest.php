<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    Product::create([
        'name' => 'Buket Bunga Mini',
        'description' => 'Buket bunga handmade dengan desain sederhana.',
        'price' => 75000,
        'stock' => 10,
        'category' => 'Buket',
    ]);
});

test('can list all products with 200 OK', function () {
    $response = $this->getJson('/api/products');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'stock',
                    'category',
                    'created_at',
                ],
            ],
        ]);
});

test('can get detail product with 200 OK', function () {
    $product = Product::first();

    $response = $this->getJson("/api/products/{$product->id}");

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
            ],
        ]);
});

test('returns 404 when product is not found on show', function () {
    $response = $this->getJson('/api/products/999999');

    $response->assertStatus(404)
        ->assertExactJson([
            'message' => 'Product not found',
            'errors' => null,
        ]);
});

test('can create product with 201 Created and validation', function () {
    $payload = [
        'name' => 'Produk Baru Test',
        'description' => 'Deskripsi produk testing minggu 5',
        'price' => 50000,
        'stock' => 5,
        'category' => 'Testing',
    ];

    $response = $this->postJson('/api/products', $payload);

    $response->assertStatus(201)
        ->assertJson([
            'data' => [
                'name' => 'Produk Baru Test',
                'description' => 'Deskripsi produk testing minggu 5',
                'category' => 'Testing',
            ],
        ]);
});

test('returns 422 when store product validation fails', function () {
    $response = $this->postJson('/api/products', []);

    $response->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => [
                'name',
                'description',
                'price',
                'stock',
                'category',
            ],
        ]);
});

test('can update product with 200 OK and partial data', function () {
    $product = Product::first();

    $response = $this->patchJson("/api/products/{$product->id}", [
        'price' => 85000,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $product->id,
                'price' => 85000,
            ],
        ]);
});

test('returns 404 when product to update is not found', function () {
    $response = $this->patchJson('/api/products/999999', [
        'name' => 'Update Not Found',
    ]);

    $response->assertStatus(404)
        ->assertExactJson([
            'message' => 'Product not found',
            'errors' => null,
        ]);
});

test('returns 422 when update product validation fails', function () {
    $product = Product::first();

    $response = $this->patchJson("/api/products/{$product->id}", [
        'price' => -100,
    ]);

    $response->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => [
                'price',
            ],
        ]);
});

test('can delete product with 204 No Content without body', function () {
    $product = Product::create([
        'name' => 'Temporary Product For Delete',
        'description' => 'Will be deleted',
        'price' => 10000,
        'stock' => 1,
        'category' => 'Temporary',
    ]);

    $response = $this->deleteJson("/api/products/{$product->id}");

    $response->assertStatus(204);
    expect($response->getContent())->toBeEmpty();
});

test('returns 404 when product to delete is not found', function () {
    $response = $this->deleteJson('/api/products/999999');

    $response->assertStatus(404)
        ->assertExactJson([
            'message' => 'Product not found',
            'errors' => null,
        ]);
});
