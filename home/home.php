<?php

include 'genres.php';

$genres = $genreStats;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="/icons/array.png">
    <title>Fragstore - Home</title>
</head>
<body>
    <header id="header">
        <img id="logo" src="../icons/array.png"></img>
        <div class="navbar">
            <a href="#game">Games</a>
            <a href="#giftcard">Gift Cards</a>
            <a href="#genre">Genres</a>
            <a href="../contact_us/contactus.php">Contact</a>
            <a href="#intro">About Us</a>
        </div>
        <div id="stuff">
            <div id="sigin">
                <a href="../login/Log In.php">Log in</a>
            </div>
            <div id="register">
                <a href="../signup/Sign Up.php">Sign up</a>
            </div>
        </div>
    </header>


<section class="hero">
  <div class="hero-content">
    <h1>Unlock the Future of Gaming</h1>
    <p>Discover exclusive deals, rare collectibles, and your next favorite adventure — all in one place.</p>
    <div class="cta-buttons">
      <a href="#game" class="btn">Explore Games</a>
      <a href="#giftcard" class="btn secondary">Buy Gift Cards</a>
    </div>
  </div>
</section>


    <main>
<section id="intro" class="intro">
  <div class="intro-container">
    <div class="intro-item">
      <div class="intro-image">
        <img src="../pacman/assets/cherry.png" alt="Power Up Icon">
      </div>
      <div class="intro-content">
        <h3>Power Up Your Play</h3>
        <p>Upgrade your setup with elite gaming gear built for speed, precision, and performance. Crafted for those who demand more from every frame.</p>
      </div>
    </div>

    <div class="intro-item reverse">
      <div class="intro-image">
        <img src="../pacman/assets/cherry.png" alt="Collectibles Icon">
      </div>
      <div class="intro-content">
        <h3>Collect the Rare</h3>
        <p>From limited-edition drops to iconic collaborations — bring home exclusive collectibles that define the next era of gaming culture.</p>
      </div>
    </div>

    <div class="intro-item">
      <div class="intro-image">
        <img src="../pacman/assets/cherry.png" alt="Style Icon">
      </div>
      <div class="intro-content">
        <h3>Style Meets Performance</h3>
        <p>Designed with precision and passion, each product blends function, form, and futuristic design — so your gear performs as good as it looks.</p>
      </div>
    </div>
  </div>
</section>

<section class="testimonials" id="testimonials">
  <h2>What Our Customers Say</h2>
  <p class="section-desc">Real feedback from gamers and collectors around the world.</p>

  <div class="testimonial-grid">
    <div class="testimonial-card">
      <div class="testimonial-content">
        <p>“Fragstore is my go-to for exclusive gaming gear. Fast delivery and top-notch quality every time.”</p>
        <div class="testimonial-author">
          <img src="https://i.pravatar.cc/100?img=1" alt="user photo">
          <div>
            <h4>Alex Johnson</h4>
            <span>Pro Gamer</span>
            <div class="stars">★★★★★</div>
          </div>
        </div>
      </div>
    </div>

    <div class="testimonial-card">
      <div class="testimonial-content">
        <p>“I love the limited edition items. The site feels premium and the customer service is amazing.”</p>
        <div class="testimonial-author">
          <img src="https://i.pravatar.cc/100?img=2" alt="user photo">
          <div>
            <h4>Samantha Lee</h4>
            <span>Streamer & Collector</span>
            <div class="stars">★★★★★</div>
          </div>
        </div>
      </div>
    </div>

    <div class="testimonial-card">
      <div class="testimonial-content">
        <p>“Excellent quality and smooth shopping experience. Definitely one of the best gaming stores out there.”</p>
        <div class="testimonial-author">
          <img src="https://i.pravatar.cc/100?img=3" alt="user photo">
          <div>
            <h4>Mark Rivera</h4>
            <span>Esports Enthusiast</span>
            <div class="stars">★★★★★</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


        <section id="giftcard" class="product-cards">

        
    <section class="section">
        <h2 class="section-title">eGift Cards</h2>
        <div class="card-grid gift-cards-grid">
            <div class="card card-placeholder">
                <img src="../icons/array.png" class="h-48">
            </div>
            <div class="card card-placeholder">
                <img src="../icons/array.png" class="h-48">
            </div>
            <div class="card card-placeholder">
                <img src="../icons/array.png" class="h-48">
            </div>
            <div class="card card-placeholder">
                <img src="../icons/array.png" class="h-48">
            </div>
        </div>
        <a href="#" class="show-all">Show all</a>
    </section>

    <!-- Top Games -->
    <section id="game" class="section">
        <h2 class="section-title">Top Games</h2>
        <div class="card-grid">
            <div class="card game-card">
                <img src="https://upload.wikimedia.org/wikipedia/en/d/d0/List_of_Playable_characters_in_Persona_5.jpg" alt="Game 1" class="w-full h-48 object-cover rounded-t-xl">
                <p class="title">Game Title 1</p>
                <p class="price">$59.99</p>
                <p class="body-text">Exciting adventure with stunning graphics.</p>
            </div>
            <div class="card game-card">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR47LjFayYHU_-Hc43iGrZkvbyFmG5YXrcrmA&s" alt="Game 2" class="w-full h-48 object-cover rounded-t-xl">
                <p class="title">Game Title 2</p>
                <p class="price">$49.99</p>
                <p class="body-text">Fast-paced action and immersive story.</p>
            </div>
            <div class="card game-card">
                <img src="https://store-images.s-microsoft.com/image/apps.58752.68182501197884443.ac728a87-7bc1-4a0d-8bc6-0712072da93c.0cf58754-9802-46f8-8557-8d3ff32a627a?q=90&w=480&h=270" alt="Game 3" class="w-full h-48 object-cover rounded-t-xl">
                <p class="title">Game Title 3</p>
                <p class="price">$39.99</p>
                <p class="body-text">Open-world RPG with incredible exploration.</p>
            </div>
            <div class="card game-card">
                <img src="https://media.wired.com/photos/639bf35a24c352e627eccc43/3:2/w_2560%2Cc_limit/Ragnaro%25CC%2588k-culture-ar1qdh.jpg" alt="Game 4" class="w-full h-48 object-cover rounded-t-xl">
                <p class="title">Game Title 4</p>
                <p class="price">$29.99</p>
                <p class="body-text">Fun casual gameplay for everyone.</p>
            </div>
        </div>
        <a href="#" class="show-all">Show all</a>
    </section>

    <!-- Upcoming Games -->
    <section class="section">
        <h2 class="section-title">Upcoming Games</h2>
        <div class="card-grid">
            <div class="card game-card">
                <img src="https://cdn.mos.cms.futurecdn.net/iPi3bFFgSfLnoNe8NS764n.jpg" alt="Upcoming Game 1" class="w-full h-48 object-cover rounded-t-xl">
                <p class="title">Upcoming Game 1</p>
                <p class="price text-gray-400">Coming Soon</p>
                <p class="body-text">Get ready for an epic new adventure!</p>
            </div>
            <div class="card game-card">
                <img src="https://assets-prd.ignimgs.com/2022/10/09/fallout5-1665340097618.jpg?crop=1%3A1%2Csmart&format=jpg&auto=webp&quality=80" alt="Upcoming Game 2" class="w-full h-48 object-cover rounded-t-xl">
                <p class="title">Upcoming Game 2</p>
                <p class="price text-gray-400">Coming Soon</p>
                <p class="body-text">RPG adventure with multiplayer mode.</p>
            </div>
            <div class="card game-card">
                <img src="https://gaming-cdn.com/images/products/6369/orig/the-sims-5-pc-mac-ea-app-cover.jpg?v=1753367505" alt="Upcoming Game 3" class="w-full h-48 object-cover rounded-t-xl">
                <p class="title">Upcoming Game 3</p>
                <p class="price text-gray-400">Coming Soon</p>
                <p class="body-text">High-octane action and story-driven gameplay.</p>
            </div>
            <div class="card game-card">
                <img src="https://static0.gamerantimages.com/wordpress/wp-content/uploads/wm/2025/01/bioshock-4-2025-game-rant.jpg?w=1600&h=900&fit=crop" alt="Upcoming Game 4" class="w-full h-48 object-cover rounded-t-xl">
                <p class="title">Upcoming Game 4</p>
                <p class="price text-gray-400">Coming Soon</p>
                <p class="body-text">Next-level graphics and immersive experience.</p>
            </div>
        </div>
        <a href="#" class="show-all">Show all</a>
    </section>

</section>


<section id="genre" class="section genre-section">
    <h2 class="section-title">Genre</h2>
    <div class="card-grid genre-grid">
        <?php if (!empty($genreStats)): ?>
            <?php foreach ($genreStats as $genre => $count): ?>
                <div class="card genre-card">
                    <div class="icon-placeholder">🎮</div> <!-- You can customize icons per genre -->
                    <p class="number"><?= $count ?></p>
                    <p class="body-text"><?= htmlspecialchars($genre) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No genre data found.</p>
        <?php endif; ?>
    </div>
    <a href="#" class="show-all centered-show-all">Show all</a>
</section>

    </main>


<section class="newsletter" id="newsletter">
  <h2>Subscribe to Our Newsletter</h2>
  <p>Get the latest deals, updates, and exclusive gaming content delivered straight to your inbox.</p>

  <form action="#" method="post">
    <input type="email" name="email" placeholder="Enter your email" required>
    <button type="submit">Subscribe</button>
  </form>

  <p class="privacy-note">We respect your privacy. Unsubscribe at any time.</p>
</section>

<!-- AI Chatbot Button -->
<div id="chatbot-container">
    <button id="chatbot-btn">💬</button>
    <div id="chatbot-window">
        <div id="chatbot-header">
            <span>AI Assistant</span>
            <button id="chatbot-close">✖</button>
        </div>
        <div id="chatbot-messages"></div>
        <form id="chatbot-form">
            <input type="text" id="chatbot-input" placeholder="Type a message..." required>
            <button type="submit">Send</button>
        </form>
    </div>
</div>

<h2>Game Genres</h2>
<ul>
    <?php if (!empty($genreStats)): ?>
        <?php foreach ($genreStats as $genre => $count): ?>
            <li><?= htmlspecialchars($genre) ?>: <?= $count ?> games</li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No genre data found.</li>
    <?php endif; ?>
</ul>


    <br><br>
    <footer class="dark:bg-gray-900 footer">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="/icons/array.png" class="flex items-center">
                        <img src="/icons/array.png" class="h-10 me-3" alt="FlowBite Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white id2"><span class="id1">Frag</span>store</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold  uppercase dark:text-white">About</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://flowbite.com/" class="">About Us</a>
                            </li>
                            <li>
                                <a href="https://tailwindcss.com/" class="">Contacts</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold  uppercase dark:text-white">Help</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://github.com/themesberg/flowbite" class="">FAQ</a>
                            </li>
                            <li class="mb-4">
                                <a href="https://discord.gg/4eeurUVvTy" class="">Refund Policy</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold uppercase dark:text-white">Legal</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="#" class="">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="">Terms &amp; Conditions</a>
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
    <button class="up-btn" ng-click="onScroll()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="#37e6ec73" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
        </svg>
    </button>

    <script src="home.js"></script>
</body>
</html>