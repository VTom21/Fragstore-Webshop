var app = angular.module('videogameApp', []);



//toggles the wish-list button

document.addEventListener('click', function () {

    var buttons = document.getElementsByClassName('wish_btn');
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].onclick = function () {
            this.classList.toggle('off');
            this.classList.toggle('active');
        };
    }
});

app.controller('GameController', function ($scope, $http, $window, $location) {

    //boolean values to check prize & name sorting

    $scope.isPrizeAscChecked = false;
    $scope.isPrizeDescChecked = false;
    $scope.prizeSortOrder = '';

    $scope.sortOrder = '';
    $scope.isAscChecked = false;
    $scope.isDescChecked = false;


    //base variables for storing games, filtered games & platforms
    $scope.games = [];
    $scope.filteredGames = [];

    var platformNames = ["PC", "PS5", "PS4", "PS3", "PS2", "PS1", "Xbox Series X", "Xbox One", "Xbox 360", "Nintendo Switch", "Nintendo Wii U", "Nintendo Wii", "Nintendo DS", "Nintendo 3DS", "Mobile", "Mac", "Linux", "Indie", "Arcade", "VR", "Point & Click", "Music"];
    $scope.platforms = [];


    //puts every platform into the platforms array - stores dictionary values
    //platforms: {"PC", false}
    for (var i = 0; i < platformNames.length; i++) {
        $scope.platforms.push({ name: platformNames[i], selected: false });
    }


    //variables storing current page, items shown per page, and minimum year that can be chosen when filtering by release date

    $scope.currentPage = 1;
    $scope.itemsPerPage = 54;
    $scope.releaseYear = 1900;


    $http.get('games.php')
        .then(function (response) {

            //in separate variables, we store all games, games after filtering, number of games, genres and platforms

            $scope.games = response.data.games;
            $scope.filteredGames = $scope.games;
            $scope.numberOfGames = response.data.total;
            $scope.numberOfGenres = response.data.totalGenres;
            $scope.numberOfPlatforms = $scope.platforms.length;

            // checks if the genre chosen by the user, exists. Doesnt allow duplicates.

            var allGenres = [];
            for (var i = 0; i < $scope.games.length; i++) {
                var genre = $scope.games[i].genre;
                var exists = false;

                for (var j = 0; j < allGenres.length; j++) {
                    if (allGenres[j] === genre) {
                        exists = true;
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

            //$watch is an Angular function that watches whether a variable changes and executes a callback function

            //True means its gonna look inside if value has other properties -> thorough scrutinization

            //If a user selects a genre, that genre now becomes selected

            //inserts commas inside array
            $scope.$watch('uniqueGenres', function (list) {
                var selected = [];
                for (var i = 0; i < list.length; i++) {
                    if (list[i].selected) {
                        selected.push(list[i].name);
                    }
                }
                var csv = selected.join(',');
                $location.search('genres', csv);
                $scope.applyAdvancedFilters();
            }, true);

            //If a user selects a platform, that platform now becomes selected
            //inserts commas inside array
            $scope.$watch('platforms', function (list) {
                var selected = [];
                for (var i = 0; i < list.length; i++) {
                    if (list[i].selected) {
                        selected.push(list[i].name);
                    }
                }
                var csv = selected.join(',');
                $location.search('platforms', csv);
                $scope.applyAdvancedFilters();
            }, true);

            //$location.search makes the URL be like: http://localhost:3000/games_main.php#!?genres={value}&platforms={value}

            createChart();
        }, function (error) {
            console.error('Failed to load game data:', error);
        });



    //function for creating pie chart
    //uses Chart.js API
    function createChart() {
        var xValues = ["Games", "Genres", "Platforms"];
        var yValues = [$scope.numberOfGames, $scope.numberOfGenres, $scope.numberOfPlatforms];
        var barColors = ["#b91d47", "#00aba9", "#2b5797"];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: "Game Data Overview"
                    }
                }
            }
        });
    }


    // Name sorting
    $scope.updateSortOrder = function (which) {
        if (which === 'asc') {
            if ($scope.isAscChecked) {
                $scope.isDescChecked = false;
                $scope.sortOrder = 'asc';
            } else {
                $scope.sortOrder = '';
            }
        } else if (which === 'desc') {
            if ($scope.isDescChecked) {
                $scope.isAscChecked = false;
                $scope.sortOrder = 'desc';
            } else {
                $scope.sortOrder = '';
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
        if (which === 'asc') {
            if ($scope.isPrizeAscChecked) {
                $scope.isPrizeDescChecked = false;
                $scope.prizeSortOrder = 'asc';
            } else {
                $scope.prizeSortOrder = '';
            }
        } else if (which === 'desc') {
            if ($scope.isPrizeDescChecked) {
                $scope.isPrizeAscChecked = false;
                $scope.prizeSortOrder = 'desc';
            } else {
                $scope.prizeSortOrder = '';
            }
        }

        if ($scope.prizeSortOrder) {
            $scope.applySorting();
        } else {
            $scope.applyAdvancedFilters();
        }
    };

    $scope.applySorting = function () {

        // Sort by price

        if ($scope.prizeSortOrder == 'asc') {
            $scope.filteredGames.sort(function (a, b) {
                return a.prize - b.prize; //if substraction gives minues value, a comes first, otherwise b
            });
        }
        else if ($scope.prizeSortOrder == 'desc') {
            $scope.filteredGames.sort(function (a, b) {
                return b.prize - a.prize; //same logic inverted
            });
        }

        // Sort by name
        //exp: a.name - Mario, b.name - Zelda

        else if ($scope.sortOrder == 'asc') {
            $scope.filteredGames.sort(function (a, b) {
                if (a.name > b.name) return 1;  //a.name comes first -> Mario > Zelda
                if (a.name < b.name) return -1; //b.name comes first -> Zelda > Mario
                return 0; //none are greater alphabetically
            });
        }
        else if ($scope.sortOrder == 'desc') {
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

            var gameGenres = game.genre.toLowerCase(); //stores all their genres

            var genreMatch = false; //checks if theres a match in genres

            if (selectedGenres.length === 0) {
                genreMatch = true; //if user chooses no genres, genre match will still apply
            } else {
                for (var j = 0; j < selectedGenres.length; j++) {
                    if (gameGenres.includes(selectedGenres[j])) { //checks from all existing genres if there really is one
                        genreMatch = true;
                        break;
                    }
                }
            }

            //platform filtering
            //checks if platforms variable stores an array, if yes it separates all values with commas, else it leaves them in lowercase

            var gamePlatforms = Array.isArray(game.platforms) ? game.platforms.join(',').toLowerCase() : game.platforms.toLowerCase();
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

    //checks if cureent game's release date isnt below the minimum
    //filters game according to their exact release date
    $scope.advancedRange = function () {
        var minYear = $scope.releaseYear || 1900;

        $scope.filteredGames = [];
        for (var i = 0; i < $scope.games.length; i++) {
            var game = $scope.games[i];
            var current_year = game.release_date;
            var year = parseInt(current_year.substring(0, 4));
            if (year == minYear) {
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

        $scope.filteredGames = [];
        for (var i = 0; i < $scope.games.length; i++) {
            var game = $scope.games[i];
            var price = parseFloat(game.prize);
            if (price >= min && price <= max) {
                $scope.filteredGames.push(game);
            }
        }

        $scope.applySorting();
    };

    // Pagination
    $scope.totalPages = function () {
        return Math.ceil($scope.filteredGames.length / $scope.itemsPerPage);
    };

    // Sets current page
    $scope.$watch('searchText', function () {
        $scope.currentPage = 1;
    });

    //Scrolls back to top at a new page
    $scope.scrollToTop = function () {
        $window.scrollTo(0, 0);
    };
});