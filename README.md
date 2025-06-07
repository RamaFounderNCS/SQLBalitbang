
# 🌐 SQLBalitbang – Omega Intelligence Core (Versi 9)

SQLBalitbang adalah platform **SQL Intelligence Tools** generasi baru yang dirancang untuk para peneliti, analis data, dan pengembang database. Proyek ini lahir dari visi _Balitbang Cyber Sovereignty_ untuk menghadirkan **alat eksplorasi database yang ringan, modern, powerful, dan responsif**, didukung dengan fitur-fitur AI, grafik interaktif, dan kemampuan ekspor data tingkat lanjut.

## 🚀 Fitur Utama (Versi 9 – Omega Intelligence Core)

✅ **AI SQL Generator** (GPT Copilot – mock)  
✅ **Multi-Database Connection**  
✅ **Query Analyzer & Security Detector**  
✅ **Ekspor CSV & Excel (.xlsx)**  
✅ **Visualisasi Data Otomatis (Chart.js)**  
✅ **Simulasi Sinkronisasi Database Cloud**  
✅ **Manajemen Session Role: Admin, Editor, Viewer**  
✅ **Proteksi CSRF Token & Logging Aktivitas Query**  
✅ **UI/UX Elite Internasional (TailwindCSS)**  
✅ **Mobile-Friendly dan Responsive untuk semua perangkat**

> ✨ Dirancang untuk skenario riset, audit data, dan eksplorasi multi-database dalam satu file PHP sederhana namun elegan.

---

## 🌟 Tujuan Proyek

1. Memberikan alat bantu eksplorasi database berbasis web untuk analisis data.
2. Mendorong riset dan efisiensi dalam penggunaan SQL oleh institusi riset dan universitas.
3. Menyediakan platform belajar SQL dengan bantuan AI dan keamanan dasar.

---

## 🖥️ Teknologi Digunakan

- 💻 PHP 7.4+
- 🎨 TailwindCSS CDN (UI/UX Modern)
- 📊 Chart.js (Visualisasi Dinamis)
- 📁 PhpSpreadsheet (Ekspor Excel)
- 🔐 PDO + CSRF Protection
- 🤖 AI SQL Copilot (Mocked Generator)

---

## 📦 Instalasi & Setup

### 🔧 1. Clone Repository
```bash
git clone https://github.com/RamaFounderNCS/SQLBalitbang.git
cd SQLBalitbang
```

### 🤠 2. (Opsional) Install PhpSpreadsheet untuk Excel Export
> Jika server mendukung Composer:
```bash
composer require phpoffice/phpspreadsheet
```

Jika tidak, gunakan versi dengan library embedded (hubungi maintainer untuk file PHP satuan).

### 🌐 3. Jalankan di Web Server

Salin ke direktori server Apache/Nginx Anda (misal: `htdocs/` atau `www/`):

```bash
http://localhost/SQLBalitbang/index.php
```

---

## 🔐 Hak Akses Role

| Role    | Deskripsi                          | Akses                           |
|---------|------------------------------------|---------------------------------|
| Admin   | Kontrol penuh                      | Jalankan SQL, ekspor, generate  |
| Editor  | Jalankan dan generate AI SQL       | Tidak bisa ekspor log           |
| Viewer  | Hanya lihat, tidak bisa kirim SQL  | Baca saja                       |

---

## 📂 Struktur File

```text
SQLBalitbang/
│
├── index.php           ← Full-feature PHP webtools
├── logs_query_advanced.txt ← Log eksekusi SQL
├── README.md           ← Dokumentasi proyek
└── vendor/             ← (Opsional) composer dependencies
```

---

## 📈 Tampilan UI

- **Dark Theme Modern** – menggunakan TailwindCSS
- **Support Mobile/Desktop** – desain adaptif
- **Tabel Interaktif + Chart Dinamis** – Chart.js bawaan
- **Export Tools** – Tombol CSV & Excel

---

## 💡 Contoh Penggunaan AI Copilot

Input:
> `jumlah pengguna`  
Hasil:
```sql
SELECT COUNT(*) FROM users;
```

Input:
> `pendapatan total`
Hasil:
```sql
SELECT SUM(amount) FROM transactions;
```

---

## 🌍 Kompatibilitas

- ✅ Apache, Nginx
- ✅ XAMPP, Laragon, Localhost
- ✅ Semua OS (Windows, Linux, macOS)
- ✅ Semua perangkat (HP, Tablet, Desktop)

---

## 📜 Lisensi

Proyek ini berada di bawah lisensi **MIT** – bebas digunakan untuk keperluan pribadi, riset, maupun pengembangan lanjutan.

---

## 🤠 Credits & Kontribusi

Dikembangkan oleh: [RamaFounderNCS](https://github.com/RamaFounderNCS)  
Silakan buka PR (Pull Request) atau kirim saran fitur baru melalui **[Issues](https://github.com/RamaFounderNCS/SQLBalitbang/issues)**

---

## 🚀 Visi Masa Depan

> ✭ Versi mendatang akan mendukung:
- 🔗 Integrasi PostgreSQL & SQLite
- 🌐 Full Cloud Sync Realtime
- 🤖 AI Natural Language → SQL Generator (Real)
- 📡 Dashboard Panel & History Query
- 🔒 Autentikasi OAuth2 dan Enkripsi Database Profile

---

> 🛡️ SQLBalitbang: Tools Riset Elite Internasional dari Nusantara untuk Dunia 🌍
