# SQLBalitbang

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](#license)  
[![Version](https://img.shields.io/badge/version-1.0.0-brightgreen)](#)

## 🔥 Deskripsi Singkat  
**SQLBalitbang** adalah tool profesional berbasis web untuk **SQL Injection testing** dan **database research**. Didesain dengan **UI/UX modern** dan **standar internasional elite**, memberikan pengalaman yang intuitif namun powerful:  
- Sistem login aman  
- Antarmuka pengguna minimalis namun elegan  
- Fitur lengkap untuk eksploitasi, pemindaian, dan pengelolaan database  

## ⭐ Fitur Utama  

| Fitur                | Deskripsi |
|----------------------|-----------|
| 🔐 **Login Sistem**         | Otentikasi berbasis username/password (`admin` / `adminncs`) dengan keamanan tinggi |
| 🛡️ **Password Masking**     | Input password otomatis tersembunyi (masked) saat mengetik |
| 🔍 **Detection Engine**     | Deteksi otomatis parameter rentan SQL Injection |
| ⚡ **Exploit Module**       | Eksekusi payload SQL Injection dengan berbagai teknik (boolean, time-based, union, dll.) |
| 🧼 **Sanitization Checker** | Validasi filter input dan respons |
| 🧠 **Optimization Cache**   | Cache pintar untuk mempercepat permintaan berulang |
| 📋 **History & Log**        | Riwayat semua percobaan, termasuk payload dan hasil |
| 🧬 **Output Formatter**     | Hasil respons disajikan dalam format JSON/CSV/Plain Text |
| 🎛️ **Dashboard Statistik** | Grafik jumlah percobaan, tipe serangan, serta tingkat keberhasilan |

## 🚀 Instalasi dan Persyaratan

1. **Clone repository**  
   ```bash
   git clone https://github.com/RamaFounderNCS/SQLBalitbang.git
   cd SQLBalitbang
   ```
2. **Setup environment (direkomendasikan virtualenv)**  
   ```bash
   python3 -m venv venv
   source venv/bin/activate
   pip install -r requirements.txt
   ```
3. **Konfigurasi database**  
   - Buat file `.env` berbasis file `.env.example`  
   - Isikan variabel: `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASS`, `DB_NAME`
4. **Migrasi & Seed database**  
   ```bash
   flask db upgrade
   flask seed data
   ```
5. **Jalankan aplikasi**  
   ```bash
   flask run --host=0.0.0.0 --port=5000
   ```

## 🛠️ Cara Menggunakan

1. Buka browser ke `http://localhost:5000`
2. Login dengan username `admin` dan password `adminncs`
3. Navigasi ke menu *Scanner* untuk memeriksa halaman/filter rentan
4. Pilih metode Injection dan sesuaikan payload
5. Jalankan serangan, simpan atau tampilkan hasilnya
6. Akses *Dashboard* untuk analisis statistik percobaan Anda

## 🧩 Kontribusi

Kami sangat menghargai kontribusi – apakah itu fitur, correction, atau issue.  
1. Fork repository  
2. Buat branch fitur (`feature/namafitur`)  
3. Commit perubahan Anda (`git commit -m "Add new feature"`)  
4. Push ke origin (`git push origin feature/namafitur`)  
5. Buat Pull Request  

Harap sertakan dokumentasi dan test untuk setiap fitur baru.

## 📄 Lisensi

Distribusi tool ini berada di bawah **MIT License** — lihat file [LICENSE](LICENSE) untuk detail lengkap.

## 🧑‍💻 Maintainer

- **RamaFounderNCS** – Inisiatif utama & desain  
- **MR.M05T3R** – Architect & Review Code

## 📞 Kontak & Dukungan

Jika menemukan masalah atau perlu bantuan, silakan buka [issue baru](https://github.com/RamaFounderNCS/SQLBalitbang/issues).  
Untuk komunikasi langsung, hubungi **MR.M05T3R** via WhatsApp: [MR.M05T3R](https://wa.me/6283846681933)
