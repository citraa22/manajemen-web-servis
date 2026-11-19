# Tugas 8 — ETS API Contract dan CRUD

## 1. Tujuan

Menerapkan API contract dan operasi CRUD pada Product API menggunakan Laravel serta memastikan setiap endpoint menghasilkan success response dan error response sesuai ketentuan.

## 2. Perubahan

Perubahan yang diterapkan pada project:

- Mengembangkan Product API dari read-only menjadi CRUD.
- Menambahkan endpoint Create, Update, dan Delete Product.
- Menggunakan Form Request untuk validasi input.
- Menggunakan ProductResource untuk menjaga konsistensi format JSON response.
- Menangani kondisi Product tidak ditemukan dengan response 404.
- Melakukan pengujian endpoint menggunakan Postman.
- Memperbarui dokumentasi dan Postman collection.

## 3. Endpoint atau Contract

| Method | Endpoint | Fungsi | Status |
|---|---|---|---|
| GET | `/api/products` | Menampilkan daftar Product | 200 |
| POST | `/api/products` | Menambahkan Product | 201 |
| GET | `/api/products/{product}` | Menampilkan detail Product | 200 |
| PATCH | `/api/products/{product}` | Memperbarui Product | 200 |
| DELETE | `/api/products/{product}` | Menghapus Product | 204 |

### Validasi Input

Field yang digunakan:

- `name`: string, maksimal 255 karakter.
- `description`: string.
- `price`: angka, minimal 0.
- `stock`: integer, minimal 0.
- `category`: string, maksimal 255 karakter.

Pada operasi update, field boleh tidak dikirim. Namun, jika dikirim, nilainya harus memenuhi aturan validasi.

### Keputusan Implementasi

- Controller mengatur alur CRUD.
- Form Request memvalidasi input.
- Model Product mengelola data pada database.
- ProductResource mengatur format JSON response.
- Pagination digunakan pada endpoint daftar Product.

Keputusan tersebut menjaga implementasi tetap sesuai dengan API contract dan menghasilkan response yang konsisten.

## 4. Bukti Pengujian

Pengujian dilakukan menggunakan Postman dan Laravel Feature Test.

| Pengujian | Hasil |
|---|---|
| Create Product | 201 Created |
| List Product | 200 OK |
| Detail Product | 200 OK |
| Update Product | 200 OK |
| Delete Product | 204 No Content |
| Feature Test | 12 tests passed, 38 assertions |

Bukti pengujian dilengkapi dengan hasil response Postman dan pengujian otomatis.

## 5. Error Case

### Product Tidak Ditemukan

Request:

`GET /api/products/999999`

Status: `404 Not Found`

Response:

```json
{
  "message": "Product not found",
  "errors": null
}
```

### Validasi Input Gagal

Request:

`POST /api/products`

Body:

```json
{}
```

Status: `422 Unprocessable Content`

API mengembalikan pesan kesalahan dan daftar field yang wajib diisi pada bagian `errors`.

## 6. Kesimpulan

Product API telah dikembangkan dengan operasi CRUD, validasi input, serta penanganan success dan error response. Pengujian dilakukan melalui Postman dan Laravel Feature Test. Implementasi menggunakan Controller, Form Request, Model, dan Resource agar alur API terstruktur dan response sesuai contract.

## 7. Referensi

1. Materi 8 — ETS: API Contract dan CRUD.
2. Hasil Praktikum 8 — Rehearsal ETS.
3. API contract Product pada dokumentasi project.
4. Dokumentasi resmi Laravel: https://laravel.com/docs

## 8. Deklarasi Penggunaan AI

AI digunakan sebagai alat bantu untuk memahami instruksi tugas, memeriksa struktur implementasi, membantu penyusunan dokumentasi, serta menjelaskan proses pengujian API.