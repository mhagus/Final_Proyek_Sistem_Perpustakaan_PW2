# 📚 Sistem Manajemen Perpustakaan Laravel

**Tugas Praktikum Pemrograman Website 2 - Pertemuan 11 (Controller & View MVC)**

Sistem ini dibangun menggunakan arsitektur MVC (Model-View-Controller) pada *framework* Laravel. Pembaruan pada versi ini mencakup pembuatan antarmuka *Dashboard* interaktif, implementasi *Blade Component* untuk *reusability* elemen UI, serta sistem pencarian dan filter tingkat lanjut berbasis kueri Eloquent.

---

## 👨‍💻 Identitas Pengembang
* **Nama:** Muhammad Agus
* **NIM:** 60324026
* **Program Studi:** Informatika
* **Mata Kuliah:** Pemrograman Website 2

---

## ✨ Fitur Utama (Capaian Penugasan)

1. **Dashboard Interaktif (Tugas 1):** Menampilkan kalkulasi statistik *real-time* perpustakaan (Total Buku, Ketersediaan Stok, Status Anggota) dan merender 5 data entri terbaru.
2. **Blade Component Modular (Tugas 2):** Menggunakan arsitektur `<x-buku-card>` untuk merender daftar buku secara terisolasi, efisien, dan konsisten di berbagai halaman.
3. **Advanced Search & Filter (Tugas 3):** Mekanisme kueri komprehensif untuk menyaring *database* berdasarkan gabungan Kata Kunci, Kategori, Tahun Terbit, dan Status Stok.

---

## 📸 Dokumentasi Antarmuka

### 1. Halaman Dashboard
Menampilkan ringkasan aktivitas dan metrik data utama perpustakaan.
![Halaman Dashboard](home2.png)

### 2. Halaman Katalog Buku & Filter
Implementasi *Blade Component* pada daftar buku terintegrasi dengan form pencarian spesifik.
![Halaman Buku](buku2.png)

### 3. Halaman Manajemen Anggota
Menampilkan daftar anggota yang telah didaftarkan melalui sistem basis data.
![Halaman Anggota](anggota2.png)