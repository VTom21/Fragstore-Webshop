//importing all necessary js files

import { Munch, Intro, Death, Fruit_Munch, Ghost_Eat, Frightened, Stop_Frightened } from "./sfx.js";

//base variables
let canva = document.querySelector(".game_canvas");
let rows = 25;
let columns = 28;
const tile_size = 32; //32 pixels
const canva_width = columns * tile_size;
const canva_height = rows * tile_size;
let MS = 40;
let context; // Possible values => 2d, webgl, webgl2 (3d), webgpu
let score = 0;
let lives = 3;
let level = 1;
let pacman_speed = 8;
let ghost_speed_multiplier = 8;
let nextDirection = null;
let score_multiplier = 10;

let total_pellets = parseInt(localStorage.getItem("total_pellets") || 0);
total_pellets = parseInt(total_pellets);


let total_ghost = parseInt(localStorage.getItem("total_ghost") || 0);
total_ghost = parseInt(total_ghost);

let total_fruits = parseInt(localStorage.getItem("total_fruits") || 0);
total_fruits = parseInt(total_fruits);

let run_state = true; //boolean to check if game is running
let hearts = document.querySelector(".hearts");
let chased = false;
let freezed = false;
let chaseTimeout = null;
let chaseInterval = null;
let pop_ups = [];
let freezeTimeout = null;
let high_score = localStorage.getItem("high_score") || 0;
high_score = parseInt(high_score);
const gameoverUI = document.querySelector(".gameoverbox");
const display_value = document.querySelector(".display_value");
const high_score_ui = document.getElementById("high_score");
high_score_ui.innerText = `High Score: ${high_score}`;


const ghostBox = {
  x: 15 * tile_size,
  y: 15 * tile_size,
};

//constant variables for map

const WALL_TILE = 1;
const TILE_EMPTY = 0;
const TILE_PACMAN = 7;
const TILE_BLUE_GHOST = 3;
const TILE_RED_GHOST = 4;
const TILE_ORANGE_GHOST = 5;
const TILE_PINK_GHOST = 6;
const PELLET = 2;
const CHERRY = 8;
const GHOST_GATE = 9;
const FREEZE_ORB = 10;
const STRAWBERRY = 11;
const PORTAL = 12;
const HEART = 13;

const RANDOM_ORB = [FREEZE_ORB, STRAWBERRY, PORTAL, HEART];


// UI variables

const scoreUI = document.querySelector(".score_value");
const lifeUI = document.querySelector(".life_value");
const levelUI = document.querySelector(".level_value");

//Invulnerability of Pac man after being hit once by a ghost -> by default pac man is vulnerable

let invulnerable = false;
let vulnerability_period = 1000; // 1000 milliseconds = 1 second

//image variables and arrays

let blue_ghost_img, red_ghost_img, orange_ghost_img, pink_ghost_img;
let pacman_down_img, pacman_up_img, pacman_left_img, pacman_right_img;
let wall_img, cherry_img,  frozen_orb_img, strawberry_img, portal_img, heart_img;

let scared_ghost_img;

const image_paths = [
  "assets/ghosts/blueGhost.png",
  "assets/ghosts/redGhost.png",
  "assets/ghosts/orangeGhost.png",
  "assets/ghosts/pinkGhost.png",
  "assets/pacman/pacmanDown.png",
  "assets/pacman/pacmanUp.png",
  "assets/pacman/pacmanLeft.png",
  "assets/pacman/pacmanRight.png",
  "assets/wall.png",
  "assets/cherry.png",
  "custom_assets/foods/ice_cube.png",
  "custom_assets/foods/strawberry.png",
  "custom_assets/foods/portal.png",
  "custom_assets/foods/heart.png"
];

//Preload every images here from the array above

const images = [];

const directions = ["U", "D", "L", "R"];
const opposite = {
  U: "D",
  D: "U",
  L: "R",
  R: "L",
};

let isGameRunning = true;
let gameOver = false;

//Intro

function handleStart(e) {
  if (e.code === "KeyF") {
    const introAudio = Intro();
    introAudio.addEventListener("ended", () => {
      // we use "ended" to tell the browser that the game can load after music ends
      Load();
    });

    document.body.removeEventListener("keyup", handleStart); // prevents multiple triggers
  }
}

document.body.addEventListener("keyup", handleStart); //When player releases the F key, it calls the function

//Load function: sets game sizes, resets life stats, defines drawing context, loads assets and the map, updates game every frame, defines pac man movement

function Load() {
  document.querySelector(".content").style.display = "none";
  hearts.style.display = "grid";
  lifeUI.innerHTML = lives;
  canva.width = canva_width;
  canva.height = canva_height;
  context = canva.getContext("2d"); //Defines drawing context, rendering for the canvas through an object

  load_images();
  load_map();
  update();

  //movement of pac man

  document.addEventListener("keyup", (e) => {
    switch (e.code) {
      case "ArrowUp":
      case "KeyW":
        nextDirection = "U";
        break;
      case "ArrowDown":
      case "KeyS":
        nextDirection = "D";
        break;
      case "ArrowLeft":
      case "KeyA":
        nextDirection = "L";
        break;
      case "ArrowRight":
      case "KeyD":
        nextDirection = "R";
        break;
    }
  });

  //Iterates through all ghosts and give them a new random starting distance

  for (let ghost of ghosts.values()) {
    const new_direction = directions[Math.floor(Math.random() * 4)];
    ghost.Refresh_Direction(new_direction);
  }
}

function Popup(x, y, points) {
  pop_ups.push({
    x,
    y,
    text: `+${points}`,
    alpha: 1,
    dy: -0.5
  });
}




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

      //we the constant variables for conditioning, sets for storing and a generate class for generating blocks

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

//updates game every frame, checks if the game is running
//if yes, it calls itself every 40 millisecond so the game runs on 25 FPS
// calls control and display functions
function update() {
  if (!isGameRunning) {
    return;
  }
  if (run_state) {
    //if game is running
    Controls();
    display();
  }
  setTimeout(update, MS); // equivalent of 30 FPS
}

function Pause() {
  run_state = false; //pauses the game
}

function Continue() {
  run_state = true; //continues the game
}

//we reset most basic values: velocities, new ghost directions at start, invulnerability
function Reset() {
  setTimeout(() => {
    gameoverUI.style.display = "none";
    display_value.innerHTML = "";
  }, 3000);
  pacman.reset();
  pacman.VelocityX = 0;
  pacman.VelocityY = 0;

  for (let ghost of ghosts.values()) {
    ghost.x = ghostBox.x;
    ghost.y = ghostBox.y;
    const newDirection = directions[Math.floor(Math.random() * 4)];
    ghost.Refresh_Direction(newDirection);
  }

  invulnerable = true; // pac man is invulnerable for 1 second after being hit, prevents multiple life loss at once
  setTimeout(() => (invulnerable = false), vulnerability_period);
}

//we iterate through all the sets after filling them and draw them out the screen
function display() {
  context.clearRect(0, 0, canva.width, canva.height); //resets drawing period

  context.drawImage(
    pacman.img,
    pacman.x,
    pacman.y,
    pacman.width,
    pacman.height
  ); //parameters: (image, posX, posY, width, height)

  walls.forEach((value) => {
    context.drawImage(value.img, value.x, value.y, value.width, value.height);
  });

  ghosts.forEach((value) => {
    context.drawImage(value.img, value.x, value.y, value.width, value.height);
  });

  cherries.forEach((value) => {
    context.drawImage(value.img, value.x, value.y, value.width, value.height);
  });

  freezes.forEach((value) => {
    context.drawImage(value.img, value.x, value.y, value.width, value.height);
  });

  strawberries.forEach((value) => {
    context.drawImage(value.img, value.x, value.y, value.width, value.height);
  });

  portals.forEach((value) => {
    context.drawImage(value.img, value.x, value.y, value.width, value.height);
  });

  hearts_set.forEach((value) => {
    context.drawImage(value.img, value.x, value.y, value.width, value.height);
  });
  

  context.fillStyle = "white";
  pellets.forEach((value) => {
    context.fillRect(value.x, value.y, value.width, value.height); // Remember: pellets dont have a separate image to draw out -> using base rectangle form filled with white -> fillRect, fillStyle
  });

  for (let i = pop_ups.length - 1; i >= 0; i--) {
    const p = pop_ups[i];
    context.globalAlpha = p.alpha;
    context.fillStyle = "yellow";
    context.font = "20px Arial";
    context.fillText(p.text, p.x, p.y);
    context.globalAlpha = 1;

    // animate
    p.y += p.dy;
    p.alpha -= 0.02;

    if (p.alpha <= 0) pop_ups.splice(i, 1); // remove when faded
  }


}

//controls function

function Controls() {
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

  // if game is over, it calls the Update function, reloads the map and draws out everything onto the screen again
  if (gameOver) {
    load_map();
    Reset();
    reset_game_stats(true); // fully reset lives, score, level
    gameOver = false;
    update();

  }

  // Here we store the current direction of pac man, alongside its positions
  const originalDirection = pacman.direction;
  const originalX = pacman.VelocityX;
  const originalY = pacman.VelocityY;

  pacman.direction = nextDirection; // sets pacman's direction to the direction the variable holds
  pacman.Velocity_Refresh(); // refreshes velocity logic

  //starts moving pacman on X and Y axis by a small step at this specific direction
  pacman.x += pacman.VelocityX;
  pacman.y += pacman.VelocityY;

  Edges(pacman);

  //if pac man hits a wall, collision happen, so movement to that direction wont happen
  let collision = false;
  for (let wall of walls.values()) {
    if (Collision(pacman, wall)) {
      collision = true;
      break;
    }
  }

  pacman.x -= pacman.VelocityX;
  pacman.y -= pacman.VelocityY;

  //resets back to previous directions, if theres no collision it updates sprite image and make it move in the new direction

  if (collision) {
    pacman.direction = originalDirection;
    pacman.VelocityX = originalX;
    pacman.VelocityY = originalY;
  } else {
    nextDirection = null;

    if (pacman.direction == "U") pacman.img = pacman_up_img;
    else if (pacman.direction == "D") pacman.img = pacman_down_img;
    else if (pacman.direction == "L") pacman.img = pacman_left_img;
    else if (pacman.direction == "R") pacman.img = pacman_right_img;
  }

  pacman.x += pacman.VelocityX;
  pacman.y += pacman.VelocityY;

  //Double Checking wall collision: if even in its current direction Pac-Man somehow bumps into a wall (e.g., he was moving toward one)
  //we move it back out so it doesnt get stuck inside the wall

  for (let wall of walls.values()) {
    if (Collision(pacman, wall)) {
      pacman.x -= pacman.VelocityX;
      pacman.y -= pacman.VelocityY;
      break;
    }
  }

  //pac man & ghost collision check -> if vulnerable and collides -> minus life, if life is 0 its game over and resets game
  for (let ghost of ghosts.values()) {
    if (Collision(ghost, pacman) && !invulnerable && !chased) {
      Pause();
      Death();
      setTimeout(() => {
        Continue();
      }, 2000);
      lives -= 1;

      lifeUI.innerHTML = lives;

      hearts.removeChild(hearts.lastElementChild);

      if (lives == 0) {
        // show game over screen
        gameoverUI.style.display = "block";
        display_value.innerHTML = "Game Over!!!";

        if (score > high_score) {
          high_score = score;
          localStorage.setItem("high_score", high_score);
          high_score_ui.innerText = `High Score: ${high_score}`;
        }

        if(total_level < 2){
          localStorage.setItem("total_level", total_level);
          total_level = 1;
        }


        // stop gameplay immediately
        isGameRunning = false;
        run_state = false;

        // wait 3 seconds, then reload
        const playerName = prompt("Enter your name:");
        if (playerName) {
          document.getElementById("playerName").value = playerName;
          document.getElementById("playerScore").value = score;
          document.getElementById("scoreForm").submit();
        }


        // wait 3 seconds, then reload
        setTimeout(() => {
          window.location.reload();
        }, 3000);
      }
      Reset();
    }

    //makes ghosts move
    if (freezed) {
      continue;
    }

    ghost.x += ghost.VelocityX;
    ghost.y += ghost.VelocityY;
    Edges(ghost);

    //if a ghost collides with wall, steps back
    let hitWall = false;
    for (let wall of walls.values()) {
      if (Collision(ghost, wall)) {
        ghost.x -= ghost.VelocityX;
        ghost.y -= ghost.VelocityY;
        hitWall = true;
        break;
      }
    }

    // if they collide with a wall, there is a slight chance they start targeting pac man

    if (hitWall || Math.random() < 0.05) {
      //default values used to target pac man
      let targetX = pacman.x;
      let targetY = pacman.y;

      //offset for Pinky
      const offset = 32;

      if (chased) {
        let flee_multiplier = 2;
        targetX = ghost.x - (pacman.x - ghost.x) * flee_multiplier;
        targetY = ghost.y - (pacman.y - ghost.y) * flee_multiplier;

        for (let wall of walls) {
          if (Collision({ x: targetX, y: targetY, width: ghost.width, height: ghost.height }, wall)) {

            targetX = ghost.x + (ghost.x - pacman.x) * 0.5;
            targetY = ghost.y + (ghost.y - pacman.y) * 0.5;

          }
        }
      }

      //delta distance values between pac man and ghost

      const dx = pacman.x - ghost.x; // (x2 - x1)
      const dy = pacman.y - ghost.y; // (y2 - y1)

      //straight line distance / Euclidean distance -> formula: √ dx^2 + dy^2
      const distance = Math.hypot(dx, dy);

      //this switch defines every ghost behavior separately
      switch (ghost.img) {
        case red_ghost_img: //Blinky's (red) job to target pac man's position. By default it breaks out the switch cuz target values are already defined
          break;

        case pink_ghost_img: //Pinky's (pink) job to get ahead of pac man based on which direction it moves, offset is 128px
          switch (pacman.direction) {
            case "U":
              targetY -= offset; //pac man moves on +Y (upwards), exp pac man (0,128), then ghost (0,0) so gets 128 pixels ahead of pac man on +Y
              break;
            case "D":
              targetY += offset; //pac man(0,128), ghost(0,256)
              break;
            case "L":
              targetX -= offset; //pac man(128,0), ghost(0,0)
              break;
            case "R":
              targetX += offset; //pac man(20,0), ghost(148,0)
              break;
          }
          break;

        case blue_ghost_img: //Inky's (blue) job is the same as Blinky's
          targetX = dx + pacman.x;
          targetY = dy + pacman.y;
          break;

        case orange_ghost_img: //Clyde's (orange) job is to chase pac man if it's far away according to the ghost's radius (64px)
          if (distance <= 64) {
            // but if it gets close to Clyde, it runs away (thats why targetX is 0, and targetY is set to canvas height -> bottom left corner )
            targetX = 0;
            targetY = canva_height;
          }
          break;
      }

      let possibleDirs = [];

      for (let dir of directions) {
        if (dir === opposite[ghost.direction]) continue; //lets opposite directions to be chosen (exp. U - D)

        //We store a current ghost position for testing

        let testX = ghost.x;
        let testY = ghost.y;

        //add velocity to it on all axis based on the multiplier

        switch (dir) {
          case "U":
            testY -= ghost_speed_multiplier;
            break;
          case "D":
            testY += ghost_speed_multiplier;
            break;
          case "L":
            testX -= ghost_speed_multiplier;
            break;
          case "R":
            testX += ghost_speed_multiplier;
            break;
        }

        //here we create a test ghost to simulate whether the next move is valid or not
        //if false its colliding with a wall so movement wont happen
        //if true it calculates the straight line distance between pac man and this ghost instance and puts it into an array as a dictionary
        let validMove = true;
        for (let wall of walls.values()) {
          let testGhost = {
            x: testX,
            y: testY,
            width: ghost.width,
            height: ghost.height,
          };
          if (Collision(testGhost, wall)) {
            validMove = false;
            break;
          }
        }

        if (validMove) {
          const dist = Math.hypot(targetX - testX, targetY - testY);
          possibleDirs.push({ dir: dir, dist: dist });
        }
      }

      //uses sort with parameters. Our possibleDirs looks something like {dir: "U", dist: 200}, {dir: "D", dist: 300}
      //subtracts distances, exp: 200 - 300 = -100;
      //if < 0, then a comes first, if > 0, then b comes first, if = 0, then they are equal
      if (possibleDirs.length > 0) {
        possibleDirs.sort((a, b) => a.dist - b.dist);
        ghost.Refresh_Direction(possibleDirs[0].dir); // gets the first values -> closest distance from target (pac man)
      }
    }
  }

  //pellet collision logic

  let pelletEaten = null;

  for (let pellet of pellets.values()) {
    if (Collision(pacman, pellet)) {
      Munch(); // calls sound effect from sfx.js
      pelletEaten = pellet;
      total_pellets++;
      localStorage.setItem("total_pellets", total_pellets);
      score += score_multiplier; //increases score
      scoreUI.innerText = score;
      break;
    }
  }
  pellets.delete(pelletEaten); // removes the pellet from the map

  if (pellets.size === 300) { //if no pellets are left, you have won: lives, score reset, level increases
    gameoverUI.style.display = "block";
    display_value.innerHTML = "You Win!";
    score_multiplier += 10;
    level++;
    total_level++;
    localStorage.setItem("total_level", total_level);
    levelUI.innerText = level;
    load_map();
    reset_game_stats(false);
    Reset();
  }
}

//Axis-Aligned Bounding Box (AABB) collision detection formula
//this formula essentially checks whether a and b (boxes) touch or cover each other by comparing edges:

//Left:	  a.x + padding
//Right:  a.x + a.width - padding
//Top:	  a.y + padding
//Bottom: a.y + a.height - padding

function Collision(a, b) {
  const padding = 0;
  return (
    a.x + padding < b.x + b.width &&
    a.x + a.width - padding > b.x &&
    a.y + padding < b.y + b.height &&
    a.y + a.height - padding > b.y
  );
}

function set_scared_sprite(scared) {
  ghosts.forEach((g) => {
    if (scared) {
      g.img = scared_ghost_img; // switch to scared sprite
    } else {
      g.img = g.original_img; // switch back
    }
  });
}

function Chase() {
  chased = true;
  set_scared_sprite(chased);

  if (chaseInterval) clearInterval(chaseInterval);
  if (chaseTimeout) clearTimeout(chaseTimeout);

  chaseInterval = setInterval(() => {
    for (let ghost of ghosts.values()) {
      if (Collision(pacman, ghost)) {
        Ghost_Eat();
        ghost.x = ghostBox.x;
        ghost.y = ghostBox.y;
        Popup(pacman.x, pacman.y, 100);
        score += 100;
        total_ghost++;
        localStorage.setItem("total_ghost", total_ghost);
      }
    }
  }, MS);

  chaseTimeout = setTimeout(() => {
    Stop_Frightened();
    chased = false;
    set_scared_sprite(chased);
    clearInterval(chaseInterval);
    chaseInterval = null;
    chaseTimeout = null;
  }, 17000);
}

function reset_datas() {
  localStorage.setItem("high_score", 0);
  high_score = 0;
  document.getElementById("high_score").innerText = "High Score: 0";

  localStorage.setItem("total_pellets", 0);
  total_pellets = 0;

  localStorage.setItem("total_ghost", 0);
  total_ghost = 0;

  localStorage.setItem("total_fruits", 0);
  total_fruits = 0;

}




function reset_game_stats(fullReset = false) {
  lives = 3;
  lifeUI.innerText = lives;
  reset_hearts();
  Stop_Frightened();

  if (fullReset) {
    score = 0;
    level = 1;
    score_multiplier = 10;
  }

  scoreUI.innerText = score;
  levelUI.innerText = level;
}

function reset_hearts() {
  hearts.innerHTML = "";

  for (let i = 0; i < lives; i++) {
    const heart = document.createElement("img");
    heart.src = "../pacman/assets/pacman/pacmanRight.png";
    heart.id = `heart${i}`;
    hearts.appendChild(heart);
  }
}

// Replace your existing simple Freeze() function with this block

function Freeze(duration = 5000) {
  // Clear any previous timeout to ensure a clean 5-second freeze
  if (freezeTimeout) clearTimeout(freezeTimeout);

  freezed = true;

  // Set all ghost velocities to 0 to stop movement immediately
  for (let ghost of ghosts.values()) { // Corrected from 'ghost.values()'
    ghost.VelocityX = 0;
    ghost.VelocityY = 0;
  }

  // Set a timeout to call Unfreeze after 5 seconds
  freezeTimeout = setTimeout(() => {
    Unfreeze();
    freezeTimeout = null;
  }, duration);
}

function Unfreeze() {
  freezed = false;

  // Restore movement by recalculating velocity based on their last direction
  for (let ghost of ghosts.values()) {
    ghost.Velocity_Refresh();
  }
}

function Edges(entity) {
  if (entity.x + entity.width < 0) {
    entity.x = canva_width - entity.width;
    entity.y = 448;
  }

  else if (entity.x > canva_width) {
    entity.x = 0;
    entity.y = 448;
  }
}

function heart_up(){
  lives++;
  lifeUI.innerHTML = lives;
  hearts.innerHTML += `<img src="../pacman/assets/pacman/pacmanRight.png" alt="">`;
  hearts.style.gridTemplateColumns = `repeat(${lives}, 1fr)`;
}

function Warp(){
  let random_x = Math.floor(Math.random() * (rows - 6)) + 5;
  let random_y = Math.floor(Math.random() * (columns - 1));

  if(map[random_x][random_y] !== 1 && map[random_x][random_y] !== 3 && map[random_x][random_y] !== 4 && map[random_x][random_y] !== 5 && map[random_x][random_y] !== 6){
    pacman.x = random_y * tile_size;
    pacman.y = random_x * tile_size;
  }
  else{
      Warp();
  }

}


//Constructor Class for block generation

class Generate {
  constructor(img, x, y, width, height, isGhost = false) {
    //base constructor values for both ghosts and pac man

    this.img = img;
    this.original_img = img;
    this.x = x;
    this.y = y;
    this.width = width;
    this.height = height;

    //we store the starting x,y positions too
    this.StartX = x;
    this.StartY = y;

    this.direction = "U";
    this.VelocityX = 0;
    this.VelocityY = 0;

    this.isGhost = isGhost; // checks if the instance is a ghost, food, pac man or something else
  }

  Refresh_Direction(direction) {
    // refreshes current direction of either pac man or a specific ghost(s), essentially this checks wall collision case for all entities not just for ghosts or pac man specifically (like above)

    let previous_direction = this.direction; // stores current direction before assigning new
    this.direction = direction; // assign new direction
    this.Velocity_Refresh();

    //if entity hits a wall, step back and keep previous direction
    for (let wall of walls.values()) {
      if (Collision(this, wall)) {
        this.x -= this.VelocityX;
        this.y -= this.VelocityY;
        this.direction = previous_direction;
        this.Velocity_Refresh();
        return;
      }
    }
  }

  //updates movement based on current direction of the entity
  //Up: -Y
  //Down: +Y
  //Right: +X
  //Left: -X

  Velocity_Refresh() {
    const speed = this.isGhost ? ghost_speed_multiplier : pacman_speed; //the speed is determined whether this entity is a ghost or pac man -> separate speed
    switch (this.direction) {
      case "U":
        this.VelocityX = 0;
        this.VelocityY = -speed;
        break;
      case "D":
        this.VelocityX = 0;
        this.VelocityY = speed;
        break;
      case "R":
        this.VelocityX = speed;
        this.VelocityY = 0;
        break;
      case "L":
        this.VelocityX = -speed;
        this.VelocityY = 0;
        break;
    }
  }

  //function that easily resets starting positions -> putting ghost back to their box after death
  reset() {
    this.x = this.StartX;
    this.y = this.StartY;
    this.direction = "U";
  }
}
