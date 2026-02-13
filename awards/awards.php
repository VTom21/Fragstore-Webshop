<?php
include 'awards_data.php';

$topGOTY = null;
foreach ($awards as $award) {
    if ($award['award_name'] === 'Game of the Year') {
        if (!$topGOTY || $award['award_year'] > $topGOTY['award_year']) {
            $topGOTY = $award;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js" integrity="sha512-P2IDYZfqSwjcSjX0BKeNhwRUH8zRPGlgcWl5n6gBLzdi4Y5/0O4zaXrtO4K9TZK6Hn1BenYpKowuCavNandERg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js" integrity="sha512-NcZdtrT77bJr4STcmsGAESr06BYGE8woZdSdEgqnpyqac7sugNO+Tr4bGwGF3MsnEkGKhU2KL2xh6Ec+BqsaHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="awards.css">
    <link rel="icon" type="image/x-icon" href="/icons/array (2).png">
    <title>Awards</title>
</head>

<body>


    <div class="hero relative min-h-screen bg-gray-900">

        <!-- Hero background -->
        
        <!-- Navbar -->

        <nav class="grid-nav navbar z-10  justify-between items-center max-w-7xl mx-auto px-6 h-16 w-full">
            <img src="../icons/array (2).png" alt="Logo" id="logo" class="h-8 w-auto">
            <div class="grid-items space-x-4">
                <a href="../redirect/redirect.php?destination=../home/home.php" class="text-white hover:text-cyan-400 px-3 py-2 rounded">Home</a>
                <a href="#dev_pub" class="text-white hover:text-cyan-400 px-3 py-2 rounded">Developers</a>
                <a href="#dev_pub" class="text-white hover:text-cyan-400 px-3 py-2 rounded">Publishers</a>
                <a href="#featured_winners" class="text-white hover:text-cyan-400 px-3 py-2 rounded">Awards</a>
            </div>
        </nav>

<div class="hero-bg absolute inset-0 bg-cover bg-center" style="background-image: url('../pictures/awards_hero.png'); filter: brightness(0.2);"></div>

        <!-- Hero content -->
        <div class=" z-10 max-w-4xl mx-auto px-6 py-32 text-center flex flex-col items-center justify-center min-h-screen">
            <h1 class="hero-title font-bold text-cyan-400 mb-6">Game Awards</h1>
            <p class="hero-subtitle text-gray-300 text-lg sm:text-xl max-w-2xl mb-8">Explore the latest winners, discover top developers, and celebrate the best games in the industry.</p>
            <div class="buttons flex flex-col sm:flex-row gap-4">
                <a href="#featured_winners" class="btn-primary px-6 py-3 rounded-lg font-semibold bg-cyan-400 text-gray-900 shadow-lg hover:scale-105 view_awards">View Awards</a>
                <a href="https://www.ign.com/articles/the-game-awards-2025-winners-the-full-list" class="learn_more">
                    Learn More
                    <span></span>
                </a>
            </div>
            <div class="arrow mt-12 animate-bounce arrow_svg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-cyan-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 18.75l7.5-7.5 7.5 7.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5-7.5 7.5 7.5" />
                </svg>
            </div>
        </div>

        <div class="absolute bottom-6 right-6 z-20 popup_bar">
            <div class="group">
                <!-- Main Button -->
                <button class="relative h-12 w-12 rounded-full bg-gray-900 text-white shadow-md hover:shadow-lg transition-all" type="button">
                    <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:rotate-45">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                    </span>
                </button>

                <!-- Popup Buttons -->
                <div class="absolute bottom-full py-2 right-0 hidden flex-col items-center gap-3 group-hover:flex">

                    <!-- Home -->
                    <a href="../redirect/redirect.php?destination=../home/home.php"
                        class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-900 text-gray-400 hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </a>

                    <a href="../redirect/redirect.php?destination=../games_main.php"
                        class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-900 text-gray-400 hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v6m0 0a2.25 2.25 0 102.25 2.25M12 9a2.25 2.25 0 11-2.25 2.25M6 15.75a3.75 3.75 0 013.75-3.75h4.5A3.75 3.75 0 0118 15.75v1.5A2.25 2.25 0 0115.75 19.5h-7.5A2.25 2.25 0 016 17.25v-1.5z" />
                        </svg>
                    </a>



                    <!-- Trophy -->
                    <a href="#featured_winners"
                        class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-900 text-gray-400 hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 18.75h-9m4.5-3v3m-3-6h6m-9-9h12v3a6 6 0 01-12 0v-3zm0 0H3v1.5a4.5 4.5 0 004.5 4.5M21 3h-3v1.5a4.5 4.5 0 01-4.5 4.5" />
                        </svg>
                    </a>

                </div>

            </div>
        </div>

    </div>

    <!-- Hero Section for #1 Game of the Year -->
    <section class="relative w-full h-screen bg-gray-900 goty_div">
        <?php if ($topGOTY): ?>
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="<?php echo $topGOTY['game_img']; ?>" alt="<?php echo $topGOTY['game_name']; ?>" class="w-full h-full object-cover brightness-50">
            </div>

            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-70"></div>

            <!-- Hero Content -->
            <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-6">
                <span class="bg-yellow-400 text-black font-bold px-4 py-2 rounded-full uppercase tracking-wide text-sm shadow-lg mb-4 game_of_the_year">
                    Game of the Year <?php echo $topGOTY['award_year']; ?>
                </span>
                <h1 class=" font-extrabold text-white mb-6 goty">
                    <?php echo $topGOTY['game_name']; ?>
                </h1>
                <p class="text-gray-300 text-lg sm:text-xl max-w-2xl mb-8 promo">
                    Celebrate the most acclaimed game of the year—experience innovation, creativity, and excellence in gaming.
                </p>
                <a href="#featured_winners" class="featured_winners bg-cyan-400 text-gray-900 font-semibold px-8 py-4 rounded-lg shadow-lg hover:scale-105">
                    Explore Winners
                </a>
            </div>
        <?php endif; ?>
    </section>
    <!-- HTML -->
    <div class="content">
        <!-- About Section -->
        <section id="about" class="section about-section">
            <div class="container">
                <div class="image img1">
                    <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/fb9cfb5b-aa09-4dc2-b19b-931576776dae/de4fujh-3cf64804-b0b2-4d1a-8f60-928f1ddeb575.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiIvZi9mYjljZmI1Yi1hYTA5LTRkYzItYjE5Yi05MzE1NzY3NzZkYWUvZGU0ZnVqaC0zY2Y2NDgwNC1iMGIyLTRkMWEtOGY2MC05MjhmMWRkZWI1NzUucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.rFK081Buxx-AdSvVm4ThS2DvtEi_M2R6XBRzlpRIrmI" alt="Gaming Illustration">
                </div>
                <div class="text">
                    <h2>About the Game Awards</h2>
                    <p>Celebrating the most innovative and inspiring games, the Game Awards honor top developers and studios worldwide.</p>
                    <p>From action-packed blockbusters to indie masterpieces, we highlight the creativity and passion that drives the gaming industry.</p>
                </div>

            </div>
        </section>

        <!-- Mission Section -->
        <section id="mission" class="section mission-section">
            <div class="container">
                <div class="text">
                    <h2>Our Mission</h2>
                    <p>The Game Awards exist to celebrate creativity, innovation, and excellence in gaming. Our mission is to shine a light on the developers, studios, and artists shaping the future of interactive entertainment.</p>
                    <p>From indie gems to blockbuster hits, we believe every game that inspires, entertains, or moves players deserves recognition and celebration.</p>
                </div>
                <div class="image img2">
                    <img src="https://images.steamusercontent.com/ugc/54707509771119863/718F623C460F13B6C40B6E9F3461FE8701613B70/" alt="Celebration Illustration">
                </div>
            </div>
        </section>


    <section class="timeline-section">
        <div class="timeline-header">
            <h2>Our Journey</h2>
            <p>From humble beginnings to industry recognition, explore the milestones that shaped our awards.</p>
        </div>

        <div class="timeline-container">

            <!-- Timeline Item 1 -->
            <div class="timeline-item">
                <div class="timeline-icon-wrapper">
                    <div class="timeline-line"></div>
                    <span class="timeline-icon">
                        <svg width="1.5em" height="1.5em" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor">
                            <path d="M17 21H7C4.79086 21 3 19.2091 3 17V10.7076C3 9.30887 3.73061 8.01175 4.92679 7.28679L9.92679 4.25649C11.2011 3.48421 12.7989 3.48421 14.0732 4.25649L19.0732 7.28679C20.2694 8.01175 21 9.30887 21 10.7076V17C21 19.2091 19.2091 21 17 21Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9 17H15" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                <div class="timeline-content">
                    <p class="timeline-title">Foundation Established</p>
                    <small class="timeline-description">The Game Awards were founded to recognize and celebrate excellence in the gaming industry. What started as a small event has grown into the most prestigious awards ceremony in gaming.</small>
                    <span class="timeline-date">2014</span>
                </div>
            </div>

            <!-- Timeline Item 2 -->
            <div class="timeline-item">
                <div class="timeline-icon-wrapper">
                    <div class="timeline-line"></div>
                    <span class="timeline-icon">
                        <svg width="1.5em" height="1.5em" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor">
                            <path d="M18 8.4C18 6.70261 17.3679 5.07475 16.2426 3.87452C15.1174 2.67428 13.5913 2 12 2C10.4087 2 8.88258 2.67428 7.75736 3.87452C6.63214 5.07475 6 6.70261 6 8.4C6 15.8667 3 18 3 18H21C21 18 18 15.8667 18 8.4Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M13.73 21C13.5542 21.3031 13.3019 21.5547 12.9982 21.7295C12.6946 21.9044 12.3504 21.9965 12 21.9965C11.6496 21.9965 11.3054 21.9044 11.0018 21.7295C10.6982 21.5547 10.4458 21.3031 10.27 21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                <div class="timeline-content">
                    <p class="timeline-title">Global Recognition</p>
                    <small class="timeline-description">Our awards gained international recognition as major studios and indie developers alike began to see the Game Awards as the ultimate achievement in gaming excellence.</small>
                    <span class="timeline-date">2017</span>
                </div>
            </div>

            <!-- Timeline Item 3 -->
            <div class="timeline-item">
                <div class="timeline-icon-wrapper">
                    <div class="timeline-line"></div>
                    <span class="timeline-icon">
                        <svg width="1.5em" height="1.5em" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor">
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M15 8.5C14.315 7.81501 13.1087 7.33855 12 7.30872M9 15C9.64448 15.8593 10.8428 16.3494 12 16.391M12 7.30872C10.6809 7.27322 9.5 7.86998 9.5 9.50001C9.5 12.5 15 11 15 14C15 15.711 13.5362 16.4462 12 16.391M12 7.30872V5.5M12 16.391V18.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                <div class="timeline-content">
                    <p class="timeline-title">Record Viewership</p>
                    <small class="timeline-description">The ceremony reached unprecedented viewership numbers with millions of fans tuning in worldwide, making it the most-watched gaming event in history.</small>
                    <span class="timeline-date">2020</span>
                </div>
            </div>

            <!-- Timeline Item 4 -->
            <div class="timeline-item">
                <div class="timeline-icon-wrapper">
                    <div class="timeline-line"></div>
                    <span class="timeline-icon">
                        <svg width="1.5em" height="1.5em" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor">
                            <path d="M3 21V8L10 4L17 8V13" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M10 21V13H14V21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M17 21L17.8944 18.5528C18.1314 17.8343 18.8686 17.8343 19.1056 18.5528L20 21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M17.5 19H19.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                <div class="timeline-content">
                    <p class="timeline-title">Expanding Categories</p>
                    <small class="timeline-description">We introduced new award categories to better represent the diverse creativity in gaming, including Best Innovation, Best Art Direction, and Best Audio Design.</small>
                    <span class="timeline-date">2023</span>
                </div>
            </div>

            <!-- Timeline Item 5 -->
            <div class="timeline-item">
                <div class="timeline-icon-wrapper">
                    <span class="timeline-icon">
                        <svg width="1.5em" height="1.5em" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="currentColor">
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M19.622 10.395L20.736 11.05C21.19 11.312 21.417 11.443 21.517 11.635C21.605 11.803 21.605 12.002 21.517 12.17C21.417 12.362 21.19 12.493 20.736 12.755L19.622 13.41C19.265 13.619 19.086 13.724 18.942 13.868C18.798 14.012 18.693 14.191 18.484 14.548L17.829 15.662C17.567 16.116 17.436 16.343 17.244 16.443C17.076 16.531 16.877 16.531 16.709 16.443C16.517 16.343 16.386 16.116 16.124 15.662L15.469 14.548C15.26 14.191 15.155 14.012 15.011 13.868C14.867 13.724 14.688 13.619 14.331 13.41L13.217 12.755C12.763 12.493 12.536 12.362 12.436 12.17C12.348 12.002 12.348 11.803 12.436 11.635C12.536 11.443 12.763 11.312 13.217 11.05L14.331 10.395C14.688 10.186 14.867 10.081 15.011 9.937C15.155 9.793 15.26 9.614 15.469 9.257L16.124 8.143C16.386 7.689 16.517 7.462 16.709 7.362C16.877 7.274 17.076 7.274 17.244 7.362C17.436 7.462 17.567 7.689 17.829 8.143L18.484 9.257C18.693 9.614 18.798 9.793 18.942 9.937C19.086 10.081 19.265 10.186 19.622 10.395Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M6.13421 3.94277L6.69631 4.34331C6.93076 4.51427 7.04799 4.59975 7.18478 4.64941C7.30622 4.69364 7.43485 4.71603 7.56463 4.71603C7.7102 4.71603 7.85672 4.68276 8.14975 4.61622L8.79768 4.46738C9.29598 4.35641 9.54513 4.30092 9.71952 4.14944C9.87368 4.01617 9.9811 3.83573 10.0254 3.63394C10.0758 3.40554 10.0102 3.13636 9.87915 2.598L9.73031 1.95007C9.66377 1.65704 9.6305 1.51052 9.5638 1.37373C9.50414 1.2523 9.42306 1.14142 9.3234 1.04817C9.21004 0.941984 9.06827 0.865752 8.78472 0.713289L8.22262 0.312746C7.98817 0.141783 7.87095 0.0563015 7.74415 0.00664095C7.63189 -0.0363471 7.51278 -0.0363471 7.40052 0.00664095C7.27372 0.0563015 7.1565 0.141783 6.92205 0.312746L6.35995 0.713289C6.0764 0.865752 5.93463 0.941984 5.82127 1.04817C5.72161 1.14142 5.64053 1.2523 5.58087 1.37373C5.51417 1.51052 5.4809 1.65704 5.41436 1.95007L5.26552 2.598C5.13445 3.13636 5.06892 3.40554 5.11929 3.63394C5.16362 3.83573 5.27105 4.01617 5.4252 4.14944C5.59959 4.30092 5.84874 4.35641 6.34704 4.46738L6.99497 4.61622C7.288 4.68276 7.43453 4.71603 7.58009 4.71603C7.70988 4.71603 7.8385 4.69364 7.95995 4.64941C8.09673 4.59975 8.21396 4.51427 8.44841 4.34331L9.01051 3.94277" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M3.13421 17.9428L3.69631 18.3433C3.93076 18.5143 4.04799 18.5997 4.18478 18.6494C4.30622 18.6936 4.43485 18.716 4.56463 18.716C4.7102 18.716 4.85672 18.6828 5.14975 18.6162L5.79768 18.4674C6.29598 18.3564 6.54513 18.3009 6.71952 18.1494C6.87368 18.0162 6.9811 17.8357 7.02543 17.6339C7.07581 17.4055 7.01027 17.1364 6.87921 16.598L6.73037 15.9501C6.66383 15.657 6.63056 15.5105 6.56386 15.3737C6.5042 15.2523 6.42312 15.1414 6.32346 15.0482C6.2101 14.942 6.06833 14.8657 5.78478 14.7133L5.22268 14.3127C4.98823 14.1418 4.87101 14.0563 4.74421 14.0066C4.63195 13.9637 4.51284 13.9637 4.40058 14.0066C4.27378 14.0563 4.15656 14.1418 3.92211 14.3127L3.36001 14.7133C3.07646 14.8657 2.93469 14.942 2.82133 15.0482C2.72167 15.1414 2.64059 15.2523 2.58093 15.3737C2.51423 15.5105 2.48096 15.657 2.41442 15.9501L2.26558 16.598C2.13451 17.1364 2.06898 17.4055 2.11935 17.6339C2.16368 17.8357 2.27111 18.0162 2.42526 18.1494C2.59965 18.3009 2.8488 18.3564 3.3471 18.4674L3.99503 18.6162C4.28806 18.6828 4.43459 18.716 4.58015 18.716C4.70994 18.716 4.83856 18.6936 4.96001 18.6494C5.09679 18.5997 5.21402 18.5143 5.44847 18.3433L6.01057 17.9428" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                <div class="timeline-content">
                    <p class="timeline-title">The Future Ahead</p>
                    <small class="timeline-description">Looking forward to celebrating even more groundbreaking games and honoring the incredible talent that continues to push the boundaries of what's possible in gaming.</small>
                    <span class="timeline-date">2025 & Beyond</span>
                </div>
            </div>

        </div>
    </section>

    <div class="awards-section">
        <div class="flex justify-center" id="why_us">
            Award Types
        </div>
        <section class="text-gray-700 body-font" id="awards_promo">


            <?php foreach ($awardsUnique as $award): ?>
                <div class="award-card" id="award-card1">
                    <img src="https://cdn-icons-png.flaticon.com/512/6535/6535462.png" alt="Award Image">
                    <h2><?php echo $award["award_name"]; ?></h2>
                </div>
            <?php endforeach; ?>
        </section>
    </div>

    <!-- Featured Winners Section -->
    <section id="featured_winners" class="relative bg-[#0f0f14] py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#00f7ff] to-[#00d4d4] text-center mb-16">
                Awards Archive
            </h2>

            <div class="flex flex-wrap justify-center gap-3 mb-16 letters">
                <button class="abc-btn px-4 py-2 rounded-lg bg-gray-700 text-white hover:bg-gray-600" data-filter="all">All</button>
                <?php foreach (range('A', 'Z') as $letter): ?>
                    <button class="abc-btn px-4 py-2 rounded-lg bg-gray-700 text-white hover:bg-gray-600" data-filter="<?php echo $letter; ?>">
                        <?php echo $letter; ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 cards_div">

                <?php foreach ($awards as $award): ?>

                    <?php
                    // Get the first letter of the game name (uppercase)
                    $firstLetter = strtoupper(substr($award['game_name'], 0, 1));
                    ?>
                    <div class="award-card award-card2 group relative rounded-3xl overflow-hidden shadow-2xl hover:scale-105 hover:shadow-3xl" data-letter="<?php echo $firstLetter; ?>">
                        <!-- Game Image -->
                        <div class="overflow-hidden rounded-3xl">
                            <img src="<?php echo $award['game_img']; ?>" alt="<?php echo $award['game_name']; ?>" class="w-full h-72 object-cover group-hover:scale-110">
                        </div>

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-70"></div>

                        <!-- Card Content -->
                        <div class="absolute bottom-0 p-6 w-full text-white">
                            <h3 class="text-2xl font-bold mb-2"><?php echo $award['game_name']; ?></h3>
                            <p class="text-sm text-gray-300 mb-2"><?php echo $award['award_name']; ?> - <?php echo $award['award_year']; ?></p>

                            <!-- Ribbon Badge for Game of the Year -->
                            <?php if ($award['award_name'] === 'Game of the Year'): ?>
                                <span class="inline-block bg-yellow-400 text-black font-semibold text-xs px-3 py-1 rounded-full uppercase tracking-wide shadow-lg">Game of the Year</span>
                            <?php endif; ?>

                            <?php if ($award['award_name'] === 'Best Action'): ?>
                                <span class="inline-block bg-red-400 text-black font-semibold text-xs px-3 py-1 rounded-full uppercase tracking-wide shadow-lg">Best Action</span>
                            <?php endif; ?>

                            <?php if ($award['award_name'] === 'Best Narrative'): ?>
                                <span class="inline-block bg-green-400 text-black font-semibold text-xs px-3 py-1 rounded-full uppercase tracking-wide shadow-lg">Best Narrative</span>
                            <?php endif; ?>

                            <?php if ($award['award_name'] === 'Best Audio Design'): ?>
                                <span class="inline-block bg-blue-400 text-black font-semibold text-xs px-3 py-1 rounded-full uppercase tracking-wide shadow-lg">Best Audio Design</span>
                            <?php endif; ?>

                            <?php if ($award['award_name'] === 'Most Anticipated'): ?>
                                <span class="inline-block bg-gray-400 text-black font-semibold text-xs px-3 py-1 rounded-full uppercase tracking-wide shadow-lg">Most Anticipated</span>
                            <?php endif; ?>

                            <?php if ($award['award_name'] === 'Best Art Direction'): ?>
                                <span class="inline-block bg-purple-400 text-black font-semibold text-xs px-3 py-1 rounded-full uppercase tracking-wide shadow-lg">Best Art Direction</span>
                            <?php endif; ?>

                            <?php if ($award['award_name'] === 'Best Innovation'): ?>
                                <span class="inline-block bg-orange-400 text-black font-semibold text-xs px-3 py-1 rounded-full uppercase tracking-wide shadow-lg">Best Innovation</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <div class="developers-section">
        <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#00f7ff] to-[#00d4d4] text-center mb-16">
            Developers & Publishers
        </h2>

        <div class="grid-wrapper" id="dev_pub">

            <!-- Publishers Grid -->
            <div class="grid grid1">
                <?php foreach ($publishers as $publisher): ?>
                    <div class="developer-card">
                        <p><?php echo htmlspecialchars($publisher['company_name']); ?></p>

                        <h4>Awards:</h4>
                        <ul>
                            <?php
                            $awardList = '';
                            foreach ($publisherAwards as $publisherAward) {
                                if ($publisherAward['publisher_id'] == $publisher['publisher_id']) {
                                    foreach ($awards as $award) {
                                        if ($award['award_id'] == $publisherAward['award_id']) {
                                            $awardList .= '<li>' . htmlspecialchars($award['award_name'] . ' (' . $award['award_year'] . ')') . '</li>';
                                        }
                                    }
                                }
                            }
                            echo $awardList ?: '<li>-</li>';
                            ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>

            <br><br>

            <!-- Developers Grid -->
            <div class="grid grid2">
                <?php foreach ($developers as $developer): ?>
                    <div class="developer-card">
                        <h3><?php echo htmlspecialchars($developer['person_name']); ?></h3>
                        <p><?php echo htmlspecialchars($developer['company_name']); ?></p>
                        <p class="role"><?php echo htmlspecialchars($developer['role']); ?></p>

                        <h4>Awards:</h4>
                        <ul>
                            <?php
                            $awardList = '';
                            foreach ($developerAwards as $developerAward) {
                                if ($developerAward['developer_id'] == $developer['developer_id']) { // ✅ correct mapping
                                    foreach ($awards as $award) {
                                        if ($award['award_id'] == $developerAward['award_id']) {
                                            $awardList .= '<li>' . htmlspecialchars($award['award_name'] . ' (' . $award['award_year'] . ')') . '</li>';
                                        }
                                    }
                                }
                            }
                            echo $awardList ?: '<li>-</li>';
                            ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

    </div>


    <section class="relative bg-[#0f0f14] py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 experience_div">
            <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#00f7ff] to-[#00d4d4] text-center mb-12">
                Experience the Awards
            </h2>
            <div class="flex justify-center video_div">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/GxUUJ-CQpmg?si=72sfXuRHllWUqKO3" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </section>



    <div class="companies">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class=" py-24 sm:py-32">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <h2 class="text-center text-3xl sm:text-4xl font-bold tracking-tight text-white trusted">
                        Trusted by Industry Leaders
                    </h2>
                    <p class="mt-4 text-center text-gray-400 max-w-2xl mx-auto trusted_text">
                        Celebrating the studios and publishers shaping the future of gaming.
                    </p>

                    <div class="mx-auto mt-10 grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-5 logos">
                        <img width="158" height="78" src="https://assets.streamlinehq.com/image/private/w_300,h_300,ar_1/f_auto/v1/icons/video-games/epic-games-hg3aynrgcuetqn170db1g9.png/epic-games-y5xqpgrdx4l1nft47f5gz7.png?_a=DATAg1AAZAA0" alt="Transistor" class="col-span-2 max-h-32 w-full object-contain lg:col-span-1" />
                        <img width="158" height="78" src="https://upload.wikimedia.org/wikipedia/pt/9/95/Guerrilla_logo.png" alt="Reform" class="col-span-2 max-h-32 w-full object-contain lg:col-span-1" />
                        <img width="158" height="78" src="https://static.vecteezy.com/system/resources/previews/020/975/554/non_2x/sony-logo-sony-icon-transparent-free-png.png" alt="Tuple" class="col-span-2 max-h-64 w-full object-contain lg:col-span-1" />
                        <img width="158" height="78" src="https://upload.wikimedia.org/wikipedia/commons/7/78/Bioware-logo.png" alt="SavvyCal" class="col-span-2 max-h-32 w-full object-contain sm:col-start-2 lg:col-span-1" />
                        <img width="158" height="78" src="https://download.logo.wine/logo/Electronic_Arts/Electronic_Arts-Logo.wine.png" alt="Statamic" class="col-span-2 col-start-2 max-h-32 w-full object-contain sm:col-start-auto lg:col-span-1" />
                    </div>
                </div>
            </div>

        </div>

    </div>


    <footer class="footer">
        <div class="mx-auto p-4 py-6 lg:py-8 footer_div justify-center">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="/icons/array.png" class="flex items-center links">
                        <img src="/icons/array.png" class="h-10 me-3" alt="FlowBite Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white id2"><span class="id1">Frag</span>store</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold  uppercase dark:text-white" data-i18n="about">About</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4 links">
                                <a href="../redirect/redirect.php?destination=../home/home.php%23intro" class="links" data-i18n="about_us">About Us</a>
                            </li>
                            <li class="links">
                                <a href="../redirect/redirect.php?destination=../contact_us/contactus.php" data-i18n="contact">Contacts</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold  uppercase dark:text-white" data-i18n="help">Help</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4 links">
                                <a href="../redirect/redirect.php?destination=../home/home.php%23FAQ" class="links" data-i18n="faq">FAQ</a>
                            </li>
                            <li class="mb-4 links">
                                <a href="../pdf/Refund Policy.pdf" class="links" data-i18n="refund_policy">Refund Policy</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold uppercase dark:text-white" data-i18n="legal">Legal</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4 links">
                                <a href="../pdf/Privacy Policy.pdf" class="links" data-i18n="privacy_policy">Privacy Policy</a>
                            </li>
                            <li class="links">
                                <a href="../pdf/Terms and Conditions.pdf" class="links" data-i18n="terms_and_conditions">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" style="border-color:rgb(88, 86, 86);" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm sm:text-center copyright_text">© 2025 <a href="https://flowbite.com/" class="hover:underline">Fragstore™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                            <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 16">
                            <path d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                        </svg>
                        <span class="sr-only">Discord community</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                            <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Dribble account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    </div>
    </div>
</body>

<script src="awards.js"></script>

</html>