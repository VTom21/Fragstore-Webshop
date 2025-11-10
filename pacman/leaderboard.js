




const leaderboardModal = document.getElementById("leaderboard_modal");
const closeModal = document.getElementById("close_modal");
const leaderboardList = document.getElementById("leaderboard_list");



function openLeaderboard() {
  leaderboardModal.style.display = "flex";
}


function closeLeaderboard() {
  leaderboardModal.style.display = "none";
}


closeModal.addEventListener("click", closeLeaderboard);

window.addEventListener("click", (e) => {
  if (e.target === leaderboardModal) closeLeaderboard();
});

window.addEventListener("keydown", (e) => {
  if (e.key.toLowerCase() === "x") {
    openLeaderboard();
  }
});


