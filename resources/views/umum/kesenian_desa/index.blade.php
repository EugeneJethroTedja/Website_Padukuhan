@extends('layouts.app')

@section('content')

{{-- **START OF INLINE CSS FOR KESENIAN DESA (DEBUGGING/TEMPORARY)** --}}
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

    /* Menggunakan class spesifik untuk hero section Kesenian untuk override/spesifik */
    .kesenian-hero {
        position: relative; /* Pastikan position relative untuk overlay */
        height: 600px; /* Diperbesar sedikit untuk memberi ruang lebih */
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

    .kesenian-hero .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--overlay-dark); /* Overlay gelap dari layout */
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)); /* Gradien overlay untuk kedalaman */
        z-index: 1;
    }

    .kesenian-hero .container {
        position: relative;
        z-index: 2; /* Pastikan konten di atas overlay */
        max-width: 900px; /* Batasi lebar konten untuk fokus */
    }

    /* Teks dalam kesenian-hero */
    .kesenian-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 4.8rem; /* Ukuran font lebih besar lagi untuk judul banner */
        font-weight: 700;
        margin-bottom: 1.8rem;
        color: var(--text-light);
        line-height: 1.1;
        letter-spacing: -1px; /* Sedikit kompresi huruf untuk kesan elegan */
    }

    .kesenian-hero p.lead {
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

    /* Card Styling (for regular grid) */
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
        .kesenian-hero {
            height: 500px;
            padding: 8rem 2rem;
        }
        .kesenian-hero h1 {
            font-size: 4rem;
        }
        .kesenian-hero p.lead {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 767.98px) {
        .kesenian-hero {
            height: 400px;
            padding: 6rem 1rem;
        }
        .kesenian-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .kesenian-hero p.lead {
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
        .kesenian-hero {
            height: 350px;
            padding: 5rem 1rem;
        }
        .kesenian-hero h1 {
            font-size: 2.5rem;
        }
        .kesenian-hero p.lead {
            font-size: 0.9rem;
        }
        .section-header h2 {
            font-size: 2rem;
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

    /* Galeri Kesenian Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .gallery-grid .gallery-item {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--shadow-light);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .gallery-grid .gallery-item:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-deep);
    }

    .gallery-grid .gallery-item img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-bottom: 3px solid var(--secondary-accent);
    }

    .gallery-grid .gallery-item .gallery-info {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .gallery-grid .gallery-item h4 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: var(--heading-dark);
        margin-bottom: 0.5rem;
    }

    .gallery-grid .gallery-item p {
        font-size: 0.95rem;
        color: var(--text-dark);
        line-height: 1.6;
        margin-bottom: 1rem;
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

        .image-grid {
            gap: 1.5rem; /* cite: 110 */
        }
        .image-grid img {
            width: 250px; /* Sesuaikan lebar gambar untuk tablet */
            height: 200px; /* cite: 111 */
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
        .gallery-grid {
            gap: 1.5rem;
        }
        .gallery-grid .gallery-item h4 {
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
        .image-grid {
            gap: 1rem; /* cite: 118 */
        }
        .image-grid img {
            width: 200px; /* Sesuaikan lebar gambar untuk ponsel */
            height: 180px; /* cite: 119 */
        }
    }
</style>
{{-- **END OF INLINE CSS FOR KESENIAN DESA** --}}

{{-- Hero Section untuk Halaman Kesenian Desa --}}
<section class="hero-section kesenian-hero" style="background-image: url('{{ asset('images/doger4.jpg') }}');">
    <div class="overlay"></div>
    <div class="container text-center text-light position-relative" style="z-index: 2;">
        <h1 class="animate__animated animate__fadeInDown">Warisan Seni & Budaya Padukuhan Kerjo</h1>
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Selami kekayaan tradisi yang hidup dan berkembang, dari tarian hingga musik, setiap alunan adalah jiwa padukuhan kami.</p>
        <a href="#daftar-kesenian" class="btn btn-hero mt-4 animate__animated animate__zoomIn animate__delay-2s" style="background: #064a9e">Jelajahi Dunia Kesenian</a>
    </div>
</section>

{{-- Bagian Pengantar Kesenian --}}
<section class="detail-content-section">
    <div class="container">
        <h2 class="text-center mb-5">Jantung Budaya Padukuhan yang Berdetak</h2>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/doger3.jpg') }}" alt="Pagelaran Kesenian Tradisional" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-6">
                <h3>Tentang Kesenian Tradisional Kami</h3>
                <p>Padukuhan Kerjo adalah rumah bagi beragam bentuk kesenian tradisional yang telah diwariskan secara turun-temurun. Kesenian bukan hanya sekadar hiburan, melainkan bagian tak terpisahkan dari identitas dan kehidupan bermasyarakat. Dari pertunjukan doger yang sarat makna, hingga tarian daerah yang memukau, setiap seni mencerminkan kearifan lokal dan nilai-nilai luhur.</p>
                <p>Kami berkomitmen untuk melestarikan dan mengembangkan kesenian ini melalui berbagai sanggar, pelatihan, dan pagelaran rutin. Generasi muda didorong untuk terlibat aktif, memastikan bahwa warisan budaya ini terus hidup dan beradaptasi dengan zaman tanpa kehilangan esensinya.</p>
            </div>
        </div>
        <div class="row align-items-center mt-5">
            <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                <img src="{{ asset('images/doger2.jpg') }}" alt="Anak-anak Latihan Tari" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-6 order-lg-1">
                <h3>Peran Kesenian dalam Kehidupan Padukuhan</h3>
                <p>Kesenian memegang peranan sentral dalam setiap aspek kehidupan padukuhan, mulai dari upacara adat, perayaan panen, hingga acara pernikahan. Ia menjadi media komunikasi, ekspresi spiritual, dan perekat sosial yang kuat. Dengan kesenian, masyarakat Padukuhan Kerjo merayakan kebersamaan, menjaga harmoni, dan mengenang sejarah leluhur mereka.</p>
                <p>Melalui pagelaran seni, kami juga menyambut wisatawan untuk merasakan langsung kehangatan dan kekayaan budaya kami. Ini adalah kesempatan untuk berbagi cerita dan tradisi, serta menginspirasi apresiasi terhadap seni dan budaya di era modern.</p>
            </div>
        </div>
    </div>
</section>

{{-- Bagian Daftar Kesenian dengan Grid --}}
<section class="blog-section" id="daftar-kesenian" style="background: #064a9e">
    <div class="container">
        <div class="section-header">
            <h2 class="text-light">Intip Koleksi Kesenian Kami</h2>
            <p class="section-description text-light">Berbagai bentuk seni yang kaya akan sejarah dan filosofi, dipersembahkan oleh para seniman padukuhan kami.</p>
        </div>

        <div class="image-grid">
            @forelse ($kesenianDesas as $kesenianDesa)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card card-blog h-100 animate__animated animate__fadeInUp">
                    @if($kesenianDesa->gambar)
                        <img src="{{ asset('storage/kesenian-desa/' . $kesenianDesa->gambar) }}" alt="{{ $kesenianDesa->nama_kesenian }}" class="card-img-top">
                    @else
                        <img src="https://via.placeholder.com/400x280?text=Kesenian+Desa" class="card-img-top" alt="Gambar Tidak Tersedia">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $kesenianDesa->nama_kesenian }}</h5>
                        {{-- Contoh jika ada jenis kesenian di model: --}}
                        {{-- <p class="card-text category"><i class="fas fa-mask me-2"></i> {{ $kesenianDesa->jenis_kesenian ?? 'Seni Pertunjukan' }}</p> --}}
                        <p class="card-text">{{ Str::limit($kesenianDesa->deskripsi, 180) }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('kesenian_desa.show.umum', $kesenianDesa->id) }}" class="btn btn-read-more" style="background: #2e7eff">Lihat Detail <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 text-center text-light py-5 empty-state">
                <img src="{{ asset('images/empty-state-icon.png') }}" alt="No Data" style="width: 150px; margin-bottom: 30px; opacity: 0.7;">
                <p class="h4">Belum ada data kesenian yang terdaftar.</p>
                <p class="lead">Mohon maaf, sepertinya belum ada informasi kesenian padukuhan saat ini. Mari bersama lestarikan budaya dengan menambahkannya!</p>
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {!! $kesenianDesas->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</section>

{{-- New Section: Kesenian Doger --}}
<section class="detail-content-section bg-dark-section" style="background: #064a9e">
    <div class="container">
        <h2 class="text-center text-light mb-5">Kesenian Doger – Warisan Budaya Gunungkidul</h2>
        <p class="text-center text-light lead mb-5">
            Tari Doger merupakan salah satu bentuk kesenian tradisional yang tumbuh dan berkembang di wilayah Gunungkidul, termasuk di Padukuhan Kerjo. Tarian ini memadukan unsur hiburan, tradisi, dan kearifan lokal yang kaya akan nilai budaya.
        </p>

        <div class="row align-items-center">
            {{-- Gambar di kiri --}}
            <div class="col-md-6 mb-4">
                <img src="{{ asset('images/doger4.jpg') }}" alt="Tari Doger Gunungkidul" class="img-fluid rounded shadow">
            </div>

            {{-- Deskripsi di kanan --}}
            <div class="col-md-6 mb-4">
                <div class="info-block h-100 p-4 rounded" style="background-color: var(--card-bg); box-shadow: var(--shadow-light);">
                    <h3 class="mb-3 text-center" style="color: var(--heading-dark);">Doger : Tari Rakyat yang Memikat</h3>
                    <p style="color: var(--text-dark);">
                        Tarian Doger biasanya dibawakan oleh sekelompok penari dengan kostum mencolok, iringan musik gamelan, dan gerakan yang enerjik. Tarian ini kerap ditampilkan dalam acara hajatan, syukuran panen, atau ritual budaya lainnya.
                    </p>
                    <p style="color: var(--text-dark);">
                        Lebih dari sekadar hiburan, Doger juga memiliki fungsi sosial yang kuat—menyatukan warga, menjadi sarana ekspresi budaya, serta pelestarian seni pertunjukan tradisional di tengah arus modernisasi.
                    </p>
                    <p style="color: var(--text-dark);">
                        Di Padukuhan Kerjo, seni Doger tetap hidup melalui pelatihan generasi muda dan pagelaran rutin yang memperkaya khasanah budaya lokal.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- New Section: Galeri Kesenian --}}
<section class="detail-content-section">
    <div class="container">
        <h2 class="text-center mb-5">Momen-momen Indah dari Panggung Padukuhan</h2>
        <p class="text-center lead mb-5">Saksikan keindahan visual dari berbagai pagelaran dan ekspresi seni yang telah kami abadikan.</p>

        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="{{ asset('images/doger2.jpg') }}" alt="Tari Topeng" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Tari Doger Tradisional</h4>
                    <p>Tarian khas Gunungkidul yang dibawakan dengan gerakan dinamis dan penuh semangat. Penari mengenakan kostum cerah dengan iringan musik gamelan yang menghentak, menghadirkan nuansa pesta rakyat yang meriah dan menghibur.</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/doger3.jpg') }}" alt="Atraksi Tari Doger" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Atraksi Tari Doger Tradisional</h4>
                    <p>Penampilan Tari Doger yang meriah dengan gerakan lincah, kostum warna-warni, serta iringan musik gamelan. Atraksi ini menjadi hiburan utama dalam berbagai acara adat di Padukuhan Kerjo.</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/doger4.jpg') }}" alt="Tari Doger Barongan" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Dogèr Singo Budoyo</h4>
                    <p>Beberapa pementasan Doger, pementasan yang menambah daya tarik visual dan nilai simbolik yang menggambarkan perlindungan serta kekuatan dalam budaya lokal.</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="{{ asset('images/doger5.jpg') }}" alt="Tari Doger Kuda" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Doger dan Ekspresi Mistis</h4>
                    <p>Dalam beberapa kesempatan, Tari Doger menampilkan unsur magis dan ekspresi spiritual, menciptakan suasana yang khidmat sekaligus memukau, memperlihatkan hubungan erat antara seni dan ritus adat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Call to Action Section --}}
<section class="cta-section" style="background: #064a9e">
    <div class="container">
        <h2 class="animate__animated animate__fadeInDown" style="color: white">Saksikan Langsung Keajaiban Kesenian Padukuhan!</h2>
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Rasakan pengalaman budaya yang mendalam dan tak terlupakan di setiap pagelaran kami.</p>
        <a href="{{ url('/kegiatan') }}" class="btn btn-lg animate__animated animate__zoomIn animate__delay-2s">Cari Agenda Kesenian <i class="fas fa-calendar-alt ms-2"></i></a>
    </div>
</section>

@endsection