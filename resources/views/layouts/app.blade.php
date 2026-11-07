<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Padukuhan Kerjo</title>

    {{-- Mengimpor Font Google: Playfair Display untuk judul, Montserrat untuk teks --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Variabel Warna Global (Palet Monokromatik & Netral untuk kesan mewah) */
        :root {
            --primary-accent: #5C6F8D; /* Blue-Grey Dark - "Biru susu tua" yang elegan untuk aksen utama */
            --secondary-accent: #064a9e; /* Blue-Grey Light - Untuk aksen sekunder/hover */
            --heading-dark: #1A3A5A; /* Dark Blue for main headings (formerly very dark almost black) */
            --text-dark: #3A5A7A; /* Slightly lighter dark blue for body text (formerly dark grey) */
            --text-light: #DEE2E6; /* Very light grey for text on dark backgrounds - kept for contrast */
            --background-light: #F8F9FA; /* Off-white for main background - kept */
            --background-dark: #2A4A6A; /* Deep Blue for section backgrounds (formerly deep charcoal) */
            --border-color: #C0E0F0; /* Light blue border color (formerly light grey) */
            --overlay-dark: rgba(42, 74, 106, 0.65); /* Blue overlay for hero/section images (formerly black overlay) */
            --card-bg: #FFFFFF; /* Pure white for card backgrounds - kept */
            --footer-bg: #2A4A6A; /* Deep Blue for footer (formerly almost black) */
            --footer-text: #CED4DA; /* Light text for footer - kept for contrast */

            /* Shadows for depth */
            --shadow-light: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.08); /* Kept black shadow for light elements, can be modified for blue if needed */
            --shadow-medium: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.12); /* Kept black shadow */
            --shadow-deep: 0 1rem 3rem rgba(0, 0, 0, 0.18); /* Kept black shadow */

            /* New Light Blue for "dark" elements (already blue) */
            --light-blue-bg: #E0F2F7; /* A very light blue for backgrounds */
            --light-blue-text: #007BFF; /* A slightly darker blue for text on light backgrounds */
            --light-blue-border: #B3E0FF; /* Light blue for borders */
            --light-blue-shadow: rgba(179, 224, 255, 0.5); /* Light blue shadow */
        }

        body {
            font-family: 'Montserrat', sans-serif; /* Menggunakan Montserrat */
            background-color: var(--background-light); /* Latar belakang terang dari palet baru */
            color: var(--text-dark); /* Warna teks gelap dari palet baru */
            line-height: 1.7;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif; /* Menggunakan Playfair Display */
            color: var(--heading-dark); /* Warna judul gelap dari palet baru */
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        /* Navbar Styling */
        .navbar {
            background-color: var(--secondary-accent) !important; /* Menggunakan secondary-accent untuk navbar */
            box-shadow: var(--shadow-light);
            transition: all 0.4s ease-in-out;
            padding: 1rem 0;
            z-index: 1030; /* Pastikan navbar di atas elemen lain */
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--text-light) !important; /* Warna teks terang dari palet baru */
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--primary-accent) !important; /* Warna "biru susu tua" saat hover */
        }

        .nav-link {
            font-weight: 400;
            color: var(--text-light) !important; /* Warna teks terang dari palet baru */
            margin: 0 12px;
            position: relative;
            transition: all 0.3s ease;
            padding: 8px 0; /* Adjust padding for better look */
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px; /* Thicker underline */
            bottom: -5px;
            left: 0;
            background-color: var(--primary-accent); /* Warna "biru susu tua" */
            transition: width 0.3s ease-out;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-accent) !important; /* Warna "biru susu tua" saat hover/active */
            transform: translateY(-2px);
        }

        .btn-outline-light {
            border-color: var(--text-light); /* Warna teks terang */
            color: var(--text-light);
            transition: all 0.3s ease;
            padding: 8px 20px;
            border-radius: 25px; /* Pill shape */
        }

        .btn-outline-light:hover {
            background-color: var(--primary-accent); /* Warna "biru susu tua" */
            border-color: var(--primary-accent); /* Warna "biru susu tua" */
            color: var(--text-light); /* Warna teks terang */
            transform: translateY(-2px);
            box-shadow: var(--shadow-light);
        }

        .pagination-info,
            .showing-info,
            .small.text-muted { 
                display: none !important; 
            }

        /* Hero Section (Banner) for Welcome Page */
        .hero-section {
            background-color: var(--secondary-accent); /* Menggunakan secondary-accent untuk hero section */
            color: var(--text-light); /* Warna teks terang dari palet baru */
            padding: 120px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 600px;
            animation: fadeIn 1.5s ease-out;
            border-bottom: 8px solid var(--primary-accent); /* Garis bawah yang kuat */
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(143, 168, 199, 0.65); /* Overlay lebih terang dari secondary-accent */
            z-index: 1;
            background: radial-gradient(circle at center, rgba(143, 168, 199, 0.1) 0%, rgba(143, 168, 199, 0.8) 100%); /* Radial gradient untuk fokus */
        }

        .hero-section .container {
            position: relative;
            z-index: 2; /* Ensure text is above overlay */
            max-width: 900px;
        }

        .hero-section h1 {
            font-family: 'Playfair Display', serif;
            font-size: 5.5rem; /* Larger heading */
            margin-bottom: 1.5rem;
            color: var(--text-light); /* Warna teks terang dari palet baru */
            text-shadow: 0px 4px 12px rgba(42, 74, 106, 0.4); /* Blue shadow */
            line-height: 1.1;
            letter-spacing: 0.15rem;
            font-weight: 700;
            animation: fadeInDown 1.5s ease-out forwards;
        }

        .hero-section p.lead {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.2rem; /* Larger paragraph */
            margin-bottom: 2.5rem;
            font-weight: 300;
            animation: fadeInUp 1.5s ease-out forwards 0.3s;
        }
        
        .hero-section .btn-hero {
            padding: 1.2rem 3.5rem;
            font-size: 1.5rem;
            border-radius: 50px; /* Bentuk pil untuk sentuhan modern */
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            background-color: transparent;
            border: 2px solid var(--text-light); /* Border putih */
            color: var(--text-light);
            box-shadow: 0 8px 25px rgba(42, 74, 106, 0.2); /* Blue shadow */
            font-weight: 500;
            letter-spacing: 0.05rem;
            animation: fadeIn 1.5s ease-out forwards 0.6s;
        }

        .hero-section .btn-hero:hover {
            transform: translateY(-7px) scale(1.02);
            box-shadow: 0 15px 35px rgba(42, 74, 106, 0.4); /* Blue shadow */
            background-color: var(--text-light);
            color: var(--heading-dark);
            border-color: var(--text-light);
        }

        /* Detail Hero Section (Specific for detail pages like wisata_alam and kegiatan) */
        .detail-hero-section {
            position: relative;
            height: 550px; /* Tinggi hero detail */
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            text-shadow: 2px 2px 10px rgba(42, 74, 106, 0.8); /* Blue shadow */
            overflow: hidden;
            margin-top: -80px;
            padding-top: 80px;
            border-bottom: 5px solid var(--primary-accent); /* Garis bawah aksen */
        }

        .detail-hero-section .hero-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            filter: brightness(0.7);
            transform: scale(1.05);
            transition: transform 0.8s ease-out;
        }
        .detail-hero-section:hover .hero-image {
            transform: scale(1);
        }

        .detail-hero-section .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(143, 168, 199, 0.85), rgba(143, 168, 199, 0.5)); /* Gradien lebih terang dari secondary-accent */
            z-index: 1;
        }

        .detail-hero-section h1 {
            font-size: 5rem;
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: -2px; /* Lebih rapat */
            margin-bottom: 1rem;
        }

        .detail-hero-section p.lead-description { /* Specific class for the lead text in detail hero */
            font-size: 1.8rem;
            max-width: 900px;
            margin: 0 auto 2.5rem auto;
            opacity: 0.9;
            font-family: 'Montserrat', sans-serif;
        }

        .detail-hero-section .btn-return {
            background-color: transparent;
            border: 2px solid var(--text-light);
            color: var(--text-light);
            font-weight: 500;
            padding: 1rem 2.5rem;
            border-radius: 30px;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(42, 74, 106, 0.3); /* Blue shadow */
        }
        .detail-hero-section .btn-return:hover {
            background-color: var(--primary-accent);
            border-color: var(--primary-accent);
            color: var(--text-light);
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 25px rgba(42, 74, 106, 0.5); /* Blue shadow */
        }

        /* Detail Content Section */
        .detail-content-section {
            background-color: var(--background-light);
            padding: 4rem 0;
        }

        .detail-content-section h2 {
            font-family: 'Playfair Display', serif;
            color: var(--heading-dark);
            font-size: 2.8rem;
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .detail-content-section p {
            font-family: 'Montserrat', sans-serif;
            color: var(--text-dark);
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        /* Custom Breadcrumb */
        .custom-breadcrumb {
            background-color: var(--background-light);
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
            border-top: 1px solid var(--border-color);
            box-shadow: var(--shadow-light);
            margin-top: 80px;
        }
        .custom-breadcrumb .breadcrumb-item a {
            color: var(--primary-accent);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .custom-breadcrumb .breadcrumb-item a:hover {
            color: var(--secondary-accent);
        }
        .custom-breadcrumb .breadcrumb-item.active {
            color: var(--text-dark);
            font-weight: 500;
        }
        .custom-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
            color: var(--text-dark);
        }

        /* Image Gallery */
        .image-gallery-container {
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        .detail-main-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: var(--shadow-medium);
            margin-bottom: 2rem;
        }

        .thumbnail-gallery img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 3px solid transparent;
            transition: border-color 0.3s ease, transform 0.2s ease;
        }

        .thumbnail-gallery img:hover {
            border-color: var(--primary-accent);
            transform: scale(1.05);
        }

        /* Featurette-like sections for detail pages */
        .featurette {
            padding: 4rem 0;
            border-bottom: 1px solid var(--border-color);
        }
        .featurette:last-child {
            border-bottom: none;
        }

        .featurette-heading {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 700;
            color: var(--heading-dark);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .featurette-divider {
            margin: 5rem 0;
            border-top: 5px dashed var(--primary-accent);
            opacity: 0.7;
        }

        /* Info Blocks (e.g., Lokasi, Jam Operasional) */
        .info-block {
            background-color: var(--background-light);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-light);
        }
        .info-block h3 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-accent);
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }
        .info-block p {
            margin-bottom: 0.8rem;
            font-size: 1rem;
            color: var(--text-dark);
        }
        .info-block i {
            color: var(--primary-accent);
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        /* Section Global Styles (for welcome sections) */
        .blog-section {
            background-color: var(--light-blue-bg); /* Menggunakan light-blue-bg untuk latar belakang section */
            padding: 6rem 0;
            margin-bottom: 5rem;
            box-shadow: 0 1rem 3rem var(--light-blue-shadow); /* Shadow dengan warna biru muda */
            position: relative;
            overflow: hidden;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
            z-index: 1;
        }

        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 3.8rem;
            color: var(--light-blue-text); /* Warna teks biru muda di latar belakang biru muda */
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

        /* Scrollable Cards Container */
        .scrollable-cards-container {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            padding: 1rem 3rem 2.5rem 3rem;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-accent) var(--light-blue-bg); /* Warna scrollbar disesuaikan */
        }

        .scrollable-cards-container::-webkit-scrollbar {
            height: 12px;
        }

        .scrollable-cards-container::-webkit-scrollbar-track {
            background: var(--light-blue-bg); /* Track background disesuaikan */
            border-radius: 10px;
        }

        .scrollable-cards-container::-webkit-scrollbar-thumb {
            background: var(--primary-accent);
            border-radius: 10px;
            border: 3px solid var(--light-blue-bg); /* Border agar thumb menonjol */
        }

        .scrollable-cards-container::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-accent);
        }

        /* Kolom untuk Kartu dalam Scrollable Container */
        .scrollable-cards-container .col-md-4 {
            flex: 0 0 auto;
            width: 380px;
            margin-right: 2.5rem;
        }

        .scrollable-cards-container .col-md-4:last-child {
            margin-right: 0;
        }

        /* Card Styling for Blog/Scrollable Sections */
        .card-blog {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px var(--light-blue-shadow); /* Bayangan lembut dengan warna biru muda */
            transition: transform 0.4s ease-out, box-shadow 0.4s ease-out;
            background-color: var(--card-bg); /* Latar belakang kartu putih bersih */
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-blog:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 45px var(--light-blue-shadow); /* Bayangan lebih dramatis dengan warna biru muda */
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
            font-size: 1.9rem;
            color: var(--heading-dark);
            margin-bottom: 0.8rem;
            line-height: 1.3;
            font-weight: 700;
        }

        .card-blog .card-text {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.05rem;
            color: var(--text-dark);
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

        /* Override Bootstrap Success Button (if used elsewhere in layout) */
        .btn-outline-success { /* Ini untuk tombol di card sebelumnya */
            border-color: var(--primary-accent) !important;
            color: var(--primary-accent) !important;
        }

        .btn-outline-success:hover {
            background-color: var(--primary-accent) !important;
            color: var(--text-light) !important;
        }

        /* Footer */
        footer {
            background-color: var(--footer-bg); /* Menggunakan warna biru tua untuk footer */
            color: var(--footer-text); /* Warna teks terang untuk kontras */
            padding: 3rem 0;
            font-family: 'Montserrat', sans-serif;
            border-top: 5px solid var(--primary-accent); /* Garis atas dengan warna aksen */
        }

        footer h5 {
            font-family: 'Playfair Display', serif;
            color: var(--text-light); /* Judul footer terang */
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer ul li {
            margin-bottom: 0.8rem;
        }

        footer ul li a {
            color: var(--footer-text); /* Warna teks terang */
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer ul li a:hover {
            color: var(--primary-accent); /* Warna hover primary-accent */
        }

        footer p {
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        footer .bottom-bar {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            font-size: 0.85rem;
            color: var(--footer-text);
        }

        /* Animasi */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsivitas */
        @media (max-width: 1200px) {
            .detail-hero-section h1 {
                font-size: 4.5rem;
            }
            .detail-hero-section p.lead-description {
                font-size: 1.6rem;
            }
            .featurette-heading {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 991.98px) {
            .navbar-nav {
                text-align: center;
            }
            .navbar-nav .nav-item {
                margin: 0.5rem 0;
            }

            .hero-section {
                padding: 8rem 1.5rem;
                margin-bottom: 4rem;
                min-height: 500px;
            }
            .hero-section h1 {
                font-size: 4rem;
            }
            .hero-section p.lead {
                font-size: 1.8rem;
            }
            .hero-section .btn-hero {
                padding: 1rem 2.8rem;
                font-size: 1.2rem;
            }

            .detail-hero-section {
                height: 450px;
                padding-top: 70px;
            }
            .detail-hero-section h1 {
                font-size: 3.5rem;
            }
            .detail-hero-section p.lead-description {
                font-size: 1.4rem;
                margin-bottom: 2rem;
            }
            .detail-hero-section .btn-return {
                padding: 0.9rem 2.2rem;
                font-size: 1.1rem;
            }

            .custom-breadcrumb {
                margin-top: 70px;
                padding: 1rem 0;
            }

            .detail-main-image {
                height: 350px;
            }
            .thumbnail-gallery img {
                height: 90px;
            }

            .featurette-heading {
                font-size: 2.2rem;
            }

            .blog-section {
                padding: 4rem 0;
                margin-bottom: 3rem;
            }
            .section-header h2 {
                font-size: 3rem;
            }
            .scrollable-cards-container {
                padding: 1rem 1.5rem 2rem 1.5rem;
            }
            .scrollable-cards-container .col-md-4 {
                width: 320px;
                margin-right: 2rem;
            }
            .card-blog .card-img-top {
                height: 240px;
            }
            .card-blog .card-body {
                padding: 1.5rem;
            }
            .card-blog .card-title {
                font-size: 1.7rem;
            }
            .card-blog .card-text {
                font-size: 0.95rem;
            }

            footer .col-md-4 {
                margin-bottom: 2rem;
                text-align: center;
            }
            footer .social-icons {
                text-align: center;
            }
        }

        @media (max-width: 767.98px) {
            .hero-section {
                padding: 6rem 1rem;
                margin-bottom: 3rem;
                min-height: 400px;
                border-bottom: 6px solid var(--primary-accent);
            }
            .hero-section h1 {
                font-size: 3rem;
                letter-spacing: 0.05rem;
            }
            .hero-section p.lead {
                font-size: 1.4rem;
                margin-bottom: 2rem;
            }
            .hero-section .btn-hero {
                padding: 0.9rem 2.2rem;
                font-size: 1.1rem;
            }

            .detail-hero-section {
                height: 350px;
                padding-top: 60px;
            }
            .detail-hero-section h1 {
                font-size: 2.8rem;
                letter-spacing: 0;
            }
            .detail-hero-section p.lead-description {
                font-size: 1.2rem;
                margin-bottom: 1.5rem;
            }
            .detail-hero-section .btn-return {
                padding: 0.8rem 1.8rem;
                font-size: 1rem;
            }

            .custom-breadcrumb {
                margin-top: 60px;
                padding: 0.8rem 0;
            }

            .detail-main-image {
                height: 280px;
            }
            .thumbnail-gallery img {
                height: 70px;
                border-width: 2px;
            }

            .featurette-heading {
                font-size: 1.8rem;
            }
            .detail-content-section p {
                font-size: 1rem;
            }
            .info-block {
                padding: 1.5rem;
            }
            .info-block h3 {
                font-size: 1.5rem;
            }
            .info-block i {
                font-size: 1rem;
            }


            .blog-section {
                padding: 3rem 0;
                margin-bottom: 2rem;
            }
            .section-header h2 {
                font-size: 2.5rem;
                margin-bottom: 2.5rem;
                padding-bottom: 15px;
            }
            .section-header h2::after {
                width: 80px;
                height: 3px;
            }
            .scrollable-cards-container {
                padding: 0.5rem 1rem 1.5rem 1rem;
            }
            .scrollable-cards-container .col-md-4 {
                width: 85%;
                max-width: 300px;
                margin-right: 1.5rem;
            }
            .card-blog {
                border-radius: 8px;
            }
            .card-blog .card-img-top {
                height: 200px;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }
            .card-blog .card-body {
                padding: 1.2rem;
            }
            .card-blog .card-title {
                font-size: 1.5rem;
                margin-bottom: 0.5rem;
            }
            .card-blog .card-text {
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }
            .card-blog .btn-read-more {
                padding: 0.7rem 1.5rem;
                font-size: 0.85rem;
            }

            footer .col-md-4 {
                margin-bottom: 2rem;
            }
            footer .col-md-4:last-child {
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/logo1.png') }}" alt="Logo" style="height: 40px; width: 40px; object-fit: cover;" class="me-2 rounded-circle">
                Padukuhan Kerjo
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::routeIs('wisata_alam.index.umum') ? 'active' : '' }}" href="{{ route('wisata_alam.index.umum') }}">Wisata Alam</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::routeIs('kegiatan.index.umum') ? 'active' : '' }}" href="{{ route('kegiatan.index.umum') }}">Kegiatan</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::routeIs('profil_desa.index.umum') ? 'active' : '' }}" href="{{ route('profil_desa.index.umum') }}">Profil Padukuhan</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::routeIs('umkm_desa.index.umum') ? 'active' : '' }}" href="{{ route('umkm_desa.index.umum') }}">UMKM</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::routeIs('kesenian_desa.index.umum') ? 'active' : '' }}" href="{{ route('kesenian_desa.index.umum') }}">Kesenian</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light" href="#" onclick="showAdminCodePrompt(event)" style="color: inherit;">Admin Dashboard</a>
                    </li>
                </ul>
                <script>
                function showAdminCodePrompt(event) {
                    event.preventDefault();
                    const ADMIN_SECRET_CODE = "KeRjo_PadUkuHan70!";

                    const overlay = document.createElement('div');
                    overlay.id = 'admin-overlay';
                    overlay.style.cssText = `
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(143, 168, 199, 0.7); /* Overlay biru muda */
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        z-index: 9999;
                    `;

                    const promptBox = document.createElement('div');
                    promptBox.id = 'admin-prompt-box';
                    promptBox.style.cssText = `
                        background-color: var(--secondary-accent); /* Latar belakang biru muda */
                        color: var(--text-light); /* Teks terang */
                        padding: 30px;
                        border-radius: 15px;
                        box-shadow: 0 10px 30px var(--light-blue-shadow); /* Shadow biru muda */
                        text-align: center;
                        width: 90%;
                        max-width: 450px;
                        position: relative;
                        font-family: 'Montserrat', sans-serif;
                    `;

                    const closeBtn = document.createElement('button');
                    closeBtn.innerHTML = '&times;';
                    closeBtn.style.cssText = `
                        position: absolute;
                        top: 15px;
                        right: 15px;
                        background: none;
                        border: none;
                        font-size: 28px;
                        color: var(--text-light); /* Warna teks terang */
                        cursor: pointer;
                        transition: color 0.3s ease;
                    `;
                    closeBtn.onmouseover = function() { this.style.color = '#5C6F8D'; }; // primary-accent
                    closeBtn.onmouseout = function() { this.style.color = '#DEE2E6'; }; // text-light
                    closeBtn.onclick = function() {
                        document.body.removeChild(overlay);
                    };

                    const title = document.createElement('h3');
                    title.textContent = 'Akses Admin';
                    title.style.cssText = `
                        font-family: 'Playfair Display', serif;
                        color: var(--primary-accent); /* primary-accent */
                        margin-bottom: 20px;
                        font-size: 2.2rem;
                        font-weight: 700;
                    `;

                    const description = document.createElement('p');
                    description.textContent = 'Silakan masukkan kode akses admin Anda untuk melanjutkan.';
                    description.style.cssText = `
                        margin-bottom: 25px;
                        color: var(--text-light); /* teks terang */
                        font-size: 1rem;
                    `;

                    const inputWrapper = document.createElement('div');
                    inputWrapper.style.cssText = `
                        display: flex;
                        align-items: center;
                        margin-bottom: 20px;
                        border: 1px solid rgba(255, 255, 255, 0.2);
                        border-radius: 8px;
                        overflow: hidden;
                        background-color: rgba(255, 255, 255, 0.08);
                    `;

                    const icon = document.createElement('span');
                    icon.innerHTML = '<i class="fas fa-lock"></i>';
                    icon.style.cssText = `
                        padding: 10px 15px;
                        background-color: var(--primary-accent); /* primary-accent */
                        color: var(--text-light);
                        display: flex;
                        align-items: center;
                        font-size: 1.2rem;
                    `;

                    const adminCodeInput = document.createElement('input');
                    adminCodeInput.type = 'password';
                    adminCodeInput.id = 'adminCodeDynamicInput';
                    adminCodeInput.placeholder = 'Kode Akses';
                    adminCodeInput.style.cssText = `
                        flex-grow: 1;
                        padding: 12px 15px;
                        border: none;
                        background: transparent;
                        color: var(--text-light); /* text-light */
                        font-size: 1rem;
                        outline: none;
                        box-shadow: none;
                    `;
                    adminCodeInput.onfocus = function() {
                        this.style.backgroundColor = 'rgba(255, 255, 255, 0.15)';
                        this.style.borderColor = '#064a9e';
                    };
                    adminCodeInput.onblur = function() {
                        this.style.backgroundColor = 'rgba(255, 255, 255, 0.08)';
                        this.style.borderColor = 'rgba(255, 255, 255, 0.2)';
                    };

                    inputWrapper.appendChild(icon);
                    inputWrapper.appendChild(adminCodeInput);

                    const messageDiv = document.createElement('div');
                    messageDiv.id = 'adminDynamicMessage';
                    messageDiv.style.cssText = `
                        margin-top: 15px;
                        font-weight: 500;
                        min-height: 20px;
                        font-size: 0.95rem;
                    `;

                    const buttonContainer = document.createElement('div');
                    buttonContainer.style.cssText = `
                        margin-top: 30px;
                        display: flex;
                        justify-content: center;
                        gap: 15px;
                    `;

                    const cancelButton = document.createElement('button');
                    cancelButton.textContent = 'Batal';
                    cancelButton.style.cssText = `
                        background-color: var(--primary-accent); /* primary-accent */
                        color: var(--text-light);
                        border: none;
                        padding: 10px 25px;
                        border-radius: 8px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        font-size: 1rem;
                        font-weight: 500;
                    `;
                    cancelButton.onmouseover = function() { this.style.backgroundColor = 'var(--secondary-accent)'; }; // secondary-accent
                    cancelButton.onmouseout = function() { this.style.backgroundColor = 'var(--primary-accent)'; };
                    cancelButton.onclick = function() {
                        document.body.removeChild(overlay);
                    };

                    const submitButton = document.createElement('button');
                    submitButton.textContent = 'Masuk';
                    submitButton.style.cssText = `
                        background-color: var(--primary-accent);
                        color: var(--text-light);
                        border: none;
                        padding: 10px 25px;
                        border-radius: 8px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        font-size: 1rem;
                        font-weight: 500;
                    `;
                    submitButton.onmouseover = function() { this.style.backgroundColor = 'var(--secondary-accent)'; this.style.transform = 'translateY(-2px)'; };
                    submitButton.onmouseout = function() { this.style.backgroundColor = 'var(--primary-accent)'; this.style.transform = 'translateY(0)'; };

                    function processCodeSubmission() {
                        const enteredCode = adminCodeInput.value;
                        messageDiv.textContent = '';
                        messageDiv.style.color = '';

                        if (enteredCode === ADMIN_SECRET_CODE) {
                            messageDiv.textContent = 'Berhasil masuk sebagai admin!';
                            messageDiv.style.color = '#28a745';
                            setTimeout(() => {
                                document.body.removeChild(overlay);
                                window.location.href = "{{ route('admin.dashboard') }}";
                            }, 1000);
                        } else {
                            messageDiv.textContent = 'Hanya untuk admin. Kode akses salah!';
                            messageDiv.style.color = '#dc3545';
                            adminCodeInput.value = '';
                            adminCodeInput.focus();
                        }
                    }

                    submitButton.onclick = processCodeSubmission;
                    adminCodeInput.addEventListener('keypress', function(event) {
                        if (event.key === 'Enter') {
                            processCodeSubmission();
                        }
                    });

                    promptBox.appendChild(closeBtn);
                    promptBox.appendChild(title);
                    promptBox.appendChild(description);
                    promptBox.appendChild(inputWrapper);
                    promptBox.appendChild(messageDiv);
                    buttonContainer.appendChild(cancelButton);
                    buttonContainer.appendChild(submitButton);
                    promptBox.appendChild(buttonContainer);

                    overlay.appendChild(promptBox);
                    document.body.appendChild(overlay);
                    adminCodeInput.focus();
                }
                </script>
            </div>
        </div>
    </nav>

    {{-- Content Section (This is where your page-specific content will be injected) --}}
    {{-- We remove the hero section from here as it's now specific to welcome.blade.php --}}
    <main style="padding-top: 80px;"> 
        @yield('content')
    </main>

    <footer class="footer" style="background: #064a9e">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Padukuhan Kerjo</h5>
                    <p>
                        Sebuah permata tersembunyi yang menawarkan pengalaman otentik padukuhan. Kami berkomitmen untuk melestarikan tradisi dan mengembangkan potensi lokal.
                    </p>
                    <div class="social-icons mt-4">
                        <a href="https://www.instagram.com/padukuhankerjo" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="mailto:padukuhankerjo@gmail.com" target="_blank">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <a href="https://wa.me/6288227364723" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Navigasi Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('wisata_alam.index.umum') }}">Wisata Alam</a></li>
                        <li><a href="{{ route('kegiatan.index.umum') }}">Kegiatan</a></li>
                        <li><a href="{{ route('profil_desa.index.umum') }}">Profil Padukuhan</a></li>
                        <li><a href="{{ route('umkm_desa.index.umum') }}">UMKM</a></li>
                        <li><a href="{{ route('kesenian_desa.index.umum') }}">Kesenian</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Kontak Kami</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Kerjo, Ngestirejo, Kec. Tanjungsari, Kabupaten Gunungkidul, Daerah Istimewa Yogyakarta 55881</p>
                    <p><i class="fas fa-phone me-2"></i> +62 882-2736-4723 </p>
                    <p><i class="fas fa-clock me-2"></i> Senin - Jumat : 08.00 - 16.00 WIB</p>
                </div>
            </div>
            <div class="bottom-bar">
                <span>&copy; {{ date('Y') }} Padukuhan Kerjo. Semua Hak Dilindungi.</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>