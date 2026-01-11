var app = angular.module("gameApp", []);

app.controller("GameController", function ($scope, $http, $location) {

    var parameters = new URLSearchParams(window.location.search);
    var name = parameters.get('name');

    $scope.apiKey = "7693d99549bf4ced830452d12958ea95";
    $scope.searchQuery = name.toLowerCase();
    $scope.placeholder = "https://placehold.co/1280x720/1a1b26/00f7ff?text=No+Image";

    $scope.game = null;
    $scope.screenshots = [];
    $scope.additions = [];
    $scope.creators = [];
    $scope.achievements = [];
    $scope.stores = [];
    $scope.tags = [];
    $scope.error = null;



    function searchGame(query) {
        var url = "https://api.rawg.io/api/games?search=" +
            encodeURIComponent(query) +
            "&page_size=5&key=" + $scope.apiKey;

        $http.get(url).then(function (res) {
            if (!res.data.results.length) {
                $scope.error = "No game found.";
                return;
            }

            var bestMatch = pickBestMatch(res.data.results, query);
            fetchGameById(bestMatch.id);
        });

        //$http.get('../games.php')  
        //    .then(function(response) {
        //        console.log('Database response:', response.data);
        //        
        //        $scope.names = response.data.names;
        //        console.log($scope.names);
        //    })
        //    .catch(function(error) {
        //        console.error('Error fetching local games:', error);
        //    });
    }


    function pickBestMatch(results, query) {
        var q = query.toLowerCase();

        for (var i = 0; i < results.length; i++) {
            var name = results[i].name.toLowerCase();
            if (name === q && !name.includes("dlc") && !name.includes("demo")) {
                return results[i];
            }
        }
        return results[0];
    }


    function fetchGameById(id) {
        $http.get("https://api.rawg.io/api/games/" + id + "?key=" + $scope.apiKey)
            .then(function (res) {
                $scope.game = res.data;
                fetchScreenshots(id);
                fetchAdditions(id);
                fetchAchievements(id);
                fetchStores(id);
                fetchTags(id);
            })
            .catch(function () {
                $scope.error = "Failed to load game.";
            });
    }


$scope.clean = function (text, maxLength) {
    if (!text) return "No description available.";

    maxLength = maxLength || 1000;

    // Step 1: normalize text
    var cleaned = text
        .replace(/\n+/g, " ")
        .replace(/\s{2,}/g, " ")
        .replace(/\.\s*/g, ". ")
        .trim();

    // Step 2: if already short enough, return it
    if (cleaned.length <= maxLength) {
        return cleaned;
    }

    // Step 3: cut at maxLength
    var sliced = cleaned.slice(0, maxLength);

    // Step 4: find last sentence end
    var lastDot = sliced.lastIndexOf(".");

    if (lastDot !== -1) {
        return sliced.slice(0, lastDot + 1);
    }

    // Fallback (no dot found)
    return sliced;
};



    function fetchScreenshots(id) {
        $http.get("https://api.rawg.io/api/games/" + id + "/screenshots?key=" + $scope.apiKey)
            .then(function (res) {
                $scope.screenshots = res.data.results;
            });
    }


    function fetchAdditions(id){
        $http.get("https://api.rawg.io/api/games/" + id + "/additions?key=" + $scope.apiKey)
            .then(function(res){
                $scope.additions = res.data.results;
            });
    }


    function fetchAchievements(id){
        $http.get("https://api.rawg.io/api/games/" + id + "/achievements?key=" + $scope.apiKey)
            .then(function(res){
                $scope.achievements = res.data.results;
            });
    }

    function fetchTags(){
        $http.get("https://api.rawg.io/api/tags?key=" + $scope.apiKey)
            .then(function(res){
                $scope.tags = res.data.results;
            });
    }

function fetchStores(id){
    $http.get("https://api.rawg.io/api/games/" + id + "/stores?key=" + $scope.apiKey)
        .then(function(res){
            if (res.data.results && res.data.results.length > 0) {
                $scope.stores = res.data.results.map(function(item) {
                    return item.store;
                });
            } else {
                $scope.stores = [];
            }
        })
        .catch(function(error) {
            console.error("Error fetching stores:", error);
            $scope.stores = [];
        });
}

    searchGame($scope.searchQuery);
});
