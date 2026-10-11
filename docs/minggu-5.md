# Praktikum Minggu 5 — Implementasi CRUD REST API Product

## 1. Tujuan Praktikum

Praktikum ini bertujuan untuk mengimplementasikan operasi CRUD (Create, Read, Update, Delete) pada REST API menggunakan Laravel. Praktikum juga mempelajari validasi data, penggunaan API Resource, serta pengujian endpoint API.

## 2. Teknologi yang Digunakan

- Laravel 13
- PHP
- REST API
- Form Request
- Eloquent API Resource
- Pest untuk pengujian otomatis
- Postman untuk pengujian endpoint API

## 3. Daftar Endpoint API

| Method | Endpoint | Fungsi | Status Sukses |
|---|---|---|---|
| GET | `/api/products` | Menampilkan seluruh produk | 200 OK |
| GET | `/api/products/{product}` | Menampilkan detail produk | 200 OK |
| POST | `/api/products` | Menambahkan produk baru | 201 Created |
| PATCH | `/api/products/{product}` | Memperbarui sebagian data produk | 200 OK |
| DELETE | `/api/products/{product}` | Menghapus produk | 204 No Content |

Data produk memiliki atribut `name`, `description`, `price`, `stock`, dan `category`.

## 4. Implementasi Validasi

Validasi dilakukan menggunakan Form Request agar data yang diterima API sesuai dengan aturan yang ditentukan.

- `StoreProductRequest` digunakan untuk memvalidasi data ketika menambahkan produk.
- `UpdateProductRequest` digunakan untuk memvalidasi data ketika memperbarui produk. Validasi mendukung pembaruan sebagian atribut melalui aturan `sometimes`.

Jika data yang dikirim tidak valid, API mengembalikan status `422 Unprocessable Content`.

## 5. Implementasi API Resource

`ProductResource` digunakan untuk menyeragamkan format data produk dalam respons JSON. Atribut yang ditampilkan meliputi `id`, `name`, `description`, `price`, `stock`, `category`, dan `created_at`.

## 6. Implementasi Controller

`ProductController` menangani operasi CRUD pada data produk:

- `index()` untuk menampilkan seluruh produk.
- `show()` untuk menampilkan detail produk berdasarkan ID.
- `store()` untuk menambahkan produk baru.
- `update()` untuk memperbarui data produk.
- `destroy()` untuk menghapus produk.

Jika produk tidak ditemukan, API mengembalikan status `404 Not Found` dengan pesan `Product not found`.

## 7. Contoh Request JSON

### Menambahkan produk

```json
{
  "name": "Buket Bunga Mini",
  "description": "Buket bunga untuk hadiah",
  "price": 75000,
  "stock": 10,
  "category": "Buket"
}
```

### Memperbarui produk

Contoh berikut memperbarui harga produk melalui endpoint `PATCH /api/products/{product}`.

```json
{
  "price": 80000
}
```

## 8. Pengujian API

Pengujian otomatis dilakukan menggunakan Pest melalui file `tests/Feature/ProductApiTest.php`.

Skenario pengujian mencakup:
- Menampilkan daftar dan detail produk.
- Menambahkan produk dengan data valid.
- Menolak data yang tidak valid.
- Memperbarui data produk.
- Menghapus produk.
- Menangani produk yang tidak ditemukan.

Status respons yang diperiksa meliputi `200`, `201`, `204`, `404`, dan `422`.

## 9. Kesimpulan

Praktikum Minggu 5 mengimplementasikan operasi CRUD pada REST API Product menggunakan Laravel. Form Request digunakan untuk validasi, API Resource untuk menyeragamkan respons JSON, dan Pest untuk menguji fungsionalitas endpoint.