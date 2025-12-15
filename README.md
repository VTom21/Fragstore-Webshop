<div align="center">
  <img src="./icons/array.png" width="60" alt="Fragstore Homepage"><br>
  <h2><strong>Fragstore - Game Webshop</strong></h2>
</div>

<div align="center">
  <img src="https://img.shields.io/badge/Build-Passing-ghostwhite">
  <img src="https://img.shields.io/badge/Version-1.0-blue">
  <img src="https://img.shields.io/badge/License-MIT-ghostwhite">
  <img src="https://img.shields.io/badge/Last_Commit-1_day_ago-blue"><br>
<img src="https://img.shields.io/badge/npm-v1.0-ghostwhite">
<img src="https://img.shields.io/badge/stars-0-blue">
<img src="https://img.shields.io/badge/commits-140-ghostwhite">
</div>


<br>
<div align="center">
<img src="https://img.shields.io/badge/Angular-DD0031?style=for-the-badge&logo=angular&logoColor=white">
<img src="https://img.shields.io/badge/npm-CB3837?style=for-the-badge&logo=npm&logoColor=white">
<img src="https://img.shields.io/badge/figma-%23F24E1E.svg?&style=for-the-badge&logo=figma&logoColor=white" />
<img src="https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white"><br>
<img src="https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white">
<img src="https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white"> 
<img src="https://img.shields.io/badge/mysql-%234479A1.svg?&style=for-the-badge&logo=mysql&logoColor=white"> 
<img src="https://img.shields.io/badge/bootstrap-%237952B3.svg?&style=for-the-badge&logo=bootstrap&logoColor=white" />
<img src="https://img.shields.io/badge/Chart%20js-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white" /><br>
<img src="https://img.shields.io/badge/green%20sock-88CE02?style=for-the-badge&logo=greensock&logoColor=white" />
<img src="https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white" />
<img src="https://img.shields.io/badge/apache-%23D42029.svg?style=for-the-badge&logo=apache&logoColor=white" />
<img src="https://img.shields.io/badge/p5%20js-ED225D?style=for-the-badge&logo=p5dotjs&logoColor=white" /><br>
<img src="https://img.shields.io/badge/Sketch-FFB387?style=for-the-badge&logo=sketch&logoColor=black" />
<img src="https://img.shields.io/badge/Sass-CC6699?style=for-the-badge&logo=sass&logoColor=white" />
<img src="https://img.shields.io/badge/Alpine%20JS-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=black" />

</div>





## 📖 **Overview**

**Fragstore** is a modern **game webshop platform** built with **Strapi** (backend) and designed to manage:

* Hundreds of games
* Gift cards
* Custom user wishlists
* Orders and Stripe payments

The platform also includes a **secret Pac-Man Easter Egg game** and an **advanced, responsive design**, providing a polished user experience.


## 🚀 **Features**

* **Game Catalog**: Browse and search hundreds of games.
* **Gift Cards**: Buy or redeem digital gift cards.
* **User Profiles**: Personalized dashboards and wishlists.
* **Secret Easter Egg**: Hidden Pac-Man game for fun discovery.
* **Stripe Integration**: Secure online payments.
* **Responsive UI**: Works seamlessly on desktop and mobile.


## 🖼 **UI Overview**

### **Homepage**

* Featured games carousel
* Quick search & category filters
* Top-selling games display

### **Game Details Page**

* Detailed description & images
* Price, stock, and purchase button
* Wishlist & social sharing options

### **Cart & Checkout**

* Manage orders
* Apply gift cards
* Secure Stripe checkout


<div align="center">
  <img src="./pacman/assets/pacman/pacmanRight.png" width="60" alt="Fragstore Homepage"><br>
  <h3><strong>Easter Egg game (Pacman)</strong></h3>
</div>

---

* Have a little fun while shopping 
* You have to found  the Pac Man
  * You have to found the way to play even after you get to it in the Store
  * hint: Just click it sometimes  
* The original mechanics from the first Pac man
* New designs and abilities
* Score system with local leaderboard  

<div align="center">
  <img src="./pacman/assets/pacman/pacmanRight.png" width="60" alt="Fragstore Homepage"><br>
  <h3><strong>Easter Egg game (Snake)</strong></h3>
</div>

---

* This also for  fun 
* It's also hidden 
  * You have to found it like the one befor
* The mechanics almost same as the original, but we made it a little bit more creative
* Different design like other fruits



## ⚙️ **How It Works**

### **1\. Browsing Games**

* Users can search, filter by category, or browse trending games.
* Each game page shows price, description, and available gift cards.

### **2\. Purchasing Games**

* Add items to the cart.
* Checkout securely with **Stripe integration**.
* Orders are saved under the user profile.

### **3\. Using Wishlists & Easter Eggs**

* Add games to personal wishlists.
* Discover hidden **Pac-Man game** Easter egg on specific pages.


## 🏆 **Admin & Management**

Administrators can manage all platform data via **Strapi**:

* **Games**: Add, edit, or remove titles.
* **Categories**: Organize games efficiently.
* **Orders**: Track user purchases.
* **Users**: Manage accounts, roles, and permissions.


## 🧑‍💻 **How to Use**

1. **Clone the repository**:
2. **After cloning make sure to load in the datebases**
   * Open xampp
   * Start Apache for php files
   * Start MySQL for the databases than run it as an admin
   * In the admin panel import the sql files one each time
   * After that you good to go 

## 👨‍💻 **Code Snippets**


<h3>
  Translation
  <img align="right" padding="0" margin="0" width="80" src="https://skillicons.dev/icons?i=js,angular">
</h3>




```Javascript
/*Translation option in the home page */

const translations = {
  hero_heading: {
    us: "Unlock the Future of Gaming",
    de: "Entdecke die Zukunft des Gamings",
    it: "Scopri il Futuro del Gaming",
    es: "Desbloquea el Futuro del Gaming",
    ru: "Откройте будущее гейминга",
    fr: "Déverrouillez l'avenir du gaming",
    in: "गेमिंग का भविष्य खोलें"
  },
  
};

// ----- TRANSLATION FUNCTION -----
function translate(lang) {
  document.querySelectorAll("[data-i18n]").forEach(el => {
    const key = el.getAttribute("data-i18n");
    if(translations[key] && translations[key][lang]) {
      el.textContent = translations[key][lang];
    }
  });
}

// ----- LANGUAGE SWITCHER -----
const selected = document.querySelector(".selected-lang");
document.querySelectorAll(".lang-menu a").forEach(link => {
  link.addEventListener("click", e => {
    e.preventDefault();
    const lang = link.className;
    selected.textContent = link.textContent;
    selected.style.setProperty("--flag", `url(${link.dataset.flag})`);
    document.querySelector(".lang-menu ul").style.display = "none";
    translate(lang);
  });
});

selected.addEventListener("click", () => {
  const menu = document.querySelector(".lang-menu ul");
  menu.style.display = menu.style.display === "block" ? "none" : "block";
});
```

<h3>
  Prize Range
  <img align="right" padding="0" margin="0" width="80" src="https://skillicons.dev/icons?i=js,angular">
</h3>

```javascript
/*Main page
 (PrizeRange)*/

$scope.PrizeRange = function () {
    var min = parseFloat($scope.parameter1) || 0;
    var max = parseFloat($scope.parameter2) || Infinity;
    var rate = $scope.rates[$scope.select_currency] || 1;

    $scope.filteredGames = [];
    for (var i = 0; i < $scope.games.length; i++) {
      var game = $scope.games[i];
      var price = game.prize * rate;
      var discountedPrice = game.discountedPrize ? game.discountedPrize * rate : null;

      if (game.isDiscount == 1) {
        if (discountedPrice >= min && discountedPrice <= max) {
          $scope.filteredGames.push(game);
        }
      } else {
        if (price >= min && price <= max) {
          $scope.filteredGames.push(game);
        }
      }
  }

  $scope.applySorting();
};

// Filter games accordingly

    var filtered = [];
    for (var i = 0; i < $scope.games.length; i++) {
      var game = $scope.games[i]; //stores all games

      var gameGenres = game.genre.toLowerCase(); //stores all their genres

      var genreMatch = false; //checks if theres a match in genres

      if (selectedGenres.length === 0) {
        genreMatch = true; //if user chooses no genres, genre match will still apply
      } else {
        for (var j = 0; j < selectedGenres.length; j++) {
          if (gameGenres.includes(selectedGenres[j])) {
            //checks from all existing genres if there really is one
            genreMatch = true;
            break;
          }
        }
      }

// Prize sorting

  $scope.updatePrizeSortOrder = function (which) {
    if (which === "asc") {
      if ($scope.isPrizeAscChecked) {
        $scope.isPrizeDescChecked = false;
        $scope.prizeSortOrder = "asc";
      } else {
        $scope.prizeSortOrder = "";
      }
    } else if (which === "desc") {
      if ($scope.isPrizeDescChecked) {
        $scope.isPrizeAscChecked = false;
        $scope.prizeSortOrder = "desc";
      } else {
        $scope.prizeSortOrder = "";
      }
    }

    if ($scope.prizeSortOrder) {
      $scope.applySorting();
    } else {
      $scope.applyAdvancedFilters();
    }
  };
```
<h3>
  Cards
  <img align="right" padding="0" margin="0" width="160" src="https://skillicons.dev/icons?i=html,css,angular,php">
</h3>


```html
<!--Inbedded html in php and angularjs (Games card)-->

<div class="game-container">
        <div class="card" ng-repeat="game in filteredGames | filter:{name: searchText} | limitTo:itemsPerPage:((currentPage - 1) * itemsPerPage)">
            <img ng-src="{{game.game_pic}}" alt="{{game.name}}" ng-click="easter_egg(game)">
            <p class="discount-badge" ng-if="game.isDiscount == 1">
                {{ (((game.prize - game.discountedPrize) / game.prize * 100)) * (-1) | number:0 }}%
            </p>
            <div class="card-content">
                <h2 class="title">{{game.name}} <button class="wish_btn off" data-game-id="{{game.id}}" ng-class="{'active': isInWishlist(game.id), 'off': !isInWishlist(game.id)}" ng-click="Wishlist(game, $event)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="transparent" viewBox="0 0 24 24" stroke-width="1.3" stroke="#00f7ff" class="WishBtn">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button></h2>
                <p><strong>Genre:</strong> {{game.genre}}</p>
                <p><strong>Platform:</strong> {{game.platforms}}</p>
                <p><strong>Release:</strong> {{game.release_date}}</p>
            </div>
            <div class="price-wrapper">
                <div class="status">
                    <h3 class="status_text"></h3>
                </div>
                <div class="price-box">
                    <p class="price" ng-style="{'text-decoration': game.isDiscount == 1 ? 'line-through' : 'none'}">
                        {{ (game.isDiscount == 1 ? convertPrice({prize: game.prize}) : convertPrice({prize: game.prize})) }} {{select_currency}}
                    </p>

                    <p class="discount" ng-if="game.isDiscount == 1">
                        {{ convertPrice({prize: game.discountedPrize || game.prize}) }} {{select_currency}}
                    </p>
                </div>   
            </div>
        </div>
    </div>

```

<h3>
  Backend
  <img align="right" padding="0" margin="0" width="80" src="https://skillicons.dev/icons?i=mysql,php">
</h3>

```sql
--Snippet from one of our database (giftcard.sql)

CREATE TABLE `giftcard` (
  `CardId` varchar(50) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IMG` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Region` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `giftcard` (`CardId`, `Name`, `IMG`, `Price`, `Region`)

-- (videogames.sql)

CREATE DATABASE IF NOT EXISTS videogames;
USE videogames;

CREATE TABLE `awards` (
  `award_id` int(11) NOT NULL,
  `award_name` varchar(255) NOT NULL,
  `award_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `datas` (
  `id` int(11) NOT NULL,
  `game_pic` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `platforms` varchar(255) DEFAULT NULL,
  `prize` decimal(10,2) DEFAULT NULL,
  `publisher_id` int(11) DEFAULT NULL,
  `isDiscount` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `datas` (`id`, `game_pic`, `name`, `release_date`, 
`genre`, `platforms`, `prize`, `publisher_id`, `isDiscount`)

-- (users.sql)

CREATE database if not exists users;
use users;

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `created_at`)

```


| Tables | Are | Cool |
| ------ | :---: | ---: |
| col 1 is | left-aligned | $1600 |
| col 2 is | centered | $12 |
| col 3 is | right-aligned | $1 |


<br>

<div align="center">
<img src="https://img.shields.io/badge/Battle.net-000?style=for-the-badge&logo=battle.net&logoColor=148EFF">
<img src="https://img.shields.io/badge/Epic%20Games-313131?style=for-the-badge&logo=Epic%20Games&logoColor=white">
<img src="https://img.shields.io/badge/Origin-F56C2D?style=for-the-badge&logo=origin&logoColor=white">
<img src="https://img.shields.io/badge/PlayStation-003791?style=for-the-badge&logo=playstation&logoColor=white"><br>
<img src="https://img.shields.io/badge/Steam-000000?style=for-the-badge&logo=steam&logoColor=white">
<img src="https://img.shields.io/badge/Xbox-107C10?style=for-the-badge&logo=xbox&logoColor=white">
<img src="https://img.shields.io/badge/Riot_Games-D32936?style=for-the-badge&logo=riot-games&logoColor=white">
<img src="https://img.shields.io/badge/Discord-5865F2?style=for-the-badge&logo=discord&logoColor=white">
<img src="https://img.shields.io/badge/Netflix-E50914?style=for-the-badge&logo=netflix&logoColor=white">
</div>

