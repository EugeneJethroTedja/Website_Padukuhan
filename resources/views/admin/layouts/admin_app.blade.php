<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Padukuhan Kerjo</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Variabel Warna Global (Palet Mewah & Modern) */
        :root {
            --primary-bg-dark: #ffffff; /* Deep Blue-Grey - Background Utama Gelap */
            --secondary-bg-light: #064a9e; /* Darker Blue-Grey - Latar Belakang Sekunder/Sidebar/Card */
            --accent-primary: #3498DB; /* Bright Sky Blue - Aksen Utama (Bisa diubah ke Gold/Copper untuk lebih mewah) */
            --accent-secondary: #2980B9; /* Darker Sky Blue - Aksen Sekunder/Hover */
            --text-light: #ECF0F1; /* Light Grey - Teks Terang */
            --text-muted: #BDC3C7; /* Muted Grey - Teks Redup */
            --border-color: rgba(255, 255, 255, 0.15); /* Garis Pembatas Halus */
            --shadow-dark: 0 10px 30px rgba(0, 0, 0, 0.4); /* Bayangan Dalam */
            --shadow-light: 0 4px 15px rgba(0, 0, 0, 0.2); /* Bayangan Ringan */
            --success-color: #2ECC71; /* Warna Sukses */
            --danger-color: #E74C3C; /* Warna Bahaya/Error */

            /* Warna Khusus Dashboard Cards */
            --card-wisata: #3498DB; /* Blue */
            --card-kegiatan: #27AE60; /* Green */
            --card-umkm: #F1C40F; /* Yellow */
            --card-kesenian: #E67E22; /* Orange */
            --card-profil: #9B59B6; /* Purple */
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--primary-bg-dark); /* Background utama yang gelap dan mewah */
            color: var(--text-light); /* Teks terang default */
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Mencegah scroll horizontal */
        }

        /* Navbar Styling */
        .navbar-admin {
            background-color: var(--secondary-bg-light) !important; /* Warna navbar sesuai secondary-bg */
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-dark); /* Bayangan kuat untuk kesan premium */
            padding: 15px 20px;
            z-index: 1050; /* Pastikan navbar di atas semua elemen lain */
            width: calc(100% - 280px); /* Lebar navbar dikurangi lebar sidebar */
            margin-left: 280px; /* Geser navbar agar tidak menutupi sidebar */
            transition: all 0.3s ease; /* Transisi untuk lebar dan margin */

            /* Penyesuaian responsif untuk navbar saat sidebar disembunyikan */
            /* Perlu JavaScript untuk toggle class 'sidebar-hidden' pada body/navbar-admin */
        }
        @media (max-width: 991.98px) {
            .navbar-admin {
                width: 100%; /* Full width saat sidebar tersembunyi */
                margin-left: 0;
            }
        }

        .navbar-admin .navbar-brand {
            font-family: 'Playfair Display', serif;
            color: var(--accent-primary) !important;
            font-weight: 700;
            font-size: 1.8rem;
            transition: color 0.3s ease;
            display: flex; /* Menggunakan flexbox untuk mengatur ikon dan teks */
            align-items: center; /* Pusatkan secara vertikal */
        }
        .navbar-admin .navbar-brand:hover {
            color: var(--accent-secondary) !important;
        }
        .navbar-admin .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            padding: 10px 15px;
            transition: all 0.3s ease;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }
        .navbar-admin .nav-link:hover {
            color: var(--text-light) !important;
            background-color: rgba(255, 255, 255, 0.08); /* Sedikit highlight transparan */
        }
        .navbar-toggler {
            border-color: var(--border-color) !important;
        }
        .navbar-toggler-icon {
            filter: invert(1); /* Untuk ikon burger putih */
        }
        .navbar-admin .nav-link i {
            margin-right: 8px; /* Spasi ikon di navbar */
        }

        /* Sidebar Styling */
        .sidebar {
            height: 100vh;
            width: 280px; /* Lebar sidebar */
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--secondary-bg-light); /* Background gelap sidebar */
            padding-top: 20px; /* Padding atas untuk konten sidebar, tidak lagi 80px */
            border-right: 1px solid var(--border-color);
            box-shadow: var(--shadow-dark); /* Bayangan kuat untuk sidebar */
            transition: all 0.3s ease; /* Transisi untuk sidebar */
            z-index: 1040; /* Di bawah navbar utama */
            display: flex;
            flex-direction: column;
        }

        /* Adjustments for fixed navbar height on content within sidebar */
        .sidebar .navbar-brand-sidebar {
            font-family: 'Playfair Display', serif;
            color: var(--accent-primary);
            font-weight: 700;
            font-size: 2rem; /* Ukuran brand di sidebar */
            padding: 20px;
            text-align: center;
            display: block;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        /* Styling untuk gambar logo di navbar dan sidebar */
        .navbar-logo, .sidebar-logo {
            width: 40px; /* Ukuran default untuk logo navbar */
            height: 40px;
            border-radius: 50%; /* Membuat gambar menjadi bulat */
            object-fit: cover; /* Memastikan gambar mengisi area tanpa terdistorsi */
            margin-right: 10px; /* Jarak antara logo dan teks */
            border: 2px solid var(--accent-primary); /* Border di sekitar logo */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); /* Sedikit bayangan */
        }

        .sidebar-logo {
            width: 80px; /* Ukuran lebih besar untuk logo sidebar */
            height: 80px;
            margin-bottom: 15px; /* Jarak bawah logo sidebar */
            border-color: var(--accent-secondary); /* Warna border berbeda untuk sidebar */
        }


        .sidebar .h5 {
            font-family: 'Playfair Display', serif;
            color: var(--accent-primary);
            font-size: 1.5rem;
            padding: 0 20px;
            margin-bottom: 30px !important;
            text-align: center;
            display: none; /* Sembunyikan jika ada brand di atas */
        }
        .sidebar .nav-link {
            color: var(--text-muted);
            padding: 15px 25px; /* Padding lebih besar */
            margin-bottom: 8px;
            border-radius: 10px; /* Sudut lebih membulat */
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-weight: 500;
        }
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Hover transparan */
            color: var(--text-light);
            transform: translateX(5px); /* Efek slide saat hover */
        }
        .sidebar .nav-link.active {
            background-color: var(--accent-primary) !important; /* Background aktif */
            color: var(--text-light) !important;
            font-weight: 600; /* Font lebih tebal saat aktif */
            box-shadow: var(--shadow-light); /* Bayangan ringan saat aktif */
        }
        .sidebar .nav-link i {
            margin-right: 15px; /* Spasi antara ikon dan teks */
            font-size: 1.2rem; /* Ukuran ikon sidebar */
            color: var(--accent-secondary); /* Warna ikon yang berbeda */
        }
        .sidebar .nav-link.active i {
            color: var(--text-light); /* Ikon putih saat aktif */
        }

        /* Content Area Styling */
        .content {
            margin-left: 280px; /* Menyesuaikan dengan lebar sidebar baru */
            padding: 30px;
            padding-top: 100px; /* Cukup padding untuk navbar fixed */
            background-color: var(--primary-bg-dark); /* Background konten utama */
            min-height: 100vh;
            color: var(--text-light);
            transition: all 0.3s ease;
        }
        @media (max-width: 991.98px) {
            .sidebar {
                left: -280px; /* Sembunyikan sidebar di luar layar */
                top: 0; /* Pastikan dari atas */
                padding-top: 20px; /* Padding tetap sama */
                z-index: 1040;
            }
            .sidebar.show {
                left: 0; /* Tampilkan sidebar saat ada class 'show' */
            }
            .content {
                margin-left: 0; /* Konten full width saat sidebar tersembunyi */
                padding-top: 80px; /* Cukup padding untuk navbar fixed */
            }
            .navbar-admin {
                width: 100%; /* Navbar full width */
                margin-left: 0;
            }
            /* Override Bootstrap's collapse.js for sidebar toggle */
            .navbar-toggler[data-bs-target="#sidebarCollapse"] {
                display: block; /* Tampilkan tombol toggle sidebar */
            }
        }


        /* --- Bagian CSS yang perlu diperbarui di admin.layouts.admin_app.blade.php --- */

        /* ... (CSS yang sudah ada sebelumnya, mulai dari :root, body, scrollbar, navbar, sidebar) ... */

        /* Dashboard Cards Styling */
        .dashboard-card {
            background-color: var(--secondary-bg-light);
            border-radius: 1.5rem; /* Sudut lebih bulat */
            border: 1px solid rgba(255, 255, 255, 0.05); /* Border sangat halus */
            box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.4), /* Bayangan bawah-kanan */
                        -8px -8px 15px rgba(255, 255, 255, 0.05); /* Highlight atas-kiri (neumorphism) */
            padding: 25px; /* Padding lebih besar */
            margin-bottom: 30px;
            color: var(--text-light);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); /* Transisi lebih halus */
            overflow: hidden;
            position: relative;
            cursor: pointer;
            backdrop-filter: blur(5px); /* Efek blur untuk glassmorphism */
            -webkit-backdrop-filter: blur(5px); /* Safari support */
            display: flex; /* Menggunakan flexbox untuk layout di dalam card */
            flex-direction: column; /* Konten diatur secara vertikal */
            justify-content: space-between; /* Menjaga tombol di bawah */
            min-height: 350px; /* <---- PENTING: Menjamin tinggi card yang konsisten. Sesuaikan jika perlu. */
            text-align: center; /* Pusatkan semua teks di dalam kartu */
        }

        .dashboard-card::before { /* Overlay warna */
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.1; /* Opasitas lebih rendah untuk kesan mewah */
            z-index: 0;
            pointer-events: none;
            transition: opacity 0.4s ease, transform 0.4s ease;
        }
        /* Specific card colors as background-color of ::before */
        .dashboard-card.card-wisata::before { background-color: var(--card-wisata); }
        .dashboard-card.card-kegiatan::before { background-color: var(--card-kegiatan); }
        .dashboard-card.card-umkm::before { background-color: var(--card-umkm); }
        .dashboard-card.card-kesenian::before { background-color: var(--card-kesenian); }
        .dashboard-card.card-profil::before { background-color: var(--card-profil); }

        .dashboard-card:hover {
            transform: translateY(-8px); /* Angkat lebih tinggi */
            box-shadow: 12px 12px 25px rgba(0, 0, 0, 0.6), /* Bayangan lebih kuat */
                        -12px -12px 25px rgba(255, 255, 255, 0.1); /* Highlight lebih kuat */
            background-color: var(--tertiary-bg-light); /* Lebih terang saat hover */
        }
        .dashboard-card:hover::before {
             opacity: 0.2; /* Warna overlay sedikit lebih kuat saat hover */
             transform: scale(1.05); /* Efek zoom halus pada overlay */
        }

        /* New CSS for the main icon in the card */
        .card-icon-wrapper {
            margin-bottom: 20px; /* Jarak antara ikon dan judul */
            position: relative;
            z-index: 1; /* Pastikan di atas overlay */
        }
        .card-main-icon {
            font-size: 4rem; /* Ukuran ikon utama yang besar */
            color: var(--accent-secondary); /* Warna ikon */
            background-color: rgba(255, 255, 255, 0.05); /* Latar belakang lingkaran transparan */
            padding: 20px; /* Ukuran lingkaran */
            border-radius: 50%; /* Bentuk lingkaran */
            box-shadow: inset 2px 2px 5px rgba(0,0,0,0.3), inset -2px -2px 5px rgba(255,255,255,0.05); /* Efek neumorphic */
            transition: all 0.4s ease;
        }
        .dashboard-card:hover .card-main-icon {
            color: var(--text-light); /* Warna ikon berubah saat hover kartu */
            background-color: rgba(255, 255, 255, 0.15);
            transform: scale(1.05);
            box-shadow: inset 3px 3px 8px rgba(0,0,0,0.4), inset -3px -3px 8px rgba(255,255,255,0.08);
        }

        .card-body-content {
            flex-grow: 1; /* Memungkinkan konten ini mengisi ruang yang tersedia */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Pusatkan konten secara vertikal */
            align-items: center; /* Pusatkan teks secara horizontal */
            margin-bottom: 20px; /* Spasi antara konten dan tombol */
        }

        .dashboard-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; /* Judul lebih besar */
            margin-bottom: 10px;
            color: var(--text-light);
            position: relative;
            z-index: 1;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }
        .dashboard-card p {
            font-size: 0.95rem; /* Deskripsi sedikit lebih kecil */
            color: var(--text-muted);
            margin-bottom: 10px; /* Kurangi margin bawah deskripsi */
            position: relative;
            z-index: 1;
        }
        .dashboard-card .total-item,
        .dashboard-card .total-item-placeholder { /* Styling untuk total item dan placeholder */
            font-size: 3.5rem; /* Angka sangat besar */
            font-weight: 800; /* Extra bold */
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
            color: var(--accent-secondary); /* Angka dengan warna aksen */
            text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
            display: block; /* Pastikan mengambil baris baru */
            min-height: 4.5rem; /* <---- PENTING: Tinggi minimum untuk elemen ini agar konsisten */
            line-height: 1; /* Pastikan line-height tidak menambah tinggi yang tidak perlu */
            display: flex; /* Untuk mempusatkan secara vertikal jika kontennya sedikit */
            align-items: center; /* Pusatkan vertikal */
            justify-content: center; /* Pusatkan horizontal */
        }
        .dashboard-card .total-item-placeholder {
            color: var(--text-muted); /* Warna placeholder agar tidak terlalu menonjol */
            opacity: 0.5; /* Agak transparan */
        }


        .dashboard-card .btn-kelola {
            background-color: var(--accent-primary);
            border-color: var(--accent-primary);
            color: var(--text-light);
            padding: 12px 25px; /* Padding tombol lebih besar */
            border-radius: 10px; /* Sudut tombol lebih bulat */
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
            text-transform: uppercase; /* Huruf besar semua */
            letter-spacing: 0.5px;
            box-shadow: var(--shadow-light); /* Bayangan tombol */
            margin-top: auto; /* Mendorong tombol ke bagian bawah card */
            width: fit-content; /* Sesuaikan lebar tombol dengan isinya */
            align-self: center; /* Pusatkan tombol di dalam flex container */
        }

        /* Override button colors based on card type */
        /* Pastikan warna tombol ini sesuai dengan gambar yang Anda berikan */
        .dashboard-card.card-wisata .btn-kelola { background-color: #2261a4; border-color: #2261a4; } /* Contoh warna biru Bootstrap */
        .dashboard-card.card-kegiatan .btn-kelola { background-color: #2261a4; border-color: #2261a4; } /* Contoh warna hijau Bootstrap */
        .dashboard-card.card-umkm .btn-kelola { background-color: #2261a4; border-color: #2261a4; } /* Contoh warna kuning Bootstrap */
        .dashboard-card.card-kesenian .btn-kelola { background-color: #2261a4; border-color: #2261a4; } /* Contoh warna merah Bootstrap */
        .dashboard-card.card-profil .btn-kelola { background-color: #2261a4; border-color: #2261a4; } /* Contoh warna ungu Bootstrap */


        .dashboard-card .btn-kelola:hover {
            filter: brightness(1.2); /* Sedikit lebih cerah saat hover */
            transform: translateY(-3px); /* Angkat sedikit lebih tinggi */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4); /* Bayangan lebih kuat saat hover */
        }

        /* General Card (for regular content like tables/forms) */
        .card {
            background-color: var(--secondary-bg-light); /* Background kartu lebih terang dari body */
            border-radius: 1rem; /* Sudut lebih membulat */
            border: none;
            box-shadow: var(--shadow-light); /* Bayangan lebih halus */
            padding: 20px;
            margin-bottom: 30px;
            color: var(--text-light);
        }
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid var(--border-color);
            color: var(--accent-primary);
            font-size: 1.3rem;
            font-weight: 600;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .card-body {
            padding: 0; /* Atur padding body kartu */
        }

        /* Table Styling */
        .table {
            color: var(--text-light); /* Teks tabel terang */
            border-collapse: separate; /* Untuk radius sudut */
            border-spacing: 0;
        }
        .table thead th {
            background-color: var(--accent-primary); /* Header tabel dengan warna aksen */
            color: var(--text-light);
            border-bottom: none;
            padding: 15px;
            font-weight: 600;
            vertical-align: middle;
        }
        .table tbody tr {
            background-color: var(--secondary-bg-light); /* Baris genap */
            transition: background-color 0.3s ease;
        }
        .table tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05); /* Baris ganjil sedikit lebih terang */
        }
        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.15); /* Hover effect */
        }
        .table tbody td {
            padding: 12px 15px;
            border-top: 1px solid var(--border-color); /* Garis antar baris */
        }
        .table-responsive {
            border-radius: 1rem; /* Radius untuk tabel agar sesuai dengan kartu */
            overflow: hidden; /* Penting untuk menerapkan radius pada tabel */
        }

        /* Form Controls Styling */
        .form-control, .form-select {
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid var(--border-color);
            color: var(--text-light);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .form-control::placeholder {
            color: var(--text-muted);
        }
        .form-control:focus, .form-select:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: var(--accent-primary); /* Warna fokus aksen utama */
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25); /* Shadow dengan warna aksen utama */
            color: var(--text-light);
        }
        .form-label {
            color: var(--text-light);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        /* Buttons Styling */
        .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .btn-primary {
            background-color: var(--accent-primary);
            border-color: var(--accent-primary);
            color: var(--text-light);
        }
        .btn-primary:hover {
            background-color: var(--accent-secondary);
            border-color: var(--accent-secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .btn-secondary {
            background-color: var(--text-muted);
            border-color: var(--text-muted);
            color: var(--primary-bg-dark);
        }
        .btn-secondary:hover {
            background-color: #8898aa;
            border-color: #8898aa;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }


        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .sidebar {
                left: -280px; /* Sembunyikan sidebar di luar layar */
                top: 0; /* Pastikan dari atas */
                padding-top: 20px; /* Padding tetap sama */
                z-index: 1040;
            }
            .sidebar.show {
                left: 0; /* Tampilkan sidebar saat ada class 'show' */
            }
            .content {
                margin-left: 0; /* Konten full width saat sidebar tersembunyi */
                padding-top: 80px; /* Cukup padding untuk navbar fixed */
            }
            .navbar-admin {
                width: 100%; /* Navbar full width */
                margin-left: 0;
            }
            /* Menampilkan toggle sidebar di navbar utama */
            .navbar-admin .navbar-toggler[data-bs-target="#sidebarCollapse"] {
                display: block;
            }
        }
        @media (min-width: 992px) {
            /* Sembunyikan toggler untuk sidebar di desktop */
            .navbar-admin .navbar-toggler[data-bs-target="#sidebarCollapse"] {
                display: none;
            }
        }

        /* Untuk menangani tombol toggle di navbar untuk sidebar */
        /* Kita akan menambahkan tombol toggle terpisah di dalam navbar-admin */
        /* Dan kita perlu JavaScript untuk mengaturnya */

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-admin">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/logo1.png') }}" alt="Logo Desa" class="navbar-logo"> Admin Padukuhan Kerjo
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAdmin" aria-controls="navbarNavAdmin" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAdmin">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-external-link-alt me-2"></i> Web Padukuhan Kerjo Umum
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar d-flex flex-column p-3 collapse collapse-horizontal" id="sidebarCollapse">
        <a class="navbar-brand-sidebar" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/logo1.png') }}" alt="Logo Padukuhan Kerja" class="sidebar-logo"> {{-- Hapus teks "Padukuhan Kerja" jika Anda ingin hanya gambar --}}
            {{-- Atau biarkan jika ingin gambar dan teks --}}
        </a>
        <ul class="nav nav-pills flex-column mb-auto mt-3">
            <li class="nav-item"><a href="{{ route('admin.profil-desa.index') }}" class="nav-link {{ request()->routeIs('admin.profil-desa.*') ? 'active' : '' }}"><i class="fas fa-info-circle"></i> Profil Kerjo</a></li>
            <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('admin.wisata-alam.index') }}" class="nav-link {{ request()->routeIs('admin.wisata-alam.*') ? 'active' : '' }}"><i class="fas fa-mountain"></i> Wisata Alam</a></li>
            <li class="nav-item"><a href="{{ route('admin.kegiatan.index') }}" class="nav-link {{ request()->routeIs('admin.kegiatan.*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i> Kegiatan</a></li>
            <li class="nav-item"><a href="{{ route('admin.umkm-desa.index') }}" class="nav-link {{ request()->routeIs('admin.umkm-desa.*') ? 'active' : '' }}"><i class="fas fa-store"></i> UMKM Kerjo</a></li>
            <li class="nav-item"><a href="{{ route('admin.kesenian-desa.index') }}" class="nav-link {{ request()->routeIs('admin.kesenian-desa.*') ? 'active' : '' }}"><i class="fas fa-palette"></i> Kesenian Kerjo</a></li>
        </ul>
    </div>

    <div class="content">
        @yield('content') {{-- Ini adalah tempat konten spesifik halaman lain akan di-inject --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // JavaScript untuk menangani toggle sidebar di mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebarCollapse');
            const navbarToggler = document.querySelector('.navbar-admin .navbar-toggler[data-bs-target="#sidebarCollapse"]');
            const content = document.querySelector('.content');
            const navbarAdmin = document.querySelector('.navbar-admin');

            navbarToggler.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                // Optional: add a class to body/content to adjust layout when sidebar is open/closed
                // This is mostly for visual consistency, not strictly necessary for Bootstrap's collapse
                // if (sidebar.classList.contains('show')) {
                //      content.style.marginLeft = '280px';
                //      navbarAdmin.style.marginLeft = '280px';
                //      navbarAdmin.style.width = 'calc(100% - 280px)';
                // } else {
                //      content.style.marginLeft = '0';
                //      navbarAdmin.style.marginLeft = '0';
                //      navbarAdmin.style.width = '100%';
                // }
            });
             // Close sidebar when clicking outside (on overlay)
            // Bootstrap's collapse-horizontal already handles this if used correctly with a backdrop
            // For a pure CSS/JS solution without Bootstrap's offcanvas, you might need a backdrop manually
        });
    </script>
</body>
</html>