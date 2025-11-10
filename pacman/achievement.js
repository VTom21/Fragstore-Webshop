angular.module('pacmanApp', [])
.controller('AchievementsController', ['$scope', '$http', function($scope, $http) {
    $scope.pellet_count = parseInt(localStorage.getItem("total_pellets") || 0);
    $scope.ghost_count = parseInt(localStorage.getItem("total_ghost") || 0);

    $scope.datas = [];

    console.log("Pellet count:", $scope.pellet_count);
    console.log("Ghost count:", $scope.ghost_count);

    // Load achievements from JSON
    $http.get("../achievements.json")
        .then(function(response) {
            $scope.datas = response.data; // JSON array
            console.log("Achievements array:", $scope.datas);
        })
        .catch(function(error) {
            console.error("Failed to load achievements:", error);
        });
}]);


const achievementModal = document.getElementById("achievement_modal");
const closeAchievementModal = document.getElementById("close_achievement_modal");

function openAchievements() {
    achievementModal.style.display = "flex";
}

function closeAchievements() {
    achievementModal.style.display = "none";
}

closeAchievementModal.addEventListener("click", closeAchievements);

window.addEventListener("click", (e) => {
    if (e.target === achievementModal) closeAchievements();
});

// Open modal on Z key press
window.addEventListener("keydown", (e) => {
    if (e.key.toLowerCase() === "z") {
        openAchievements();
    }
});

