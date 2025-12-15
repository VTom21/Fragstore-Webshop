

export const IsRunning = false;
export type TetrominoShape = number[][];

export const SHAPES: Record<string, TetrominoShape> = {
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

console.log(SHAPES);
console.log(SHAPE_COLORS);


let currentTetromino: {
    shape: TetrominoShape;
    x: number;
    y: number;
    type: string;
};



export function generateTetromino() {
    const types = Object.keys(SHAPES);
    const randomIndex = Math.floor(Math.random() * types.length);
    const randomType = types[randomIndex];

    currentTetromino = {
        shape: SHAPES[randomType],
        x: 0,
        y: 0,
        type: randomType
    };

    console.log(currentTetromino);
}
