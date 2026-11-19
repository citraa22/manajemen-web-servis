# Praktikum 8 — Rehearsal ETS

## 1. Tujuan
Memastikan project Product API siap digunakan dan dapat didemonstrasikan pada ETS.

## 2. Pemeriksaan Environment
- Laravel Framework 13.34.0 berhasil dijalankan.
- Composer platform requirements berhasil diperiksa.
- Database berhasil terhubung.
- Seluruh migration berstatus `Ran`.
- Server lokal berhasil dijalankan.

## 3. Pengujian CRUD API

| Pengujian | Method | Hasil |
|---|---|---|
| Create Product | POST | 201 Created |
| List Products | GET | 200 OK |
| Detail Product | GET | 200 OK |
| Update Product | PATCH | 200 OK |
| Delete Product | DELETE | 204 No Content |
| Product Not Found | GET | 404 Not Found |
| Validation Error | POST | 422 Unprocessable Content |

## 4. Pengujian Otomatis
Perintah:

```bash
php artisan test
```

Hasil:
- 12 tests passed.
- 38 assertions passed.

## 5. Pemahaman Implementasi
- Route: mendefinisikan endpoint API.
- Controller: mengatur proses CRUD.
- Form Request: melakukan validasi input.
- Model: berinteraksi dengan database.
- Resource: mengatur format JSON response.

## 6. Kesimpulan
Project Product API telah melalui rehearsal ETS. Pengujian CRUD, validasi, penanganan data tidak ditemukan, serta pengujian otomatis telah dilakukan. Project siap digunakan untuk persiapan demonstrasi ETS.