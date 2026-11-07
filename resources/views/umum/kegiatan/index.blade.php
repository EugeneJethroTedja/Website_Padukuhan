@extends('layouts.app')

@section('content')

<section class="hero-section kegiatan-hero" style="position: relative; background-image: url('{{ asset('images/warga2.jpg') }}'); background-size: cover; background-position: center; margin-top: 10px;">
    {{-- Gradasi gelap kehitaman --}}
    <div style="
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5));
        z-index: 1;">
    </div>

    <div class="container text-center text-light position-relative" style="z-index: 2; padding: 100px 20px;">
        <h1 class="animate__animated animate__fadeInDown" style="margin-top: 1cm">Agenda & Kegiatan Padukuhan</h1>
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Ikuti perkembangan dan partisipasi aktif dalam setiap event yang kami selenggarakan.</p>
        <a href="#kegiatan-list" class="btn btn-hero mt-4 animate__animated animate__zoomIn animate__delay-2s" style="background: #064a9e;">Lihat Semua Kegiatan</a>
    </div>
</section>


{{-- Tambahkan CSS khusus untuk halaman ini --}}
<style>
    /* Mengimpor Font Google */
    /* Playfair Display untuk judul yang elegan, Montserrat untuk teks modern & bersih */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;500;700&display=swap'); /* cite: 2, 3 */

    /* Variabel Warna Global (Palet Monokromatik & Netral untuk kesan mewah) */
    :root {
        --primary-accent: #2e7eff; /* cite: 3, 4 */ /* Blue-Grey Dark - "Biru susu tua" yang elegan untuk aksen utama */
        --secondary-accent: #064a9e; /* cite: 3, 5 */ /* Blue-Grey Light - Untuk aksen sekunder/hover */
        --heading-dark: #212529; /* cite: 3, 6 */ /* Very dark almost black for main headings */
        --text-dark: #343A40; /* cite: 3, 7 */ /* Dark grey for body text */
        --text-light: #DEE2E6; /* cite: 3, 8 */ /* Very light grey for text on dark backgrounds */
        --background-light: #ffffff; /* cite: 3, 9 */ /* Off-white for main background */
        --background-dark: #2C3034; /* cite: 3, 10 */ /* Deep charcoal for section backgrounds */
        --border-color: #E9ECEF; /* cite: 3, 11 */ /* Light border color for separation */
        --overlay-dark: rgba(0, 0, 0, 0.65); /* cite: 3, 12 */ /* Dark overlay for hero/section images */
        --card-bg: #FFFFFF; /* cite: 3, 13 */ /* Pure white for card backgrounds */
        --footer-bg: #1A1A1A; /* cite: 3, 14 */ /* Hampir hitam untuk footer */
        --footer-text: #CED4DA; /* cite: 3, 15 */ /* Teks terang untuk footer */
        --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.1); /* cite: 3, 16 */
        --shadow-medium: 0 10px 30px rgba(0, 0, 0, 0.15); /* cite: 3, 16 */
        --shadow-deep: 0 15px 40px rgba(0, 0, 0, 0.25); /* cite: 3, 17 */
    }

    body {
        background-color: var(--background-light); /* cite: 3 */
        font-family: 'Montserrat', sans-serif; /* cite: 3 */
        color: var(--text-dark); /* cite: 3, 18 */
        overflow-x: hidden; /* cite: 18 */
    }

    /* Jumbotron / Hero Section */
    .hero-section {
        background-size: cover; /* cite: 19 */
        background-position: center; /* cite: 19 */
        color: var(--text-light); /* cite: 19 */
        padding: 10rem 2rem; /* cite: 19 */
        text-shadow: 0px 4px 12px rgba(0, 0, 0, 0.4); /* cite: 19 */
        margin-bottom: 6rem; /* cite: 19 */
        position: relative; /* cite: 19, 20 */
        overflow: hidden; /* cite: 20 */
        display: flex; /* cite: 20 */
        align-items: center; /* cite: 20 */
        justify-content: center; /* cite: 20 */
        flex-direction: column; /* cite: 20 */
        text-align: center; /* cite: 20 */
        border-bottom: 8px solid var(--primary-accent); /* cite: 21 */
    }

    /* Menggunakan class spesifik untuk hero section kegiatan untuk override */
    .kegiatan-hero {
        height: 550px; /* cite: 22 */ /* Tinggi standar hero-section */
        padding-top: 200px; /* cite: 22 */
        margin-top: -80px; /* cite: 22 */
        background-image: url('{{ asset('images/kegiatan-banner.jpg') }}'); /* cite: 23 */ /* Ensure correct image path */
    }

    .kegiatan-hero .overlay {
        /* OVERRIDE: Membuat overlay lebih gelap untuk kontras TEKS yang maksimal */
        background: linear-gradient(to top, rgba(0, 0, 0, 0.95), rgba(0, 0, 0, 0.7)); /* cite: 24 */ /* Sangat gelap di bawah, sedikit memudar ke atas */
    }

    .kegiatan-hero h1 {
        /* OVERRIDE: Meningkatkan text-shadow agar teks lebih terbaca */
        text-shadow: 4px 4px 20px rgba(0, 0, 0, 1); /* cite: 25 */ /* Bayangan teks lebih kuat dan solid */
        font-family: 'Playfair Display', serif; /* cite: 26 */
        font-size: 5.5rem; /* cite: 26 */
        margin-bottom: 1.5rem; /* cite: 26 */
        line-height: 1.1; /* cite: 26 */
        letter-spacing: 0.15rem; /* cite: 26 */
        font-weight: 700; /* cite: 26 */
        animation: fadeInDown 1.5s ease-out forwards; /* cite: 27 */
    }

    .kegiatan-hero p.lead {
        /* OVERRIDE: Meningkatkan text-shadow agar teks lebih terbaca */
        text-shadow: 3px 3px 15px rgba(0, 0, 0, 0.8); /* cite: 28 */ /* Bayangan teks lebih kuat */
        font-family: 'Montserrat', sans-serif; /* cite: 28 */
        font-size: 2.2rem; /* cite: 28 */
        font-weight: 300; /* cite: 29 */
        margin-bottom: 2.5rem; /* cite: 29 */
        animation: fadeInUp 1.5s ease-out forwards 0.3s; /* cite: 29 */
    }

    .hero-section .btn-hero {
        padding: 1.2rem 3.5rem; /* cite: 30 */
        font-size: 1.5rem; /* cite: 30 */
        border-radius: 50px; /* cite: 30 */
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); /* cite: 30 */
        background-color: transparent; /* cite: 30 */
        border: 2px solid var(--text-light); /* cite: 30 */
        color: var(--text-light); /* cite: 31 */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2); /* cite: 31 */
        font-weight: 500; /* cite: 31 */
        letter-spacing: 0.05rem; /* cite: 31 */
        animation: fadeIn 1.5s ease-out forwards 0.6s; /* cite: 32 */
    }

    .hero-section .btn-hero:hover {
        transform: translateY(-7px) scale(1.02); /* cite: 33 */
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4); /* cite: 33 */
        background-color: var(--text-light); /* cite: 33 */
        color: var(--heading-dark); /* cite: 33 */
        border-color: var(--text-light); /* cite: 34 */
    }

    /* Section Global Styles */
    .blog-section {
        background-color: var(--background-dark); /* cite: 35 */
        padding: 6rem 0; /* cite: 35 */
        margin-bottom: 5rem; /* cite: 35 */
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.2); /* cite: 35 */
        position: relative; /* cite: 35 */
        overflow: hidden; /* cite: 36 */
    }

    .section-header {
        text-align: center; /* cite: 37 */
        margin-bottom: 4rem; /* cite: 37 */
        position: relative; /* cite: 37 */
        z-index: 1; /* cite: 37 */
    }

    .section-header h2 {
        font-family: 'Playfair Display', serif; /* cite: 38 */
        font-size: 3.8rem; /* cite: 38 */
        color: var(--text-light); /* cite: 38 */
        font-weight: 700; /* cite: 38 */
        padding-bottom: 20px; /* cite: 38 */
        position: relative; /* cite: 38 */
        display: inline-block; /* cite: 39 */
    }

    .section-header h2::after {
        content: ''; /* cite: 39 */
        position: absolute; /* cite: 39 */
        left: 50%; /* cite: 40 */
        transform: translateX(-50%); /* cite: 40 */
        bottom: 0; /* cite: 40 */
        width: 100px; /* cite: 40 */
        height: 4px; /* cite: 40 */
        background-color: var(--primary-accent); /* cite: 40 */
        border-radius: 2px; /* cite: 41 */
    }

    .section-header .section-description {
        font-family: 'Montserrat', sans-serif; /* cite: 41 */
        font-size: 1.2rem; /* cite: 42 */
        color: var(--text-light); /* cite: 42 */
        max-width: 700px; /* cite: 42 */
        margin: 1.5rem auto 0 auto; /* cite: 42 */
        line-height: 1.6; /* cite: 42 */
        opacity: 0.9; /* cite: 43 */
    }

    /* Card Styling */
    .card-blog {
        border: none; /* cite: 44 */
        border-radius: 12px; /* cite: 44 */
        overflow: hidden; /* cite: 44 */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* cite: 44 */
        transition: transform 0.4s ease-out, box-shadow 0.4s ease-out; /* cite: 45 */
        background-color: var(--card-bg); /* cite: 45 */
        height: 100%; /* cite: 45 */
        display: flex; /* cite: 45 */
        flex-direction: column; /* cite: 45 */
    }

    .card-blog:hover {
        transform: translateY(-15px); /* cite: 46 */
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.2); /* cite: 46 */
    }

    .card-blog .card-img-top {
        height: 280px; /* cite: 47 */
        object-fit: cover; /* cite: 47 */
        width: 100%; /* cite: 47 */
        border-top-left-radius: 12px; /* cite: 47 */
        border-top-right-radius: 12px; /* cite: 47 */
    }

    .card-blog .card-body {
        padding: 2rem; /* cite: 48 */
        flex-grow: 1; /* cite: 48 */
        display: flex; /* cite: 48 */
        flex-direction: column; /* cite: 48 */
        justify-content: space-between; /* cite: 48 */
    }

    .card-blog .card-title {
        font-family: 'Playfair Display', serif; /* cite: 49 */
        font-size: 1.9rem; /* cite: 49 */
        color: var(--heading-dark); /* cite: 49 */
        margin-bottom: 0.8rem; /* cite: 49 */
        line-height: 1.3; /* cite: 49 */
        font-weight: 700; /* cite: 50 */
    }

    .card-blog .card-text {
        font-family: 'Montserrat', sans-serif; /* cite: 50 */
        font-size: 1.05rem; /* cite: 51 */
        color: var(--text-dark); /* cite: 51 */
        line-height: 1.7; /* cite: 51 */
        margin-bottom: 1.5rem; /* cite: 51 */
        flex-grow: 1; /* cite: 51 */
    }

    .card-blog .card-text.date {
        font-size: 0.95rem; /* cite: 52 */
        color: var(--primary-accent); /* cite: 52 */
        font-weight: 500; /* cite: 52 */
        margin-bottom: 0.8rem; /* cite: 52 */
        display: flex; /* cite: 52 */
        align-items: center; /* cite: 53 */
    }

    .card-blog .btn-read-more {
        background-color: var(--primary-accent); /* cite: 53 */
        color: var(--text-light); /* cite: 53 */
        border: none; /* cite: 54 */
        padding: 0.8rem 1.8rem; /* cite: 54 */
        border-radius: 5px; /* cite: 54 */
        transition: background-color 0.3s ease, transform 0.3s ease; /* cite: 54 */
        align-self: flex-start; /* cite: 54 */
        font-weight: 500; /* cite: 54 */
        text-transform: uppercase; /* cite: 54 */
        letter-spacing: 0.05rem; /* cite: 55 */
    }

    .card-blog .btn-read-more:hover {
        background-color: var(--secondary-accent); /* cite: 55 */
        transform: translateY(-3px); /* cite: 56 */
    }

    /* Pagination */
    .pagination {
        margin-top: 4rem; /* cite: 57 */
    }
    .pagination .page-item .page-link {
        background-color: var(--background-dark); /* cite: 57 */
        color: var(--text-light); /* cite: 58 */
        border-color: var(--primary-accent); /* cite: 58 */
        transition: all 0.3s ease; /* cite: 58 */
        padding: 0.75rem 1.25rem; /* cite: 58 */
        border-radius: 8px; /* cite: 58 */
        margin: 0 5px; /* cite: 59 */
    }

    .pagination .page-item .page-link:hover {
        background-color: var(--primary-accent); /* cite: 59 */
        color: var(--text-light); /* cite: 60 */
        border-color: var(--primary-accent); /* cite: 60 */
        transform: translateY(-2px); /* cite: 60 */
        box-shadow: var(--shadow-light); /* cite: 60 */
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-accent); /* cite: 61 */
        color: var(--text-light); /* cite: 61 */
        border-color: var(--primary-accent); /* cite: 61 */
        box-shadow: var(--shadow-medium); /* cite: 61 */
    }
    .pagination .page-item.disabled .page-link {
        background-color: var(--background-dark); /* cite: 62 */
        color: rgba(255, 255, 255, 0.4); /* cite: 62 */
        border-color: var(--background-dark); /* cite: 62 */
        cursor: not-allowed; /* cite: 62 */
    }

    /* Animasi */
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } } /* cite: 63 */
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-80px); } to { opacity: 1; transform: translateY(0); } } /* cite: 64 */
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(80px); } to { opacity: 1; transform: translateY(0); } } /* cite: 65 */
    @keyframes zoomIn { from { opacity: 0; transform: scale(0.7); } to { opacity: 1; transform: scale(1); } } /* cite: 66 */

    .animate__animated {
        animation-duration: 1s; /* cite: 67 */
        animation-fill-mode: both; /* cite: 67 */
    }
    .animate__delay-1s { animation-delay: 1s; } /* cite: 67 */
    .animate__delay-2s { animation-delay: 2s; } /* cite: 68 */

    /* Penyesuaian responsif untuk hero section kegiatan */
    @media (max-width: 991.98px) {
        .kegiatan-hero {
            height: 450px; /* cite: 69 */
            padding-top: 70px; /* cite: 69 */
        }
        .kegiatan-hero h1 {
            font-size: 3.8rem; /* cite: 70 */
            margin-bottom: 1rem; /* cite: 70 */
        }
        .kegiatan-hero p.lead {
            font-size: 1.3rem; /* cite: 71 */
            margin-bottom: 2rem; /* cite: 71 */
        }
        .section-header h2 {
            font-size: 3rem; /* cite: 72 */
        }
        .section-header .section-description {
            font-size: 1.1rem; /* cite: 73 */
        }
        .card-blog .card-img-top {
            height: 240px; /* cite: 74 */
        }
        .card-blog .card-title {
            font-size: 1.7rem; /* cite: 75 */
        }
        .card-blog .card-text {
            font-size: 0.95rem; /* cite: 76 */
        }
    }

    @media (max-width: 767.98px) {
        .kegiatan-hero {
            height: 380px; /* cite: 77 */
            padding-top: 60px; /* cite: 77 */
        }
        .kegiatan-hero h1 {
            font-size: 2.8rem; /* cite: 78 */
        }
        .kegiatan-hero p.lead {
            font-size: 1.1rem; /* cite: 79 */
            margin-bottom: 1.8rem; /* cite: 79 */
        }
        .section-header h2 {
            font-size: 2.5rem; /* cite: 80 */
        }
        .section-header .section-description {
            font-size: 1rem; /* cite: 81 */
        }
    }

    @media (max-width: 575.98px) {
        .kegiatan-hero {
            height: 300px; /* cite: 82 */
        }
        .kegiatan-hero h1 {
            font-size: 2.2rem; /* cite: 83 */
        }
        .kegiatan-hero p.lead {
            font-size: 0.95rem; /* cite: 84 */
        }
        .hero-section .btn-hero {
            font-size: 1rem; /* cite: 85 */
            padding: 0.8rem 2rem; /* cite: 85 */
        }
    }

    /* New: Content Sections for detailed information */
    .content-detail-section {
        background-color: var(--background-light); /* cite: 86 */
        padding: 5rem 0; /* cite: 86 */
        color: var(--text-dark); /* cite: 86 */
        border-bottom: 1px solid var(--border-color); /* cite: 86 */
        margin-bottom: 5rem; /* cite: 86 */
        box-shadow: var(--shadow-light); /* cite: 87 */
    }

    .content-detail-section.bg-dark-section {
        background-color: var(--background-dark); /* cite: 87 */
        color: var(--text-light); /* cite: 87 */
        box-shadow: var(--shadow-medium); /* cite: 88 */
    }

    .content-detail-section h3 {
        font-family: 'Playfair Display', serif; /* cite: 88 */
        font-size: 3.2rem; /* cite: 89 */
        color: var(--heading-dark); /* cite: 89 */
        margin-bottom: 2.5rem; /* cite: 89 */
        text-align: center; /* cite: 89 */
        position: relative; /* cite: 89 */
        padding-bottom: 15px; /* cite: 90 */
    }

    .content-detail-section.bg-dark-section h3 {
        color: var(--text-light); /* cite: 91 */
    }

    .content-detail-section h3::after {
        content: ''; /* cite: 91 */
        position: absolute; /* cite: 91 */
        left: 50%; /* cite: 92 */
        transform: translateX(-50%); /* cite: 92 */
        bottom: 0; /* cite: 92 */
        width: 80px; /* cite: 92 */
        height: 3px; /* cite: 92 */
        background-color: var(--primary-accent); /* cite: 92 */
        border-radius: 2px; /* cite: 93 */
    }

    .content-detail-section p {
        font-family: 'Montserrat', sans-serif; /* cite: 93 */
        font-size: 1.1rem; /* cite: 94 */
        line-height: 1.8; /* cite: 94 */
        margin-bottom: 1.5rem; /* cite: 94 */
        color: var(--text-dark); /* cite: 94 */
    }

    .content-detail-section.bg-dark-section p {
        color: var(--text-light); /* cite: 95 */
    }

    .content-detail-section ul {
        list-style: none; /* cite: 95 */
        padding-left: 0; /* cite: 96 */
    }

    .content-detail-section ul li {
        margin-bottom: 1rem; /* cite: 96 */
        font-size: 1.05rem; /* cite: 97 */
        color: var(--text-dark); /* cite: 97 */
    }

    .content-detail-section.bg-dark-section ul li {
        color: var(--text-light); /* cite: 98 */
    }

    .content-detail-section ul li i {
        color: var(--primary-accent); /* cite: 98 */
        margin-right: 10px; /* cite: 99 */
    }

    /* Modifikasi untuk horizontal scroll */
    .image-grid {
        display: flex; /* Mengubah menjadi flexbox */
        overflow-x: auto; /* Mengizinkan scroll horizontal */
        -webkit-overflow-scrolling: touch; /* Meningkatkan pengalaman scrolling di iOS */
        gap: 2rem; /* cite: 100 */
        margin-top: 3rem; /* cite: 100 */
        padding-bottom: 1rem; /* Memberi sedikit padding di bawah untuk scrollbar jika ada */
    }

    /* Sembunyikan scrollbar untuk browser WebKit (Chrome, Safari) */
    .image-grid::-webkit-scrollbar {
        display: none;
    }

    /* Sembunyikan scrollbar untuk IE, Edge, dan Firefox */
    .image-grid {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }

    .image-grid img {
        flex-shrink: 0; /* Mencegah gambar menyusut */
        width: 300px; /* Lebar tetap untuk setiap gambar */
        height: 250px; /* cite: 101 */
        object-fit: cover; /* cite: 101 */
        border-radius: 10px; /* cite: 101 */
        box-shadow: var(--shadow-medium); /* cite: 101 */
        transition: transform 0.3s ease-in-out; /* cite: 102 */
    }

    .image-grid img:hover {
        transform: scale(1.03); /* cite: 103 */
    }

    .highlight-box {
        background-color: var(--secondary-accent); /* cite: 103 */
        color: var(--text-light); /* cite: 103 */
        padding: 2.5rem; /* cite: 104 */
        border-radius: 10px; /* cite: 104 */
        margin-top: 3rem; /* cite: 104 */
        box-shadow: var(--shadow-medium); /* cite: 104 */
    }

    .highlight-box h4 {
        font-family: 'Playfair Display', serif; /* cite: 105 */
        font-size: 2.5rem; /* cite: 105 */
        margin-bottom: 1.5rem; /* cite: 105 */
        color: var(--text-light); /* cite: 105 */
    }

    .highlight-box p {
        font-size: 1.15rem; /* cite: 106 */
        line-height: 1.7; /* cite: 106 */
        color: var(--text-light); /* cite: 106 */
    }

    /* Responsive adjustments for new sections */
    @media (max-width: 991.98px) {
        .content-detail-section {
            padding: 4rem 0; /* cite: 107 */
        }
        .content-detail-section h3 {
            font-size: 2.8rem; /* cite: 108 */
        }
        .content-detail-section p {
            font-size: 1rem; /* cite: 109 */
        }
        .image-grid {
            gap: 1.5rem; /* cite: 110 */
        }
        .image-grid img {
            width: 250px; /* Sesuaikan lebar gambar untuk tablet */
            height: 200px; /* cite: 111 */
        }
        .highlight-box {
            padding: 2rem; /* cite: 112 */
        }
        .highlight-box h4 {
            font-size: 2rem; /* cite: 113 */
        }
        .highlight-box p {
            font-size: 1.05rem; /* cite: 114 */
        }
    }

    @media (max-width: 767.98px) {
        .content-detail-section {
            padding: 3rem 0; /* cite: 115 */
        }
        .content-detail-section h3 {
            font-size: 2.2rem; /* cite: 116 */
            margin-bottom: 2rem; /* cite: 116 */
        }
        .content-detail-section p {
            font-size: 0.95rem; /* cite: 117 */
        }
        .image-grid {
            gap: 1rem; /* cite: 118 */
        }
        .image-grid img {
            width: 200px; /* Sesuaikan lebar gambar untuk ponsel */
            height: 180px; /* cite: 119 */
        }
        .highlight-box {
            padding: 1.5rem; /* cite: 120 */
        }
        .highlight-box h4 {
            font-size: 1.8rem; /* cite: 121 */
        }
        .highlight-box p {
            font-size: 1rem; /* cite: 122 */
        }
    }
</style>


{{-- Bagian Daftar Kegiatan --}}
<section class="blog-section" id="kegiatan-list" style="background: #064a9e">
    <div class="container">
        <div class="section-header">
            <h2 class="text-light">Agenda Kegiatan</h2>
            <p class="section-description text-light">Berbagai acara dan inisiatif yang memperkaya kehidupan masyarakat Padukuhan Kerjo.</p>
        </div>

        <div class="image-grid">
            @forelse ($kegiatans as $kegiatan)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card card-blog h-100 animate__animated animate__fadeInUp">
                    @if($kegiatan->gambar)
                        <img src="{{ asset('storage/kegiatan/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->nama_kegiatan }}" class="card-img-top">
                    @else
                        <img src="{{ asset('images/placeholder-card.jpg') }}" alt="Gambar Tidak Tersedia" class="card-img-top">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $kegiatan->nama_kegiatan }}</h5>
                        <p class="card-text date"><i class="far fa-calendar-alt me-2"></i> {{ $kegiatan->tanggal->format('d F Y') }}</p>
                        <p class="card-text">{{ Str::limit(strip_tags($kegiatan->deskripsi), 120) }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('kegiatan.show.umum', $kegiatan->id) }}" class="btn btn-read-more">Lihat Detail <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 text-center text-light py-5 empty-state">
                <img src="{{ asset('images/empty-state-icon.png') }}" alt="No Data" style="width: 150px; margin-bottom: 30px; opacity: 0.7;">
                <p class="h4">Belum ada kegiatan yang terdaftar.</p>
                <p class="lead">Mohon maaf, saat ini belum ada agenda kegiatan yang akan datang.</p>
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {!! $kegiatans->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</section>

{{-- New Section: Mengapa Partisipasi Penting? --}}
<section class="content-detail-section">
    <div class="container">
        <h3 class="text-center">Mengapa Partisipasi Anda Penting?</h3>
        <p class="text-center">Setiap kegiatan di padukuhan kami adalah wujud kebersamaan dan semangat gotong royong. Partisipasi Anda tidak hanya menghidupkan acara, tetapi juga berkontribusi langsung pada kemajuan dan kesejahteraan masyarakat Padukuhan Kerjo.</p>

        <div class="row align-items-center mt-5">
            <div class="col-md-6 mb-4">
                <img src="{{ asset('images/kerja1.jpg') }}" alt="Kegiatan Komunitas" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-md-6 mb-4">
                <h4>Membangun Komunitas yang Kuat</h4>
                <p>Kegiatan padukuhan kami menjadi wadah interaksi antarwarga, mempererat tali silaturahmi, dan menumbuhkan rasa memiliki terhadap padukuhan. Dari festival budaya hingga kerja bakti lingkungan, setiap momen adalah kesempatan untuk terhubung.</p>
                <ul>
                    <li><i class="fas fa-handshake"></i> Memperkuat ikatan sosial dan solidaritas.</li>
                    <li><i class="fas fa-users-cog"></i> Meningkatkan partisipasi aktif dalam pembangunan padukuhan.</li>
                    <li><i class="fas fa-heart"></i> Menciptakan lingkungan yang ramah dan suportif.</li>
                </ul>
            </div>
        </div>

        <div class="row align-items-center mt-5">
            <div class="col-md-6 order-md-2 mb-4">
                <img src="{{ asset('images/belajar2.jpg') }}" alt="Anak-anak Belajar" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-md-6 order-md-1 mb-4">
                <h4>Edukasi dan Pengembangan Diri</h4>
                <p>Kami menyelenggarakan berbagai lokakarya dan pelatihan yang bertujuan untuk meningkatkan keterampilan dan pengetahuan masyarakat, dari kelas memasak tradisional hingga pelatihan digital.</p>
                <ul>
                    <li><i class="fas fa-book-reader"></i> Lokakarya untuk peningkatan keterampilan.</li>
                    <li><i class="fas fa-lightbulb"></i> Berbagi pengetahuan antar generasi.</li>
                    <li><i class="fas fa-seedling"></i> Mendorong inovasi dan kreativitas warga.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- New Section: Pelatihan Ergonomi dalam Pekerjaan --}}
<section class="content-detail-section mt-5">
    <div class="container">
        <h3 class="text-center">Pelatihan Ergonomi Postur Tubuh dalam Bekerja</h3>
        <p class="text-center mb-5">
            Kegiatan pelatihan ini bertujuan untuk meningkatkan kesadaran petani dan warga terhadap pentingnya menjaga postur tubuh yang benar saat bekerja, demi menghindari risiko gangguan otot dan sendi.
        </p>

        <div class="row align-items-center">
            <div class="col-md-6 mb-4">
                <a href="{{ asset('images/fian1.jpg') }}" target="_blank">
                    <img src="{{ asset('images/fian1.jpg') }}" alt="Pelatihan Ergonomi"
                        class="img-fluid w-100 rounded shadow-lg"
                        style="object-fit: contain; width: 100%;">
                </a>
            </div>
            <div class="col-md-6 mb-4">
                <h4>Risiko dan Solusi Postur dalam beraktivitas</h4>
                <p>
                    Banyak aktivitas pertanian seperti mencangkul, menanam, atau memanen dilakukan dengan postur yang kurang ideal. Hal ini dapat menyebabkan <strong>Musculoskeletal Disorders (MSDs)</strong>, yakni gangguan pada otot, tulang, dan sendi. Gejala seperti nyeri, kesemutan, dan kelelahan berlebih kerap dialami petani.
                </p>
                <p>
                    Pelatihan ini memperkenalkan prinsip <strong>ergonomi</strong> seperti penggunaan posisi netral tubuh, pengurangan gerakan berulang, serta pentingnya istirahat berkala. Metode penilaian risiko seperti <em>Rapid Entire Body Assessment (REBA)</em> juga dikenalkan untuk membantu menilai postur kerja sehari-hari.
                </p>
                <ul>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Mengurangi risiko cedera otot dan sendi.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Meningkatkan kenyamanan dan produktivitas kerja.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Memberikan pemahaman tentang postur kerja yang ideal.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- New Section: Galeri Kegiatan Desa --}}
<section class="content-detail-section bg-dark-section" style="background: #064a9e">
    <div class="container">
        <h3 class="text-center">Momen-Momen Indah Kegiatan Padukuhan</h3>
        <p class="text-center text-light-50 mb-5">Lihatlah kebahagiaan dan semangat kebersamaan yang terekam dalam galeri foto kegiatan kami. Setiap gambar menceritakan kisah tentang padukuhan yang hidup dan bersemangat.</p>
        <div class="image-grid">
            <img src="{{ asset('images/belajar1.jpg') }}" alt="Kegiatan Desa 1">
            <img src="{{ asset('images/belajar3.jpg') }}" alt="Kegiatan Desa 2">
            <img src="{{ asset('images/bio1.jpg') }}" alt="Kegiatan Desa 3">
            <img src="{{ asset('images/kerja1.jpg') }}" alt="Kegiatan Desa 4">
            <img src="{{ asset('images/warga1.jpg') }}" alt="Kegiatan Desa 5">
            <img src="{{ asset('images/singkong1.jpg') }}" alt="Kegiatan Desa 6">
            <img src="{{ asset('images/warga6.jpg') }}" alt="Kegiatan Desa 7">
            <img src="{{ asset('images/warga9.jpg') }}" alt="Kegiatan Desa 8">
        </div>
        <div class="highlight-box text-center mt-5" style="background: #326ac4">
            <h4>Bagikan Cerita Anda!</h4>
            <p>Pernahkah Anda berpartisipasi dalam kegiatan kami? Bagikan pengalaman Anda dan inspirasi orang lain untuk bergabung!</p>
            <p>Ayo Bergabung Bersama Kami Ikuti Kegiatan-kegiatan Seru Yang Ada Di Padukuhan Kerjo</p>
        </div>
    </div>
</section>

{{-- New Section: Kegiatan Mendatang & Cara Berpartisipasi --}}
<section class="content-detail-section py-5 bg-light-section">
    <div class="container">
        <h3 class="text-center mb-3">Kegiatan Mendatang & Cara Berpartisipasi</h3>
        <p class="text-center mb-4">Padukuhan Kerjo senantiasa berupaya mengadakan kegiatan positif yang menguatkan kebersamaan dan semangat gotong royong warga. Anda dapat menjadi bagian dari perjalanan ini.</p>

        <div class="row mt-4">
            <div class="col-md-6 mb-4 animate__animated animate__fadeInLeft">
                <h4>Apa yang Bisa Anda Nantikan?</h4>
                <p>Beragam kegiatan akan diadakan secara berkala sesuai kebutuhan dan inisiatif warga. Beberapa kegiatan yang biasanya diadakan meliputi:</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-leaf text-success me-2"></i> Bersih-bersih lingkungan bersama warga dan relawan.</li>
                    <li class="mb-2"><i class="fas fa-hands-helping text-success me-2"></i> Program berbagi dengan warga yang membutuhkan.</li>
                    <li class="mb-2"><i class="fas fa-seedling text-success me-2"></i> Penanaman pohon dan penghijauan area publik.</li>
                    <li class="mb-2"><i class="fas fa-users text-success me-2"></i> Pelatihan keterampilan dan pemberdayaan UMKM lokal.</li>
                </ul>
                <p>Semua kegiatan diselenggarakan dengan semangat kebersamaan dan terbuka untuk siapa saja yang ingin berkontribusi.</p>
            </div>
            <div class="col-md-6 mb-4 animate__animated animate__fadeInRight">
                <h4>Bagaimana Anda Bisa Terlibat?</h4>
                <p>Ada banyak cara Anda dapat terlibat dalam kegiatan di Padukuhan Kerjo, baik secara langsung maupun tidak langsung:</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-hands text-primary me-2"></i> <strong>Bergabung Sebagai Relawan:</strong> Bantu secara langsung dalam kegiatan lapangan dan koordinasi acara.</li>
                    <li class="mb-2"><i class="fas fa-donate text-primary me-2"></i> <strong>Dukungan Donasi:</strong> Membantu pengadaan alat dan kebutuhan kegiatan secara sukarela.</li>
                    <li class="mb-2"><i class="fas fa-share-alt text-primary me-2"></i> <strong>Sebarkan Informasi:</strong> Bagikan kegiatan Padukuhan Kerjo kepada teman dan keluarga untuk meningkatkan partisipasi.</li>
                    <li class="mb-2"><i class="fas fa-lightbulb text-primary me-2"></i> <strong>Berikan Ide dan Saran:</strong> Masukan Anda akan membantu kami menyelenggarakan kegiatan yang lebih baik dan bermanfaat.</li>
                </ul>
                <p>Dengan berpartisipasi, Anda telah ikut serta dalam membangun Padukuhan Kerjo yang lebih maju dan harmonis.</p>
            </div>
        </div>
    </div>
</section>


@endsection