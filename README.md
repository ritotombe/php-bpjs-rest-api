## PHP BPJS REST API

PHP BPJS REST API mirip seperti [Postman](https://www.postman.com/), namun aplikasi ini secara khusus digunakan untuk menangani proses Request API BPJS VClaim & PCare menjadi lebih mudah, karena di dalamnya terdapat proses pembuatan Signature dan Authorization secara otomatis.

## Kebutuhan
- Web Service (Apache / Nginx)
- PHP

## Fitur
- Proses pembuatan Signature dan Authorization otomatis.
- Dapat menyimpan & menghapus `ConsID`, `Secret`, `Username` dan `Password` di local storage web browser.
- Terdapat toggle untuk melihat dan menyembunyikan `ConsID`, `Secret`, `Username` dan `Password`
- Tersedia tombol untuk akses dokumentasi `VClaim` dan `PCare`.

## Cara Pakai
- Buka web browser.
- Masukan url aplikasi sesuai instalasi, misal `http://localhost/php-bpjs-rest-api`.
- Pilih jenis API sesuai kebutuhan.
- Jika menggunakan VClaim :
    - Silahkan isi `ConsID` dan `Secret`
    - `Endpoint` dan `Parameter` mengacu pada dokumentasi `VClaim`.
- Jika menggunakan PCare :
    - Silahkan isi `ConsID`, `Secret`, `Username` dan `Password`.
    - `Endpoint` dan `Parameter` mengacu pada dokumentasi `PCare`.
- Pilih `SEND` untuk mendapatkan data response.

## Sumber Daya
- https://new-api.bpjs-kesehatan.go.id/pcare-rest-v3.0
- https://dvlp.bpjs-kesehatan.go.id:8888/trust-mark

## Lisensi
- Aplikasi ini open source dengan lisensi [MIT](LICENSE).