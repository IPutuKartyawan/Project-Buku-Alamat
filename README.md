# Judul Project : Buku Alamat
Buku Alamat adalah aplikasi web untuk mengelola kontak pribadi dan profesional secara terstruktur. Aplikasi ini memungkinkan pengguna untuk menyimpan informasi kontak seperti nama, nomor telepon, email, alamat, dan kategori.
Selain itu, sistem ini dilengkapi dengan autentikasi pengguna, sehingga setiap orang memiliki akun sendiri untuk mengakses dan mengelola kontak pribadinya. Admin memiliki hak akses lebih luas, dapat melihat semua kontak milik seluruh pengguna, dan mengelola data dengan lebih lengkap.
* Fitur-fitur utama meliputi:
        Registrasi dan login pengguna dengan keamanan password menggunakan hashing.
        Manajemen kontak (CRUD: Create, Read, Update, Delete).
        Pencarian kontak berdasarkan nama atau nomor telepon.
        Kategori kontak (Keluarga, Teman, Kerja, Lainnya) untuk memudahkan pengelompokan.
        Ekspor data kontak ke format CSV.
Tujuan utama aplikasi ini adalah untuk menyediakan sistem pengelolaan kontak yang sederhana, aman, dan efisien, serta memudahkan pengguna dalam mengelola informasi kontak pribadi maupun profesional.

# Daftar Anggota : 
    1. RAMADHAN DWIPA PUTRA WIJAYA (230030606)
    2. I PUTU KARTYAWAN (240030194)
    
# Lingkungan pengembangan : 
Aplikasi Buku Alamat dikembangkan menggunakan lingkungan pengembangan web standar yang mendukung PHP Native dan MySQL. Lingkungan pengembangan yang digunakan meliputi:

* Bahasa Pemrograman:
PHP – untuk logika backend dan pengelolaan server-side scripting.
CSS3 – untuk struktur dan tampilan halaman web.

* Database:
MySQL / MariaDB – untuk menyimpan data pengguna, kontak, dan hak akses.
Struktur database menggunakan tabel users dan tabel contacts dengan relasi one-to-many.

* Web Server:
XAMPP / WAMP / LAMP – digunakan untuk men-deploy aplikasi secara lokal.
Mendukung modul Apache dan MySQL untuk menjalankan aplikasi secara lokal.

* Editor / IDE:
Visual Studio Code (VS Code) – untuk menulis kode PHP, HTML, dan CSS.
PHPMyAdmin – untuk memanage database secara visual.

* Browser:
Aplikasi dapat dijalankan dan diuji di browser modern seperti Google Chrome, Firefox, Edge, atau browser lainnya.

* Tools Tambahan:
Git & GitHub – untuk version control dan upload project.

# Hasil Pengembangan : 
Aplikasi Buku Alamat memiliki beberapa modul dan fitur utama yang telah diimplementasikan, antara lain: 
* 1. Autentikasi Pengguna
- Register / Registrasi: Pengguna baru dapat membuat akun dengan mengisi nama, email, dan password. Sistem akan melakukan validasi input, memastikan email unik, dan password di-hash untuk keamanan.
- Login: Pengguna dapat login menggunakan email dan password yang terdaftar. Sistem memverifikasi kredensial dengan data di database.
- Logout: Pengguna dapat keluar dari aplikasi, dan session akan dihapuskan untuk keamanan.

* 2. Dashboard
- Halaman utama setelah login yang menampilkan selamat datang dan informasi ringkas tentang aplikasi.
- Menu navigasi untuk mengakses kontak, dashboard, dan logout.

* 3. Manajemen Kontak (CRUD)
- Create / Tambah Kontak: Pengguna dapat menambahkan kontak baru dengan memasukkan nama, nomor telepon, email, alamat, dan kategori.
- Read / Daftar Kontak: - Menampilkan seluruh daftar kontak pengguna.
                        - Fitur pencarian memungkinkan mencari berdasarkan nama atau nomor telepon.
- Update / Edit Kontak: Pengguna dapat mengubah informasi kontak yang sudah ada.
- Delete / Hapus Kontak: Pengguna dapat menghapus kontak tertentu. Sistem memberikan konfirmasi sebelum penghapusan.

* 4. Ekspor Kontak ke CSV
- Pengguna dapat mengekspor daftar kontak ke file CSV, sehingga data dapat di-backup atau digunakan di aplikasi lain.
- File CSV berisi kolom: Nama, Telepon, Email, Alamat, Kategori.

5. Validasi dan Keamanan
- Semua input divalidasi untuk memastikan format yang benar (misalnya email).
- Password pengguna disimpan dalam bentuk hash menggunakan password_hash().
- Setiap pengguna hanya dapat mengakses data mereka sendiri.

# Struktur Folder
Struktur folder pada project Buku Alamat disusun secara terorganisir untuk memudahkan pengembangan, pemeliharaan, dan pemahaman alur aplikasi. Berikut penjelasan masing-masing folder dan file utama:
* 1. assets/ Berisi file statis yang digunakan oleh aplikasi :
    - style.css, Mengatur tampilan antarmuka (UI) aplikasi, termasuk navbar, form, tabel, dan tombol.
* 2. auth/ Folder ini menangani proses autentikasi pengguna:
    - login.php → Halaman dan proses login pengguna.
    - register.php → Halaman pendaftaran akun pengguna baru.
    - logout.php → Proses keluar dari aplikasi (menghapus session).
* 3. contacts/ Berisi modul utama untuk manajemen data kontak:
    - index.php → Menampilkan daftar kontak dan fitur pencarian.
    - create.php → Form dan proses menambah kontak baru.
    - edit.php → Form dan proses mengubah data kontak.
    - delete.php → Proses penghapusan kontak.
    - export_csv.php → Mengekspor data kontak ke file CSV.
* 4. config/ Folder konfigurasi sistem:
    - database.php → Konfigurasi koneksi database menggunakan PDO.
* 5. dashboard.php
    - Halaman utama setelah login yang menampilkan informasi singkat dan navigasi aplikasi.
* 6. index.php
    - Halaman awal (landing page) aplikasi sebelum pengguna login.
* 7. check_session.php
    - Digunakan untuk memeriksa apakah pengguna sudah login atau belum.
    - Jika belum login, pengguna akan diarahkan ke halaman login.

# Cara Instalasi dan Menjalankan Aplikasi 
* 1. Persiapan Perangkat
Pastikan perangkat telah terpasang:
    - Web Server (Apache).
    - PHP versi 7.4 atau lebih baru.
    - MySQL / MariaDB.
    - Browser (Chrome, Firefox, Edge, dsb.).
Jika menggunakan XAMPP, pastikan Apache dan MySQL sudah berjalan.
* 2. Menempatkan Project
    - Salin folder project buku-alamat.
    - Letakkan di direktori web server.
* 3. Membuat Database
    - Buka MySQL Workbench/phpMyAdmin.
    - Jalankan query SQL yang telah dibuat.
* 5. Konfigurasi Database
Edit file config/database.php disesuaikan dengan nama dan pasword database:
    - $host = "localhost";
    - $db   = "buku_alamat";
    - $user = "root";
    - $pass = "";
* 6. Menjalankan Aplikasi
- Buka browser dan akses: http://localhost/8000
- Klik menu Registrasi.
- Isi data:
            - Nama lengkap
            -  Email
            - Password
- Klik tombol Registrasi
- Sistem akan menyimpan akun dan data login.
        - Setelah registrasi berhasil, pengguna dapat login dan:
        - Menambah kontak.
        - Melihat kontak milik sendiri.
        - Mengedit dan menghapus kontak pribadi.

# Kesimpulan
Aplikasi Sistem Buku Alamat berbasis PHP Native berhasil dikembangkan sebagai sistem manajemen data kontak yang sederhana, terstruktur, dan aman. Aplikasi ini mampu memenuhi kebutuhan dasar pengguna dalam mengelola data kontak pribadi melalui fitur registrasi, autentikasi, serta pengelolaan data kontak (CRUD).
