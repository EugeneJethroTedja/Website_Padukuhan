@extends('layouts.app')

@section('content')

{{-- **START OF INLINE CSS FOR UMKM DESA (DEBUGGING/TEMPORARY)** --}}
<style>
    /* PENTING:
    - CSS di sini akan menimpa CSS yang ada di layouts/app.blade.php jika selectornya sama.
    - Untuk hasil terbaik, HAPUS atau komentari properti serupa dari layouts/app.blade.php
      agar tidak ada konflik atau perilaku yang tidak terduga.
    - Setelah selesai debugging, sangat disarankan untuk memindahkan CSS ini kembali
      ke file CSS eksternal atau ke bagian <style> di layouts/app.blade.php.
    */

    /* Mengimpor Font Google */
    /* Playfair Display untuk judul yang elegan, Montserrat untuk teks modern & bersih */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;500;700&display=swap');

    /* Variabel Warna Global (Palet Monokromatik & Netral untuk kesan mewah) */
    :root {
        --primary-accent: #2e7eff; /* Blue-Grey Dark - "Biru susu tua" yang elegan untuk aksen utama */
        --secondary-accent: #064a9e; /* Blue-Grey Light - Untuk aksen sekunder/hover */
        --heading-dark: #212529; /* Very dark almost black for main headings */
        --text-dark: #343A40; /* Dark grey for body text */
        --text-light: #DEE2E6; /* Very light grey for text on dark backgrounds */
        --background-light: #F8F9FA; /* Off-white for main background */
        --background-dark: #2C3034; /* Deep charcoal for section backgrounds */
        --border-color: #E9ECEF; /* Light border color for separation */
        --overlay-dark: rgba(0, 0, 0, 0.65); /* Dark overlay for hero/section images */
        --card-bg: #FFFFFF; /* Pure white for card backgrounds */
        --footer-bg: #1A1A1A; /* Hampir hitam untuk footer */
        --footer-text: #CED4DA; /* Teks terang untuk footer */
        --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.1);
        --shadow-medium: 0 10px 30px rgba(0, 0, 0, 0.15);
        --shadow-deep: 0 15px 40px rgba(0, 0, 0, 0.25);
    }

    body {
        background-color: var(--background-light);
        font-family: 'Montserrat', sans-serif;
        color: var(--text-dark);
        overflow-x: hidden; /* Mencegah scroll horizontal pada body */
    }

    /* Perbaikan untuk NAVBAR agar selalu di atas konten dan tidak tumpang tindih */
    .navbar.fixed-top {
        z-index: 1050; /* Pastikan navbar memiliki z-index tinggi */
    }

    /* Solusi Jarak dari Navbar Fixed (GLOBAL, sebaiknya di layouts/app.blade.php atau file CSS utama) */
    body {
        padding-top: 75px !important; /* Sesuaikan dengan tinggi navbar desktop Anda */
    }

    @media (max-width: 991.98px) {
        body {
            padding-top: 68px !important; /* Sesuaikan dengan tinggi navbar tablet Anda */
        }
    }

    @media (max-width: 767.98px) {
        body {
            padding-top: 58px !important; /* Sesuaikan dengan tinggi navbar mobile Anda */
        }
    }

    /* Menggunakan class spesifik untuk hero section UMKM untuk override/spesifik */
    .umkm-hero {
        position: relative; /* Pastikan position relative untuk overlay */
        height: 600px; /* **Diperbesar sedikit untuk memberi ruang lebih** */
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center; /* Memusatkan konten secara vertikal */
        justify-content: center; /* Memusatkan konten secara horizontal */
        text-align: center;
        color: var(--text-light); /* Warna teks terang dari layout */
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8); /* Bayangan teks lebih kuat agar lebih terbaca */
        padding-top: 80px; /* Pastikan konten banner dimulai di bawah navbar */
        margin-top: -80px; /* Offset negatif untuk menyelaraskan banner ke atas, di bawah navbar fixed */
        overflow: hidden; /* Pastikan tidak ada overflow yang tidak diinginkan */
        box-shadow: var(--shadow-deep); /* Bayangan lebih dalam untuk kesan mewah */
    }

    .umkm-hero .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--overlay-dark); /* Overlay gelap dari layout */
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)); /* Gradien overlay untuk kedalaman */
        z-index: 1;
    }

    .umkm-hero .container {
        position: relative;
        z-index: 2; /* Pastikan konten di atas overlay */
        max-width: 900px; /* Batasi lebar konten untuk fokus */
    }

    /* Teks dalam umkm-hero */
    .umkm-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 4.8rem; /* Ukuran font lebih besar lagi untuk judul banner */
        font-weight: 700;
        margin-bottom: 1.8rem;
        color: var(--text-light);
        line-height: 1.1;
        letter-spacing: -1px; /* Sedikit kompresi huruf untuk kesan elegan */
    }

    .umkm-hero p.lead {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.6rem; /* Ukuran font lead sedikit lebih besar */
        max-width: 800px; /* Lebar maksimum teks */
        margin: 0 auto 2.5rem auto; /* Jarak bawah lebih lega */
        color: var(--text-light); /* Pastikan warna teks terang */
    }

    /* Tombol pada banner */
    .btn-hero {
        background: linear-gradient(to right, var(--primary-accent), var(--secondary-accent));
        color: var(--text-light);
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 30px;
        font-size: 1.2rem;
        font-weight: 600;
        transition: all 0.4s ease;
        box-shadow: var(--shadow-medium);
    }

    .btn-hero:hover {
        background: linear-gradient(to right, var(--secondary-accent), var(--primary-accent));
        color: var(--text-light);
        transform: translateY(-5px) scale(1.02);
        box-shadow: var(--shadow-deep);
    }

    /* Section Global Styles */
    .blog-section {
        background-color: var(--background-dark); /* Latar belakang gelap untuk setiap bagian */
        padding: 6rem 0; /* Padding vertikal konsisten */
        margin-bottom: 5rem; /* Jarak antar bagian */
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.2);
        position: relative;
        overflow: hidden; /* Untuk memastikan scrollbar tidak keluar */
    }

    .section-header {
        text-align: center;
        margin-bottom: 4rem; /* Jarak bawah judul */
        position: relative;
        z-index: 1; /* Pastikan judul di atas overlay jika ada */
    }

    .section-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3.8rem;
        color: var(--text-light); /* Warna teks terang di latar gelap */
        font-weight: 700;
        padding-bottom: 20px;
        position: relative;
        display: inline-block; /* Agar after pseudo-element mengikuti lebar teks */
    }

    .section-header h2::after {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: 0;
        width: 100px;
        height: 4px;
        background-color: var(--primary-accent); /* Garis bawah "biru susu tua" */
        border-radius: 2px;
    }

    .section-header .section-description {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2rem;
        color: var(--text-light); /* Pastikan deskripsi di blog-section tetap terang */
        max-width: 700px;
        margin: 1.5rem auto 0 auto; /* Jarak dari judul */
        line-height: 1.6;
        opacity: 0.9;
    }

    /* Scrollable Cards Container */
    .scrollable-cards-container {
        display: flex;
        flex-wrap: nowrap; /* Mencegah wrap ke bawah */
        overflow-x: auto; /* Memungkinkan scroll horizontal */
        -webkit-overflow-scrolling: touch; /* Smooth scrolling di iOS */
        padding: 1rem 3rem 2.5rem 3rem; /* Padding horizontal dan bawah untuk scrollbar */
        scrollbar-width: thin; /* Firefox */
        scrollbar-color: var(--primary-accent) var(--background-dark); /* Warna scrollbar */
    }

    .scrollable-cards-container::-webkit-scrollbar {
        height: 12px; /* Tinggi scrollbar */
    }

    .scrollable-cards-container::-webkit-scrollbar-track {
        background: var(--background-dark); /* Track background */
        border-radius: 10px;
    }

    .scrollable-cards-container::-webkit-scrollbar-thumb {
        background: var(--primary-accent); /* Warna thumb */
        border-radius: 10px;
        border: 3px solid var(--background-dark); /* Border agar thumb menonjol */
    }

    .scrollable-cards-container::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-accent); /* Warna thumb saat hover */
    }

    /* Kolom untuk Kartu dalam Scrollable Container */
    .scrollable-cards-container .col-md-4 {
        flex: 0 0 auto; /* Mencegah item menyusut/meregang */
        width: 380px; /* Lebar tetap untuk setiap kartu */
        margin-right: 2.5rem; /* Jarak antar kartu */
    }

    .scrollable-cards-container .col-md-4:last-child {
        margin-right: 0; /* Hapus margin kanan pada kartu terakhir */
    }

    /* Card Styling */
    .card-blog {
        border: none;
        border-radius: 12px; /* Sudut membulat yang elegan */
        overflow: hidden;
        box-shadow: var(--shadow-medium);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: var(--card-bg); /* Latar belakang kartu putih */
        color: var(--text-dark); /* Warna teks gelap */
        height: 100%; /* Memastikan tinggi kartu konsisten */
        display: flex;
        flex-direction: column;
    }

    .card-blog:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-deep);
    }

    .card-blog .card-img-top {
        height: 280px;
        object-fit: cover;
        border-bottom: 4px solid var(--primary-accent); /* Garis bawah pada gambar */
    }

    .card-blog .card-body {
        padding: 1.8rem; /* Padding lebih lega */
        display: flex;
        flex-direction: column;
        flex-grow: 1; /* Agar body memenuhi sisa ruang */
    }

    .card-blog .card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.7rem;
        font-weight: 700;
        color: var(--heading-dark);
        margin-bottom: 0.8rem;
    }

    .card-blog .card-text {
        font-size: 0.95rem;
        line-height: 1.6;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .card-blog .card-text.category {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--primary-accent);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .card-blog .card-text.category i {
        margin-right: 8px;
        font-size: 1rem;
        color: var(--secondary-accent);
    }

    /* Gaya untuk .btn-read-more */
    .btn-read-more {
        background: linear-gradient(to right, var(--primary-accent), var(--secondary-accent));
        color: var(--text-light);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-light);
        text-decoration: none; /* Pastikan tidak ada underline default */
        display: inline-flex; /* Untuk menengahkan ikon */
        align-items: center;
        justify-content: center;
    }

    .btn-read-more:hover {
        background: linear-gradient(to right, var(--secondary-accent), var(--primary-accent));
        color: var(--text-light);
        transform: translateY(-3px);
        box-shadow: var(--shadow-medium);
    }

    .btn-read-more i {
        margin-left: 8px;
        transition: transform 0.3s ease;
    }

    .btn-read-more:hover i {
        transform: translateX(5px);
    }

    /* Empty State Styling */
    .empty-state {
        padding: 8rem 0;
        background-color: var(--background-dark);
        color: var(--text-light);
        border-radius: 12px;
        box-shadow: var(--shadow-medium);
        text-align: center;
        margin: 3rem auto;
        max-width: 800px;
    }

    .empty-state img {
        width: 180px;
        margin-bottom: 40px;
        opacity: 0.6;
        filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.1));
    }

    .empty-state .h4 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--text-light);
        margin-bottom: 1rem;
    }

    .empty-state .lead {
        font-size: 1.2rem;
        color: var(--text-light);
        opacity: 0.8;
    }

    /* Pagination Styling (Bootstrap 5 already good, but custom touch) */
    .pagination .page-item .page-link {
        background-color: var(--background-dark);
        color: var(--text-light);
        border: 1px solid var(--primary-accent);
        margin: 0 5px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-accent);
        border-color: var(--primary-accent);
        color: var(--text-light);
        box-shadow: var(--shadow-light);
    }

    .pagination .page-item .page-link:hover {
        background-color: var(--secondary-accent);
        border-color: var(--secondary-accent);
        color: var(--text-light);
        transform: translateY(-2px);
        box-shadow: var(--shadow-light);
    }

    .pagination .page-item.disabled .page-link {
        background-color: var(--background-dark);
        color: rgba(255, 255, 255, 0.5);
        border-color: rgba(255, 255, 255, 0.2);
    }

    /* Responsive adjustments for hero section */
    @media (max-width: 991.98px) {
        .umkm-hero {
            height: 500px;
            padding: 8rem 2rem;
        }
        .umkm-hero h1 {
            font-size: 4rem;
        }
        .umkm-hero p.lead {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 767.98px) {
        .umkm-hero {
            height: 400px;
            padding: 6rem 1rem;
        }
        .umkm-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .umkm-hero p.lead {
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }
        .hero-section .btn-hero {
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
        }
        .section-header h2 {
            font-size: 2.8rem;
        }
        .section-header .section-description {
            font-size: 1rem;
        }
        .scrollable-cards-container {
            padding: 1rem 1rem 2rem 1rem;
        }
        .scrollable-cards-container .col-md-4 {
            width: 320px;
            margin-right: 1.5rem;
        }
        .card-blog .card-img-top {
            height: 220px;
        }
        .card-blog .card-title {
            font-size: 1.5rem;
        }
        .empty-state {
            padding: 4rem 1rem;
        }
        .empty-state .h4 {
            font-size: 2rem;
        }
        .empty-state .lead {
            font-size: 1rem;
        }
    }

    @media (max-width: 575.98px) {
        .umkm-hero {
            height: 350px;
            padding: 5rem 1rem;
        }
        .umkm-hero h1 {
            font-size: 2.5rem;
        }
        .umkm-hero p.lead {
            font-size: 0.9rem;
        }
        .section-header h2 {
            font-size: 2rem;
        }
        .scrollable-cards-container .col-md-4 {
            width: 280px; /* Lebar lebih kecil untuk layar sangat kecil */
            margin-right: 1rem;
        }
        .card-blog .card-body {
            padding: 1.2rem;
        }
        .card-blog .card-title {
            font-size: 1.3rem;
        }
        .card-blog .card-text {
            font-size: 0.85rem;
        }
        .btn-read-more {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }
    }

    /* New Section Specific Styles */
    .detail-content-section {
        padding: 5rem 0;
        margin-bottom: 3rem;
        background-color: var(--background-light);
        border-bottom: 1px solid var(--border-color);
        box-shadow: var(--shadow-light);
    }

    .detail-content-section.bg-dark-section {
        background-color: var(--background-dark);
        color: var(--text-light);
        box-shadow: var(--shadow-medium);
    }

    .detail-content-section.bg-dark-section h2,
    .detail-content-section.bg-dark-section h3 {
        color: var(--text-light);
    }

    .detail-content-section.bg-dark-section p,
    .detail-content-section.bg-dark-section ul li {
        color: var(--text-light);
        opacity: 0.9;
    }

    .detail-content-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        color: var(--heading-dark);
        text-align: center;
        margin-bottom: 3.5rem;
        position: relative;
        padding-bottom: 15px;
    }

    .detail-content-section h2::after {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: 0;
        width: 100px;
        height: 4px;
        background-color: var(--primary-accent);
        border-radius: 2px;
    }

    .detail-content-section h3 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--heading-dark);
        margin-bottom: 1.5rem;
    }

    .detail-content-section p {
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .img-fluid.rounded.shadow-lg {
        border-radius: 12px !important;
        box-shadow: var(--shadow-medium) !important;
    }

    .icon-list-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 1.1rem;
        color: var(--text-dark);
    }

    .icon-list-item i {
        color: var(--primary-accent);
        font-size: 1.5rem;
        margin-right: 15px;
        min-width: 30px; /* Ensure icon doesn't shrink */
        text-align: center;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .product-grid .product-item {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--shadow-light);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-grid .product-item:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-deep);
    }

    .product-grid .product-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 3px solid var(--secondary-accent);
    }

    .product-grid .product-item .product-info {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-grid .product-item h4 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: var(--heading-dark);
        margin-bottom: 0.5rem;
    }

    .product-grid .product-item p {
        font-size: 0.95rem;
        color: var(--text-dark);
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .product-grid .product-item .btn {
        margin-top: auto; /* Push button to the bottom */
    }

    /* Testimonial Section */
    .testimonial-section {
        background-color: var(--background-light);
        padding: 6rem 0;
        text-align: center;
    }

    .testimonial-card {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--shadow-medium);
        padding: 2.5rem;
        margin: 2rem auto;
        max-width: 800px;
        position: relative;
        overflow: hidden;
    }

    .testimonial-card i.fas.fa-quote-left {
        font-size: 3rem;
        color: var(--primary-accent);
        opacity: 0.2;
        position: absolute;
        top: 20px;
        left: 30px;
        z-index: 0;
    }

    .testimonial-card p.testimonial-text {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        line-height: 1.8;
        color: var(--heading-dark);
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .testimonial-card .author {
        font-weight: 600;
        color: var(--primary-accent);
        font-size: 1.1rem;
    }

    .testimonial-card .author span {
        font-weight: 400;
        color: var(--text-dark);
        font-size: 0.9rem;
    }

    /* Call to Action Section */
    .cta-section {
        background-color: var(--primary-accent);
        color: var(--text-light);
        padding: 5rem 0;
        text-align: center;
        margin-top: 5rem;
        box-shadow: var(--shadow-deep);
    }

    .cta-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
    }

    .cta-section p.lead {
        font-size: 1.5rem;
        margin-bottom: 2.5rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        opacity: 0.9;
    }

    .cta-section .btn {
        background-color: var(--text-light);
        color: var(--primary-accent);
        border: 2px solid var(--text-light);
        padding: 1rem 3rem;
        font-size: 1.3rem;
        border-radius: 30px;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .cta-section .btn:hover {
        background-color: transparent;
        color: var(--text-light);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    /* Media queries for new sections */
    @media (max-width: 991.98px) {
        .detail-content-section h2 {
            font-size: 3rem;
        }
        .detail-content-section h3 {
            font-size: 2rem;
        }
        .testimonial-card p.testimonial-text {
            font-size: 1.3rem;
        }
        .cta-section h2 {
            font-size: 3rem;
        }
        .cta-section p.lead {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 767.98px) {
        .detail-content-section {
            padding: 3rem 0;
        }
        .detail-content-section h2 {
            font-size: 2.5rem;
            margin-bottom: 2.5rem;
        }
        .detail-content-section h3 {
            font-size: 1.8rem;
        }
        .icon-list-item {
            font-size: 1rem;
        }
        .icon-list-item i {
            font-size: 1.2rem;
        }
        .product-grid {
            gap: 1.5rem;
        }
        .product-grid .product-item h4 {
            font-size: 1.5rem;
        }
        .testimonial-card {
            padding: 1.5rem;
            margin: 1.5rem auto;
        }
        .testimonial-card i.fas.fa-quote-left {
            font-size: 2.5rem;
            top: 15px;
            left: 20px;
        }
        .testimonial-card p.testimonial-text {
            font-size: 1.2rem;
        }
        .cta-section {
            padding: 3rem 0;
        }
        .cta-section h2 {
            font-size: 2.5rem;
        }
        .cta-section p.lead {
            font-size: 1.2rem;
        }
        .cta-section .btn {
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
        }
    }
</style>
{{-- **END OF INLINE CSS FOR UMKM DESA** --}}

{{-- Hero Section untuk Halaman UMKM Desa --}}
<section class="hero-section umkm-hero" style="background-image: url('{{ asset('images/singkong1.jpg') }}');">
    <div class="overlay"></div>
    <div class="container text-center text-light position-relative" style="z-index: 2;">
        <h1 class="animate__animated animate__fadeInDown" style="margin-top: 50px">Produk Unggulan UMKM Padukuhan Kami</h1> 
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Dukung ekonomi lokal dengan menjelajahi beragam produk berkualitas dari pengusaha padukuhan.</p> 
        <a href="#umkm-list" class="btn btn-hero mt-4 animate__animated animate__zoomIn animate__delay-2s" style="background: #064a9e">Lihat Semua Produk</a> 
    </div>
</section>

{{-- Bagian Pengantar UMKM --}}
<section class="detail-content-section">
    <div class="container">
        <h2 class="text-center mb-5">Semangat Kewirausahaan Padukuhan Kerjo</h2>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/singkong2.jpg') }}" alt="Pengusaha Lokal" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-6">
                <h3>Tentang UMKM Kami</h3>
                <p>Unit Mikro, Kecil, dan Menengah (UMKM) adalah tulang punggung perekonomian Padukuhan Kerjo. Kami bangga dengan semangat inovasi dan kegigihan para pengusaha lokal yang terus berkarya menghasilkan produk-produk berkualitas tinggi. Dari resep turun-temurun hingga kreasi modern, setiap produk menceritakan kisah dedikasi dan kualitas.</p>
                <p>Pemerintah padukuhan aktif memberikan dukungan penuh melalui berbagai program pelatihan, fasilitasi perizinan, hingga bantuan promosi. Tujuannya adalah untuk meningkatkan daya saing UMKM kami di pasar yang lebih luas, sekaligus melestarikan kekayaan kuliner dan kerajinan tangan khas padukuhan.</p>
            </div>
        </div>
        <div class="row align-items-center mt-5">
            <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                <img src="{{ asset('images/singkong3.jpg') }}" alt="Produk UMKM Lokal" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-6 order-lg-1">
                <h3>Dampak Positif & Keberlanjutan</h3>
                <p>Dengan membeli produk UMKM padukuhan, Anda tidak hanya mendapatkan barang berkualitas, tetapi juga turut serta dalam memutar roda ekonomi lokal. Setiap pembelian berarti dukungan langsung bagi keluarga pengusaha, penciptaan lapangan kerja, dan pengembangan potensi padukuhan secara keseluruhan.</p>
                <p>Kami juga mendorong praktik bisnis yang berkelanjutan dan ramah lingkungan. Banyak UMKM kami yang sudah mengadopsi bahan baku lokal, mengurangi limbah, dan menggunakan metode produksi yang bertanggung jawab. Mari bersama membangun ekosistem ekonomi yang kuat dan lestari di Padukuhan Kerjo.</p>
            </div>
        </div>
    </div>
</section>

{{-- Bagian Daftar Produk UMKM dengan scrollable-cards-container --}}
<section class="blog-section" id="umkm-list" style="background: #064a9e">
    <div class="container">
        <div class="section-header">
            <h2 class="text-light">Jelajahi Produk Kami</h2> 
            <p class="section-description text-light">Temukan keragaman produk UMKM lokal kami yang dibuat dengan sepenuh hati oleh pengusaha-pengusaha berbakat di padukuhan.</p> 
        </div>

        <div class="scrollable-cards-container">
            @forelse ($umkmDesas as $umkmDesa)
            <div class="col-md-4">
                <div class="card card-blog h-100 animate__animated animate__fadeInUp">
                    @if($umkmDesa->gambar)
                        <img src="{{ asset('storage/umkm-desa/' . $umkmDesa->gambar) }}" alt="{{ $umkmDesa->nama_produk }}" class="card-img-top"> 
                    @else
                        <img src="{{ asset('images/placeholder-card.jpg') }}" alt="Gambar Tidak Tersedia" class="card-img-top">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $umkmDesa->nama_produk }}</h5> 
                        <p class="card-text category"><i class="fas fa-store me-2"></i> {{ $umkmDesa->nama_umkm }}</p>
                        <p class="card-text">{{ Str::limit($umkmDesa->deskripsi, 100) }}</p> 
                        <div class="mt-auto">
                            <a href="{{ route('umkm_desa.show.umum', $umkmDesa->id) }}" class="btn btn-read-more" style="background: #2e7eff">Lihat Detail Produk <i class="fas fa-arrow-right ms-2"></i></a> 
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 text-center text-light py-5 empty-state">
                <img src="{{ asset('images/empty-state-icon.png') }}" alt="No Data" style="width: 150px; margin-bottom: 30px; opacity: 0.7;"> 
                <p class="h4">Belum ada produk UMKM yang terdaftar.</p> 
                <p class="lead">Mohon maaf, saat ini belum ada produk unggulan yang tersedia. Coba kunjungi lagi nanti!</p> 
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {!! $umkmDesas->links('pagination::bootstrap-5') !!} 
        </div>
    </div>
</section>

{{-- New Section: Kategori Produk Unggulan --}}
<section class="detail-content-section bg-dark-section" style="background: #064a9e">
    <div class="container">
        <h2 class="text-center text-light mb-5">Kategori Produk Unggulan Kami</h2>
        <p class="text-center text-light-50 lead mb-5">Padukuhan Kerjo memiliki beragam jenis produk UMKM yang dibagi berdasarkan kategori, memudahkan Anda menemukan apa yang Anda cari.</p>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="info-block h-100">
                    <img src="{{ asset('images/sing2.jpg') }}" alt="Kuliner & Makanan" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--secondary-accent);">
                    <h3 style="color: #1A1A1A"><i class="fas fa-utensils"></i> Kuliner & Makanan</h3>
                    <p style="color: #1A1A1A">Temukan berbagai jajanan tradisional, makanan ringan, hingga hidangan berat khas padukuhan kerjo yang diolah dengan resep autentik dan bahan-bahan segar.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-block h-100">
                    <img src="{{ asset('images/rotan1.jpg') }}" alt="Kerajinan Tangan" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--secondary-accent);">
                    <h3 style="color: #1A1A1A"><i class="fas fa-paint-brush"></i> Kerajinan Tangan</h3>
                    <p style="color: #1A1A1A">Jelajahi keindahan kerajinan tangan unik seperti, anyaman bambu, keranjang rotan, dan souvenir khas yang dibuat oleh warga padukuhan kerjo.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-block h-100">
                    <img src="{{ asset('images/singkong1.jpg') }}" alt="Produk Pertanian" class="img-fluid rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--secondary-accent);">
                    <h3 style="color: #1A1A1A"><i class="fas fa-seedling"></i> Produk Pertanian</h3>
                    <p style="color: #1A1A1A">Dapatkan hasil bumi segar dan produk olahan pertanian organik langsung dari petani padukuhan kami, seperti singkong, pisang, kacang, benguk.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- New Section: Kisah Sukses UMKM --}}
<section class="detail-content-section">
    <div class="container">
        <h2 class="text-center mb-5">Kisah Inspiratif UMKM Padukuhan Kerjo</h2>
        <p class="text-center lead mb-5">Di balik setiap produk, ada kisah perjuangan, inovasi, dan semangat pantang menyerah. Berikut adalah beberapa cerita sukses dari para pengusaha UMKM kami.</p>

        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/s1.jpg') }}" alt="Kisah UMKM Sukses 1" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-6">
                <h3>"Keripik Singkong Sido Mukti": Melestarikan Rasa, Menggerakkan Ekonomi</h3>
                <p>Ibu Juminah, pendiri usaha rumahan "Keripik Singkong Sido Mukti", memulai produksi dari dapur kecil di rumahnya dengan alat sederhana dan bahan baku dari kebun sendiri. Dengan tekad dan semangat melestarikan olahan tradisional, ia terus mengembangkan resep dan teknik pengolahan singkong agar tetap gurih, renyah, dan tahan lama dan tanpa sedikit bahan pengawet pada produknya.</p>
                <p>Saat ini, usaha tersebut dijalankan secara sederhana dari rumah dan dipasarkan secara langsung ke tetangga, warung-warung, serta warga di sekitar wilayah Gunungkidul. "Sido Mukti" bukan hanya sekadar nama keripik, tapi juga cerminan semangat Ibu Juminah dalam mempertahankan resep tradisional.</p>
            </div>
        </div>
    </div>
</section>

{{-- Call to Action Section --}}
<section class="cta-section" style="background: #064a9e">
    <div class="container">
        <h2 class="animate__animated animate__fadeInDown" style="color: white">Dukung Produk Lokal, Majukan UMKM Padukuhan Kerjo!</h2>
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Setiap produk yang Anda beli adalah investasi untuk masa depan Padukuhan Kerjo.</p>
        <a href="#umkm-list" class="btn btn-lg animate__animated animate__zoomIn animate__delay-2s">Jelajahi Produk Sekarang <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
</section>

@endsection