@extends('layouts.app')

@section('content')

{{-- Bagian Banner/Header Halaman Wisata Alam --}}
<section class="hero-section kegiatan-hero" style="position: relative; background-image: url('{{ asset('images/pantai7.jpg') }}'); background-size: cover; background-position: center; margin-top: 10px;">
    {{-- Gradasi gelap kehitaman --}}
    <div style="
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5));
        z-index: 1;">
    </div>

    <div class="container text-center text-light position-relative" style="z-index: 2; padding: 100px 20px;">
        <h1 class="animate__animated animate__fadeInDown">Jelajahi Keindahan Alam di Sekitar Padukuhan Kerjo</h1>
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Nikmati pesona alam yang menenangkan dan petualangan tak terlupakan di Padukuhan Kerjo.</p>
        <a href="#wisata-list-scrollable" class="btn btn-hero mt-4 animate__animated animate__zoomIn animate__delay-2s" style="background: #064a9e;">Lihat Destinasi Unggulan</a>
    </div>
</section>


{{-- Tambahkan CSS khusus untuk page-banner ini dan perbaikan kontras --}}
<style>
    /* Perbaikan untuk NAVBAR agar selalu di atas konten dan tidak tumpang tindih */
    .navbar.fixed-top {
        z-index: 1050; /* Pastikan navbar memiliki z-index tinggi */
    }

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
        overflow-x: hidden;
    }

    .page-banner {
        position: relative;
        height: 500px; /* Tinggi banner sedikit ditingkatkan untuk ruang lebih */
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light); /* Warna teks terang dari layout */
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8); /* Bayangan teks lebih kuat agar lebih terbaca */
        padding-top: 80px; /* Pastikan konten banner dimulai di bawah navbar */
        margin-top: -80px; /* Offset negatif untuk menyelaraskan banner ke atas, di bawah navbar fixed */
        overflow: hidden; /* Pastikan tidak ada overflow yang tidak diinginkan */
        box-shadow: var(--shadow-deep); /* Bayangan lebih dalam untuk kesan mewah */
    }

    .page-banner .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--overlay-dark); /* Overlay gelap dari layout */
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)); /* Gradien overlay untuk kedalaman */
        z-index: 1;
    }

    /* Teks dalam page-banner */
    .page-banner h1 {
        font-family: 'Playfair Display', serif;
        font-size: 4.8rem; /* Ukuran font lebih besar lagi untuk judul banner */
        font-weight: 700;
        margin-bottom: 1.8rem;
        color: var(--text-light);
        line-height: 1.1;
        letter-spacing: -1px; /* Sedikit kompresi huruf untuk kesan elegan */
    }

    .page-banner p.lead {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.6rem; /* Ukuran font lead sedikit lebih besar */
        max-width: 800px; /* Lebar maksimum teks */
        margin: 0 auto 2.5rem auto; /* Jarak bawah lebih lega */
        color: var(--text-light); /* Pastikan warna teks terang */
    }

    /* Tombol pada banner */
    .page-banner .btn-outline-light {
        font-size: 1.2rem;
        padding: 1rem 2.5rem;
        border-width: 2px; /* Border lebih tebal */
        border-radius: 30px; /* Lebih membulat */
        transition: all 0.4s ease;
    }
    .page-banner .btn-outline-light:hover {
        background-color: var(--primary-accent);
        color: var(--text-light);
        transform: translateY(-5px) scale(1.02); /* Efek hover yang lebih dramatis */
        box-shadow: var(--shadow-medium);
    }

    /* General Section Styles */
    .blog-section {
        background-color: var(--background-dark);
        padding: 6rem 0;
        margin-bottom: 5rem;
        box-shadow: var(--shadow-deep);
    }

    .section-header {
        text-align: center;
        margin-bottom: 4rem;
        position: relative;
    }

    .section-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3.8rem;
        color: var(--text-light); /* Pastikan judul di blog-section tetap terang */
        font-weight: 700;
        padding-bottom: 20px;
        position: relative;
        display: inline-block;
    }

    .section-header h2::after {
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

    .section-header .section-description {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2rem;
        color: var(--text-light); /* Pastikan deskripsi di blog-section tetap terang */
        max-width: 700px;
        margin: 1.5rem auto 0 auto;
        line-height: 1.6;
        opacity: 0.9;
    }

    /* Scrollable Cards Container */
    .scrollable-cards-container {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto; /* Memungkinkan scroll horizontal */
        -webkit-overflow-scrolling: touch;
        padding: 1rem 3rem 2.5rem 3rem; /* Padding horizontal dan bawah untuk scrollbar */
        scrollbar-width: thin; /* Firefox */
        scrollbar-color: var(--primary-accent) var(--background-dark); /* Warna scrollbar */
    }

    .scrollable-cards-container::-webkit-scrollbar {
        height: 12px;
    }

    .scrollable-cards-container::-webkit-scrollbar-track {
        background: var(--background-dark);
        border-radius: 10px;
    }

    .scrollable-cards-container::-webkit-scrollbar-thumb {
        background: var(--primary-accent);
        border-radius: 10px;
        border: 3px solid var(--background-dark);
    }

    .scrollable-cards-container::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-accent);
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
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.4s ease-out, box-shadow 0.4s ease-out;
        background-color: var(--card-bg);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card-blog:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.2);
    }

    .card-blog .card-img-top {
        height: 280px;
        object-fit: cover;
        width: 100%;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .card-blog .card-body {
        padding: 2rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-blog .card-title {
        font-family: 'Playfair Display', serif;
        color: var(--heading-dark);
        font-size: 2rem; /* Ukuran judul kartu sedikit lebih besar */
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 0.8rem;
    }

    .card-blog .card-text {
        font-family: 'Montserrat', sans-serif;
        color: var(--text-dark);
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    .card-blog .btn-read-more {
        background-color: var(--primary-accent);
        color: var(--text-light);
        border: none;
        padding: 0.8rem 1.8rem;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        align-self: flex-start;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
    }

    .card-blog .btn-read-more:hover {
        background-color: var(--secondary-accent);
        transform: translateY(-3px);
    }

    /* Pagination */
    .pagination {
        margin-top: 4rem;
    }
    .pagination .page-item .page-link {
        background-color: var(--background-dark);
        color: var(--text-light);
        border-color: var(--primary-accent);
        transition: all 0.3s ease;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        margin: 0 5px;
    }

    .pagination .page-item .page-link:hover {
        background-color: var(--primary-accent);
        color: var(--text-light);
        border-color: var(--primary-accent);
        transform: translateY(-2px);
        box-shadow: var(--shadow-light);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-accent);
        color: var(--text-light);
        border-color: var(--primary-accent);
        box-shadow: var(--shadow-medium);
    }
    .pagination .page-item.disabled .page-link {
        background-color: var(--background-dark);
        color: rgba(255, 255, 255, 0.4); /* Teks lebih pudar untuk disabled */
        border-color: var(--background-dark); /* Border menyatu dengan background */
        cursor: not-allowed;
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

    /* Animasi */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-80px); } /* Lebih jauh turun */
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(80px); } /* Lebih jauh naik */
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes zoomIn {
        from { opacity: 0; transform: scale(0.7); } /* Mulai dari lebih kecil */
        to { opacity: 1; transform: scale(1); }
    }

    .animate__animated {
        animation-duration: 1s;
        animation-fill-mode: both;
    }
    .animate__fadeInDown { animation-name: fadeInDown; }
    .animate__fadeInUp { animation-name: fadeInUp; }
    .animate__zoomIn { animation-name: zoomIn; }
    .animate__delay-1s { animation-delay: 1s; }
    .animate__delay-2s { animation-delay: 2s; }


    /* Penyesuaian responsif untuk banner yang lebih baik */
    @media (max-width: 991.98px) {
        .page-banner {
            height: 400px;
            padding-top: 70px;
            margin-top: -70px;
        }
        .page-banner h1 {
            font-size: 3.8rem;
            margin-bottom: 1rem;
        }
        .page-banner p.lead {
            font-size: 1.3rem;
            margin-bottom: 2rem;
        }
        .section-header h2 {
            font-size: 3rem;
        }
        .section-header .section-description {
            font-size: 1.1rem;
        }
        .scrollable-cards-container {
            padding: 1rem 1.5rem 2rem 1.5rem;
        }
        .scrollable-cards-container .col-md-4 {
            width: 320px;
            margin-right: 2rem;
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
        .page-banner {
            height: 350px;
            padding-top: 60px;
            margin-top: -60px;
        }
        .page-banner h1 {
            font-size: 2.8rem;
        }
        .page-banner p.lead {
            font-size: 1.1rem;
            margin-bottom: 1.8rem;
        }
        .section-header h2 {
            font-size: 2.5rem;
        }
        .section-header .section-description {
            font-size: 1rem;
        }
        .card-blog .card-title {
            font-size: 1.7rem;
        }
        .card-blog .card-text {
            font-size: 0.95rem;
        }
        .scrollable-cards-container {
            padding: 0.5rem 1rem 1.5rem 1rem;
        }
        .scrollable-cards-container .col-md-4 {
            width: 85%; /* Lebih lebar di mobile untuk scroll mudah */
            max-width: 300px;
            margin-right: 1.5rem;
        }
        .image-grid {
            gap: 1rem; /* cite: 118 */
        }
        .image-grid img {
            width: 200px; /* Sesuaikan lebar gambar untuk ponsel */
            height: 180px; /* cite: 119 */
        }
    }
    @media (max-width: 575.98px) {
        .page-banner {
            height: 300px;
        }
        .page-banner h1 {
            font-size: 2.2rem;
        }
        .page-banner p.lead {
            font-size: 0.95rem;
        }
        .page-banner .btn-outline-light {
            font-size: 1rem;
            padding: 0.8rem 2rem;
        }
    }

    /* New: Content Sections for detailed information */
    .content-detail-section {
        background-color: var(--background-light);
        padding: 5rem 0;
        color: var(--text-dark);
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 5rem; /* Consistent spacing */
        box-shadow: var(--shadow-light); /* Gentle shadow */
    }

    .content-detail-section.bg-dark-section {
        background-color: var(--background-dark);
        color: var(--text-light);
        box-shadow: var(--shadow-medium); /* Stronger shadow for dark sections */
    }

    .content-detail-section h3 {
        font-family: 'Playfair Display', serif;
        font-size: 3.2rem;
        color: var(--heading-dark);
        margin-bottom: 2.5rem;
        text-align: center;
        position: relative;
        padding-bottom: 15px;
    }

    .content-detail-section.bg-dark-section h3 {
        color: var(--text-light);
    }

    .content-detail-section h3::after {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: 0;
        width: 80px;
        height: 3px;
        background-color: var(--primary-accent);
        border-radius: 2px;
    }

    .content-detail-section p {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 1.5rem;
        color: var(--text-dark); /* Ensure text color is appropriate for background */
    }

    .content-detail-section.bg-dark-section p {
        color: var(--text-light);
    }

    .content-detail-section ul {
        list-style: none;
        padding-left: 0;
    }

    .content-detail-section ul li {
        margin-bottom: 1rem;
        font-size: 1.05rem;
        color: var(--text-dark); /* Ensure text color is appropriate for background */
    }

    .content-detail-section.bg-dark-section ul li {
        color: var(--text-light);
    }

    .content-detail-section ul li i {
        color: var(--primary-accent);
        margin-right: 10px;
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
        background-color: var(--secondary-accent);
        color: var(--text-light);
        padding: 2.5rem;
        border-radius: 10px;
        margin-top: 3rem;
        box-shadow: var(--shadow-medium);
    }

    .highlight-box h4 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        color: var(--text-light);
    }

    .highlight-box p {
        font-size: 1.15rem;
        line-height: 1.7;
        color: var(--text-light);
    }


    /* Responsive adjustments for new sections */
    @media (max-width: 991.98px) {
        .content-detail-section {
            padding: 4rem 0;
        }
        .content-detail-section h3 {
            font-size: 2.8rem;
        }
        .content-detail-section p {
            font-size: 1rem;
        }
        .image-grid {
            gap: 1.5rem; /* cite: 110 */
        }
        .image-grid img {
            width: 250px; /* Sesuaikan lebar gambar untuk tablet */
            height: 200px; /* cite: 111 */
        }
        .highlight-box {
            padding: 2rem;
        }
        .highlight-box h4 {
            font-size: 2rem;
        }
        .highlight-box p {
            font-size: 1.05rem;
        }
    }

    @media (max-width: 767.98px) {
        .content-detail-section {
            padding: 3rem 0;
        }
        .content-detail-section h3 {
            font-size: 2.2rem;
            margin-bottom: 2rem;
        }
        .content-detail-section p {
            font-size: 0.95rem;
        }
        .image-grid {
            gap: 1rem; /* cite: 118 */
        }
        .image-grid img {
            width: 200px; /* Sesuaikan lebar gambar untuk ponsel */
            height: 180px; /* cite: 119 */
        }
        .highlight-box {
            padding: 1.5rem;
        }
        .highlight-box h4 {
            font-size: 1.8rem;
        }
        .highlight-box p {
            font-size: 1rem;
        }
    }
</style>

{{-- New Section: Daftar Destinasi Pilihan (Scrollable) --}}
<section class="blog-section" id="wisata-list-scrollable" style="background: #064a9e">
    <div class="container-fluid"> {{-- Use container-fluid for full width of scrollable section --}}
        <div class="section-header">
            <h2>Destinasi Unggulan Kami</h2>
            <p class="section-description">Selami keajaiban tersembunyi di Padukuhan Kerjo melalui destinasi-destinasi pilihan yang menakjubkan ini.</p>
        </div>
        <div class="scrollable-cards-container">
            @forelse ($wisataAlams as $wisataAlam)
                <div class="col-md-4">
                    <div class="card card-blog h-100 animate__animated animate__fadeInUp">
                        @if($wisataAlam->gambar)
                            <img src="{{ asset('storage/wisata-alam/' . $wisataAlam->gambar) }}" alt="{{ $wisataAlam->judul }}" class="card-img-top">
                        @else
                            <img src="{{ asset('images/placeholder-wisata.jpg') }}" alt="Gambar Tidak Tersedia" class="card-img-top">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $wisataAlam->judul }}</h5>
                            <p class="card-text">{{ Str::limit(strip_tags($wisataAlam->deskripsi), 120) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('wisata_alam.show.umum', $wisataAlam->id) }}" class="btn btn-read-more">Lihat Detail <i class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- No specific empty state for scrollable as it implies a selection.
                     If there are no wisataAlams at all, the main section below will handle it. --}}
            @endforelse
        </div>
    </div>
</section>

{{-- New Section: Introduction to the Natural Wonders (Now showing ALL items with pagination) --}}
<section class="detail-content-section">
    <div class="container">
        <h2 class="text-center mb-5">Wisata Alam Terdekat Dari Padukuhan Kerjo</h2>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/pantai4.jpg') }}" alt="Wisata Alam Kerjo" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-6">
                <h3>Menjelajahi Pantai Drini</h3>
                <p>Pantai Drini di Padukuhan Kerjo, Ngestirejo, Gunungkidul, menghadirkan pesona unik berupa deretan perahu nelayan yang berjajar rapi di sepanjang bibir pantai. Suasana khas kampung nelayan terasa kuat, dipadukan dengan pasir putih yang bersih dan air laut biru jernih yang menyegarkan mata.</p>
                <p>Pantai ini tidak hanya menjadi tempat bersandar bagi para nelayan, tetapi juga destinasi wisata favorit bagi wisatawan yang ingin merasakan kehidupan pesisir secara langsung. Pengunjung dapat menyaksikan aktivitas nelayan, menikmati hasil laut segar, atau sekadar bersantai di tepi pantai sambil menikmati angin laut yang sejuk dan suara deburan ombak.</p>
            </div>
        </div>
        <div class="row align-items-center mt-5">
            <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                <img src="{{ asset('images/singkong6.jpg') }}" alt="Wisata Alam Padukuhan Kerjo" class="img-fluid w-100 rounded shadow-lg" style="height: 400px; object-fit: cover;">
            </div>
            <div class="col-lg-6 order-lg-1">
                <h3>Potensi Wisata & Pelestarian Alam</h3>
                <p>Selain pemandangan indah, Kerjo juga memiliki potensi wisata edukasi seperti pertanian organik dan pengolahan hasil bumi lokal. Anda dapat belajar langsung dari warga tentang cara bercocok tanam dengan cara tradisional sekaligus menikmati hasil pertanian segar dari kebun.</p>
                <p>Warga Padukuhan Kerjo berkomitmen menjaga kelestarian alam dengan tidak merusak ekosistem sekitar dan menjaga kebersihan lingkungan. Setiap wisatawan yang datang diharapkan turut berpartisipasi dalam menjaga kebersihan agar keindahan alam Kerjo tetap lestari untuk generasi mendatang.</p>
            </div>
        </div>
    </div>
</section>

{{-- New Section: Explore Our Diverse Landscapes --}}
<section class="content-detail-section bg-dark-section" style="background: #064a9e">
    <div class="container" >
        <h3 class="text-center">Keindahan Padukuhan Kerjo</h3>
        <p class="text-center text-light-50 mb-5">
            Padukuhan Kerjo menyuguhkan lanskap alam yang memesona seperti perbukitan yang menjulang, trasering yang hijau, hingga sudut padukuhan yang penuh ketenangan. Mari jelajahi sekitar padukuhan kerjo yang menjadi kebanggaan dan identitas masyarakat kami.
        </p>

        <div class="row">
            <div class="col-md-4 mb-4">
                <img src="{{ asset('images/bukit2.jpg') }}" alt="Perbukitan" class="img-fluid rounded shadow-sm mb-3">
                <h4 class="text-light">Perbukitan Hijau</h4>
                <p class="text-light-50">
                    Rasakan petualangan mendaki bukit dengan lanskap memukau. Cocok untuk penyuka alam dan pencari ketenangan di ketinggian.
                </p>
            </div>
            <div class="col-md-4 mb-4">
                <img src="{{ asset('images/kerja1.jpg') }}" alt="Pemandangan Desa" class="img-fluid rounded shadow-sm mb-3">
                <h4 class="text-light">Panorama Padukuhan</h4>
                <p class="text-light-50">
                    Abadikan keindahan padukuhan yang asri dan bersahaja. Pemandangan yang memperlihatkan keseharian warga dalam harmoni dengan alam.
                </p>
            </div>
            <div class="col-md-4 mb-4">
                <img src="{{ asset('images/bukit1.jpg') }}" alt="Trasering Sawah" class="img-fluid rounded shadow-sm mb-3">
                <h4 class="text-light">Trasering</h4>
                <p class="text-light-50">
                    Susunan tanaman bertingkat yang memanjakan mata, simbol kerja keras petani kami sekaligus daya tarik visual khas padukuhan.
                </p>
            </div>
        </div>
        <div class="image-grid">
            <img src="{{ asset('images/singkong1.jpg') }}" alt="Gambar Lanskap 1">
            <img src="{{ asset('images/jalan8.jpg') }}" alt="Gambar Lanskap 2">
            <img src="{{ asset('images/jalan5.jpg') }}" alt="Gambar Lanskap 3">
            <img src="{{ asset('images/balai6.jpg') }}" alt="Gambar Lanskap 3">
            <img src="{{ asset('images/balai5.jpg') }}" alt="Gambar Lanskap 3">
        </div>
    </div>
</section>

{{-- New Section: Kegiatan Lokal Padukuhan Kerjo --}}
<section class="content-detail-section">
    <div class="container">
        <h3 class="text-center">Kehidupan Sosial dan Budaya Padukuhan Kerjo</h3>
        <p class="text-center mb-5">
            Padukuhan Kerjo, Ngestirejo, Gunungkidul tidak hanya dikenal karena keindahan alamnya, tapi juga kekayaan budaya dan semangat kebersamaan warganya. Dari kegiatan bercocok tanam hingga seni tari tradisional dan gotong royong, inilah kekuatan padukuhan kami.
        </p>

        <div class="row">
            <div class="col-md-6 mb-4">
                <h4>Bercocok Tanam & Kemandirian Pangan</h4>
                <p>Warga Kerjo menanam tanaman pangan lokal seperti singkong, kacang, dan pisang yang menjadi bagian penting dari kemandirian pangan dan warisan pertanian padukuhan.</p>
                <ul>
                    <li><i class="fas fa-seedling"></i> Penanaman singkong di lahan kering berbasis tradisional.</li>
                    <li><i class="fas fa-apple-alt"></i> Pemanfaatan pekarangan untuk menanam pisang dan kacang.</li>
                    <li><i class="fas fa-hand-holding-water"></i> Pengelolaan kebun secara gotong royong antar warga.</li>
                </ul>
            </div>

            <div class="col-md-6 mb-4">
                <h4>Kebudayaan dan Kehidupan Sosial</h4>
                <p>Tari Doger menjadi ekspresi budaya yang dijaga oleh para seniman lokal. Selain itu, gotong royong dan arisan rutin menjadi sarana mempererat hubungan sosial antarwarga.</p>
                <ul>
                    <li><i class="fas fa-music"></i> Pelatihan dan pertunjukan Tari Doger oleh kelompok seni padukuhan.</li>
                    <li><i class="fas fa-people-arrows"></i> Gotong royong untuk perbaikan jalan, kebersihan lingkungan, dan kegiatan umum lainnya.</li>
                    <li><i class="fas fa-coins"></i> Arisan bulanan sebagai sarana solidaritas ekonomi dan sosial warga.</li>
                </ul>
            </div>
        </div>

        <div class="highlight-box text-center mt-5">
            <h4>Ikut Rasakan Kehangatan Hidup di Padukuhan Kerjo</h4>
            <p>Dengan mengunjungi Padukuhan Kerjo, Anda tidak hanya menikmati keindahan alam, tapi juga merasakan kekayaan tradisi dan kekompakan masyarakat kami.</p>
            <p>Ayo datang, bergabung dalam kegiatan padukuhan, dan jadilah bagian dari keluarga besar Padukuhan Kerjo!</p>
        </div>
    </div>
</section>

@endsection