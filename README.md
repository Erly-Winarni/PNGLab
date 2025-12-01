#  🎨 PNGLab
PNGLab adalah platform kursus  yang berfokus pada pelatihan mendalam di bidang **Desain Grafis ataupun Editing**. PNGLab dirancang untuk menjembatani Guru profesional dengan Siswa yang haus akan keterampilan visual.

### Peran Pengguna & Akses

| Peran | Fokus Peran | Akses |
| :--- | :--- | :--- |
| **Admin** | **Master Kontrol:** Mengawasi dan mengelola seluruh ekosistem platform. | User, Course, Category, Content Management |
| **Teacher** | **Mentor Kreatif:** Menyusun materi, mengunggah materi, dan memantau perkembangan Siswanya. | Course & Content Management (Miliknya) |
| **Student** | **Siswa Kreatif:** Mengikuti kursus , melacak progres, dan menandai pencapaian belajar. | Course Catalog, Lesson Pages, Progress Tracker |
| **Public User** | **Pengunjung:** Melihat katalog dan detail kursus. | Homepage, Course Catalog (View Only) |

### Modul Manajemen Konten (CMS)

* **User Management (Admin)**: Kontrol penuh atas seluruh pengguna. Dilengkapi fitur **Pagination** dan opsi **Aktif/Non-aktif** untuk menjaga ekosistem yang sehat.
* **Course Management (Admin & Teacher)**: Mengelola siklus kursus dari pembuatan hingga penonaktifan, dengan fokus pada **Desain & Editing** (nama kursus, deskripsi, tanggal, dan Teacher).
* **Content Management (Teacher)**: Area bagi Teacher untuk mengunggah materi ajar visual (teks, file(pdf), link youtube) dan memastikan **progress belajar** berurutan.
* **Category Management (Admin)**: Memastikan konsistensi data dengan mengelola kategori-kategori khusus Desain (misalnya: *Desain Vektor*, *Prototyping UI/UX*, *Color Grading*).

## Tata Letak & Alur Pengguna

* **Dashboard**: Menyajikan **5 Kursus Desain Paling Populer** dan sistem pencarian/filter berdasarkan kategori yang tersedia.
* **Kelas**: Menampilkan koleksi lengkap kursus dengan tombol aksi cepat (**"Hubungi Guru"**) dan indikator **Progress Belajar** yang jelas.
* **Materi**: Menampilkan materi-materi terkait dengan kelas dan dilengkapi fitur penting: **"Tandai Selesai"** dan tombol **"Lanjutkan"** agar pembelajaran terstruktur.
* **Profile**: Dashboard progres personal. Siswa melihat progres kursus desainnya, Guru memantau kinerja kelasnya dan Admin memantau Statistik User dan Kelas.

## Panduan Instalasi (Development)

Proyek dibangun di atas **Laravel** dan **Breeze**.

## Requirement Sistem (XAMPP)
- XAMPP terbaru (PHP ≥ 8.1, MySQL, Apache)
- Composer
- Node.js & NPM / Yarn
- Laravel 10

## Panduan Lengkap Instalasi PNGLab di XAMPP
### 1. Kloning Repositori
#### 1. Buka terminal (CMD / PowerShell / Git Bash)
#### 2. Masuk ke folder `htdocs` XAMPP:
```bash
cd C:\xampp\htdocs
```
#### 3. Clone repository PNGLab:
```bash
git clone https://github.com/Erly-Winarni/PNGLab.git
cd PNGLab
```
## 2. Install Dependency
#### 1. Install PHP dependencies:
```bash
composer install
```
#### 2. Install Node.js dependencies:
```bash
npm install
```
#### 3. Build asset frontend:
```bash
npm run dev
```
### 3. Buat Database
#### 1.Jalankan migration untuk membuat database dan tabelnya:
```bash
php artisan migrate
```
#### 2.Jalankan seeder untuk data awal:
```bash
php artisan db:seed
```
### 4. Nyalakan Server Lokal
#### 1.Start Apache dan MySQL di XAMPP Control Panel
#### 2.Jalankan Laravel server:
```bash
php artisan serve
```
#### 3.Buka browser dan akses web:
```bash
http://127.0.0.1:8000
```
### 5. Login Awal
#### 1.Gunakan akun yang dibuat melalui seeder atau register di halaman login
#### 2.Admin dapat langsung login untuk mengelola pengguna, course/kelas, kategori dan konten

