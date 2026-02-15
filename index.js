var app = angular.module("videogameApp", []);

app.controller("GameController", function ($scope, $http, $window, $location) {
  //boolean values to check prize & name sorting

  $scope.isPrizeAscChecked = false;
  $scope.isPrizeDescChecked = false;
  $scope.prizeSortOrder = "";
  $scope.stockBool = null;
  $scope.stockBool2 = null;

  $scope.sortOrder = "";
  $scope.isAscChecked = false;
  $scope.isDescChecked = false;
  $scope.count = 0;

  $scope.games = [];
  $scope.filteredGames = [];

  $scope.platforms = [];

  $scope.cartOpen = false;
  $scope.cartItems = [];

  $scope.rates = window.exchangeRates;
  $scope.select_currency = "USD";

  $scope.convertPrice = function (game) {
    let price = game.isDiscount == 1 ? game.discountedPrize : game.prize;
    let rate = $scope.rates[$scope.select_currency] || 1;
    return (price * rate).toFixed(2);
  };

  $scope.isInWishlist = function (gameId) {
    return $scope.wishlistItems.some((item) => item.id === gameId);
  };

  $scope.wishlistItems = JSON.parse(
    localStorage.getItem("wishlistItems") || "[]",
  );
  $scope.count2 = $scope.wishlistItems.length || 0;

  $scope.openCart = function (game) {
    $scope.count++;
    let existingItem = $scope.cartItems.find((item) => item.id === game.id);

    // Get base price (considering discount)
    let basePrice =
      game.isDiscount == 1 && game.discountedPrize
        ? game.discountedPrize
        : game.prize;

    // Get current exchange rate
    let rate = $scope.rates[$scope.select_currency] || 1;
    let convertedPrice = parseFloat((basePrice * rate).toFixed(2));

    if (existingItem) {
      existingItem.quantity += 1;
      existingItem.total_prize = parseFloat(
        (existingItem.quantity * existingItem.prize).toFixed(2),
      );
    } else {
      $scope.cartItems.push({
        gameRef: game,
        id: game.id,
        name: game.name,
        prize: convertedPrice,
        game_pic: game.game_pic,
        quantity: 1,
        total_prize: convertedPrice,
      });
    }

    $scope.cartOpen = true;

    // Store selected currency
    localStorage.setItem("currency", $scope.select_currency);
  };

  $scope.pacmanCounter = 0;
  $scope.snakeCounter = 0;
  $scope.tetrisCounter = 0;

  $scope.easter_egg = function (game) {
    if (game.name.toLowerCase() === "pac-man") {
      // Use Angular's ng-click on the image
      $scope.pacmanCounter++; // increment counter on each click

      if ($scope.pacmanCounter >= 5) {
        window.location.href =
          "../redirect/redirect.php?destination=../pacman/pacman.php";
      }
    }

    if (game.name.toLowerCase() === "snake") {
      // Use Angular's ng-click on the image
      $scope.snakeCounter++; // increment counter on each click

      if ($scope.snakeCounter >= 5) {
        window.location.href =
          "../redirect/redirect.php?destination=../snake/snake.php";
      }
    }

    if (game.name.toLowerCase() === "tetris effect") {
      // Use Angular's ng-click on the image
      $scope.tetrisCounter++; // increment counter on each click

      if ($scope.tetrisCounter >= 5) {
        window.location.href = "http://localhost:4000/";
      }
    }
  };

  $scope.increaseQty = function (item) {
    $scope.count++;
    item.quantity++;
    item.total_prize = item.prize * item.quantity;
  };

  $scope.decreaseQty = function (item) {
    $scope.count--;
    if (item.quantity > 1) {
      item.quantity--;
      item.total_prize = item.prize * item.quantity;
    } else {
      let index = $scope.cartItems.indexOf(item);
      $scope.cartItems.splice(index, 1);
    }
  };

  $scope.checkout = function () {
    $scope.cart_data = encodeURIComponent(JSON.stringify($scope.cartItems));
    window.location.href =
      "http://localhost:3000/cart_website/sum_main.php?cart=" +
      $scope.cart_data;
  };

  $scope.Content = function (name, genre) {
    if (genre.toLowerCase() === "giftcards") {
      return;
    }
    window.location.href =
      "http://localhost:3000/Content/Content.php?name=" +
      encodeURIComponent(name);
  };

  //puts every platform into the platforms array - stores dictionary values
  //platforms: {"PC", false}

  //variables storing current page, items shown per page, and minimum year that can be chosen when filtering by release date

  $scope.currentPage = 1;
  $scope.itemsPerPage = 54;
  $scope.releaseYear = 1900;

  $http.get("games.php").then(
    function (response) {
      //in separate variables, we store all games, games after filtering, number of games, genres and platforms

      $scope.games = response.data.games;
      $scope.filteredGames = $scope.games;
      $scope.numberOfProducts = response.data.total;
      $scope.numberOfGenres = response.data.totalGenres;
      $scope.numberOfPlatforms = $scope.platforms.length;

var allPlatforms = [];

$scope.games.forEach(function (game) {
  if (!game.platforms || !Array.isArray(game.platforms)) return; // skip if undefined
  game.platforms.forEach(function (p) {
    var plat = p.trim();
    if (plat && allPlatforms.indexOf(plat) === -1) {
      allPlatforms.push(plat);
    }
  });
});


      // now put them in $scope.platforms for ng-repeat
      $scope.platforms = allPlatforms.map(function (p) {
        return { name: p, selected: false };
      });

      $scope.games.forEach(function (game) {
        const stockRef = db.ref("games/" + game.id + "/stock");
        stockRef.on("value", function (snapshot) {
          let value = snapshot.val();

          if (value === null) {
            value = 500;
            stockRef.set(value);
          }

          game.stock = value;
          console.log(`${game.name} => ${game.stock}`);
          $scope.$applyAsync();
        });

        if (game.isDiscount == 1 && game.discountPerc != null) {
          game.discountedPrize = parseFloat(
            game.prize * (1 - game.discountPerc / 100),
          ).toFixed(2);
        } else {
          game.discountedPrize = null;
        }
      });

      // checks if the genre chosen by the user, exists. Doesnt allow duplicates.

      var allGenres = [];
      for (var i = 0; i < $scope.games.length; i++) {
        var genre = $scope.games[i].genre;
        var exists = false;

        if ($scope.games[i].available != 1) {
          continue;
        }
        for (var j = 0; j < allGenres.length; j++) {
          if (allGenres[j] === genre) {
            exists = true;
            break;
          }
        }

        if (exists === false) {
          allGenres.push(genre);
        }
      }

      //makes a genre object that stores two dictionary values (paired with keys) and pushes them into a new array
      $scope.uniqueGenres = [];
      for (var i = 0; i < allGenres.length; i++) {
        var genreObj = { name: allGenres[i], selected: false };
        $scope.uniqueGenres.push(genreObj);
      }

      var urlGenres = $location.search().genres;

      $scope.uniqueGenres.forEach(function (genreObj) {
        if (urlGenres == genreObj.name) {
          genreObj.selected = true;
        }
      });

      //$watch is an Angular function that watches whether a variable changes and executes a callback function

      //True means its gonna look inside if value has other properties -> thorough scrutinization

      //If a user selects a genre, that genre now becomes selected

      //inserts commas inside array
      $scope.$watch(
        "uniqueGenres",
        function (list) {
          var selected = [];
          for (var i = 0; i < list.length; i++) {
            if (list[i].selected) {
              selected.push(list[i].name);
            }
          }
          var csv = selected.join(",");
          $location.search("genres", csv);
          $scope.applyAdvancedFilters();
        },
        true,
      );

      //If a user selects a platform, that platform now becomes selected
      //inserts commas inside array
      $scope.$watch(
        "platforms",
        function (list) {
          var selected = [];
          for (var i = 0; i < list.length; i++) {
            if (list[i].selected) {
              selected.push(list[i].name);
            }
          }
          var csv = selected.join(",");
          $location.search("platforms", csv);
          $scope.applyAdvancedFilters();
        },
        true,
      );

      //$location.search makes the URL be like: http://localhost:3000/games_main.php#!?genres={value}&platforms={value}

      createChart();
    },
    function (error) {
      console.error("Failed to load game data:", error);
    },
  );

  //function for creating pie chart
  //uses Chart.js API
  function createChart() {
    var xValues = ["Games", "Genres", "Platforms"];
    var yValues = [
      $scope.numberOfProducts,
      $scope.numberOfGenres,
      $scope.numberOfPlatforms,
    ];
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

  $scope.Discount = function (isDiscount) {
    switch (isDiscount) {
      case true:
        $scope.filteredGames = $scope.games.filter((k) => k.isDiscount == 1);
        break;
      case false:
        $scope.filteredGames = $scope.games;
        break;
    }
  };

  // Name sorting
  $scope.updateSortOrder = function (which) {
    if (which === "asc") {
      if ($scope.isAscChecked) {
        $scope.isDescChecked = false;
        $scope.sortOrder = "asc";
      } else {
        $scope.sortOrder = "";
      }
    } else if (which === "desc") {
      if ($scope.isDescChecked) {
        $scope.isAscChecked = false;
        $scope.sortOrder = "desc";
      } else {
        $scope.sortOrder = "";
      }
    }

    //if not empty
    if ($scope.sortOrder) {
      $scope.applySorting();
    } else {
      $scope.applyAdvancedFilters();
    }
  };

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

  $scope.inStock = function () {
    let filtered = $scope.games;

    switch ($scope.stockBool) {
      case true:
        filtered = filtered.filter((game) => game.stock !== 0);
        break;
      case false:
        break;
    }

    switch ($scope.stockBool2) {
      case true:
        filtered = filtered.filter((game) => game.stock === 0);
        break;
      case false:
        break;
    }

    if (!$scope.stockBool && !$scope.stockBool2) {
      filtered = $scope.games;
    }

    $scope.filteredGames = filtered;
  };

  $scope.applySorting = function () {
    // => Prototype Sorting
    // Sort by price
    //exp. a.prize - 59.99, b.prize - 49.99

    if ($scope.prizeSortOrder == "asc") {
      $scope.filteredGames.sort(function (a, b) {
        const PrizeA = a.isDiscount == 1 ? a.discountedPrize : a.prize;
        const PrizeB = b.isDiscount == 1 ? b.discountedPrize : b.prize;
        return PrizeA - PrizeB; //if substraction gives minues value, a comes first, otherwise b
      });
    } else if ($scope.prizeSortOrder == "desc") {
      $scope.filteredGames.sort(function (a, b) {
        const PrizeA = a.isDiscount == 1 ? a.discountedPrize : a.prize;
        const PrizeB = b.isDiscount == 1 ? b.discountedPrize : b.prize;
        return PrizeB - PrizeA; //same logic inverted
      });
    }

    // Sort by name
    //exp: a.name - Mario, b.name - Zelda
    else if ($scope.sortOrder == "asc") {
      $scope.filteredGames.sort(function (a, b) {
        if (a.name > b.name) return 1; //a.name comes first -> Mario > Zelda
        if (a.name < b.name) return -1; //b.name comes first -> Zelda > Mario
        return 0; //none are greater alphabetically
      });
    } else if ($scope.sortOrder == "desc") {
      $scope.filteredGames.sort(function (a, b) {
        if (a.name < b.name) return 1;
        if (a.name > b.name) return -1;
        return 0; //none are greater alphabetically
      });
    }
  };

  // Advanced filters

  $scope.applyAdvancedFilters = function () {
    //pushes every genre and platform picked by the user and stores them

    var selectedGenres = [];
    for (var i = 0; i < $scope.uniqueGenres.length; i++) {
      if ($scope.uniqueGenres[i].selected) {
        selectedGenres.push($scope.uniqueGenres[i].name.toLowerCase());
      }
    }

    var selectedPlatforms = [];
    for (var i = 0; i < $scope.platforms.length; i++) {
      if ($scope.platforms[i].selected) {
        selectedPlatforms.push($scope.platforms[i].name.toLowerCase());
      }
    }

    // Filter games accordingly

    var filtered = [];
    for (var i = 0; i < $scope.games.length; i++) {
      var game = $scope.games[i]; //stores all games

      if (game.available != 1) {
        continue;
      }

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

      //platform filtering
      //checks if platforms variable stores an array, if yes it separates all values with commas, else it leaves them in lowercase

      var gamePlatforms = Array.isArray(game.platforms)
        ? game.platforms.join(",").toLowerCase()
        : [game.platforms.toLowerCase()];
      var platformMatch = false;
      if (selectedPlatforms.length === 0) {
        platformMatch = true; //if user chooses no platforms, genre match will still apply
      } else {
        for (var j = 0; j < selectedPlatforms.length; j++) {
          if (gamePlatforms.includes(selectedPlatforms[j])) {
            platformMatch = true;
            break;
          }
        }
      }

      // Include game if both genre and platform match
      if (genreMatch && platformMatch) {
        filtered.push(game);
      }
    }

    $scope.filteredGames = filtered;

    $scope.applySorting();
  };

  //checks if current game's release date isnt below the minimum
  //filters game according to their exact release date
  $scope.advancedRange = function () {
    var minYear = $scope.releaseYear || 1900;

    $scope.filteredGames = [];
    for (var i = 0; i < $scope.games.length; i++) {
      var game = $scope.games[i];
      var current_year = game.release_date;
      var year = parseInt(current_year.substring(0, 4));
      if (year >= minYear) {
        $scope.filteredGames.push(game);
      }
    }
  };

  // Prize range filter
  //sets minimum and maximum parameters by given parameters
  //filters those games that fit into this prize range

  $scope.PrizeRange = function () {
    var min = parseFloat($scope.parameter1) || 0;
    var max = parseFloat($scope.parameter2) || Infinity;
    var rate = $scope.rates[$scope.select_currency] || 1;

    $scope.filteredGames = [];
    for (var i = 0; i < $scope.games.length; i++) {
      var game = $scope.games[i];
      var price = game.prize * rate;
      var discountedPrice = game.discountedPrize
        ? game.discountedPrize * rate
        : null;

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

  // Pagination
  $scope.totalPages = function () {
    return Math.ceil($scope.filteredGames.length / $scope.itemsPerPage);
  };

  // Sets current page
  $scope.$watch("searchText", function () {
    $scope.currentPage = 1;
  });

  //Scrolls back to top at a new page
  $scope.scrollToTop = function () {
    $window.scrollTo(0, 0);
  };

  $scope.Wishlist = function (game, event) {
    var wish_btn = event.currentTarget;
    wish_btn.classList.toggle("off");
    wish_btn.classList.toggle("active");

    let gameExist = $scope.wishlistItems.find((item) => item.id === game.id);

    if (wish_btn.classList.contains("active") && !gameExist) {
      $scope.wishlistItems.push({
        id: game.id,
        name: game.name,
        prize: game.prize,
        game_pic: game.game_pic,
      });
    } else {
      $scope.wishlistItems = $scope.wishlistItems.filter(
        (item) => item.id !== game.id,
      );
    }

    $scope.count2 = $scope.wishlistItems.length;
    localStorage.setItem("wishlistItems", JSON.stringify($scope.wishlistItems));
  };

  $scope.changeCurrency = function (newCurrency) {
    $scope.select_currency = newCurrency;
    localStorage.setItem("currency", newCurrency);
  };
});
