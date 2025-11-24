<?php

include 'genres.php';
include 'giftcards.php';

$genres = json_encode($genreStats);
$gift_img = $Img;

$emojiKeywords = [
  'action' => '🎮',
  'adventure' => '🗺️',
  'rpg' => '🛡️',
  'battle' => '⚔️',
  'horror' => '👻',
  'fighting' => '🥊',
  'fps' => '🔫',
  'shooter' => '🔫',
  'platformer' => '🚩',
  'puzzle' => '🧩',
  'racing' => '🏎️',
  'simulation' => '🛠️',
  'sports' => '⚽',
  'stealth' => '🕵️',
  'strategy' => '♟️',
  'survival' => '🪓',
  'sandbox' => '🏖️',
  'rhythm' => '🎵',
  'visual novel' => '📖',
  'co-op' => '🤝',
  'metroidvania' => '🧭',
  'party' => '🎉',
  'mmorpg' => '🌐',
  'moba' => '🗡️',
  'tps' => '🔫',
  'run' => '🏃',
  'roguelike' => '🌀',
  'exploration' => '🧭'
];

// Function to pick emoji based on keywords
function getAccurateEmoji($genre, $emojiKeywords)
{
  $genreLower = strtolower($genre);
  foreach ($emojiKeywords as $keyword => $emoji) {
    if (strpos($genreLower, $keyword) !== false) {
      return $emoji;
    }
  }
  return '🎲'; // default emoji if no match
}

$index = 0;
$limit = 12;



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="home.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <link rel="icon" type="image/x-icon" href="/icons/array.png">
  <title>Fragstore - Home</title>
</head>

<body ng-app="home" ng-controller="home_controller">
  <header id="header">
    <img id="logo" src="../icons/array.png"></img>
    <div class="navbar">
      <a href="#game" data-i18n="games">Games</a>
      <a href="#giftcard" data-i18n="giftcards">Gift Cards</a>
      <a href="#genre" data-i18n="genres">Genres</a>
      <a href="../redirect/redirect.php?destination=../contact_us/contactus.php" data-i18n="contact">Contact</a>
      <a href="#intro" data-i18n="about_us">About Us</a>
      <p class="login_toggle"></p>
    </div>


    <div id="stuff">
      <div id="sigin">
        <a href="../redirect/redirect.php?destination=../login/Log In.php" data-i18n="log_in">Log in</a>
      </div>
      <div id="register">
        <a href="../redirect/redirect.php?destination=../signup/Sign Up.php" data-i18n="sign_up">Sign up</a>
      </div>

      <div id="logout">
        <a href="../home/home.php" data-i18n="sign_up">Log out</a>
      </div>
    </div>

    <div class="progress-bar">
      <div class="filled">

      </div>

    </div>
  </header>







  <section class="hero">

    <div class="lang-menu">
      <div class="selected-lang" data-flag="https://flagsapi.com/US/flat/32.png">
        English
      </div>

      <ul>
        <li><a href="#" class="us" data-flag="https://flagsapi.com/US/flat/32.png">English</a></li>
        <li><a href="#" class="de" data-flag="https://flagsapi.com/DE/flat/32.png">German</a></li>
        <li><a href="#" class="it" data-flag="https://flagsapi.com/IT/flat/32.png">Italian</a></li>
        <li><a href="#" class="es" data-flag="https://flagsapi.com/ES/flat/32.png">Spanish</a></li>
        <li><a href="#" class="fr" data-flag="https://flagsapi.com/FR/flat/32.png">French</a></li>
        <li><a href="#" class="ru" data-flag="https://flagsapi.com/RU/flat/32.png">Russian</a></li>
        <li><a href="#" class="in" data-flag="https://flagsapi.com/IN/flat/32.png">Hindi</a></li>
      </ul>
    </div>

    <div class="hero-content">
      <h1 data-i18n="hero_heading">Unlock the Future of Gaming</h1>
      <p data-i18n="hero_content">Discover exclusive deals, rare collectibles, and your next favorite adventure — all in one place.</p>
      <div class="cta-buttons">
        <a href="../redirect/redirect.php?destination=../games_main.php" class="btn" data-i18n="explore">Explore Games</a>
        <a href="../redirect/redirect.php?destination=../games_main.php" class="btn secondary" data-i18n="buy">Buy Gift Cards</a>
      </div>
    </div>
  </section>



  <nav class="flex breadcrumbs" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
      <li class="inline-flex items-center">
        <a href="#" class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand">
          <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
          </svg>
          Fragstore
        </a>
      </li>
      <li>
        <div class="flex items-center space-x-1.5">
          <svg class="w-3.5 h-3.5 rtl:rotate-180 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
          </svg>
          <a href="#" class="inline-flex items-center text-sm font-medium text-body hover:text-fg-brand">Home</a>
        </div>
      </li>
    </ol>
  </nav>



  <main>
    <section id="intro" class="intro">
      <div class="intro-container">
        <div class="intro-item">
          <div class="intro-image">
            <img src="https://cms-assets.xboxservices.com/assets/bc/40/bc40fdf3-85a6-4c36-af92-dca2d36fc7e5.png?n=642227_Hero-Gallery-0_A1_857x676.png" alt="Power Up Icon">
          </div>
          <div class="intro-content">
            <h3 data-i18n="intro_heading">Power Up Your Play</h3>
            <p data-i18n="intro_content">Upgrade your setup with elite gaming gear built for speed, precision, and performance. Crafted for those who demand more from every frame.</p>
          </div>
        </div>

        <div class="intro-item reverse">
          <div class="intro-image">
            <img src="../pictures/perfomance.png" alt="Collectibles Icon">
          </div>
          <div class="intro-content">
            <h3 data-i18n="intro_heading2">Style Meets Performance</h3>
            <p data-i18n="intro_content2">Designed with precision and passion, each product blends function, form, and futuristic design — so your gear performs as good as it looks.</p>
          </div>
        </div>

        <div class="intro-item">
          <div class="intro-image">
            <img src="../pictures/game_pic.png" alt="Style Icon">
          </div>
          <div class="intro-content">
            <h3 data-i18n="intro_heading3">Collect the Rare</h3>
            <p data-i18n="intro_content3">From limited-edition drops to iconic collaborations — bring home exclusive collectibles that define the next era of gaming culture.</p>
          </div>
        </div>
      </div>
    </section>

    <div class="marquee-container">
      <div class="marquee-mask-left"></div>
      <div class="marquee-mask-right"></div>

      <div class="marquee-track">
        <div class="logos-slide">
          <div class="logo-wrapper" ng-repeat="image in images">
            <img ng-src="../pictures/{{image}}.png">
          </div>
        </div>
      </div>
    </div>

    <section class="testimonials" id="testimonials">
      <h2 data-i18n="customers_title">What Our Customers Say</h2>
      <p class="section-desc" data-i18n="feedback">Real feedback from gamers and collectors around the world.</p>

      <div class="testimonial-grid">
        <div class="testimonial-card" ng-repeat="rater in raters">
          <div class="testimonial-content">
            <p>{{rater.testimony}}</p>
            <div class="testimonial-author">
              <img ng-src="{{rater.img}}" alt="user photo">
              <div>
                <h4>{{rater.name}}</h4>
                <span>{{rater.job}}</span>
                <div class="stars">★★★★★</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section id="giftcard" class="section gift-cards-section">
      <h2 class="section-title" data-i18n="egiftcards">eGift Cards</h2>
      <div class="card-grid gift-cards-grid">
        <?php if (!empty($gift_img)): ?>
          <?php $giftIndex = 0; ?>
          <?php foreach ($gift_img as $img): ?>
            <a href="../games_main.php">
              <div class="gift-card-wrapper <?= $giftIndex >= $limit ? 'hidden-gift' : '' ?>">
                <div class="card gift-card">
                  <img src="<?= htmlspecialchars($img['IMG']); ?>" class="h-48 gift_card_img" alt="<?= htmlspecialchars($img['Name']); ?>">
                  <p class="body-text name"><?= htmlspecialchars($img['Name']); ?></p>
                </div>
              </div>
            </a>
            <?php $giftIndex++; ?>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No gift cards found.</p>
        <?php endif; ?>
      </div>

      <?php if (count($gift_img) > $limit): ?>
        <button class="show-all-gift centered-show-all" data-i18n="show_all">Show all</button>
      <?php endif; ?>
    </section>


    <!-- Top Games -->
    <section id="game" class="section">
      <h2 class="section-title" data-i18n="top_games">Top Games</h2>
      <div class="card-grid">
        <div class="card game-card" ng-repeat="game in top_games">
          <img ng-src="{{game.img}}" alt="Game 1" class="w-full h-48 object-cover rounded-t-xl">
          <p class="title">{{game.name}}</p>
          <p class="price">{{game.prize}}</p>
          <p class="body-text">{{game.desc}}</p>
        </div>
      </div>
      <br>
    </section>

    <!-- Upcoming Games -->
    <section class="section">
      <h2 class="section-title" data-i18n="upcoming_game">Upcoming Games</h2>
      <div class="card-grid">
        <div class="card game-card" ng-repeat="game in upcoming_games">
          <img ng-src="{{game.img}}" alt="Upcoming Game 1" class="w-full h-48 object-cover rounded-t-xl">
          <p class="title">{{game.name}}</p>
          <p class="price text-gray-400">Coming Soon</p>
          <p class="body-text">{{game.desc}}</p>
        </div>
      </div>
      <br>
    </section>

    </section>


    <section id="genre" class="section genre-section">
      <h2 class="section-title" data-i18n="genre">Genre</h2>
      <div class="card-grid genre-grid">
        <?php if (!empty($genreStats)): ?>
          <?php foreach ($genreStats as $genre => $count): ?>
            <a href="http://localhost:3000/games_main.php#!?genres=<?= $genre ?>&platforms=">
              <div class="genre-card-wrapper <?= $index >= $limit ? 'hidden' : '' ?>">
                <div class="card genre-card">
                  <div class="icon-placeholder"><?= getAccurateEmoji($genre, $emojiKeywords); ?></div> <!-- You can customize icons per genre -->
                  <p class="number"><?= $count ?></p>
                  <p class="body-text"><?= htmlspecialchars($genre) ?></p>
                </div>
              </div>
            </a>
            <?php $index++; ?>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No genre data found.</p>
        <?php endif; ?>
      </div>
      <?php if ($genreStats > $limit): ?>

        <button class="show-all centered-show-all" data-i18n="show_all">Show all</button>
      <?php endif; ?>
    </section>

  </main>


  <div class="faq-container">
    <h1 class="faq-title section-title mb-6" id="FAQ" data-i18n="faq">FAQ</h1><br>

    <div class="faq-item" ng-repeat="content in faq_contents">
      <input type="checkbox" id="faq{{content.id}}" class="faq-checkbox">
      <label for="faq{{content.id}}" class="faq-question">
        {{content.query}}
        <span class="faq-icon">+</span>
      </label>
      <div class="faq-answer">
        {{content.answer}}
      </div>
    </div>

  </div>

  <section id="quotes" class="section quotes-section">
    <div class="max-w-6xl mx-auto px-4 text-center">
      <h2 class="section-title mb-6" data-i18n="from_people">From People</h2>
      <p class="section-desc mb-12" data-i18n="from_people_content">Hear from gamers, creators, and enthusiasts who love shopping at Fragstore.</p>

      <div class="testimonial-grid">
        <div class="testimonial-card" ng-repeat="content in testimonial_content">
          <div class="testimonial-content">
            <p>{{content.title}}</p>
            <div class="testimonial-author">
              <span>{{content.author}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <!-- AI Chatbot Button -->
  <div id="chatbot-container">
    <button id="chatbot-btn">💬</button>
    <div id="chatbot-window">
      <div id="chatbot-header">
        <span>AI Assistant</span>
        <img src="../pictures/chatbot.png" alt="" class="chatbot_img">
        <button id="chatbot-close">✖</button>
      </div>
      <div class="chatbot-wrapper">
        <div id="chatbot-messages"></div>
      </div>
      <form id="chatbot-form">
        <input type="text" id="chatbot-input" placeholder="Type a message..." required>
        <button type="submit" id="chatbot-send">Send</button>
      </form>
    </div>
  </div>





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
            <h2 class="mb-6 text-sm font-semibold  uppercase dark:text-white" data-i18n="about">About</h2>
            <ul class="text-gray-500 dark:text-gray-400 font-medium">
              <li class="mb-4">
                <a href="#intro" class="#" data-i18n="about_us">About Us</a>
              </li>
              <li>
                <a href="/contact_us/contactus.php" class="" data-i18n="contact">Contacts</a>
              </li>
            </ul>
          </div>
          <div>
            <h2 class="mb-6 text-sm font-semibold  uppercase dark:text-white" data-i18n="help">Help</h2>
            <ul class="text-gray-500 dark:text-gray-400 font-medium">
              <li class="mb-4">
                <a href="#FAQ" class="" data-i18n="faq">FAQ</a>
              </li>
              <li class="mb-4">
                <a href="../pdf/Refund Policy.pdf" class="" data-i18n="refund_policy">Refund Policy</a>
              </li>
            </ul>
          </div>
          <div>
            <h2 class="mb-6 text-sm font-semibold uppercase dark:text-white" data-i18n="legal">Legal</h2>
            <ul class="text-gray-500 dark:text-gray-400 font-medium">
              <li class="mb-4">
                <a href="../pdf/Privacy Policy.pdf" class="" data-i18n="privacy_policy">Privacy Policy</a>
              </li>
              <li>
                <a href="../pdf/Terms and Conditions.pdf" class="" data-i18n="terms_and_conditions">Terms &amp; Conditions</a>
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

  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="home.js"></script>
  <script src="translations.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.0/dist/flowbite.min.js"></script>


  <script>

    document.querySelectorAll('.show-all').forEach(button => {
      button.addEventListener('click', function() {
        // Find all hidden cards in the same section
        const section = this.closest('section');
        section.querySelectorAll('.hidden').forEach(card => card.classList.remove('hidden'));
        this.style.display = 'none';
      });
    });


    document.querySelectorAll('.show-all-gift').forEach(button => {
      button.addEventListener('click', function() {
        const section = this.closest('section');
        section.querySelectorAll('.hidden-gift').forEach(card => card.classList.remove('hidden-gift'));
        this.style.display = 'none';
      });
    });

    const chatHistory = [];

    const chatbotBtn = document.getElementById("chatbot-btn");
    const chatbotWindow = document.getElementById("chatbot-window");
    const chatbotClose = document.getElementById("chatbot-close");
    const chatbotForm = document.getElementById("chatbot-form");
    const chatbotInput = document.getElementById("chatbot-input");
    const chatbotMessages = document.getElementById("chatbot-messages");

    // Show chatbot
    chatbotBtn.addEventListener("click", () => {
      chatbotWindow.style.display = "flex";
      chatbotBtn.style.display = "none";
    });

    // Hide chatbot
    chatbotClose.addEventListener("click", () => {
      chatbotWindow.style.display = "none";
      chatbotBtn.style.display = "block";
    });

    // Handle form submission
    chatbotForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const userMessage = chatbotInput.value.trim();
      if (!userMessage) return;

      appendMessage("user", userMessage);
      chatbotInput.value = "";
      await getResponse(userMessage);
    });

    function appendMessage(sender, message) {
      const msgElement = document.createElement("div");
      msgElement.classList.add("message", sender);
      msgElement.textContent = message;
      chatbotMessages.appendChild(msgElement);
      chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    async function getResponse(userMessage) {
      const API_KEY = "AIzaSyC-OwJUqBPkTyehSxqqpwE3YkRTGCmF7oE";
      const API_URL = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${API_KEY}`;

      // add user message to history
      chatHistory.push({
        role: "user",
        text: userMessage
      });

      // create contents array
      const contents = chatHistory.map(msg => ({
        parts: [{
          text: msg.text
        }]
      }));

      try {
        const response = await fetch(API_URL, {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            contents,
            generationConfig: {
              maxOutputTokens: 150,
              temperature: 0.7,
            }
          }),
        });

        const data = await response.json();

        if (!data.candidates?.length) {
          throw new Error("No response from Gemini API");
        }

        const botMessage = data.candidates[0].content.parts[0].text;

        // add bot message to history
        chatHistory.push({
          role: "bot",
          text: botMessage
        });

        appendMessage("bot", botMessage);

      } catch (error) {
        console.error("Error:", error);
        appendMessage("bot", "⚠️ Sorry, I’m having trouble responding right now.");
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
    const loginToggle = document.querySelector(".login_toggle");
    const username = localStorage.getItem("name"); // use the same key

    if (username) {
        loginToggle.style.display = "flex";
        loginToggle.textContent = `Welcome ${username}!`; // use textContent instead of innerHTML
    } else {
        loginToggle.style.display = "none"; // hide if not logged in
    }

});

  </script>
</body>

</html>