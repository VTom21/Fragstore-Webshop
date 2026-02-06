<?php
error_reporting(0); // suppress warnings/notices

// --- Firebase Config ---
$firebaseBaseUrl = "https://stock-9bff5-default-rtdb.europe-west1.firebasedatabase.app/games.json";


// --- Fetch current Firebase data ---
$context = stream_context_create([
    'http' => ['method' => 'GET'],
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false
    ]
]);

$firebaseRaw = @file_get_contents($firebaseBaseUrl, false, $context);
$firebaseData = json_decode($firebaseRaw, true);



// --- Function to reset stock ---
function resetStock($value, &$firebaseData)
{
    foreach ($firebaseData as $gameId => &$game) {
        $game['stock'] = $value;
    }
}

// --- Reset stock to 500 ---
if (!empty($firebaseData)) {
    $options = [
        'http' => [
            'method' => 'PUT',
            'header' => "Content-Type: application/json\r\n",
            'content' => json_encode($firebaseData),
            'ignore_errors' => true
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]
    ];
    $context = stream_context_create($options);
    $result = @file_get_contents($firebaseBaseUrl, false, $context);

    if ($result === FALSE) {
        $error = error_get_last();
        echo "Error updating Firebase: " . $error['message'];
    }
} else {
    echo "Firebase is empty. Nothing to reset.";
}

$apiUrl = "https://open.er-api.com/v6/latest/USD";
$context = stream_context_create([
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false
    ]
]);
$response = @file_get_contents($apiUrl, false, $context);
$data = json_decode($response, true);
$currencies = isset($data["rates"]) ? array_keys($data["rates"]) : [];

?>




<!DOCTYPE html>
<html lang="en" ng-app="videogameApp">

<head>
    <meta charset="UTF-8">
    <title>Fragstore</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
    <link rel="icon" type="image/x-icon" href="/icons/array.png">
</head>

<body ng-controller="GameController" class="dark">

    <div class="navbar" id="#top">


        <button class="filter-ranking" ng-click="rankingOpen = true">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#37e6ec73" viewBox="0 0 24 24">
                <path d="M4 21h4v-8H4v8zm6 0h4v-14h-4v14zm6 0h4v-5h-4v5z" />
            </svg>
        </button>

        <button class="shop-cart" ng-click="cartOpen = true" data-count={{count}}>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#37e6ec73" viewBox="0 0 24 24">
                <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 
                 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 
                 14h9.58c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1 1 0 0 0 
                 21.25 5H6.21L5.27 2H2v2h2l3.6 7.59-1.35 
                 2.44C5.52 14.37 6.23 16 7.16 16H19v-2H7.16z" />
            </svg>
        </button>

        <div class="cart-sidebar" ng-class="{'active': cartOpen}">
            <div class="cart-header">
                <h2>Your Cart</h2>
                <button class="close-btn" ng-click="cartOpen = false">×</button>
            </div>
            <div class="cart-content">
                <div ng-if="cartItems.length === 0">Your cart is empty.</div>
                <div class="cart-item" ng-repeat="item in cartItems">
                    <img ng-src="{{item.game_pic}}">
                    <div class="cart-data">
                        <h4>{{item.name}}</h4>
                        <p>{{item.total_prize | number:2 }} {{select_currency}}</p>
                    </div>
                    <div class="qty-controls">
                        <button ng-click="decreaseQty(item)">−</button>
                        <span>{{item.quantity}}</span>
                        <button ng-click="increaseQty(item)">+</button>
                    </div>
                </div>
            </div>
            <button class="redirect_btn" ng-click="checkout()" ng-show="cartItems.length > 0">Buy Now</button>
        </div>

        <div class="overlay" ng-class="{'active': cartOpen}" ng-click="cartOpen = false"></div>

        <!-- Wishlist Sidebar -->
        <div class="wishlist-sidebar" ng-class="{'active': wishlistOpen}">
            <div class="wishlist-header">
                <h2>Your Wishlist</h2>
                <button class="close-btn" ng-click="wishlistOpen = false">×</button>
            </div>


            <div class="wishlist-content">
                <div ng-if="wishlistItems.length === 0" style="  grid-column: 1/ span 3; text-align: center;">Your
                    wishlist is empty.</div>

                <div class="wishlist-item" ng-repeat="item in wishlistItems track by item.id">
                    <img ng-src="{{item.game_pic}}">
                    <div class="wishlist-data">
                        <h4>{{item.name}}</h4>
                    </div>

                </div>
            </div>
            <button class="redirect_btn" ng-click="wishlistOpen = false" ng-hide="wishlistItems.length > 0">Add
                Now</button>
        </div>

        <!-- Wishlist Overlay -->
        <div class="overlay" ng-class="{'active': wishlistOpen}" ng-click="wishlistOpen = false"></div>


        <button class="wish-btn" ng-click="wishlistOpen = true" data-count2={{count2}}>
            <svg xmlns="http://www.w3.org/2000/svg" fill="#37e6ec73" viewBox="0 0 24 24" stroke-width="0" width="20"
                height="20" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </button>


        <div class="modal-backdropchart" ng-show="rankingOpen">
            <div class="modalchart">
                <h2>Game Rankings</h2><br>
                <canvas id="myChart"></canvas>
                <p>Total products: {{ numberOfProducts }}</p>
                <p>Total Genres: {{ numberOfGenres }}</p>
                <p>Total Platforms: {{ numberOfPlatforms }}</p><br>
                <button ng-click="rankingOpen = false">Close</button>

            </div>
        </div>


        <div class="input-div">
            <input type="text" id="input" name="input" placeholder="Enter a game..." ng-model="searchText"
                autocomplete="off">
            <div class="top-controls">
                <button class="filter-button" ng-click="modalOpen = true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#00f7ff44" viewBox="0 0 24 24">
                        <path d="M3 5h18v2H3zm3 6h12v2H6zm3 6h6v2H9z" />
                    </svg>
                </button>
                <button class="hamburger-btn mobile-only" ng-click="menuOpen = !menuOpen">
                    ☰
                </button>
            </div>
        </div>



        <div class="hamburger-menu" ng-class="{active: menuOpen}">

            <!-- Wishlist -->
            <button ng-click="wishlistOpen = true; menuOpen = false">
                Wishlist
                <svg xmlns="http://www.w3.org/2000/svg" fill="#37e6ec73" viewBox="0 0 24 24" width="22" height="22">
                    <path
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>

            <!-- Cart -->
            <button ng-click="cartOpen = true; menuOpen = false">
                Cart
                <svg xmlns="http://www.w3.org/2000/svg" fill="#37e6ec73" viewBox="0 0 24 24" width="22" height="22">
                    <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 
            0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 
            14h9.58c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1 1 0 0 0 
            21.25 5H6.21L5.27 2H2v2h2l3.6 7.59-1.35 
            2.44C5.52 14.37 6.23 16 7.16 16H19v-2H7.16z" />
                </svg>

                <span class="badge" ng-show="count > 0">{{count}}</span>
            </button>

            <!-- Stats -->
            <button ng-click="rankingOpen = true; menuOpen = false">
                Statistics
                <svg xmlns="http://www.w3.org/2000/svg" fill="#37e6ec73" viewBox="0 0 24 24" width="22" height="22">
                    <path d="M4 21h4v-8H4v8zm6 0h4v-14h-4v14zm6 0h4v-5h-4v5z" />
                </svg>
            </button>

            <button ng-click="menuOpen = false">
                Go Back
                <svg xmlns="http://www.w3.org/2000/svg" , fill="#37e6ec73" , viewBox="0 0 24 24" width="22" height="22">
                    <path
                        d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8z" />
                    <path d="M13.293 7.293 8.586 12l4.707 4.707 1.414-1.414L11.414 12l3.293-3.293-1.414-1.414z" />
                </svg>
            </button>

        </div>

        <div class="hamburger-overlay" ng-show="menuOpen" ng-click="menuOpen = false">
        </div>

    </div>
    <div class="modal-backdrop" ng-show="modalOpen">
        <div class="modal">
            <div class="filter-columns">
                <div class="filter-group">
                    <strong>Genres:</strong>
                    <div class="checkbox-list">
                        <label class="custom-checkbox" ng-repeat="genre in uniqueGenres">
                            <input type="checkbox" ng-model="genre.selected" ng-change="save()">
                            <span class="checkmark"></span>
                            <p class="label_p">{{ genre.name }}</p>
                        </label>
                    </div>

                </div>

                <div class="filter-group">
                    <h1><strong>Platforms:</strong></h1>
                    <div class="checkbox-list">
                        <label id="platforms" class="custom-checkbox" ng-repeat="platform in platforms">
                            <input type="checkbox" ng-model="platform.selected" />
                            <span class="checkmark"></span>
                            <p class="label_p">{{ platform.name }}</p>
                        </label>
                    </div>
                </div>

                <div class="filter-group">
                    <strong>Name:</strong>
                    <div class="checkbox-list">
                        <label class="custom-checkbox">
                            <input type="checkbox" ng-model="isAscChecked" ng-change="updateSortOrder('asc')">
                            <span class="checkmark"></span>
                            <p class="label_p">A–Z (Ascending)</p>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" ng-model="isDescChecked" ng-change="updateSortOrder('desc')">
                            <span class="checkmark"></span>
                            <p class="label_p">Z–A (Descending)</p>
                        </label>
                    </div>
                </div>

                <div class="filter-group">
                    <strong>Prize:</strong>
                    <div class="checkbox-list">
                        <label class="custom-checkbox">
                            <input type="checkbox" ng-model="isPrizeAscChecked"
                                ng-change="updatePrizeSortOrder('asc')" />
                            <span class="checkmark"></span>
                            <p class="label_p">Ascending</p>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" ng-model="isPrizeDescChecked"
                                ng-change="updatePrizeSortOrder('desc')" />
                            <span class="checkmark"></span>
                            <p class="label_p">Descending</p>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" ng-model="PrizeDiscount" ng-change="Discount(PrizeDiscount)" />
                            <span class="checkmark"></span>
                            <p class="label_p">Discount</p>
                        </label>
                    </div>
                </div>

                <div class="filter-group special1">
                    <strong style="width: 50%; margin: auto;">Prize Range:</strong>
                    <div class="checkbox-list" id="Range">
                        <label class="custom-checkbox">
                            <input id="range2" type="text" ng-model="parameter1" ng-change="PrizeRange()" class="parameter1"
                                placeholder="Min" /> -
                            <input id="range2" type="text" ng-model="parameter2" ng-change="PrizeRange()" class="parameter2"
                                placeholder="Max" />
                        </label>
                    </div>
                </div>

                <div class="filter-group special1">
                    <strong>Release Date:</strong>
                    <div class="checkbox-list">
                        <input type="range" min="2000" max="2025" ng-model="releaseYear" ng-change="advancedRange()"
                            id="vol">

                        <span id="input2">{{ releaseYear }}</span>
                    </div>
                </div>

                <div class="filter-group">
                    <strong>Stock:</strong>
                    <div class="checkbox-list">
                        <label class="custom-checkbox">
                            <input type="checkbox" ng-model="stockBool" ng-change="inStock()">
                            <span class="checkmark"></span>
                            <p class="label_p">Items in stock</p>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" ng-model="stockBool2" ng-change="inStock()">
                            <span class="checkmark"></span>
                            <p class="label_p">Items not in stock</p>
                        </label>
                    </div>
                </div>
            </div>
            <button ng-click="modalOpen = false">Close</button>
        </div>
    </div>

    <div class="select-container">
        <div class="select-wrapper">
            <select id="currency-select" ng-model="select_currency" ng-change="changeCurrency(select_currency)">
                <option ng-repeat="(key, value) in rates" value="{{key}}">{{key}}</option>
            </select>
        </div>
    </div>

    <br><br><br><br>


    <div class="game-container">
        <div class="card"
            ng-repeat="game in filteredGames | filter:{name: searchText} | limitTo:itemsPerPage:((currentPage - 1) * itemsPerPage)">
            <img ng-src="{{game.game_pic}}" alt="{{game.name}}" ng-click="easter_egg(game)">
            <p class="discount-badge" ng-if="game.isDiscount == 1">
                {{ (((game.prize - game.discountedPrize) / game.prize * 100)) * (-1) | number:0 }}%
            </p>
            <div class="card-content">
                <h2 class="title">{{game.name}} <button class="wish_btn off" data-game-id="{{game.id}}"
                        ng-class="{'active': isInWishlist(game.id), 'off': !isInWishlist(game.id)}"
                        ng-click="Wishlist(game, $event)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="transparent" viewBox="0 0 24 24"
                            stroke-width="1.3" stroke="#00f7ff" class="WishBtn">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button></h2>
                <p><strong>Genre:</strong> {{game.genre}}</p>
                <p><strong>Platform:</strong> {{game.platforms}}</p>
                <p><strong>Release:</strong> {{game.release_date}}</p>
                <p class="stock"><strong>Stock:</strong> {{game.stock}}</p>
            </div>
            <div class="price-wrapper">
                <div class="status">
                    <h3 class="status_text"></h3>
                </div>
                <div class="price-box">
                    <p class="price" ng-style="{'text-decoration': game.isDiscount == 1 ? 'line-through' : 'none'}">
                        {{ (game.isDiscount == 1 ? convertPrice({prize: game.prize}) : convertPrice({prize:
                        game.prize})) }} {{select_currency}}
                    </p>

                    <p class="discount" ng-if="game.isDiscount == 1">
                        {{ convertPrice({prize: game.discountedPrize || game.prize}) }} {{select_currency}}
                    </p>

                </div>
                <br>
                <p id="stock_text" ng-style="{'color': game.stock > 0 ? 'var(--stock)' : 'var(--out_stock)'}">
                    {{ game.stock > 0 ? 'In Stock' : 'Out of Stock' }}
                </p>
                <div class="btns">
                    <button class="buy_btn" ng-click="Content(game.name, game.genre)">Read More</button>
                    <button class="shop_btn" ng-click="openCart(game)"><svg xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="pagination-controls">
        <button ng-disabled="currentPage == 1" ng-click="currentPage = currentPage - 1; scrollToTop();"
            class="prev">Previous</button>

        <p id="pagination_count">Page {{currentPage}} of {{ totalPages() }}</p>

        <button ng-disabled="currentPage >= totalPages()" ng-click="currentPage = currentPage + 1; scrollToTop();"
            class="next">Next</button>
    </div>


    <br><br>
    <footer class="footer">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="./home/home.php" class="flex items-center">
                        <img src="/icons/array.png" class="h-10 me-3" alt="FlowBite Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white id2"><span
                                class="id1">Frag</span>store</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold  uppercase dark:text-white">About</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="/home/home.php#intro" class="">About Us</a>
                            </li>
                            <li>
                                <a href="./contact_us/contactus.php" class="">Contacts</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold  uppercase dark:text-white">Help</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="/home/home.php#FAQ" class="">FAQ</a>
                            </li>
                            <li class="mb-4">
                                <a href="./pdf/Refund Policy.pdf" class="">Refund Policy</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold uppercase dark:text-white" data-i18n="legal">Community
                        </h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4 links">
                                <a href="../redirect/redirect.php?destination=../awards/awards.php" class="links"
                                    data-i18n="privacy_policy">Game Awards</a>
                            </li>
                            <li class="links">
                                <a href="../pdf/Terms and Conditions.pdf" class="links"
                                    data-i18n="terms_and_conditions">Work with us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8"
                style="border-color:rgb(88, 86, 86);" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm sm:text-center copyright_text">© 2025 <a href="https://flowbite.com/"
                        class="hover:underline">Fragstore™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 8 19">
                            <path fill-rule="evenodd"
                                d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 21 16">
                            <path
                                d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                        </svg>
                        <span class="sr-only">Discord community</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 17">
                            <path fill-rule="evenodd"
                                d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Dribble account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <button class="up-btn" ng-click="onScroll()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#37e6ec73"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
        </svg>
    </button>

    <script>
        window.exchangeRates = <?php echo json_encode($data["rates"]); ?>;
    </script>

    <script src="index.js"></script>
    <script src="autofill.js"></script>

    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyARV1o5YF4c17jMNBNRLC_54wCr0H1nA0E",
            authDomain: "stock-9bff5.firebaseapp.com",
            databaseURL: "https://stock-9bff5-default-rtdb.europe-west1.firebasedatabase.app",
            projectId: "stock-9bff5",
            storageBucket: "stock-9bff5.firebasestorage.app",
            messagingSenderId: "517000549452",
            appId: "1:517000549452:web:d83c4d8f92738e188fd0e9",
            measurementId: "G-EQDYMYTVJM"
        };

        firebase.initializeApp(firebaseConfig);
        const db = firebase.database();

    </script>


</body>



</html>