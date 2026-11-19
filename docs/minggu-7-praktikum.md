# Praktikum 7 — Feature Test dan Postman Collection

## 1. Tujuan Praktikum

Praktikum ini bertujuan untuk menguji API menggunakan HTTP Feature Test, memeriksa success response dan error response, merapikan Postman Collection, serta membuat dokumentasi endpoint.

## 2. Persiapan

Project Laravel yang digunakan:

`C:\Users\citra\project-herd-semester-5`

Pemeriksaan endpoint dilakukan menggunakan perintah:

```bash
php artisan route:list --path=api
```

Hasil pemeriksaan menunjukkan terdapat lima endpoint Product API:

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | /api/products | Menampilkan semua produk |
| POST | /api/products | Menambahkan produk |
| GET | /api/products/{product} | Menampilkan detail produk |
| PATCH | /api/products/{product} | Mengubah produk |
| DELETE | /api/products/{product} | Menghapus produk |

## 3. Pengujian Menggunakan Postman

Pengujian dilakukan menggunakan Postman pada tiga skenario.

### A. Success Response

- Method: GET
- Endpoint: `/api/products`
- Status code: 200 OK
- Hasil: Request berhasil menampilkan daftar produk dalam format JSON.

Contoh data yang diterima:

- ID: 1
- Nama: Buket Bunga Mini
- Harga: 75000
- Stok: 10
- Kategori: Buket

### B. Validation Error

- Method: POST
- Endpoint: `/api/products`
- Request body: `{}` 
- Status code: 422 Unprocessable Entity
- Hasil: Laravel menolak request karena field wajib belum diisi.

Field yang harus diisi adalah name, description, price, stock, dan category.

### C. Not Found

- Method: GET
- Endpoint: `/api/products/999999`
- Status code: 404 Not Found
- Hasil: API mengembalikan pesan bahwa produk tidak ditemukan.

Contoh response:

```json
{
    "message": "Product not found",
    "errors": null
}
```

Ketiga request disimpan dalam Postman Collection `minggu 7 - praktikum`.

## 4. Pengujian HTTP Feature Test

Pengujian otomatis dilakukan menggunakan perintah:

```bash
php artisan test tests/Feature/ProductApiTest.php
```

Hasil pengujian:

| Keterangan | Hasil |
|---|---:|
| Total test | 10 |
| Test berhasil | 10 |
| Test gagal | 0 |
| Assertions | 36 |
| Durasi | 773 ms |

Pengujian mencakup proses menampilkan, menambahkan, mengubah, dan menghapus produk, termasuk validasi serta kondisi data tidak ditemukan.

## 5. Hasil Pengujian Keseluruhan

Pengujian seluruh project dilakukan menggunakan:

```bash
php artisan test
```

Hasil yang diperoleh:

| Keterangan | Hasil |
|---|---:|
| Total test | 12 |
| Test berhasil | 12 |
| Test gagal | 0 |
| Assertions | 38 |
| Durasi | 5.317 ms |

Seluruh pengujian yang tersedia berhasil dijalankan.

## 6. Kesimpulan

Berdasarkan praktikum yang telah dilakukan, Product API berhasil diuji menggunakan Postman dan HTTP Feature Test. Pengujian menunjukkan bahwa API dapat memberikan respons sesuai kondisi request, baik ketika berhasil, mengalami kesalahan validasi, maupun ketika produk tidak ditemukan.

Postman Collection digunakan untuk menyimpan request agar dapat diuji kembali, sedangkan Feature Test membantu memastikan perilaku API tetap berjalan sesuai harapan.

