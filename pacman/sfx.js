// Functions and variables related to sound effects and music

let munch = new Audio("sfx/munch.wav");
let intro = new Audio("sfx/intro.wav");
let death = new Audio("sfx/death.wav");
let fruit = new Audio("sfx/fruit_munch.wav");
let ghost_munch = new Audio("sfx/eat_ghost.wav");
let frightened = new Audio("sfx/fright.wav");
let frightened2 = new Audio("sfx/fright.wav");
let toggle = true;
let loopInterval;

let can_munch = true;

export function Munch() {
    if (!can_munch) {
        return;
    }
    else {
        can_munch = false;
    }

    let clone = munch.cloneNode(); // clone music
    clone.play();

    setTimeout(() => {
        can_munch = true; // playing music with timeout -> avoids unecessary overlapping
    }, 600);
}

export function Fruit_Munch(){
    fruit.play();
    return fruit;
}

export function Intro() {
    intro.play();
    return intro;
}

export function Death() {
    death.play();
    return death;
}

export function Ghost_Eat(){
    ghost_munch.play();
    return ghost_munch;
}

export function Frightened() {
    if (loopInterval) return; 

    loopInterval = setInterval(() => {
        if (toggle) {
            frightened.currentTime = 0;
            frightened.play();
        } else {
            frightened2.currentTime = 0;
            frightened2.play();
        }
        toggle = !toggle;
    }, 1050); 
}

export function Stop_Frightened() {
    clearInterval(loopInterval);
    loopInterval = null;
    frightened.pause();
    frightened2.pause();
    frightened.currentTime = 0;
    frightened2.currentTime = 0;
}



