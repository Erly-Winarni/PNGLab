#  🎨 PNGLab
PNGLab adalah platform kursus  yang berfokus pada pelatihan mendalam di bidang **Desain Grafis ataupun Editing**. PNGLab dirancang untuk menjembatani Guru profesional dengan Siswa yang haus akan keterampilan visual.

## Fitur Utama & Keunggulan

Kami membagi fungsionalitas berdasarkan empat peran pengguna inti yaitu

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

### Prasyarat

Pastikan Anda memiliki: PHP >= 8.1, Composer, Node.js/NPM, dan Database (misal: MySQL).

### 1. Kloning Repositori

```bash
git clone [URL-REPOSITORI-ANDA]
cd PNGLab
