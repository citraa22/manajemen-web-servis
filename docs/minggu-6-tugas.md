# Tugas Praktikum Minggu 6
## Implementasi Endpoint Produk dengan Pencarian, Sorting, dan Pagination

### 1. Tujuan
Tujuan praktikum ini adalah menambahkan fitur pencarian, pengurutan data (*sorting*), pagination, dan validasi parameter pada endpoint `GET /api/products`.

### 2. Implementasi
Implementasi dilakukan pada method `index()` di file `ProductController.php`.

Fitur yang diterapkan meliputi:
1. **Pagination:** Mengatur jumlah produk yang ditampilkan pada setiap halaman menggunakan parameter `per_page` dan memilih halaman menggunakan `page`.
2. **Pencarian:** Mencari produk berdasarkan nama produk (`name`) atau kategori (`category`) menggunakan parameter `search`.
3. **Sorting:** Mengurutkan produk berdasarkan kolom yang diizinkan menggunakan parameter `sort` dan `direction`.
4. **Validasi parameter:** Memvalidasi parameter pencarian, pengurutan, dan pagination agar nilai yang dikirim sesuai ketentuan.
5. **Respons API:** Mengembalikan data produk dalam format JSON yang berisi `data`, `links`, dan `meta`.

### 3. Hasil Pengujian
Pengujian dilakukan menggunakan Postman dengan header `Accept: application/json`.

| No. | Skenario Pengujian | Parameter | Hasil |
|---|---|---|---|
| 1 | Menampilkan produk dengan pagination | `per_page=2&page=1` | Berhasil, status 200 OK |
| 2 | Mencari produk berdasarkan nama | `search=Buket` | Berhasil, produk Buket Bunga Mini ditemukan |
| 3 | Mencari produk berdasarkan kategori | `search=Buket` | Berhasil, produk kategori Buket ditemukan |
| 4 | Mengurutkan harga dari tertinggi | `sort=price&direction=desc` | Berhasil, Tas Rajut Handmade dengan harga Rp120.000 tampil pertama |
| 5 | Mengurutkan harga dari terendah | `sort=price&direction=asc` | Berhasil, Buket Bunga Mini dengan harga Rp75.000 tampil pertama |
| 6 | Memvalidasi parameter sorting yang tidak diizinkan | `sort=password` | Ditolak dengan status 422 |
| 7 | Memvalidasi jumlah produk per halaman yang melebihi batas | `per_page=100` | Ditolak dengan status 422 |
| 8 | Menggabungkan pencarian, sorting, dan pagination | `search=Buket&sort=price&direction=desc&per_page=2&page=1` | Berhasil, status 200 OK |

### 4. Kesimpulan
Berdasarkan pengujian, endpoint `GET /api/products` berhasil menerapkan fitur pencarian, sorting, pagination, dan validasi parameter. Pengujian melalui Postman menunjukkan bahwa permintaan valid mendapatkan respons 200 OK, sedangkan parameter yang tidak sesuai ketentuan mendapatkan respons 422.

### 5. Bukti Pengujian
Bukti pengujian menggunakan Postman disimpan pada file `bukti-pengujian-minggu-6.png` di folder `docs`.