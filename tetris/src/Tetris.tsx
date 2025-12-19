import { useRef, useEffect } from "react";
import {
  generateTetromino,
  getTetrominoColor,
  SHAPES,
  SHAPE_COLORS,
} from "./Tetromino"; //imports functions from Tetromino.tsx

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

    //Collision Checker Function

    function CheckCollision(
      tetro: typeof tetrominoRef.current,
      offsetX = 0,
      offsetY = 0
    ) {
      if (!tetro) return false;

      //Loops through rows and columns of Tetromino

      for (let y = 0; y < tetro.shape.length; y++) {
        for (let x = 0; x < tetro.shape[y].length; x++) {
          if (tetro.shape[y][x]) {
            //if filled (1), assign new x and y
            const newX = tetro.x + x + offsetX; //exp. 4 + 1 + 1 = 6
            const newY = tetro.y + y + offsetY; //exp. 4 + 0 + 0 = 5 (stays the same)

            // Checks whether it goes outside any borders on x and y
            if (newX < 0 || newX >= COLS || newY >= ROWS) return true;

            // Loops through already placed Tetrominos
            for (const placed of placedTetrominos.current) {
              //placed.shape[newY - placed.y] => checks if row exists
              //placed.shape[newY - placed.y][newX - placed.x] => checks if cell is filled
              // && binds the logic together
              if (
                placed.shape[newY - placed.y] &&
                placed.shape[newY - placed.y][newX - placed.x]
              ) {
                return true;
              }
            }
          }
        }
      }

      return false;
    }

    // Bottom collision => OffsetY + 1 => We check one row ahead on Y
    function BottomCollision(tetro: typeof tetrominoRef.current) {
      return CheckCollision(tetro, 0, 1);
    }

    // Left collision => OffsetX - 1 => We check one column to the left on X
    function LeftCollision(tetro: typeof tetrominoRef.current) {
      return CheckCollision(tetro, -1, 0);
    }

    // Right collision => OffsetX + 1 => We check one column to the right on X
    function RightCollision(tetro: typeof tetrominoRef.current) {
      return CheckCollision(tetro, 1, 0);
    }

    function Edges(tetro: typeof tetrominoRef.current) {
      if (!tetro) return { minC: 0, maxC: 0 };
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

      return { minC, maxC };
    }

    function ClearLines() {
      const board: number[][] = [];
      const colors: string[][] = [];

      for (let y = 0; y < ROWS; y++) {
        board[y] = [];
        colors[y] = [];
        for (let x = 0; x < COLS; x++) {
          board[y][x] = 0;
          colors[y][x] = "";
        }
      }

      placedTetrominos.current.forEach((tetro) => {
        const color = getTetrominoColor(tetro.type);
        tetro.shape.forEach((row, y) => {
          row.forEach((cell, x) => {
            if (cell) {
              const gridY = tetro.y + y;
              const gridX = tetro.x + x;
              if (gridY >= 0 && gridY < ROWS && gridX >= 0 && gridX < COLS) {
                board[gridY][gridX] = 1;
                colors[gridY][gridX] = color;
              }
            }
          });
        });
      });

      const complete_lines: number[] = [];

      for (let y = 0; y < ROWS; y++) {
        if (board[y].every((cell) => cell == 1)) {
          complete_lines.push(y);
        }
      }

      if (complete_lines.length === 0) return;

      for (let y = complete_lines.length - 1; y >= 0; y--) {
        const line = complete_lines[y];

        board.splice(line, 1);
        colors.splice(line, 1);

        board.unshift(Array(COLS).fill(0));
        colors.unshift(Array(COLS).fill(""));

        for(let j = 0; j <= y; j++){
          complete_lines[j]++;
        }
      }

      placedTetrominos.current = [];
      for (let y = 0; y < ROWS; y++) {
        for (let x = 0; x < COLS; x++) {
          if (board[y][x] === 1) {
            const color = colors[y][x];
            const typeIndex = SHAPE_COLORS.indexOf(color);
            const type = Object.keys(SHAPES)[typeIndex];

            placedTetrominos.current.push({
              shape: [[1]],
              x: x,
              y: y,
              type: type,
            });
          }
        }
      }
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

      const { minC, maxC } = Edges(tetromino);

      if (tetromino.x + maxC >= COLS) {
        tetromino.x -= tetromino.x + maxC - COLS + 1;
      }

      if (tetromino.x + minC < 0) {
        tetromino.x += -(tetromino.x + minC);
      }
    }

    //Controls Function: takes a keyboard event as parameter

    function Controls(e: KeyboardEvent) {
      if (!tetrominoRef.current) return;
      const tetro = tetrominoRef.current; //stores current Tetromino

      //switch statements for movements
      switch (e.key) {
        case "ArrowLeft":
          if (!isBottom.current && !LeftCollision(tetro)) {
            tetro.x -= 1; //Moving Tetris to the left. If x is -1, Math.max doesn't let the Tetromino go too far left as it chooses the bigger value (a, b)
          }
          break;

        case "ArrowRight":
          if (!isBottom.current && !RightCollision(tetro)) {
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
        ClearLines();

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

  return (
    <div className="game-container">
      <canvas ref={canvasRef} className="canvas" />
      <div className="sidebar">
        <div className="block-grid"></div>
      </div>
    </div>
  );
}

export default App;
