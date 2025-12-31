<div align="center">
  <img src="./icons/array.png" width="60" alt="Fragstore Homepage"><br>
  <h2><strong>Fragstore - Game Webshop</strong></h2>
</div>

<div align="center">
  <img src="https://img.shields.io/badge/Build-Passing-blue">
    <img src="https://img.shields.io/github/last-commit/Vtom21/Fragstore-Webshop?color=blue">
  <img src="https://img.shields.io/badge/License-MIT-blue"><br>
  <img src="https://img.shields.io/badge/Version-1.0-ghostwhite">
  <img src="https://img.shields.io/github/commit-activity/t/Vtom21/Fragstore-Webshop?color=white">
<img src="https://img.shields.io/github/languages/count/Vtom21/Fragstore-Webshop?color=white">

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
<img src="https://img.shields.io/badge/react-%2320232a.svg?style=for-the-badge&logo=react&logoColor=%2361DAFB" />

</div>


### About
<img src="/pictures/home2.png"></img><br>
<img src="/pictures/main1.png"></img>

**Fragstore** is a modern webshop for games featuring a sleek, responsive design and dynamic functionality. Browse, purchase, and discover hidden gems—including **3 secret games** waiting to be unlocked by curious explorers.


### Key Features

- **User System** – Secure Sign Up and Login for personalized experiences  
- **Browse & Search** – Explore a vast catalog of games, gift cards via advanced filtering  
- **Shopping Cart** – Add items to cart, review, and purchase seamlessly  
- **Wishlist** – Save your favorite games and products for later  
- **Purchase Products** – Buy games and gift cards with integrated PayPal payment  
- **Secret Games** – Discover 3 hidden Easter eggs and unlockable games 
- **Real-time Updates** – Stay informed about new releases, deals, and latest game awards  
- **Responsive Design** – Optimized for mobile and desktop devices  
- **Enhanced Filtering & Sorting** – Quickly find products by category, price and so on
- **Language Selection** - For up to 6+ available languages

### 📑 Table of Contents

- [About](#about)
- [Installation](#prerequisites)
  - [Prerequisites](#prerequisites)
  - [Setup](#setup)
- [Secret Games](#the-secret)
- [Application Flow](#app-flow)
- [File Structure](#file)
- [Database Schema](#database)
  - [Giftcards](#giftcard)
  - [Videogames](#videogames)
  - [Users](#users)
  - [Leaderboard](#leaderboard)
- [API Endpoints & Integrations](#api)
  - [EmailJS](#api)
  - [Currency Exchange API](#currency)
  - [Flags API](#flags)
  - [Chart.js](#chart)
- [Contributing](#contribute)
- [License](#license)


---

## 🚀 Installation

### Prerequisites
- Node.js (v14 or higher)
- PHP (v7.4+)
- Git (v2.30+)
- MySQL or MariaDB
- Code Editor (Visual Studio, WebStorm..)
- Database Client (phpMyAdmin, DBeaver..)

### Setup

1. Clone the repository:
```bash
git clone https://github.com/Vtom21/Fragstore-Webshop.git
cd Fragstore-Webshop
```

2. Install dependencies:
```sh
npm install
```

3. Install PHP and Node.js:

  **Windows:**
   - Download and install Node.js: [https://nodejs.org/en/download](https://nodejs.org/en/download)
   - Download and install PHP: [https://www.php.net/downloads.php](https://www.php.net/downloads.php)

  **macOS:**
```sh
brew install php node
```

   **Linux (Ubuntu/Debian):**
```sh
sudo apt update
sudo apt install php php-cli php-mysql php-json nodejs npm -y
```

   **Verify Installations:**
```sh
php -v
node -v
npm -v
```

4. Import all databases from ```databases``` folder:
```
📁 databases/
├── 🛢️ giftcard.sql
├── 🛢️ leaderboard.sql
├── 🛢️ users.sql
└── 🛢️ videogames.sql
```

5. Start the development server:
```php
php -S localhost:8000
```

6. Open your browser and visit:
```powershell
http://localhost:3000
```

---

### 🕹️ Secret Games

Three classic arcade games lie hidden within Fragstore, waiting to be discovered by curious explorers.

### The Secret:
Click on **any game card 5 times** to unlock one of three nostalgic surprises:


<div width="20">

| Game | Version | Status    | High Score | Score System | Leaderboard | Custom Sprites | Achievements | SFX |
|------|--------|----------|-----------------|-------------|------------|----------------|--------------|-----|
| 🐍 Snake | v1.0 | Available | yes | yes | no | yes | no | no |
| 🟦 Tetris | v1.0 | Available | yes | yes | no | no  | no | no |
| <img src="pacman/assets/ghosts/redGhost.png" height="25" width="25"> Pac-Man | v1.0 | Available | yes | yes | yes | yes | yes | yes |


</div>


Will you uncover all three hidden treasures?

### 🖥️ Application Flow 

```

                                     Home
                              ┌───────┼───────┐
                              ↓       ↓       ↓
                      Main Website  Contacts  Login / Sign Up
                              │
                              │
                              ├─────────────┬─────────────┬─────────────┐
                              ↓             ↓             ↓             ↓
                      Shopping Cart  Secret Game Entry  Game Awards    Home
                              │             Points       Website
                              ↓             ↓             ↓
                           Summary        Game Screen   Completion & Rewards
                              ↓                           ↓
                           Checkout                      Home
                              ↓
                            Payment
                              ↓
                         Success/Failure
                      
```
<div id="file"></div>

### 📁 File Structure

Here’s the entire structure of the Fragstore Webshop project:

```
Fragstore-Webshop/
    ├── awards/
    │   ├── awards_data.php
    │   ├── awards.js
    │   ├── awards.php
    │   └── awards.scss
    │
    ├── cart_website/
    │   ├── sum_main.css
    │   ├── sum_main.js
    │   └── sum_main.php
    │
    ├── contact_us/
    │   ├── contactus.css
    │   ├── contactus.js
    │   └── contactus.php
    │
    ├── databases/
    │   ├── giftcard.sql
    │   ├── leaderboard.sql
    │   ├── users.sql
    │   └── videogames.sql
    │
    ├── documentation/
    │   └── documentation.docx
    │
    ├── home/
    │   ├── genres.php
    │   ├── giftcards.php
    │   ├── gsap.js
    │   ├── home.css
    │   ├── home.js
    │   ├── home.php
    │   └── translations.js
    │ 
    ├── icons/
    │   └── base assets
    │
    ├── login/
    │   ├── Forgot.php
    │   ├── Log In.css
    │   ├── Log In.php
    │   ├── OTP.css
    │   ├── OTP.js
    │   └── OTP.php
    │
    ├── order_successful/
    │   ├── success.css
    │   ├── success.js
    │   └── success.php
    │
    ├── pacman/
    │   ├── assets/
    │   │   ├── ghosts/
    │   │   │   └── ghost assets
    │   │   │
    │   │   ├── pacman/
    │   │   │   └── pacman assets
    │   │   │
    │   │   ├── others assets (food, wall)
    │   │   │
    │   ├── custom_assets/
    │   │   ├── foods/
    │   │   │   └── custom-made food assets
    │   │   ├── ghosts/
    │   │   │   └── custom-made ghost assets
    │   │   │   
    │   │   │   
    │   ├── sfx/
    │   │   ├── sound effects
    │   │   │
    │   ├── achievement.js
    │   ├── achievements.json
    │   ├── leaderboard.js
    │   ├── leaderboard.php
    │   ├── pacman.css
    │   ├── pacman.js
    │   ├── pacman.php
    │   ├── sfx.js
    │   └── submit.php
    ├── pdf/
    │   ├── Privacy Policy.pdf
    │   ├── Refund Policy.pdf
    │   └── Terms and Conditions.pdf
    │
    ├── pictures/
    │   └── some other pictures
    │
    ├── redirect
    │   ├── redirect.css
    │   ├── redirect.js
    │   └── redirect.php
    │
    ├── signup
    │   ├── Sign Up.css
    │   └── Sign Up.php
    │
    ├── snake
    │   ├── assets
    │   │   └── snake assets
    │   │
    │   ├── snake.css
    │   ├── snake.css.map
    │   ├── snake.js
    │   ├── snake.php
    │   └── snake.scss
    │
    ├── tetris
    │   ├── public
    │   │   └── tetris.png
    │   ├── src
    │   │   ├── App.css
    │   │   ├── App.css.map
    │   │   ├── App.scss
    │   │   ├── index.css
    │   │   ├── main.tsx
    │   │   ├── Tetris.tsx
    │   │   └── Tetromino.tsx
    │   │
    │   ├── .gitignore
    │   ├── eslint.config.js
    │   ├── index.html
    │   ├── package-lock.json
    │   ├── package.json
    │   ├── README.md
    │   ├── tsconfig.app.json
    │   ├── tsconfig.json
    │   ├── tsconfig.node.json
    │   └── vite.config.ts
    │
    ├── autofill.js
    ├── config.php
    ├── games_main.php
    ├── games.php
    ├── index.css
    ├── index.js
    ├── package-lock.json
    ├── package.json
    └── README.md


```

<div align="center" id="pacman">
  <img src="./pacman/assets/pacman/pacmanRight.png" width="60" alt="Fragstore Homepage"><br>
  <h3><strong>Easter Egg game (Pacman)</strong></h3>
</div>


* Have a little fun while shopping 
* You have to found  the Pac Man
  * You have to found the way to play even after you get to it in the Store
  * hint: Just click it sometimes  
* The original mechanics from the first Pac man
* New designs and abilities
* Score system with local leaderboard  

---






### 🐍 Snake
A timeless arcade classic reimagined with smooth controls and scalable difficulty.

<img src="pictures\snake1.png"></img>

Control the snake as it moves across the screen, eating food to grow longer while avoiding collisions with walls and your own tail. As the game progresses, the challenge increases, testing your reflexes and strategic movement.

Perfect for quick play sessions, Snake rewards precision, timing, and smart path planning.

**Features:**
- Three difficulty modes (Easy, Medium, Hard)
- Responsive controls

**Difficulty Settings:**

| Difficulty | Frame rate 
|-----------|--------
| Easy      | 10   
| Medium    | 20 
| Hard      | 26   

---


### 🟧 Tetris

A legendary puzzle game that challenges your speed, foresight, and spatial reasoning. Rotate and position falling blocks to form complete horizontal lines while managing limited space and increasing speeds.


<img src="pictures\tetris1.png"></img>

## 👨‍💻 **Code Snippets**


<h3>
  Translation
  <img align="right" padding="0" margin="0" width="80" src="https://skillicons.dev/icons?i=js,angular">
</h3><br>


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
---
<h3>
  Prize Range
  <img align="right" padding="0" margin="0" width="80" src="https://skillicons.dev/icons?i=js,angular">
</h3><br>

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
---
<h3>
  Cards
  <img align="right" padding="0" margin="0" width="160" src="https://skillicons.dev/icons?i=html,css,angular,php">
</h3><br>


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

---

<h3>
  Snake
  <img align="right" padding="0" margin="0" width="160" src="https://skillicons.dev/icons?i=html,css,js,php">
</h3><br>


```javascript
//Creating Snake class for storing its positions and Velocity.
class Snake {
  constructor(x, y, VelocityX, VelocityY) {
    this.body = [];
    this.x = x;
    this.y = y;
    this.VelocityX = VelocityX;
    this.VelocityY = VelocityY;

    for (let i = 4; i >= 0; i--) {
      this.body.push({ x: x - 1 * cell, y: y });
    }

    // Fix: Use cell size for proper grid alignment

    this.foodX = Math.floor(Math.random() * ((width - hitbox) / cell)) * cell;
    this.foodY = Math.floor(Math.random() * ((height - hitbox) / cell)) * cell;

    this.update = function () {
      let body_part = {
        x: this.body[this.body.length - 1].x + this.VelocityX * cell,
        y: this.body[this.body.length - 1].y + this.VelocityY * cell,
      };

      this.body.push(body_part);

      //Constrain Logic
      if (body_part.x >= width || body_part.y >= height || body_part.x < 0 || body_part.y < 0) {
        this.x = 200;
        this.y = 200;
        this.body = [{ x: 200, y: 200 }];
        this.VelocityX = 1;
        this.VelocityY = 0;
        Freeze();
        return;
      }

      for (let i = 0; i < this.body.length - 1; i++) {
        if (this.body[i].x == body_part.x && this.body[i].y == body_part.y) {
          Freeze();
          return;
        }
      }

      if (body_part.x >= this.foodX - (hitbox - cell) / 2 && body_part.x < this.foodX + hitbox - (hitbox - cell) / 2 && body_part.y >= this.foodY - (hitbox - cell) / 2 && body_part.y < this.foodY + hitbox - (hitbox - cell) / 2) {
        this.foodX = Math.floor(Math.random() * (width / cell)) * cell;
        this.foodY = Math.floor(Math.random() * (height / cell)) * cell;
        score++;
        scoreDiv = document.querySelector(".score_heading");
        scoreDiv.innerHTML = `Score: ${score}`;

            if (score > high_score) {
      high_score = score;  // update variable
      localStorage.setItem("high_score", high_score); // store in localStorage
      HighScoreDiv.innerHTML = `High Score: ${high_score}`; // update display
    }

      } else {
        this.body.shift();
      }
    };

    this.show = function () {
      snakeImg = createImg("assets/body.png");
      snakeImg.hide();
      foodImg = createImg("assets/apple.png");
      foodImg.hide();

      for (let part of this.body) {
        image(foodImg, snake.foodX, snake.foodY);
        image(snakeImg, part.x, part.y);
      }
    };
  }
}

//The controls

function Controls() {
  document.addEventListener("keydown", function (e) {
    if (!snake) {
      return;
    }
    switch (e.key) {
      case "ArrowUp":
        if (snake.VelocityY !== 1) {
          snake.VelocityX = 0;
          snake.VelocityY = -1;
        }
        break;

      case "ArrowDown":
        if (snake.VelocityY !== -1) {
          snake.VelocityX = 0;
          snake.VelocityY = 1;
        }
        break;

      case "ArrowLeft":
        if (snake.VelocityX !== 1) {
          snake.VelocityY = 0;
          snake.VelocityX = -1;
        }
        break;

      case "ArrowRight":
        if (snake.VelocityX !== -1) {
          snake.VelocityY = 0;
          snake.VelocityX = 1;
        }
        break;
    }
  });
}
```

---
<h3>
  Pac Man
  <img align="right" padding="0" margin="0" width="160" src="https://skillicons.dev/icons?i=html,css,js,php">
</h3><br>

```javascript
//image load function

function load_images() {
  image_paths.forEach((path, i) => {
    images[i] = new Image();
    images[i].src = path;
  });

  blue_ghost_img = images[0];
  red_ghost_img = images[1];
  orange_ghost_img = images[2];
  pink_ghost_img = images[3];
  pacman_down_img = images[4];
  pacman_up_img = images[5];
  pacman_left_img = images[6];
  pacman_right_img = images[7];
  wall_img = images[8];
  cherry_img = images[9];
  frozen_orb_img = images[10];
  strawberry_img = images[11];
  portal_img = images[12];
  heart_img = images[13];

  scared_ghost_img = new Image();
  scared_ghost_img.src = "assets/ghosts/scaredGhost.png";
}

// creating map[]

const map = [
  [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
  [1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1],
  [1, 2, 1, 1, 1, 2, 2, 1, 1, 1, 1, 2, 2, 1, 2, 2, 1, 1, 1, 1, 2, 2, 1, 1, 1, 2, 2, 1],
  [1, 2, 1, 1, 1, 2, 2, 1, 1, 1, 1, 2, 1, 1, 1, 2, 1, 1, 1, 1, 2, 2, 1, 1, 1, 2, 2, 1],
  [1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 10, 1], //(4,27)
  [1, 2, 1, 1, 1, 2, 1, 1, 2, 2, 2, 1, 1, 1, 1, 1, 1, 2, 2, 1, 1, 2, 1, 1, 1, 2, 2, 1],
  [1, 2, 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 2, 2, 1],
  [1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 2, 2, 1, 1, 2, 2, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1],
  [0, 0, 0, 0, 1, 2, 1, 1, 1, 1, 1, 2, 2, 1, 1, 2, 2, 1, 1, 1, 1, 2, 1, 0, 0, 0, 0, 0],
  [1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 2, 2, 1, 1, 2, 2, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1],
  [1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1],
  [1, 2, 1, 1, 1, 2, 2, 1, 1, 1, 1, 2, 2, 1, 1, 2, 2, 1, 1, 1, 1, 2, 1, 1, 1, 2, 2, 1],
  [1, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 2, 1],
  [1, 1, 1, 1, 1, 2, 2, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 2, 2, 1, 1, 1, 1, 1],
  [0, 0, 0, 0, 0, 2, 2, 1, 2, 2, 2, 1, 9, 9, 9, 9, 1, 2, 2, 2, 1, 2, 2, 0, 0, 0, 0, 0],
  [1, 1, 1, 1, 1, 2, 2, 1, 2, 2, 2, 1, 3, 6, 5, 4, 1, 2, 2, 2, 1, 2, 2, 1, 1, 1, 1, 1],
  [1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 2, 2, 2, 2, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1],
  [1, 2, 1, 1, 1, 2, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 1, 2, 1, 1, 1, 2, 2, 1],
  [1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1],
  [1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 2, 1, 1, 1, 2, 1, 1, 1, 1, 1, 2, 1, 1, 2, 1, 1, 1],
  [1, 2, 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1, 1, 2, 2, 2, 2, 2, 2, 1],
  [1, 8, 1, 1, 1, 2, 2, 2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 1, 1, 1, 1, 8, 1],
  [1, 2, 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1, 2, 1],
  [1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 7, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1],
  [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1]
];


//Map Sets and variables
//Sets dont allow duplicates, better element accessing <-> lists are ordered, slower searching, requires indexing

const walls = new Set();
const ghosts = new Set();
const cherries = new Set();
const pellets = new Set();
const gates = new Set();
const freezes = new Set();
const strawberries = new Set();
const portals = new Set();
const hearts_set = new Set();
let pacman;

// Loading the map

function load_map() {
  //reset all contents on the map
  walls.clear();
  ghosts.clear();
  cherries.clear();
  pellets.clear();
  gates.clear();
  freezes.clear();
  strawberries.clear();
  portals.clear();
  hearts_set.clear();

  for (let row = 0; row < rows; row++) {
    for (let col = 0; col < columns; col++) {
      let tile = map[row][col]; //current tile (exp. 0,0)

      let x = col * tile_size; // X coordinate => column value * tilesize => scalingX
      let y = row * tile_size; // Y coordinate => row value * tilesize => scalingY

      if(row == 4 && col == 26){
        map[row][col] = RANDOM_ORB[Math.floor(Math.random() * RANDOM_ORB.length)];
      }

      tile = map[row][col]; 
      x = col * tile_size;
      y = row * tile_size;

      //we use the constant variables for conditioning, sets for storing and a generate class for generating blocks

      switch (tile) {
        case TILE_EMPTY:
          break;

        case GHOST_GATE:
          const gate = new Generate(null, x, y + tile_size / 2, tile_size, 4);
          gate.color = "rgb(50, 50, 255)";
          gates.add(gate);
          break;

        case WALL_TILE:
          const tile_ = new Generate(wall_img, x, y, tile_size, tile_size);
          walls.add(tile_);
          break;

        case PELLET:
          const pellet = new Generate(null, x + 14, y + 14, 4, 4); // a pellet's size is 4x4, and is placed at 14 on both x and y inside the 32x32 tile -> centering of pellet
          pellets.add(pellet);
          break;

        case TILE_BLUE_GHOST:
          const blue_ghost = new Generate(blue_ghost_img, x, y, tile_size, tile_size, true);
          ghosts.add(blue_ghost);
          break;

        case TILE_RED_GHOST:
          const red_ghost = new Generate(red_ghost_img, x, y, tile_size, tile_size, true);
          ghosts.add(red_ghost);
          break;

        case TILE_ORANGE_GHOST:
          const orange_ghost = new Generate(orange_ghost_img, x, y, tile_size, tile_size, true);
          ghosts.add(orange_ghost);
          break;

        case TILE_PINK_GHOST:
          const pink_ghost = new Generate(pink_ghost_img, x, y, tile_size, tile_size, true);
          ghosts.add(pink_ghost);
          break;

        case TILE_PACMAN:
          pacman = new Generate(pacman_up_img, x, y, tile_size, tile_size);
          break;

        case CHERRY:
          const cherry = new Generate(cherry_img, x, y, tile_size, tile_size);
          cherries.add(cherry);
          break;

        case FREEZE_ORB:
          const freeze = new Generate(frozen_orb_img, x, y, tile_size, tile_size);
          freezes.add(freeze);
          break;

        case STRAWBERRY:
            const straw = new Generate(strawberry_img, x, y, tile_size, tile_size);
            strawberries.add(straw);
            break;

        case PORTAL:
            const portal = new Generate(portal_img, x, y, tile_size, tile_size);
            portals.add(portal);
            break;

        case HEART:
            const heart = new Generate(heart_img, x, y, tile_size, tile_size);
            hearts_set.add(heart);
            break;
      }    
    }
  }
}

//Abilities 

for (let cherry of cherries.values()) {
    if (Collision(pacman, cherry)) {
      Fruit_Munch();
      cherries.delete(cherry);
      chased = true;
      total_fruits++;
      localStorage.setItem("total_fruits", total_fruits);
      Frightened();
      Chase();

      Popup(pacman.x, pacman.y, 200);
      break;
    }
  }

  for (let freeze of freezes.values()) {
    if (Collision(pacman, freeze)) {
      freezes.delete(freeze);
      freezed = true;
      total_fruits++;
      localStorage.setItem("total_fruits", total_fruits);
      Freeze();
    }
  }

  for (let strawberry of strawberries.values()) {
    if (Collision(pacman, strawberry)) {
      strawberries.delete(strawberry);
      score += 500;
      total_fruits++;
      localStorage.setItem("total_fruits", total_fruits);
      Popup(pacman.x, pacman.y, 500);
      scoreUI.innerHTML = score;
    }
  }

  for (let heart of hearts_set.values()) {
    if (Collision(pacman, heart)) {
      hearts_set.delete(heart);
      total_fruits++;
      localStorage.setItem("total_fruits", total_fruits);
      heart_up()
    }
  }

  for (let portal of portals.values()) {
    if (Collision(pacman, portal)) {
      portals.delete(portal);
      total_fruits++;
      localStorage.setItem("total_fruits", total_fruits);
      Warp();
    }
  }
```
---
<div align="left" id="database">
<h3>Database Schema</h3><img  padding="0" margin="0" width="80" src="https://skillicons.dev/icons?i=mysql,php">
</div>
<br>

This section outlines the structure of all the databases used throughout this project.  
Each table is described to provide clarity about its purpose and relationships.

<div id="giftcard"></div>

### 1. `giftcard`

```sql

CREATE TABLE `giftcard` (
  `CardId` varchar(50) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IMG` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Region` varchar(255) DEFAULT NULL
) 
```
<div id="videogames"></div>

### 2. `videogames`

Contains details about games, including the picture, name, release date, genre, platforms, prize, publisher, and discount status.

```sql
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
) 
```
Stores awards associated with games or developers, including award name and year.
```sql
CREATE TABLE `awards` (
  `award_id` int(11) NOT NULL,
  `award_name` varchar(255) NOT NULL,
  `award_year` int(11) DEFAULT NULL
) 

```
Contains information about developers, including their personal/company details, role, start and end dates, and associated publisher.
```sql
CREATE TABLE `developers` (
  `developer_id` int(11) NOT NULL,
  `person_name` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `publisher_id` int(11) DEFAULT NULL
) 
```
Stores information about publishers, including contact person, company, role, and tenure.
```sql
CREATE TABLE `publishers` (
  `publisher_id` int(11) NOT NULL,
  `person_name` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) 
```
<div id="users"></div>

### 3. `users`
Stores registered users, their emails, usernames, password hashes, and account creation timestamps.
```sql
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
)

```
<div id="leaderboard"></div>

### 4. `leaderboard`
Stores player scores for the arcade games.  
This table is used to track high scores and display rankings across the platform.
```sql
CREATE TABLE `datas` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) 
```
<br>

### 🔌 API Endpoints & Integrations

Fragstore integrates multiple APIs to provide a seamless shopping experience.

---

### <img height="35" id="api" style="display:inline; align-items:center;" align="center" src="https://www.emailjs.com/logo.png"></img> EmailJS (Gmail Service - SMP)
Used for sending emails and OTP verification.

**Configuration:**
```javascript
emailjs.init('YOUR_PUBLIC_KEY');

// Send OTP Email
emailjs.send('YOUR_SERVICE_ID', 'YOUR_TEMPLATE_ID', {
  to_email: 'user@example.com',
  otp_code: '123456',
  user_name: 'John Doe'
});
```

**Example Response:**
```json
{
  "status": 200,
  "text": "OK"
}
```

**Use Cases:**
- Order confirmation email (work in progress)
- OTP verification for account security
- Reach & write to Contact email

---

### <img height="50" id="currency" style="display:inline; align-items:center;" align="center" src="https://img.stackshare.io/stack/37303/default_657b34af1c7b9ea45750ae5720351d3735cf17d4.png"></img> Currency Exchange API
Real-time currency conversion using [ExchangeRate-API](https://open.er-api.com).

**Endpoint:**
```
GET https://open.er-api.com/v6/latest/USD
```

**Example Request:**
```javascript
fetch('https://open.er-api.com/v6/latest/USD')
  .then(response => response.json())
  .then(data => console.log(data));
```

**Example Response:**
```json
{
  "result": "success",
  "provider": "https://www.exchangerate-api.com",
  "documentation": "https://www.exchangerate-api.com/docs/free",
  "terms_of_use": "https://www.exchangerate-api.com/terms",
  "time_last_update_unix": 1735516801,
  "time_last_update_utc": "Mon, 30 Dec 2024 00:00:01 +0000",
  "time_next_update_unix": 1735603201,
  "time_next_update_utc": "Tue, 31 Dec 2024 00:00:01 +0000",
  "time_eol_unix": 0,
  "base_code": "USD",
  "rates": {
    "USD": 1,
    "EUR": 0.85,
    "GBP": 0.73,
    "JPY": 110.5,
    "HUF": 350.25
  }
}
```

**Use Cases:**
- Display prices in user's local currency
- Multi-currency checkout
- Real-time exchange rate updates

---

### <img height="50" id="flags" style="display:inline; align-items:center;" align="center" src="https://apiverve.com/images/favicon.png"></img> Flags API
Display country flags based on currency or user location.

**Endpoint:**
```
GET https://flagsapi.com/{COUNTRY_CODE}/flat/64.png
```

**Example Request:**
```javascript
// Get Hungarian flag
const flagUrl = 'https://flagsapi.com/HU/flat/64.png';

// Usage in React, PHP or html
<img src={`https://flagsapi.com/${countryCode}/flat/64.png`} alt="Country Flag" />
```

**Example Implementation:**
```javascript
const currencies = {
  USD: 'US',
  EUR: 'EU',
  GBP: 'GB',
  HUF: 'HU'
};

const getFlagUrl = (currency) => {
  const countryCode = currencies[currency];
  return `https://flagsapi.com/${countryCode}/flat/64.png`;
};
```

**Use Cases:**
- Currency selector with flag icons
- User location display
- Multi-language support indicators

---

### <img height="50" style="display:inline; align-items:center;" align="center" id="chart" src="https://assets.streamlinehq.com/image/private/w_300,h_300,ar_1/f_auto/v1/icons/1/chartjs-gbwxkdn5urp4w5jg9xk4g5.png/chartjs-p7803bgd17hc5uxtz82i.png?_a=DATAg1AAZAA0"></img> Chart.js
JavaScript charting library for data visualization.

**Installation:**
```bash
npm install chart.js react-chartjs-2
```

**Example Implementation:**
```javascript

function createChart() {
  var xValues = ["Games", "Genres", "Platforms"];
  var yValues = [$scope.numberOfProducts, $scope.numberOfGenres, 
                 $scope.numberOfPlatforms];

  var barColors = ["#b91d47", "#00aba9", "#2b5797"];

  new Chart("myChart", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [
        {
          backgroundColor: barColors,
          data: yValues,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: "Products Info",
        },
      },
    },
  });
}
```

**Example Chart Data:**
```json
{
  "labels": ["January", "February", "March", "April", "May", "June"],
  "datasets": [
    {
      "label": "Monthly Sales",
      "data": [65, 59, 80, 81, 56, 55],
      "backgroundColor": "rgba(54, 162, 235, 0.2)",
      "borderColor": "rgba(54, 162, 235, 1)",
      "borderWidth": 2
    }
  ]
}
```

**Use Cases:**
- Products Data Visualization
---

<div id="contribute"></div>

### 🤝 Contributing

Contributions are welcome! Follow these steps:

1. Fork the repository
2. Create a new branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch:  `git push origin feature/your-feature`
5. Open a Pull Request

------------------

<div id="license"></div>

### 📄 License

This project is licensed under the **MIT License**.  

You are free to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the software, under the following conditions:

1. The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
2. The software is provided "as is", without warranty of any kind, express or implied.


---


<div align="center">
  Made with ❤️ by Fragstore Webshop <br>
  <sub>Powered by modern web technologies for a seamless gaming experience</sub>
</div>




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

