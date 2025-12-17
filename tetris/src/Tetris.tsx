import { useRef, useEffect } from "react";
import { generateTetromino, getTetrominoColor } from "./Tetromino"; //imports functions from Tetromino.tsx
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
//@ts-ignore
import "./App.css"; //stylesheet

function App() {
  //Refs are React Hooks that lets you edit (mutate) a stored value without rendering

  const canvasRef = useRef<HTMLCanvasElement | null>(null); //Creates the Canvas object
  const tetrominoRef = useRef<ReturnType<typeof generateTetromino> | null>(
    null
  ); //References and assigns the generateTetromino class
  const isRunning = useRef(false); //isRunning Boolean
  const isBottom = useRef(false); //isBottom Boolean
  const placedTetrominos = useRef<ReturnType<typeof generateTetromino>[]>([]); // stores old, already placed blocks in array

  useEffect(() => {
    const canvas = canvasRef.current!; //We access the Cnavas object
    const ctx = canvas.getContext("2d")!; //Set the Context to 2D
    ctx.fillStyle = "#000";

    //Base variables

    const BLOCK_SIZE = 20;
    const COLS = 20;
    const ROWS = 40;
    const GRID_WIDTH = COLS * BLOCK_SIZE; //scalingX
    const GRID_HEIGHT = ROWS * BLOCK_SIZE; //scalingY

    //setting width & height
    canvas.width = GRID_WIDTH;
    canvas.height = GRID_HEIGHT;
    ctx.fillRect(0, 0, canvas.width, canvas.height); //initial clear on Canvas

    //draws out already placed Tetrominos on bottom
    function Draw() {
      ctx.fillStyle = "#000";
      ctx.fillRect(0, 0, canvas.width, canvas.height);

      //loops through placedTetromino array, draws them out with their individual color (getTetrominoColor)
      placedTetrominos.current.forEach((tetro) => {
        ctx.fillStyle = getTetrominoColor(tetro.type);
        //loops through rows and cells
        tetro.shape.forEach((row, y) => {
          row.forEach((cell, x) => {
            if (cell) {
              //if filled (1)
              ctx.fillRect(
                (tetro.x + x) * BLOCK_SIZE, //X position in pixels, exp: (4 + 1) * 20 = 100px
                (tetro.y + y) * BLOCK_SIZE, //Y position in pixels, exp: (4 + 1) * 20 = 100px
                BLOCK_SIZE, //width
                BLOCK_SIZE //height
              );
            }
          });
        });
      });
    }

    //draws the given Tetromino to the Canvas
    //takes a tetromino typed same as the tetromino stored in Ref

    function drawTetromino(tetromino: typeof tetrominoRef.current) {
      if (!tetromino) return;
      ctx.fillStyle = getTetrominoColor(tetromino.type); //fill Tetromino according to it's color

      tetromino.shape.forEach((row, y) => {
        //loops through rows and their index (y)
        row.forEach((cell, x) => {
          //loops through columns (cells) and their index (x)
          if (cell) {
            //only draws if cell is 1, not 0
            ctx.fillRect(
              (tetromino.x + x) * BLOCK_SIZE, //(x coordinate + row index) * block size  = PX
              (tetromino.y + y) * BLOCK_SIZE, //(y coordinate + column index) * block size  = PX
              BLOCK_SIZE, //width
              BLOCK_SIZE //height
            );
          }
        });
      });
    }

    //Bottom-Collision Function

    function BottomCollision(tetromino: typeof tetrominoRef.current) {
      if (!tetromino) return;

      //Goes through rows and cells (columns) of the Tetromino
      for (let y = 0; y < tetromino.shape.length; y++) {
        for (let x = 0; x < tetromino.shape[y].length; x++) {
          if (tetromino.shape[y][x]) {
            //checks if cell is filled (1 = true, 0 = false)
            if (tetromino.y + y + 1 >= ROWS) {
              //checks the next row as it moves down, whether it goes past bottom
              return true;
            }

            //goes through the array containing Tetrominos already placed on Canvas
            for (const placed of placedTetrominos.current) {
              //Checks if there is an existing row and that the cell is filled => next Tetromino falls on the first cell of placed Tetromino
              //exp. 1 + 5 + 1 - 6 = 1 => ensures we are looking at the correct row of placed Tetromino
              //exp. 1 + 3 - 2 = 2 => ensures we are looking at the correct column of placed Tetromino
              if (
                placed.shape[y + tetromino.y + 1 - placed.y] &&
                placed.shape[y + tetromino.y + 1 - placed.y][
                  x + tetromino.x - placed.x
                ]
              ) {
                return true; //Tetromino falls onto another one
              }
            }
          }
        }
      }
      return false;
    }

    function Edges(tetro: typeof tetrominoRef.current){
      if(!tetro) return {minC: 0, maxC:0};
      const size = tetro.shape.length;
      let minC = size;
      let maxC = 0;
      for (let y = 0; y < size; y++) {
        for (let x = 0; x < size; x++) {
          if (tetro.shape[y][x]) {
            minC = Math.min(minC, x);
            maxC = Math.max(maxC, x);
          }
        }
      }

      return {minC, maxC};
    }

    function Rotation() {
      if (!tetrominoRef.current) return;
      const tetromino = tetrominoRef.current;
      const size = tetromino.shape.length; //if 3x3 -> 3, 4x4 -> 4 etc.

      const newElements: number[][] = [];

      for (let y = 0; y < size; y++) {
        newElements[y] = [];
        for (let x = 0; x < size; x++) {
          newElements[y][x] = 0;
        }
      }
      for (let y = 0; y < size; y++) {
        for (let x = 0; x < size; x++) {
          const newX = size - 1 - y;
          const newY = x;

          newElements[newY][newX] = tetromino.shape[y][x];
        }
      }

      tetromino.shape = newElements;

      const {minC, maxC} = Edges(tetromino);


      if(tetromino.x + maxC >= COLS){
        tetromino.x -= tetromino.x + maxC - COLS + 1;
      }

      if(tetromino.x + minC < 0){
        tetromino.x += -(tetromino.x + minC);
      }

    }

    //Controls Function: takes a keyboard event as parameter

    function Controls(e: KeyboardEvent) {
      if (!tetrominoRef.current) return;
      const tetro = tetrominoRef.current; //stores current Tetromino
      const {minC, maxC} = Edges(tetro);



      //switch statements for movements
      switch (e.key) {
        case "ArrowLeft":
          if (!isBottom.current && tetro.x + minC > 0) {
            tetro.x -= 1; //Moving Tetris to the left. If x is -1, Math.max doesn't let the Tetromino go too far left as it chooses the bigger value (a, b)
          }
          break;

        case "ArrowRight":
          if (!isBottom.current && tetro.x + maxC < COLS - 1) {
            tetro.x += 1; //Moving Tetris to the right. If x is more than column count, Math.min doesn't let the Tetromino go too far right as it the smaller bigger value (a, b)
          }
          break;

        case "ArrowDown":
          if (BottomCollision(tetro)) {
            //uses BottomCollision Function that checks bottom collision of Tetromino & and ensures stacking of Tetrominos
            isBottom.current = true;
          } else {
            tetro.y += 1; //moves it on y-axis
          }
          break;

        case "ArrowUp":
          Rotation();
          break;
      }

      Draw(); //draws out placed Tetrominos on bottom
      drawTetromino(tetrominoRef.current); //draws out current Tetromino
    }

    //Move function -> called every frame
    function Move() {
      if (!tetrominoRef.current) return;

      //checks if theres bottom collision made by the Tetromino
      if (BottomCollision(tetrominoRef.current)) {
        placedTetrominos.current.push(tetrominoRef.current); //pushes Tetromino values to array

        tetrominoRef.current = generateTetromino(); // genereates a new Tetromino
        isBottom.current = false; //sets boolean to false
      } else {
        tetrominoRef.current.y += 1; //continues moving it downwards
      }

      //calls draw functions
      Draw();
      drawTetromino(tetrominoRef.current);
    }

    //at Spacebar press, the game starts.
    //generates a tetromino and draws out every tetromino on canvas (placed & not placed)
    const handleKeyDown = (e: KeyboardEvent) => {
      Controls(e); //calling Control function
      if (e.code === "Space" && !isRunning.current) {
        isRunning.current = true;
        isBottom.current = false;
        tetrominoRef.current = generateTetromino();
        Draw();
        drawTetromino(tetrominoRef.current);

        setInterval(() => {
          Move();
        }, 500);
      }
    };

    window.addEventListener("keydown", handleKeyDown);

    return () => {
      window.removeEventListener("keydown", handleKeyDown);
    };
  }, []);

  return <canvas ref={canvasRef} className="canvas"></canvas>;
}

export default App;
