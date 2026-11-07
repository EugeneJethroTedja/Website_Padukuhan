@extends('layouts.app')

@section('content')
<style>
    /* Mengimpor Font Google */
    /* Playfair Display untuk judul yang elegan, Montserrat untuk teks modern & bersih */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;500;700&display=swap'); /* cite: 1 */

    /* Variabel Warna Global (Palet Monokromatik & Netral untuk kesan mewah) */
    :root {
        --primary-accent: #2e7eff; /* cite: 2 */ /* Blue-Grey Dark - "Biru susu tua" yang elegan untuk aksen utama */
        --secondary-accent: #064a9e; /* cite: 3 */ /* Blue-Grey Light - Untuk aksen sekunder/hover */
        --heading-dark: #212529; /* cite: 4 */ /* Very dark almost black for main headings */
        --text-dark: #343A40; /* cite: 5 */ /* Dark grey for body text */
        --text-light: #DEE2E6; /* cite: 6 */ /* Very light grey for text on dark backgrounds */
        --background-light: #F8F9FA; /* cite: 7 */ /* Off-white for main background */
        --background-dark: #2C3034; /* cite: 8 */ /* Deep charcoal for section backgrounds */
        --border-color: #E9ECEF; /* cite: 9 */ /* Light border color for separation */
        --overlay-dark: rgba(0, 0, 0, 0.65); /* cite: 10 */ /* Dark overlay for hero/section images */
        --card-bg: #FFFFFF; /* cite: 11 */ /* Pure white for card backgrounds */
        --footer-bg: #1A1A1A; /* cite: 12 */ /* Hampir hitam untuk footer */
        --footer-text: #CED4DA; /* cite: 13 */ /* Teks terang untuk footer */
    }

    body {
        background-color: var(--background-light); /* cite: 14 */
        font-family: 'Montserrat', sans-serif; /* cite: 15 */
        color: var(--text-dark);
        overflow-x: hidden; /* Mencegah scroll horizontal pada body */
    }

    /* Jumbotron / Hero Section */
    .hero-section {
        background: linear-gradient(var(--overlay-dark), var(--overlay-dark)), url('images/h1.jpg') center center no-repeat; /* cite: 16 */
        background-size: cover; /* cite: 16 */
        color: var(--text-light);
        padding: 10rem 2rem; /* Padding lebih besar untuk kesan luas */
        text-shadow: 0px 4px 12px rgba(0, 0, 0, 0.4); /* cite: 17 */
        margin-bottom: 6rem; /* Jarak bawah yang signifikan */
        position: relative;
        overflow: hidden; /* cite: 18 */ /* Pastikan konten tidak keluar */
        display: flex;
        align-items: center;
        justify-content: center; /* cite: 19 */
        flex-direction: column;
        text-align: center;
        border-bottom: 8px solid var(--primary-accent); /* Garis bawah yang kuat */
    }

    .hero-section::before {
        content: ''; /* cite: 20 */
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.8) 100%); /* cite: 21 */ /* Radial gradient untuk fokus */
        z-index: 1; /* cite: 22 */
    }

    .hero-section .container {
        position: relative;
        z-index: 2; /* cite: 23 */ /* Pastikan konten di atas overlay */
        max-width: 900px; /* cite: 24 */ /* Batasi lebar konten untuk fokus */
    }

    .hero-section h1 {
        font-family: 'Playfair Display', serif; /* cite: 25 */
        font-size: 5.5rem; /* cite: 25 */
        margin-bottom: 1.5rem;
        line-height: 1.1;
        letter-spacing: 0.15rem; /* Lebih jarang */
        font-weight: 700; /* cite: 26 */
        animation: fadeInDown 1.5s ease-out forwards;
        color: var(--text-light); /* Ensure hero text is light */
    }

    .hero-section .lead {
        font-family: 'Montserrat', sans-serif; /* cite: 27 */
        font-size: 2.2rem; /* cite: 27 */
        font-weight: 300;
        margin-bottom: 2.5rem;
        animation: fadeInUp 1.5s ease-out forwards 0.3s; /* cite: 28 */
        color: var(--text-light); /* Ensure hero text is light */
    }

    .hero-section .btn-hero {
        padding: 1.2rem 3.5rem;
        font-size: 1.5rem; /* cite: 29 */
        border-radius: 50px; /* Bentuk pil untuk sentuhan modern */
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); /* cite: 30 */
        background-color: transparent;
        border: 2px solid var(--text-light); /* Border putih */
        color: var(--text-light); /* cite: 31 */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        font-weight: 500;
        letter-spacing: 0.05rem;
        animation: fadeIn 1.5s ease-out forwards 0.6s; /* cite: 32 */
    }

    .hero-section .btn-hero:hover {
        transform: translateY(-7px) scale(1.02); /* cite: 33 */
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4); /* cite: 33 */
        background-color: var(--text-light);
        color: var(--heading-dark);
        border-color: var(--text-light); /* cite: 34 */
    }

    /* Section Global Styles */
    .blog-section {
        background-color: var(--background-dark); /* cite: 35 */ /* Latar belakang gelap untuk setiap bagian */
        padding: 6rem 0; /* cite: 36 */ /* Padding vertikal konsisten */
        margin-bottom: 5rem; /* cite: 37 */ /* Jarak antar bagian */
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.2); /* cite: 38 */
        position: relative;
        overflow: hidden; /* Untuk memastikan scrollbar tidak keluar */
    }

    .section-header {
        text-align: center; /* cite: 39 */
        margin-bottom: 4rem; /* Jarak bawah judul */
        position: relative;
        z-index: 1; /* cite: 40 */ /* Pastikan judul di atas overlay jika ada */
    }

    .section-header h2 {
        font-family: 'Playfair Display', serif; /* cite: 41 */
        font-size: 3.8rem; /* cite: 41 */
        color: var(--text-light); /* Warna teks terang di latar gelap */
        font-weight: 700; /* cite: 42 */
        padding-bottom: 20px;
        position: relative;
        display: inline-block; /* Agar after pseudo-element mengikuti lebar teks */
    }

    .section-header h2::after {
        content: ''; /* cite: 43 */
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: 0;
        width: 100px;
        height: 4px;
        background-color: var(--primary-accent); /* cite: 44 */ /* Garis bawah "biru susu tua" */
        border-radius: 2px; /* cite: 45 */
    }

    /* Scrollable Cards Container */
    .scrollable-cards-container {
        display: flex; /* cite: 46 */
        flex-wrap: nowrap; /* Mencegah wrap ke bawah */
        overflow-x: auto; /* cite: 47 */ /* Memungkinkan scroll horizontal */
        -webkit-overflow-scrolling: touch; /* cite: 48 */ /* Smooth scrolling di iOS */
        padding: 1rem 3rem 2.5rem 3rem; /* cite: 49 */ /* Padding horizontal dan bawah untuk scrollbar */
        scrollbar-width: thin; /* cite: 50 */ /* Firefox */
        scrollbar-color: var(--primary-accent) var(--background-dark); /* cite: 51 */ /* Warna scrollbar */
    }

    .scrollable-cards-container::-webkit-scrollbar {
        height: 12px; /* cite: 52 */ /* Tinggi scrollbar */
    }

    .scrollable-cards-container::-webkit-scrollbar-track {
        background: var(--background-dark); /* cite: 53 */ /* Track background */
        border-radius: 10px; /* cite: 54 */
    }

    .scrollable-cards-container::-webkit-scrollbar-thumb {
        background: var(--primary-accent); /* cite: 55 */ /* Warna thumb */
        border-radius: 10px;
        border: 3px solid var(--background-dark); /* cite: 56 */ /* Border agar thumb menonjol */
    }

    .scrollable-cards-container::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-accent); /* cite: 57 */ /* Warna thumb saat hover */
    }

    /* Kolom untuk Kartu dalam Scrollable Container */
    .scrollable-cards-container .col-md-4 {
        flex: 0 0 auto; /* cite: 58 */ /* Mencegah item menyusut/meregang */
        width: 380px; /* cite: 59 */ /* Lebar tetap untuk setiap kartu */
        margin-right: 2.5rem; /* cite: 60 */ /* Jarak antar kartu */
    }

    .scrollable-cards-container .col-md-4:last-child {
        margin-right: 0; /* cite: 61 */ /* Hapus margin kanan pada kartu terakhir */
    }

    /* Card Styling */
    .card-blog {
        border: none; /* cite: 62 */
        border-radius: 12px; /* Sudut membulat yang elegan */
        overflow: hidden; /* cite: 63 */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
        transition: transform 0.4s ease-out, box-shadow 0.4s ease-out; /* cite: 64 */
        background-color: var(--card-bg); /* Latar belakang kartu putih bersih */
        height: 100%; /* cite: 65 */ /* Pastikan semua kartu memiliki tinggi yang sama */
        display: flex;
        flex-direction: column; /* cite: 66 */
    }

    .card-blog:hover {
        transform: translateY(-15px); /* cite: 67 */ /* Lift up effect */
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.2); /* cite: 68 */ /* Bayangan lebih dramatis */
    }

    .card-blog .card-img-top {
        height: 280px; /* cite: 69 */ /* Tinggi gambar konsisten */
        object-fit: cover;
        width: 100%;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px; /* cite: 70 */
    }

    .card-blog .card-body {
        padding: 2rem; /* cite: 71 */ /* Padding konten kartu */
        flex-grow: 1; /* cite: 72 */ /* Memungkinkan body memenuhi sisa ruang */
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* cite: 73 */ /* Dorong tombol ke bawah */
    }

    .card-blog .card-title {
        font-family: 'Playfair Display', serif; /* cite: 74 */
        font-size: 1.9rem; /* cite: 74 */
        color: var(--heading-dark);
        margin-bottom: 0.8rem;
        line-height: 1.3;
        font-weight: 700; /* cite: 75 */
    }

    .card-blog .card-text {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.05rem; /* cite: 76 */
        color: var(--text-dark);
        line-height: 1.7;
        margin-bottom: 1.5rem;
        flex-grow: 1; /* Biarkan teks mengisi ruang */
    }

    .card-blog .btn-read-more {
        background-color: var(--primary-accent); /* cite: 77 */ /* Tombol dengan warna "biru susu tua" */
        color: var(--text-light);
        border: none; /* cite: 78 */
        padding: 0.8rem 1.8rem;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        align-self: flex-start; /* cite: 79 */ /* Selaraskan ke kiri */
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05rem; /* cite: 80 */
    }

    .card-blog .btn-read-more:hover {
        background-color: var(--secondary-accent); /* cite: 81 */ /* Warna hover yang lebih terang dari "biru susu tua" */
        transform: translateY(-3px); /* cite: 82 */
    }

    /* Override Bootstrap Success Button (if used elsewhere in layout) */
    .btn-outline-success { /* Ini untuk tombol di card sebelumnya */
        border-color: var(--primary-accent) !important; /* cite: 83 */
        color: var(--primary-accent) !important;
    }

    .btn-outline-success:hover {
        background-color: var(--primary-accent) !important; /* cite: 84 */
        color: var(--text-light) !important;
    }

    /* Styling for the footer (assuming it's part of layouts.app or similar) */
    /* If the footer is not in this file, you'll need to apply these styles in a global CSS file or layouts.app */
    footer {
        background-color: var(--footer-bg); /* cite: 85 */ /* Latar belakang footer yang sangat gelap */
        color: var(--footer-text); /* cite: 86 */ /* Warna teks terang untuk kontras */
        padding: 3rem 0;
        font-family: 'Montserrat', sans-serif; /* cite: 87 */
        border-top: 5px solid var(--primary-accent); /* Garis atas dengan warna aksen */
    }

    footer h5 {
        font-family: 'Playfair Display', serif; /* cite: 88 */
        color: var(--text-light); /* Judul footer terang */
        margin-bottom: 1.5rem;
        font-weight: 700; /* cite: 89 */
    }

    footer ul {
        list-style: none;
        padding: 0; /* cite: 90 */
    }

    footer ul li {
        margin-bottom: 0.8rem; /* cite: 91 */
    }

    footer ul li a {
        color: var(--footer-text);
        text-decoration: none; /* cite: 92 */
        transition: color 0.3s ease;
    }

    footer ul li a:hover {
        color: var(--secondary-accent); /* cite: 93 */ /* Warna hover "biru susu tua" */
    }

    footer p {
        font-size: 0.95rem; /* cite: 94 */
        margin-bottom: 0.5rem;
    }

    footer .bottom-bar {
        border-top: 1px solid rgba(255, 255, 255, 0.1); /* cite: 95 */
        padding-top: 1.5rem;
        margin-top: 2rem;
        text-align: center;
        font-size: 0.85rem;
        color: var(--footer-text); /* cite: 96 */
    }

    /* Animasi */
    @keyframes fadeIn {
        from { opacity: 0; /* cite: 97 */ }
        to { opacity: 1; /* cite: 98 */ }
    }
    @keyframes fadeInDown {
        from { opacity: 0; /* cite: 99 */ transform: translateY(-50px); }
        to { opacity: 1; transform: translateY(0); /* cite: 100 */ }
    }
    @keyframes fadeInUp {
        from { opacity: 0; /* cite: 101 */ transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); /* cite: 102 */ }
    }

    /* New styles for general content sections */
    .content-section {
        background-color: var(--background-light);
        padding: 6rem 0; /* Consistent with blog-section padding for flow */
        color: var(--text-dark);
        margin-bottom: 5rem; /* Consistent with blog-section margin */
        box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.08); /* Lighter shadow for light sections */
        border-top: 1px solid var(--border-color); /* Subtle separation */
        border-bottom: 1px solid var(--border-color); /* Subtle separation */
    }

    .content-section.bg-dark {
        background-color: var(--background-dark);
        color: var(--text-light);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.2); /* Darker shadow for dark sections */
        border-top: none; /* No extra border for dark sections */
        border-bottom: none; /* No extra border for dark sections */
    }

    .content-section h3 {
        font-family: 'Playfair Display', serif;
        font-size: 3.8rem; /* Larger for section titles */
        margin-bottom: 2rem; /* More space below heading */
        color: var(--heading-dark);
        text-align: center; /* Center align section titles */
        position: relative;
        padding-bottom: 20px;
    }

    .content-section h3::after {
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

    .content-section.bg-dark h3 {
        color: var(--text-light);
    }

    .content-section p {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.15rem; /* Slightly larger for readability */
        line-height: 1.8;
        margin-bottom: 1.5rem;
        color: var(--text-dark); /* Default text color for light background */
    }

    .content-section.bg-dark p {
        color: var(--text-light); /* Text color for dark background */
    }

    .content-section .text-light-50 { /* For subtle text on dark background */
        color: rgba(222, 226, 230, 0.8); /* Adjusted text-light with opacity */
    }

    .image-collage {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Slightly larger min-width */
        gap: 2rem; /* Increased gap */
        margin-top: 4rem; /* More space above collage */
    }

    .image-collage img {
        width: 100%;
        height: 250px; /* Slightly taller images */
        object-fit: cover;
        border-radius: 12px; /* More rounded corners */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* More pronounced shadow */
        transition: transform 0.3s ease-in-out;
    }

    .image-collage img:hover {
        transform: scale(1.03); /* Subtle zoom on hover */
    }

    .feature-icon {
        color: var(--primary-accent);
        font-size: 4.5rem; /* Larger icons */
        margin-bottom: 1.5rem;
    }

    .content-section h4 {
        font-family: 'Playfair Display', serif;
        color: var(--heading-dark);
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .content-section.bg-dark h4 {
        color: var(--text-light);
    }

    .call-to-action-banner {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('images/cta-banner.jpg') center center no-repeat; /* Darker overlay */
        background-size: cover;
        padding: 10rem 2rem; /* More vertical padding */
        color: var(--text-light);
        text-align: center;
        margin-top: 6rem; /* More margin */
        margin-bottom: 6rem; /* More margin */
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 15px 40px rgba(0,0,0,0.4); /* Stronger shadow */
    }

    .call-to-action-banner h2 {
        font-family: 'Playfair Display', serif;
        font-size: 4.5rem; /* Larger CTA heading */
        margin-bottom: 2.5rem; /* More space */
        text-shadow: 0px 5px 15px rgba(0, 0, 0, 0.6); /* Stronger shadow */
        color: var(--text-light);
    }

    .call-to-action-banner p {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.8rem; /* Larger CTA text */
        margin-bottom: 3.5rem; /* More space */
        font-weight: 300;
        color: var(--text-light);
    }

    .call-to-action-banner .btn {
        background-color: var(--primary-accent);
        color: var(--text-light);
        border: 2px solid var(--primary-accent);
        padding: 1.4rem 4rem; /* Larger button */
        font-size: 1.6rem; /* Larger button text */
        border-radius: 50px;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1); /* Smoother transition */
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }

    .call-to-action-banner .btn:hover {
        background-color: var(--secondary-accent);
        border-color: var(--secondary-accent);
        transform: translateY(-8px); /* More pronounced lift */
        box-shadow: 0 18px 40px rgba(0,0,0,0.5); /* Stronger hover shadow */
    }


    /* Responsiveness */
    @media (max-width: 991.98px) {
        .hero-section {
            padding: 8rem 1.5rem; /* cite: 103 */
            margin-bottom: 4rem;
        }
        .hero-section h1 {
            font-size: 4rem; /* cite: 104 */
        }
        .hero-section .lead {
            font-size: 1.8rem; /* cite: 105 */
        }
        .hero-section .btn-hero {
            padding: 1rem 2.8rem; /* cite: 106 */
            font-size: 1.2rem;
        }
        .blog-section {
            padding: 4rem 0; /* cite: 107 */
            margin-bottom: 3rem;
        }
        .section-header h2 {
            font-size: 3rem; /* cite: 108 */
        }
        .scrollable-cards-container {
            padding: 1rem 1.5rem 2rem 1.5rem; /* cite: 109 */
        }
        .scrollable-cards-container .col-md-4 {
            width: 320px; /* cite: 110 */
            margin-right: 2rem;
        }
        .card-blog .card-img-top {
            height: 240px; /* cite: 111 */
        }
        .card-blog .card-body {
            padding: 1.5rem; /* cite: 112 */
        }
        .card-blog .card-title {
            font-size: 1.7rem; /* cite: 113 */
        }
        .card-blog .card-text {
            font-size: 0.95rem; /* cite: 114 */
        }
        .content-section {
            padding: 4rem 0;
            margin-bottom: 3rem;
        }
        .content-section h3 {
            font-size: 3rem;
        }
        .content-section p {
            font-size: 1rem;
        }
        .image-collage img {
            height: 200px;
        }
        .call-to-action-banner {
            padding: 6rem 1.5rem;
            margin-top: 4rem;
            margin-bottom: 4rem;
        }
        .call-to-action-banner h2 {
            font-size: 3.5rem;
        }
        .call-to-action-banner p {
            font-size: 1.4rem;
        }
        .call-to-action-banner .btn {
            padding: 1rem 2.8rem;
            font-size: 1.2rem;
        }
    }

    @media (max-width: 767.98px) {
        .hero-section {
            padding: 6rem 1rem; /* cite: 115 */
            margin-bottom: 3rem;
            border-bottom: 6px solid var(--primary-accent);
        }
        .hero-section h1 {
            font-size: 3rem; /* cite: 116 */
            letter-spacing: 0.05rem;
        }
        .hero-section .lead {
            font-size: 1.4rem; /* cite: 117 */
            margin-bottom: 2rem;
        }
        .hero-section .btn-hero {
            padding: 0.9rem 2.2rem; /* cite: 118 */
            font-size: 1.1rem;
        }
        .blog-section {
            padding: 3rem 0; /* cite: 119 */
            margin-bottom: 2rem;
        }
        .section-header h2 {
            font-size: 2.5rem; /* cite: 120 */
            margin-bottom: 2.5rem;
            padding-bottom: 15px;
        }
        .section-header h2::after {
            width: 80px; /* cite: 121 */
            height: 3px;
        }
        .scrollable-cards-container {
            padding: 0.5rem 1rem 1.5rem 1rem; /* cite: 122 */
        }
        .scrollable-cards-container .col-md-4 {
            width: 85%; /* cite: 123 */ /* Lebih lebar di mobile untuk scroll mudah */
            max-width: 300px; /* cite: 124 */
            margin-right: 1.5rem;
        }
        .card-blog {
            border-radius: 8px; /* cite: 125 */
        }
        .card-blog .card-img-top {
            height: 200px; /* cite: 126 */
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .card-blog .card-body {
            padding: 1.2rem; /* cite: 127 */
        }
        .card-blog .card-title {
            font-size: 1.5rem; /* cite: 128 */
            margin-bottom: 0.5rem;
        }
        .card-blog .card-text {
            font-size: 0.9rem; /* cite: 129 */
            margin-bottom: 1rem;
        }
        .card-blog .btn-read-more {
            padding: 0.7rem 1.5rem; /* cite: 130 */
            font-size: 0.85rem;
        }

        /* Footer Responsiveness */
        footer .col-md-4 {
            margin-bottom: 2rem; /* cite: 131 */
        }
        footer .col-md-4:last-child {
            margin-bottom: 0; /* cite: 132 */
        }
        .content-section {
            padding: 3rem 0;
            margin-bottom: 2rem;
        }
        .content-section h3 {
            font-size: 2.5rem;
        }
        .content-section p {
            font-size: 0.9rem;
        }
        .image-collage {
            grid-template-columns: 1fr; /* Single column on very small screens */
            gap: 1rem;
        }
        .image-collage img {
            height: 180px;
        }
        .feature-icon {
            font-size: 3.5rem;
        }
        .content-section h4 {
            font-size: 1.7rem;
        }
        .call-to-action-banner {
            padding: 4rem 1rem;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }
        .call-to-action-banner h2 {
            font-size: 2.8rem;
        }
        .call-to-action-banner p {
            font-size: 1.2rem;
        }
        .call-to-action-banner .btn {
            padding: 0.9rem 2.2rem;
            font-size: 1.1rem;
        }
    }
</style>

<section class="hero-section kegiatan-hero" style="background-image: url('{{ asset('images/balai4.jpg') }}'); margin-top: 10px;">
    <div class="overlay"></div>
    <div class="container text-center text-light position-relative" style="z-index: 2;">
       <h1>Selamat Datang di Padukuhan Kerjo</h1>
        <p class="lead">Temukan keindahan alam, kekayaan budaya, dan potensi lokal yang tak terlupakan.</p>
        <a class="btn btn-hero mt-4 animate__animated animate__zoomIn animate__delay-2s" style="background: #064a9e" href="{{ route('wisata_alam.index.umum') }}" role="button">Jelajahi Sekarang</a>
    </div>
</section>

{{-- About Desa Section --}}
<section class="content-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 order-md-2">
                <img src="{{ asset('images/kerja1.jpg') }}" alt="Pemandangan Desa Padukuhan Kerja" class="img-fluid rounded shadow-lg mb-4 mb-md-0">
            </div>
            <div class="col-md-6 order-md-1">
                <h3>Mengenal Lebih Dekat Padukuhan Kerjo</h3>
                <p>Padukuhan Kerjo adalah permata tersembunyi yang menawarkan perpaduan sempurna antara keindahan alam yang asri dan kearifan lokal yang terjaga. Terletak di jantung padukuhan, padukuhan kami menjadi rumah bagi lanskap hijau yang membentang luas, dan udara segar pegunungan yang menenangkan jiwa. Kami mengundang Anda untuk merasakan ketenangan dan keaslian hidup di padukuhan yang jarang ditemukan di era modern ini.</p>
                <p>Lebih dari sekadar pemandangan yang indah, Padukuhan Kerjo adalah komunitas yang hidup dengan semangat gotong royong dan tradisi yang kaya. Setiap sudut padukuhan menyimpan cerita, dari sawah terasering yang subur hingga rumah-rumah tradisional yang masih kokoh berdiri. Kami bangga dengan warisan budaya kami dan bersemangat untuk berbagi dengan dunia.</p>
            </div>
        </div>
    </div>
</section>

{{-- Filosofi & Visi Section --}}
<section class="content-section" style="background: #064a9e">
    <div class="container text-center">
        <h3 style="color: white">Filosofi dan Visi Kami</h3>
        <p class="text-light-50">Di Padukuhan Kerjo, kami percaya bahwa pembangunan harus berjalan seiring dengan pelestarian. Visi kami adalah menciptakan padukuhan yang mandiri, sejahtera, dan lestari, di mana kekayaan alam dan budaya menjadi fondasi kemajuan. Kami berkomitmen untuk:</p>
        <div class="row mt-5">
            <div class="col-md-4">
                <i class="fas fa-tree feature-icon mb-3"></i>
                <h4 style="color: white">Pelestarian Lingkungan</h4>
                <p class="text-light-50">Melindungi ekosistem alami padukuhan kerjo, menjaga keanekaragaman hayati, dan mempromosikan praktik ramah lingkungan untuk keberlanjutan masa depan.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-handshake feature-icon mb-3"></i>
                <h4 style="color: white">Pemberdayaan Masyarakat</h4>
                <p class="text-light-50">Meningkatkan kualitas hidup penduduk melalui pendidikan, kesehatan, dan pengembangan ekonomi lokal yang inklusif.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-palette feature-icon mb-3"></i>
                <h4 style="color: white">Pengembangan Budaya</h4>
                <p class="text-light-50">Melestarikan dan mempromosikan seni, tradisi, serta kearifan lokal sebagai identitas dan daya tarik Padukuhan Kerjo.</p>
            </div>
        </div>
        <div class="image-collage">
            <img src="{{ asset('images/doger4.jpg') }}" alt="Pantai">
            <img src="{{ asset('images/singkong6.jpg') }}" alt="Pantai">
            <img src="{{ asset('images/doger2.jpg') }}" alt="Pantai">
            <img src="{{ asset('images/pantai7.jpg') }}" alt="Pantai">
        </div>
    </div>
</section>

{{-- Wisata Alam Section --}}
<section class="blog-section" style="background: #064a9e">
    <div class="container-fluid" style="background: #064a9e"> {{-- Gunakan container-fluid untuk full width sections --}}
        <div class="section-header">
            <h2>Pesona Wisata Alam</h2> </div>
        <div class="container">
            <p class="text-center text-light">Padukuhan Kerjo diberkahi dengan kekayaan alam yang memukau, menjadikannya destinasi ideal bagi para pencinta petualangan dan ketenangan. Dari pantai-pantai indah yang tersembunyi hingga hamparan hijau perbukitan, setiap sudut menawarkan pengalaman yang tak terlupakan. Jelajahi keajaiban alami yang menanti Anda.</p>
        </div>
        <div class="scrollable-cards-container">
            @foreach ($wisataAlams as $item)
                <div class="col-md-4">
                    <div class="card card-blog">
                        @if ($item->gambar)
                            <img src="{{ asset('storage/wisata-alam/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}"> @else
                            <img src="https://via.placeholder.com/400x280?text=Gambar+Wisata" class="card-img-top" alt="Tanpa Gambar"> @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->judul }}</h5> <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 120) }}</p> <a href="{{ route('wisata_alam.show.umum', $item->id) }}" class="btn btn-read-more">Baca Selengkapnya</a> </div>
                    </div>
                </div> @endforeach
        </div>
    </div>
</section>

{{-- Kegiatan & Acara Desa Section --}}
<section class="blog-section" style="background: #064a9e">
    <div class="container-fluid" style="background: #064a9e">
        <div class="section-header">
            <h2>Kegiatan & Acara Padukuhan</h2>
        </div>
        <div class="container">
            <p class="text-center text-light">Kehidupan di Padukuhan Kerjo selalu semarak dengan berbagai kegiatan dan acara yang mencerminkan semangat kebersamaan dan kekayaan budaya kami. Dari kegiatan panen tradisional hingga pertunjukan seni lokal, setiap acara adalah kesempatan untuk merasakan denyut nadi kehidupan di padukuhan yang otentik. Jangan lewatkan momen-momen istimewa ini!</p>
        </div>
        <div class="scrollable-cards-container">
            @foreach ($kegiatans as $item)
                <div class="col-md-4"> <div class="card card-blog">
                        @if ($item->gambar)
                            <img src="{{ asset('storage/kegiatan/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}"> @else
                            <img src="https://via.placeholder.com/400x280?text=Gambar+Kegiatan" class="card-img-top" alt="Tanpa Gambar">
                        @endif
                        <div class="card-body"> <h5 class="card-title">{{ $item->judul }}</h5> <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 120) }}</p> <a href="{{ route('kegiatan.show.umum', $item->id) }}" class="btn btn-read-more">Baca Selengkapnya</a> </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- UMKM Desa Section --}}
<section class="blog-section"style="background: #064a9e">
    <div class="container-fluid">
        <div class="section-header">
            <h2>Produk Unggulan UMKM</h2>
        </div>
        <div class="container">
            <p class="text-center text-light">Dukungan terhadap UMKM lokal adalah tulang punggung perekonomian Padukuhan Kerjo. Kami bangga mempersembahkan beragam produk unggulan yang dibuat dengan cinta dan keahlian oleh masyarakat padukuhan. Setiap pembelian tidak hanya memberikan Anda produk berkualitas, tetapi juga turut serta dalam memajukan kesejahteraan komunitas kami.</p> </div>
        <div class="scrollable-cards-container">
            @foreach ($umkmDesas as $item)
                <div class="col-md-4"> <div class="card card-blog">
                        @if ($item->gambar)
                            <img src="{{ asset('storage/umkm-desa/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama }}"> @else
                            <img src="https://via.placeholder.com/400x280?text=Gambar+UMKM" class="card-img-top" alt="Tanpa Gambar">
                        @endif
                        <div class="card-body"> <h5 class="card-title">{{ $item->nama }}</h5> <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 120) }}</p> <a href="{{ route('umkm_desa.show.umum', $item->id) }}" class="btn btn-read-more">Lihat Produk</a> </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Call to Action Banner --}}
<section class="hero-section" style="background-image: url('{{ asset('images/balai5.jpg') }}'); margin-top: 10px;">
    <div class="container">
        <h2 style="color: #DEE2E6">Siap Menjelajahi Keindahan Kami?</h2>
        <p>Bergabunglah dengan kami untuk merasakan pengalaman tak terlupakan di Padukuhan Kerjo.</p>
        <p>Mari Kita Tunjukan Indonesia yang penuh dengan keindahan Alamnya.</p>
    </div>
</section>

@endsection