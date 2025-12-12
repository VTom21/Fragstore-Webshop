const cell = 20;
const width = 400;
const height = 400;



class Snake{
    constructor(x,y,VelocityX,VelocityY){
        this.x = x;
        this.y = y;
        this.VelocityX = VelocityX;
        this.VelocityY = VelocityY;

        this.update = function(){

            //Moving

            this.x = this.x + this.VelocityX * cell;
            this.y = this.y + this.VelocityY * cell;

            //Constrain


        }

        this.show = function(){

        }
    }


}

function setup(){
    createCanvas(width,height);
}

function draw(){
    background(50);
}