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
        <div class="hero-bg absolute inset-0 bg-cover bg-center" style="background-image: url('../pictures/awards_hero.png'); filter: brightness(0.2);"></div>

        <!-- Navbar -->
        <nav class="navbar relative z-10 flex justify-between items-center max-w-7xl mx-auto px-6 h-16 w-full">
            <img src="../icons/array (2).png" alt="Logo" class="h-8 w-auto">
            <div class="flex space-x-4">
                <a href="#" class="text-white hover:text-cyan-400 px-3 py-2 rounded">Home</a>
                <a href="#" class="text-white hover:text-cyan-400 px-3 py-2 rounded">Developers</a>
                <a href="#" class="text-white hover:text-cyan-400 px-3 py-2 rounded">Publishers</a>
                <a href="#" class="text-white hover:text-cyan-400 px-3 py-2 rounded">Awards</a>
            </div>
        </nav>

        <!-- Hero content -->
        <div class="relative z-10 max-w-4xl mx-auto px-6 py-32 text-center flex flex-col items-center justify-center min-h-screen">
            <h1 class="hero-title text-4xl sm:text-6xl font-bold text-cyan-400 mb-6">Game Awards</h1>
            <p class="hero-subtitle text-gray-300 text-lg sm:text-xl max-w-2xl mb-8">Explore the latest winners, discover top developers, and celebrate the best games in the industry.</p>
            <div class="buttons flex flex-col sm:flex-row gap-4">
                <a href="#awards" class="btn-primary px-6 py-3 rounded-lg font-semibold bg-cyan-400 text-gray-900 shadow-lg hover:scale-105 transition-transform">View Awards</a>
                <a href="#about" class="learn_more">
                    Learn More
                    <span></span>
                </a>
            </div>
            <div class="arrow mt-12 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-cyan-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 18.75l7.5-7.5 7.5 7.5" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l7.5-7.5 7.5 7.5" />
                </svg>
            </div>
        </div>

        <!-- Floating Pop-Up Button (Bottom Right of Hero) -->
        <div class="absolute bottom-6 right-6 z-20">
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
                    <button class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-900 text-gray-400 hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                        </svg>
                    </button>
                    <button class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-900 text-gray-400 hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513"></path>
                        </svg>
                    </button>
                    <button class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-900 text-gray-400 hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    </div>


    <!-- HTML -->
    <div class="content">
        <!-- About Section -->
        <section id="about" class="section about-section">
            <div class="container">
                <div class="image">
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
                <div class="image">
                    <img src="https://images.steamusercontent.com/ugc/54707509771119863/718F623C460F13B6C40B6E9F3461FE8701613B70/" alt="Celebration Illustration">
                </div>
            </div>
        </section>
    </div>


    <div class="awards-section">
        <div class="flex justify-center" id="why_us">
            Award Types
        </div>
        <section class="text-gray-700 body-font" id="awards_promo">


            <?php foreach ($awardsUnique as $award): ?>
                <div class="award-card">
                    <img src="https://cdn-icons-png.flaticon.com/512/6535/6535462.png" alt="Award Image">
                    <h2><?php echo $award["award_name"]; ?></h2>
                </div>
            <?php endforeach; ?>
        </section>
    </div>

    <!-- Hero Section for #1 Game of the Year -->
    <section class="relative w-full h-screen bg-gray-900">
        <?php if ($topGOTY): ?>
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="<?php echo $topGOTY['game_img']; ?>" alt="<?php echo $topGOTY['game_name']; ?>" class="w-full h-full object-cover brightness-50">
            </div>

            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-70"></div>

            <!-- Hero Content -->
            <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-6">
                <span class="bg-yellow-400 text-black font-bold px-4 py-2 rounded-full uppercase tracking-wide text-sm shadow-lg mb-4">
                    Game of the Year <?php echo $topGOTY['award_year']; ?>
                </span>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white mb-6">
                    <?php echo $topGOTY['game_name']; ?>
                </h1>
                <p class="text-gray-300 text-lg sm:text-xl max-w-2xl mb-8">
                    Celebrate the most acclaimed game of the year—experience innovation, creativity, and excellence in gaming.
                </p>
                <a href="#featured_winners" class="bg-cyan-400 text-gray-900 font-semibold px-8 py-4 rounded-lg shadow-lg hover:scale-105 transition-transform">
                    Explore Winners
                </a>
            </div>
        <?php endif; ?>
    </section>
    <!-- Featured Winners Section -->
    <section id="featured_winners" class="relative bg-[#0f0f14] py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#00f7ff] to-[#00d4d4] text-center mb-16">
                Awards Archive
            </h2>

            <div class="flex flex-wrap justify-center gap-3 mb-16">
                <button class="abc-btn px-4 py-2 rounded-lg bg-gray-700 text-white hover:bg-gray-600 transition" data-filter="all">All</button>
                <?php foreach (range('A', 'Z') as $letter): ?>
                    <button class="abc-btn px-4 py-2 rounded-lg bg-gray-700 text-white hover:bg-gray-600 transition" data-filter="<?php echo $letter; ?>">
                        <?php echo $letter; ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

                <?php foreach ($awards as $award): ?>

                    <?php
                    // Get the first letter of the game name (uppercase)
                    $firstLetter = strtoupper(substr($award['game_name'], 0, 1));
                    ?>
                    <div class=" award-card group relative rounded-3xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105 hover:shadow-3xl" data-letter="<?php echo $firstLetter; ?>">
                        <!-- Game Image -->
                        <div class="overflow-hidden rounded-3xl">
                            <img src="<?php echo $award['game_img']; ?>" alt="<?php echo $award['game_name']; ?>" class="w-full h-72 object-cover transition-transform duration-500 group-hover:scale-110">
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
            Publisher Awards
        </h2>
        <div class="grid-wrapper">
            <div class="grid grid1">
                <?php foreach ($publishers as $publisher): ?>
                    <div class="developer-card">
                        <h3><?php echo htmlspecialchars($publisher['person_name']); ?></h3>
                        <p><?php echo htmlspecialchars($publisher['company_name']); ?></p>
                        <p class="role"><?php echo htmlspecialchars($publisher['role']); ?></p>

                        <h4>Awards:</h4>
                        <ul>
                            <?php foreach ($publisherAwards as $publisherAward): ?>
                                <?php if ($publisherAward['publisher_id'] == $publisher['publisher_id']): ?>
                                    <?php foreach ($awards as $award): ?>
                                        <?php if ($award['award_id'] == $publisherAward['award_id']): ?>
                                            <li><?php echo htmlspecialchars($award['award_name'] . ' (' . $award['award_year'] . ')'); ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
<br><br>
            <div class="grid grid2">
                <?php foreach ($developers as $developer): ?>
                    <div class="developer-card">
                        <h3><?php echo htmlspecialchars($developer['person_name']); ?></h3>
                        <p><?php echo htmlspecialchars($developer['company_name']); ?></p>
                        <p class="role"><?php echo htmlspecialchars($developer['role']); ?></p>

                        <h4>Awards:</h4>
                        <ul>
                            <?php foreach ($developerAwards as $developerAward): ?>
                                <?php if ($developerAward['developer_id'] == $developer['publisher_id']): ?>
                                    <?php foreach ($awards as $award): ?>
                                        <?php if ($award['award_id'] == $developerAward['award_id']): ?>
                                            <li><?php echo htmlspecialchars($award['award_name'] . ' (' . $award['award_year'] . ')'); ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>



    <div class="companies">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class=" py-24 sm:py-32">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <h2 class="text-center text-3xl sm:text-4xl font-bold tracking-tight text-white">
                        Trusted by Industry Leaders
                    </h2>
                    <p class="mt-4 text-center text-gray-400 max-w-2xl mx-auto">
                        Celebrating the studios and publishers shaping the future of gaming.
                    </p>

                    <div class="mx-auto mt-10 grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-5">
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
    </div>
    </div>
</body>

<script src="awards.js"></script>

</html>