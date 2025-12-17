

export type TetrominoShape = number[][]; // defines a 2D array type called TetrominoShape

export const SHAPES: Record<string, TetrominoShape> = { //Record is a Typescript Utility that creates an object with a key (string) and property (TetrominoShape) 
    i: [
        [0,0,0,0],
        [1,1,1,1],
        [0,0,0,0],
        [0,0,0,0]
    ],
    j: [
        [1,0,0], 
        [1,1,1], 
        [0,0,0],
    ],
    l: [
        [0,0,1],
        [1,1,1],
        [0,0,0],
    ],
    o: [
        [1,1],
        [1,1],
    ],
    s: [
        [0,1,1],
        [1,1,0],
        [0,0,0],
    ],
    t: [
        [1,1,1],
        [0,1,0],
        [0,0,0],
    ],
    z: [
        [1,1,0],
        [0,1,1],
        [0,0,0],
    ],
};

export const SHAPE_COLORS = [
    '#00BCD4',
    '#485FE5',
    '#FF9800',
    '#FFEB3B',
    '#4CAF50',
    '#A629BC',
    '#F44336'
];



export function getTetrominoColor(type: string) {
    const SHAPE_TYPES = Object.keys(SHAPES);  // returns an array of all the keys in the object, exp: i, j
    const index = SHAPE_TYPES.indexOf(type); // stores the index of that Tetromino
    return SHAPE_COLORS[index]; //returns its color based on index
  }

console.log(SHAPES);
console.log(SHAPE_COLORS);


//Generating Tetromino

export function generateTetromino() {
    const types = Object.keys(SHAPES);
    const randomIndex = Math.floor(Math.random() * types.length); //generates a random index
    const randomType = types[randomIndex]; //chooses a random Tetromino

    return{
        shape: SHAPES[randomType], //2D array of that Tetromino, exp z: [[0,1,1], [1,1,0], [0,0,0]]
        x: 3, //x-axis
        y: 0,//y-axis
        type: randomType //exp: i, j
    };

}


