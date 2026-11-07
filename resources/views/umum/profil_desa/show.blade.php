@extends('layouts.app')

@section('content')

{{-- **START OF INLINE CSS FOR PROFIL DESA (DEBUGGING/TEMPORARY)** --}}
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

    /* --- Solusi Jarak dari Navbar Fixed --- */
    /* Ini akan mendorong seluruh konten halaman ke bawah, sesuai tinggi navbar fixed-top.  */
    body {
        /*
        * Coba tingkatkan padding-top ini sedikit demi sedikit jika masih ada jarak. 
        * Periksa tinggi navbar Anda di browser DevTools (F12) untuk nilai yang akurat. 
        * Misalnya, jika navbar Anda 70px, coba 70px, atau 75px jika ada border/shadow. 
        */
        padding-top: 75px !important; /* Ditingkatkan sedikit dan ditambahkan !important  */
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

    /* Media queries untuk responsivitas padding-top body */
    @media (max-width: 991.98px) { /* Untuk tablet dan layar lebih kecil */
        body {
            padding-top: 68px !important; /* Sesuaikan dengan tinggi navbar tablet Anda  */
        }
        .image-grid {
            gap: 1.5rem; /* cite: 110 */
        }
        .image-grid img {
            width: 250px; /* Sesuaikan lebar gambar untuk tablet */
            height: 200px; /* cite: 111 */
        }
    }
    @media (max-width: 767.98px) { /* Untuk mobile dan layar sangat kecil */
        body {
            padding-top: 58px !important; /* Sesuaikan dengan tinggi navbar mobile Anda  */
        }
        .image-grid {
            gap: 1rem; /* cite: 118 */
        }
        .image-grid img {
            width: 200px; /* Sesuaikan lebar gambar untuk ponsel */
            height: 180px; /* cite: 119 */
        }
    }

    /* --- Solusi Foto Background Kecil-kecil Banyak --- */
    /* Pastikan properti ini ada dan aktif untuk detail-hero-section */
    .detail-hero-section {
        background-size: cover; /* Gambar akan menutupi seluruh area section  */
        background-position: center; /* Gambar akan terpusat di tengah */
        background-repeat: no-repeat; /* Gambar tidak akan diulang  */
        /* Anda bisa menambahkan atau menyesuaikan tinggi jika perlu */
        height: 550px; /* Contoh tinggi  */
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: var(--text-light);
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8); /* Tambahkan shadow agar lebih kontras  */
        padding: 8rem 0; /* Memberi ruang di atas dan bawah */
        margin-bottom: 5rem; /* Jarak bawah yang signifikan */
    }

    .detail-hero-section .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
        z-index: 1;
    }

    .detail-hero-section .container {
        position: relative;
        z-index: 2;
    }

    .detail-hero-section h1 {
        font-family: 'Playfair Display', serif;
        font-size: 4.5rem;
        margin-bottom: 1rem;
        color: var(--text-light); /* Pastikan teks putih  */
        line-height: 1.1;
        font-weight: 700;
    }

    .detail-hero-section p.lead {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.5rem;
        font-weight: 300;
        max-width: 800px;
        margin: 0 auto;
    }

    /* --- CSS Tambahan Lain yang Mungkin Anda Pindahkan dari layouts/app.blade.php --- */
    /* Contoh jika Anda ingin memastikan custom-breadcrumb tidak punya margin-top lagi */
    .custom-breadcrumb {
        margin-top: 0 !important; /* Pastikan tidak ada margin tambahan dari luar  */
    }

    /* Gaya untuk info-block (dari pembahasan sebelumnya) */
    .info-block {
        background-color: var(--card-bg); 
        border-radius: 12px;
        padding: 2rem;
        box-shadow: var(--shadow-medium);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%; /* Pastikan tinggi block konsisten dalam satu baris  */
        display: flex;
        flex-direction: column;
        align-items: center; /* Ikon dan teks di tengah  */
        text-align: center; 
    }

    .info-block:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-deep); 
    }

    .info-block h3 {
        color: var(--primary-accent);
        font-size: 1.8rem;
        margin-bottom: 1rem; 
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .info-block h3 i {
        color: var(--secondary-accent); 
        font-size: 2rem;
        margin-right: 10px;
    }

    .info-block p {
        font-size: 1rem;
        color: var(--text-dark); 
        line-height: 1.6;
        flex-grow: 1; /* Agar paragraf mengisi ruang yang tersedia */
    }

    /* Gaya untuk map-container */
    .map-container {
        position: relative; 
        padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
        height: 0;
        overflow: hidden;
        border-radius: 12px; 
        box-shadow: var(--shadow-medium);
        margin-bottom: 2rem;
    }

    .map-container iframe {
        position: absolute; 
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0; 
    }

    /* Custom Button Primary Accent */
    .btn-primary-accent {
        background-color: var(--primary-accent); 
        color: var(--text-light);
        border-color: var(--primary-accent);
        transition: all 0.3s ease;
    }

    .btn-primary-accent:hover {
        background-color: var(--secondary-accent); 
        border-color: var(--secondary-accent);
        color: var(--text-light);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2); 
    }

    /* Styling for text content within sections */
    .description-content p,
    .pemerintahan-content p {
        font-size: 1.15rem; 
        line-height: 1.8;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
    }

    .description-content p:last-child,
    .pemerintahan-content p:last-child {
        margin-bottom: 0; 
    }

    /* Responsive untuk struktur/potensi sections */
    @media (max-width: 767.98px) {
        .description-content p,
        .pemerintahan-content p {
            font-size: 1rem; 
        }
        .map-container {
            padding-bottom: 75%; /* 4:3 Aspect Ratio for smaller screens */
        }
    }

    /* Global Section Styling for Content */
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

    .detail-content-section ul {
        list-style: none;
        padding-left: 0;
    }

    .detail-content-section ul li {
        margin-bottom: 0.8rem;
        font-size: 1rem;
        display: flex;
        align-items: flex-start;
    }

    .detail-content-section ul li i {
        color: var(--primary-accent);
        margin-right: 10px;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .img-fluid.rounded.shadow-lg {
        border-radius: 12px !important;
        box-shadow: var(--shadow-medium) !important;
    }

    .image-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .image-gallery img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: var(--shadow-light);
        transition: transform 0.3s ease-in-out;
    }

    .image-gallery img:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-medium);
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .detail-hero-section {
            height: 450px;
            padding: 6rem 0;
        }
        .detail-hero-section h1 {
            font-size: 3.5rem;
        }
        .detail-hero-section p.lead {
            font-size: 1.3rem;
        }
        .detail-content-section {
            padding: 4rem 0;
        }
        .detail-content-section h2 {
            font-size: 3rem;
        }
        .detail-content-section h3 {
            font-size: 2.2rem;
        }
        .detail-content-section p {
            font-size: 1rem;
        }
        .image-gallery {
            gap: 1rem;
        }
        .image-gallery img {
            height: 180px;
        }
    }

    @media (max-width: 767.98px) {
        .detail-hero-section {
            height: 380px;
            padding: 5rem 0;
        }
        .detail-hero-section h1 {
            font-size: 2.8rem;
        }
        .detail-hero-section p.lead {
            font-size: 1.1rem;
        }
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
        .detail-content-section ul li {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 575.98px) {
        .detail-hero-section h1 {
            font-size: 2.2rem;
        }
        .detail-hero-section p.lead {
            font-size: 0.9rem;
        }
    }

    /* Pastikan gradient background ada */
    .bg-light-gradient {
        background: linear-gradient(to bottom, var(--background-light), var(--border-color)); 
    }
</style>
{{-- **END OF INLINE CSS FOR PROFIL DESA** --}}

{{-- Hero Section untuk Profil Desa --}}
{{-- Menggunakan class detail-hero-section untuk konsistensi dengan halaman detail lainnya --}}
<section class="detail-hero-section" style="background-image: url('{{ asset('storage/profil-desa/' . $profilDesa->gambar_desa) }}');">
    <div class="overlay"></div>
    <div class="container text-center text-light position-relative" style="z-index: 2;">
        <h1 class="animate__animated animate__fadeInDown">{{ $profilDesa->nama_desa }}</h1>
        <p class="lead lead-description animate__animated animate__fadeInUp animate__delay-1s">
            Membangun masa depan gemilang dengan akar tradisi yang kuat. 
        </p>
    </div>
</section>

{{-- Detail Content Section - Sejarah Desa --}}
<section class="detail-content-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Sejarah Singkat Padukuhan Kerjo</h2>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/Balai5.jpg') }}" alt="Pemandangan Desa Dulu" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-6 description-content">
                <p>Padukuhan Kerjo, sebuah permata tersembunyi di pedalaman, memiliki sejarah yang kaya dan berakar kuat pada nilai-nilai gotong royong serta kearifan lokal. Tanah subur dan sumber daya alam melimpah menjadi fondasi utama kehidupan masyarakat di sini.</p>
                <p>Generasi awal padukuhan adalah para petani dan pengrajin ulung yang tidak hanya mengolah tanah, tetapi juga menciptakan karya seni bernilai tinggi. Mereka hidup berdampingan dengan alam, menghormati setiap pemberiannya, dan mewariskan tradisi turun-temurun yang masih dijaga hingga kini. Cerita-cerita tentang perjuangan dan keberhasilan mereka menjadi inspirasi bagi setiap generasi penerus.</p>
            </div>
        </div>
        <div class="row align-items-center mt-5">
            <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                <img src="{{ asset('images/pantai6.jpg') }}" alt="Tradisi Desa" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-6 order-lg-1 description-content">
                <p>Seiring berjalannya waktu, Padukuhan Kerjo mengalami berbagai transformasi. Pembangunan infrastruktur modern mulai masuk, namun tidak mengikis identitas aslinya. Padukuhan ini berhasil memadukan kemajuan dengan kelestarian budaya, menciptakan harmoni yang unik. Banyak inisiatif lokal lahir dari semangat warga untuk melestarikan tradisi sambil menyambut inovasi.</p>
                <p>Momentum penting dalam sejarah padukuhan adalah ketika pariwisata berbasis masyarakat mulai berkembang, membawa dampak positif pada ekonomi lokal tanpa merusak lingkungan. Kisah-kisah tentang keramahan penduduk dan keindahan alamnya mulai menyebar, menjadikan Padukuhan Kerjo destinasi yang dicari. Hingga hari ini, Padukuhan Kerjo terus berkembang, menjadi contoh bagaimana tradisi dan kemajuan bisa berjalan seiring.</p>
            </div>
        </div>
    </div>
</section>

{{-- Detail Content Section - Visi & Misi --}}
<section class="detail-content-section bg-dark-section" style="background: #064a9e">
    <div class="container">
        <h2 class="text-center text-light mb-5">Visi & Misi Padukuhan Kerjo</h2>
        <div class="row">
            {{-- Visi --}}
            <div class="col-lg-6 mb-4 mb-lg-0 text-light">
                <h3>Visi Kami</h3>
                <p>Menjadi Padukuhan Kerjo yang mandiri, sejahtera, berbudaya, dan berwawasan lingkungan, dengan partisipasi aktif seluruh elemen masyarakat.</p>
                
                {{-- Grid gambar sejajar --}}
                <div class="row mt-3 g-2">
                    <div class="col-6">
                        <img src="{{ asset('images/balai5.jpg') }}" alt="Visi Desa" class="img-fluid rounded shadow-lg w-100">
                    </div>
                    <div class="col-6">
                        <img src="{{ asset('images/warga9.jpg') }}" alt="Visi Desa" class="img-fluid rounded shadow-lg w-100">
                    </div>
                </div>
            </div>

            {{-- Misi --}}
            <div class="col-lg-6 text-light">
                <h3>Misi Kami</h3>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle"></i> Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan yang berkelanjutan.</li>
                    <li><i class="fas fa-check-circle"></i> Mengembangkan potensi ekonomi lokal berbasis UMKM dan pariwisata berkelanjutan.</li>
                    <li><i class="fas fa-check-circle"></i> Melestarikan nilai-nilai budaya dan kearifan lokal sebagai identitas padukuhan.</li>
                    <li><i class="fas fa-check-circle"></i> Menciptakan lingkungan padukuhan yang bersih, sehat, aman, dan nyaman.</li>
                    <li><i class="fas fa-check-circle"></i> Meningkatkan kualitas pelayanan publik dan transparansi pemerintahan padukuhan.</li>
                    <li><i class="fas fa-check-circle"></i> Mendorong partisipasi aktif masyarakat dalam setiap proses pembangunan padukuhan.</li>
                </ul>
                
                {{-- Grid gambar sejajar --}}
                <div class="row mt-3 g-2">
                    <div class="col-6">
                        <img src="{{ asset('images/warga3.jpg') }}" alt="Misi Desa" class="img-fluid rounded shadow-lg w-100">
                    </div>
                    <div class="col-6">
                        <img src="{{ asset('images/kerja1.jpg') }}" alt="Misi Desa" class="img-fluid rounded shadow-lg w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Detail Content Section - Profil Padukuhan Kerjo --}}
<section class="detail-content-section">
    <div class="container">
        <h2 class="text-center mb-5">Profil Padukuhan Kerjo</h2>
        <p class="text-center lead mb-5">
            Padukuhan Kerjo terletak di Kalurahan Ngastirejo, Kecamatan Tanjungsari, Gunungkidul. Wilayah ini dikenal dengan keindahan alamnya, keramahan warganya, serta semangat gotong-royong yang tinggi dalam menjaga kearifan lokal dan kelestarian lingkungan.
        </p>

        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/balai5.jpg') }}" alt="Padukuhan Kerjo" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h3 class="mb-3">Tentang Padukuhan Kerjo</h3>
                <p>
                    Padukuhan Kerjo merupakan salah satu padukuhan di Kalurahan Ngastirejo yang memiliki potensi wisata alam, pertanian, dan budaya. Warga di padukuhan ini mayoritas bermata pencaharian sebagai petani dan pengrajin, dengan hasil bumi seperti singkong, jagung, dan hasil kebun lainnya yang menjadi penopang ekonomi masyarakat.
                </p>
                <p>
                    Selain itu, Padukuhan Kerjo juga memiliki berbagai kegiatan sosial seperti kegiatan posyandu, kelompok tani, serta kegiatan keagamaan yang rutin dilaksanakan untuk menjaga kekompakan dan silaturahmi antarwarga.
                </p>
                <p>
                    Dengan suasana padukuhan yang asri, pemandangan sawah yang hijau, serta udara yang masih sejuk, Padukuhan Kerjo menjadi tempat yang nyaman untuk dikunjungi bagi Anda yang ingin merasakan ketenangan padukuhan sekaligus belajar tentang kehidupan masyarakat padukuhan yang penuh nilai kekeluargaan.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- New Section: Potensi Unggulan Desa --}}
<section class="detail-content-section bg-dark-section" style="background: #064a9e">
    <div class="container">
        <h2 class="text-center text-light mb-5">Potensi Unggulan Padukuhan Kerjo</h2>
        <p class="text-center text-light-50 lead mb-5">Padukuhan Kerjo diberkahi dengan beragam potensi yang siap untuk dikembangkan, dari keindahan alam hingga kekayaan budaya dan sumber daya manusia yang produktif.</p>

        <div class="row mb-5 align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/pantai6.jpg') }}" alt="Potensi Wisata" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-6 text-light">
                <h3><i class="fas fa-map-marked-alt"></i> Wisata Alam & Budaya</h3>
                <p>Padukuhan kami menawarkan pesona alam yang memukau, mulai dari persawahan hijau yang membentang luas, sungai jernih, hingga hutan pinus yang menenangkan. Tidak hanya itu, kekayaan budaya seperti seni tari tradisional, kerajinan tangan, dan upacara adat masih lestari dan menjadi daya tarik tersendiri bagi wisatawan.</p>
                <p>Kami terus mengembangkan ekowisata dan padukuhan wisata yang melibatkan masyarakat lokal, memastikan keberlanjutan lingkungan dan peningkatan kesejahteraan warga.</p>
            </div>
        </div>

        <div class="row mb-5 align-items-center">
            <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                <img src="{{ asset('images/singkong1.jpg') }}" alt="Potensi UMKM" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-6 order-lg-1 text-light">
                <h3><i class="fas fa-store"></i> Produk UMKM Unggulan</h3>
                <p>Semangat kewirausahaan warga Padukuhan Kerjo tercermin dari berbagai produk UMKM berkualitas tinggi. Mulai dari olahan makanan tradisional, kerajinan bambu, batik tulis, hingga produk pertanian organik, semuanya dibuat dengan cinta dan dedikasi.</p>
                <p>Pemerintah padukuhan aktif mendukung UMKM melalui pelatihan, fasilitasi pemasaran, dan pengembangan inovasi produk agar dapat bersaing di pasar yang lebih luas.</p>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="{{ asset('images/doger4.jpg') }}" alt="Potensi Komunitas" class="img-fluid w-100 rounded shadow-lg" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-lg-6 text-light">
                <h3><i class="fas fa-people-arrows"></i> Sumber Daya Manusia & Komunitas</h3>
                <p>Kekuatan terbesar Padukuhan Kerjo adalah masyarakatnya. Dengan semangat gotong royong yang tinggi dan kepedulian antar sesama, berbagai komunitas aktif bergerak di bidang pendidikan, lingkungan, seni, dan olahraga. Warga padukuhan juga memiliki keterampilan tradisional yang unik dan siap diwariskan kepada generasi muda.</p>
                <p>Kami percaya bahwa dengan memberdayakan individu dan komunitas, padukuhan ini akan terus tumbuh dan berinovasi.</p>
            </div>
        </div>
    </div>
</section>

{{-- New Section: Galeri Foto Desa --}}
<section class="detail-content-section">
    <div class="container">
        <h2 class="text-center mb-5">Jelajahi Padukuhan Kerjo dalam Gambar</h2>
        <p class="text-center lead mb-5">Sebuah koleksi visual yang menangkap esensi kehidupan, keindahan alam, dan budaya yang kaya di padukuhan kami. Setiap foto menceritakan kisah.</p>
        <div class="image-grid">
            <img src="{{ asset('images/jalan4.jpg') }}" alt="Pemandangan Sawah">
            <img src="{{ asset('images/jalan5.jpg') }}" alt="Rumah Adat">
            <img src="{{ asset('images/jalan6.jpg') }}" alt="Kerajinan Tangan">
            <img src="{{ asset('images/warga2.jpg') }}" alt="Festival Desa">
            <img src="{{ asset('images/jalan11.jpg') }}" alt="Anak Bermain">
            <img src="{{ asset('images/jalan13.jpg') }}" alt="Sungai Jernih">
            <img src="{{ asset('images/jalan9.jpg') }}" alt="Puskesmas Desa">
            <img src="{{ asset('images/kerja1.jpg') }}" alt="Pasar Tradisional">
        </div>
    </div>
</section>

{{-- Detail Content Section - Hubungi Kami --}}
<section class="detail-content-section bg-dark-section" style="background: #064a9e">
    <div class="container">
        <h2 class="text-center text-light mb-5">Kunjungi atau Hubungi Kami</h2>
        <p class="text-center text-light-50 lead mb-5">Kami sangat senang menyambut Anda di Padukuhan Kerjo atau menjawab pertanyaan Anda. Jangan ragu untuk menghubungi kami melalui informasi di bawah ini.</p>

        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="map-container">
                    {{-- Ganti dengan embed peta Google Maps yang sebenarnya dari lokasi desa Anda --}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.0828218906317!2d110.6147001!3d-8.0930365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7bb14ffebef00f%3A0x5b6d22458a9835e4!2sKepala%20Dukuh%20Kerjo!5e0!3m2!1sen!2sid!4v1753169795810!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="text-center mt-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <p class="lead text-light">Kunjungi kami di jantung padukuhan yang damai dan asri.</p>
                    {{-- Ganti dengan URL Google Maps yang sebenarnya untuk petunjuk arah --}}
                    <a href="https://maps.app.goo.gl/pV7JrfNTZS14oTFv9" target="_blank" class="btn btn-primary-accent btn-lg mt-3">Dapatkan Petunjuk Arah <i class="fas fa-map-marker-alt ms-2"></i></a>
                </div>
            </div>
        </div>

        <div class="row text-center mt-5">
            <div class="col-md-4 mb-4">
                <div class="info-block bg-white text-dark h-100">
                    <h3 style="color: #1A1A1A"><i class="fas fa-phone-alt"></i> Telepon</h3>
                    <p style="color: #1A1A1A">+62 882-2736-4723</p>
                    <p class="text-muted">Jam Kerja (Fleksibel).</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-block bg-white text-dark h-100">
                    <h3 style="color: #1A1A1A"><i class="fas fa-envelope"></i> Email</h3>
                    <p style="color: #1A1A1A">padukuhankerjo@gmail.com</p>
                    <p class="text-muted">Respon (Fleksibel).</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="info-block bg-white text-dark h-100">
                    <h3 style="color: #1A1A1A"><i class="fas fa-map-marker-alt"></i> Alamat</h3>
                    <p style="color: #1A1A1A">Kerjo, Ngestirejo, Kec. Tanjungsari, Kabupaten Gunungkidul, Daerah Istimewa Yogyakarta 55881</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Detail Content Section - Denah Padukuhan --}}
<section class="detail-content-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4" style="color: black">Denah Padukuhan Kerjo</h2>
        <p class="text-center text-muted lead mb-4">Lihat gambaran visual wilayah Padukuhan Kerjo untuk membantu navigasi dan pemahaman lokasi fasilitas padukuhan kami.</p>

        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <a href="{{ asset('images/rangga1.jpg') }}" target="_blank">
                    <img src="{{ asset('images/rangga1.jpg') }}" alt="Denah Padukuhan Kerjo"
                         class="img-fluid rounded shadow-lg w-100"
                         style="object-fit: contain; width: 100%;">
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <p class="text-muted fs-5">
                    Denah ini menggambarkan berbagai fasilitas umum dan lokasi penting di Padukuhan Kerjo, termasuk balai dusun, tempat ibadah, akses jalan utama, serta area pemukiman warga.
                    Anda dapat mengklik gambar di atas untuk melihat versi resolusi penuh.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection