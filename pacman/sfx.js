// Functions and variables related to sound effects and music

let munch = new Audio("sfx/munch.wav");
let intro = new Audio("sfx/intro.wav");
let death = new Audio("sfx/death.wav");

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

export function Intro() {
    intro.play();
    return intro;
}

export function Death() {
    death.play();
    return death;
}

