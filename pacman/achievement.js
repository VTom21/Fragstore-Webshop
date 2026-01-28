angular.module('pacmanApp', [])
.controller('AchievementsController', ['$scope', '$http', function($scope, $http) {
    $scope.pellet_count = parseInt(localStorage.getItem("total_pellets") || 0);
    $scope.ghost_count = parseInt(localStorage.getItem("total_ghost") || 0);
    $scope.fruit_count = parseInt(localStorage.getItem("total_fruits") || 0);
    $scope.high_score = parseInt(localStorage.getItem("high_score") || 0);

    $scope.datas = [];


    console.log("Pellet count:", $scope.pellet_count);
    console.log("Ghost count:", $scope.ghost_count);
    console.log("Fruit count:", $scope.fruit_count);

    $scope.checkAchievements = function() {

        $scope.datas.forEach(achievement => {
            
            if (achievement.id === "one" && $scope.pellet_count >= achievement.value) {
                achievement.obtained = true;
            }

            if (achievement.id === "two" && $scope.ghost_count >= achievement.value) {
                achievement.obtained = true;
            }

            if (achievement.id === "three" && $scope.fruit_count >= achievement.value) {
                achievement.obtained = true;
            }

            if (achievement.id === "four" && $scope.high_score >= achievement.value) {
                achievement.obtained = true;
            }

            if (achievement.id === "five" && $scope.pellet_count >= achievement.value) {
                achievement.obtained = true;
            }

            if (achievement.id === "six" && $scope.ghost_count >= achievement.value) {
                achievement.obtained = true;
            }
        });
    };

    // Load achievements from JSON
    $http.get("./achievements.json")
        .then(function(response) {
            $scope.datas = response.data;
            console.log("Achievements loaded:", $scope.datas);
            $scope.checkAchievements();
        })
        .catch(function(error) {
            console.error("Failed to load achievements:", error);
        });
}]);

// Modal controls
const achievementModal = document.getElementById("achievement_modal");
const closeAchievementModal = document.getElementById("close_achievement_modal");

function openAchievements() {
    achievementModal.style.display = "flex";
    
    // Trigger Angular digest cycle to refresh achievement status
    const scope = angular.element(achievementModal).scope();
    if (scope) {
        scope.$apply(function() {
            scope.checkAchievements();
        });
    }
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