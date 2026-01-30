import { useRef, useEffect, useState } from "react";
import { generateTetromino, getTetrominoColor, SHAPES, SHAPE_COLORS, } from "./Tetromino"; //imports functions from Tetromino.tsx

function App() {
  //In React, we have to talk about rendering => React only renders state changes (useState), property and context changes
  //Refs are React Hooks that lets you edit (mutate) a stored value without re-rendering, by using .current
  //useState is a React model that lets you render (score) and also re-render (setScore) a specific variable
  //useState - useRef Comparison: setScore(value) - score.current = value

  const canvasRef = useRef<HTMLCanvasElement | null>(null); //Creates the Canvas container
  const NextcanvasRef = useRef<HTMLCanvasElement | null>(null); //Creates another Canvas container for sidebar
  const tetrominoRef = useRef<ReturnType<typeof generateTetromino> | null>(null); //References and assigns the generateTetromino class
  const NextTetrominoRef = useRef<ReturnType<typeof generateTetromino> | null>(null);
  const isRunning = useRef(false); //isRunning Boolean
  const isBottom = useRef(false); //isBottom Boolean
  const placedTetrominos = useRef<ReturnType<typeof generateTetromino>[]>([]); // stores old, already placed blocks in array
  const [score, setScore] = useState(0);
  const scoreUI = useRef<HTMLHeadingElement | null>(null);
  const high_score = localStorage.getItem("highScore") || "";
  const highScoreUI = useRef<HTMLHeadingElement | null>(null);
  let speed = 1;


  useEffect(() => {
    const canvas = canvasRef.current!; //We access the Canvas object
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

    if (highScoreUI.current) {
      highScoreUI.current.textContent = `High Score: ${high_score || 0}`;
    }

    //draws out already placed Tetrominos on bottom
    function Draw() {
      ctx.fillStyle = "#000";
      ctx.fillRect(0, 0, canvas.width, canvas.height);
      ctx.lineWidth = 2;
      ctx.strokeStyle = "rgba(0,0,0,0.35)"; // vagy "white", "#111", stb.

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
              ctx.strokeRect((tetro.x + x) * BLOCK_SIZE, (tetro.y + y) * BLOCK_SIZE, BLOCK_SIZE, BLOCK_SIZE);
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

      ctx.lineWidth = 2;
      ctx.strokeStyle = "rgba(0,0,0,0.35)";

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

            ctx.strokeRect((tetromino.x + x) * BLOCK_SIZE, (tetromino.y + y) * BLOCK_SIZE, BLOCK_SIZE, BLOCK_SIZE);
          }
        });
      });
    }


    //Function for drawing out next random tetromino before first
    function Next_Tetromino(tetromino: typeof NextTetrominoRef.current) {
      if (!tetromino) return;

      const sidebar = NextcanvasRef.current; //we set the sidebar variable to it's own canvas
      if (!sidebar) return;

      const sidebar_ctx = sidebar.getContext("2d"); //set the rendering to 2D
      if (!sidebar_ctx) return;

      sidebar_ctx.clearRect(0, 0, sidebar.width, sidebar.height); //perform initial clean on canvas

      sidebar_ctx.fillStyle = getTetrominoColor(tetromino.type); //chooses the color that applies to the tetromino

      sidebar_ctx.lineWidth = 2;
      sidebar_ctx.strokeStyle = "rgba(0,0,0,0.35)"; // vagy "white", "#111", stb.

      tetromino.shape.forEach((row, y) => { //we go through tetromino
        row.forEach((cell, x) => {
          if (cell) {
            sidebar_ctx.fillRect(
              x * BLOCK_SIZE + 25, //defining x position
              y * BLOCK_SIZE + 20, //defining y position
              BLOCK_SIZE,
              BLOCK_SIZE
            );
            sidebar_ctx.strokeRect(x * BLOCK_SIZE + 25, y * BLOCK_SIZE + 20, BLOCK_SIZE, BLOCK_SIZE);
          }
        });
      });

    }


    //Collision Checker Function

    function CheckCollision(tetro: typeof tetrominoRef.current, offsetX = 0, offsetY = 0) {
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
              if (placed.shape[newY - placed.y] && placed.shape[newY - placed.y][newX - placed.x]
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

    //Edges Function for checking edge collision
    function Edges(tetro: typeof tetrominoRef.current) {
      if (!tetro) return { minC: 0, maxC: 0 };
      const size = tetro.shape.length; //stores size of the tetromino array, exp. 3x3 => 3
      let minC = size; //set this value as minimum column count by default
      let maxC = 0;

      //By using minimum and maximum search, we get the smallest and biggest column a tetromino can access 
      for (let y = 0; y < size; y++) {
        for (let x = 0; x < size; x++) {
          if (tetro.shape[y][x]) {
            minC = Math.min(minC, x); //Math.min() choose the smaller number inside the brackets
            maxC = Math.max(maxC, x); //Math.max() choose the higher number inside the brackets
          }
        }
      }

      return { minC, maxC }; //returns the smallest and biggest column
    }

    function TopCollision(tetro: typeof tetrominoRef.current){
      if(!tetro) return;
      for(let y = 0 ; y < tetro.shape.length; y++){
        for(let x = 0; x < tetro.shape[y].length; x++){
          if(tetro.shape[y][x]){
            if(tetro.y + y < 1){
              return true;
            }
          }
        }
      }
      return false;
    }

    

    //Clearlines function for clearing full rows
    function ClearLines() {
      //we define two 2D arrays: for storing board content & tetromino colors
      const board: number[][] = [];
      const colors: string[][] = [];

      //we fill up both arrays with zero and empty values
      for (let y = 0; y < ROWS; y++) {
        board[y] = [];
        colors[y] = [];
        for (let x = 0; x < COLS; x++) {
          board[y][x] = 0;
          colors[y][x] = "";
        }
      }

      //goes through tetrominos already placed on bottom
      placedTetrominos.current.forEach((tetro) => {
        const color = getTetrominoColor(tetro.type);
        tetro.shape.forEach((row, y) => {
          row.forEach((cell, x) => {
            if (cell) {
              const gridY = tetro.y + y; //store x coordinates
              const gridX = tetro.x + x; //store y coordinates
              if (gridY >= 0 && gridY < ROWS && gridX >= 0 && gridX < COLS) { //checks if tetromino is properly inside the grid
                board[gridY][gridX] = 1; //sets a value of 1 inside new array at exact positions
                colors[gridY][gridX] = color; //sets it's color accordingly
              }
            }
          });
        });
      });

      const complete_lines: number[] = []; //we create a complete_lines array that contains all full rows

      for (let y = 0; y < ROWS; y++) {
        if (board[y].every((cell) => cell == 1)) { //we filter out every cell that has the value of 1
          complete_lines.push(y); //push it inside array
          speed *= 1.05;
        }
      }
      //we use setter to increase score by 10 at every full row
      setScore(prev => {
        const newScore = prev + 10 * complete_lines.length;

        if (scoreUI.current) {
          scoreUI.current.textContent = `Score: ${newScore}`; //Set the DOM value of current score (UI)
        }

        const currentHigh = parseInt(high_score) || 0; //store the high score in separate variable

        if (newScore > currentHigh) { //condition to check if new score is higher than high score or not

          if (highScoreUI.current) {
            highScoreUI.current.textContent = `High Score: ${newScore}`; //Set the DOM value of high score (UI)
          }

          localStorage.setItem("highScore", newScore.toString()); //use localstorage for long-term high score saving 
        }

        return newScore; //returns new current score
      });


      //checks again if current new score is higher than the high score
      if (score > parseInt(high_score)) {
        localStorage.setItem("highScore", score.toString()); //then sets the highest using localStorage
      }

      if (complete_lines.length === 0) return;

      //we go through all filled lines (top to bottom)
      for (let y = complete_lines.length - 1; y >= 0; y--) {
        const line = complete_lines[y]; //store the row itself

        //by using splice(), we remove one row at the index where our first full row is, then delete the colors tied to the shapes too
        board.splice(line, 1);
        colors.splice(line, 1);

        //by using unshift(), we fill up the top of the array with a full row of zeros (empty spaces)
        board.unshift(Array(COLS).fill(0));
        colors.unshift(Array(COLS).fill(""));

        //increase the index of every other row (makes sure multiple row removal can happen)

        /*
        exp. if line 0 gets removed, then we unshift so on top there's a row full of 0. 
        Therefore line 1 will not have index 1 anymore but 0, so we need to increment indexes 
        if we want to remove multiple at one go. (if possible)
        
        */

        for (let j = 0; j <= y; j++) {
          complete_lines[j]++;
        }
      }


      //we empty out array that contains all tetrominos placed on bottom
      placedTetrominos.current = [];
      for (let y = 0; y < ROWS; y++) {
        for (let x = 0; x < COLS; x++) {
          if (board[y][x] === 1) {
            const color = colors[y][x]; //stores color of tetromino, exp. blue
            const typeIndex = SHAPE_COLORS.indexOf(color); //gets out the index of the tetromino's color, exp. 2
            const type = Object.keys(SHAPES)[typeIndex]; //searches for tetromino type by indexing its shape, exp. shapes[2] = l

            //pushes the block into the 2D array
            placedTetrominos.current.push({
              shape: [[1]], //creating one block
              x: x, //x-axis
              y: y, //y-axis
              type: type, //tetromino type, exp. i, j
            });
          }
        }
      }
    }


    //Rotation Function => Matrix Rotation
    function Rotation() {
      if (!tetrominoRef.current) return;
      const tetromino = tetrominoRef.current; //stores current tetromino
      const size = tetromino.shape.length; //if 3x3 -> 3, 4x4 -> 4 etc.

      const newElements: number[][] = []; //creates a new 2D Array

      //We fill out this 2D array with zeros
      for (let y = 0; y < size; y++) {
        newElements[y] = [];
        for (let x = 0; x < size; x++) {
          newElements[y][x] = 0;
        }
      }
      //We perform rotation
      //example of Matrix Rotation with T-shape (counter-clockwise):
      /* 

      0°  : (1,1)
      90° : (0,1)
      180°: (1,0)
      270°: (2,1)
      360°: (1,1)

      */
      for (let y = 0; y < size; y++) {
        for (let x = 0; x < size; x++) {
          const newX = size - 1 - y; //Gets the value of X
          const newY = x; //Y gets the value of X in previous angle

          newElements[newY][newX] = tetromino.shape[y][x]; //stores filled values into the new array
        }
      }

      //applies the new position for the tetromino
      tetromino.shape = newElements;

      const { minC, maxC } = Edges(tetromino); //extract minimum and maximum column count from Edges() class

      if (tetromino.x + maxC >= COLS) { //checks if the tetromino on the biggest column, is out of bounds or not on the right edge
        tetromino.x -= tetromino.x + maxC - COLS + 1; //if yes, tetromino gets pushed back inside the grid
      }

      if (tetromino.x + minC < 0) { //checks if the tetromino on the biggest column, is out of bounds or not on the left edge
        tetromino.x += -(tetromino.x + minC);  //if yes, tetromino gets pushed back inside the grid
      }
    }

    //Controls Function: takes a keyboard event as parameter

    function Controls(e: KeyboardEvent) {
      if (!tetrominoRef.current) return;
      const tetro = tetrominoRef.current; //stores current Tetromino

      //switch statements for movements
      switch (e.key) {
        case "ArrowLeft":
          case "a":
          case "A":
          if (!isBottom.current && !LeftCollision(tetro)) {
            tetro.x -= 1; //Moving Tetris to the left. If x is -1, Math.max doesn't let the Tetromino go too far left as it chooses the bigger value (a, b)
          }
          break;

        case "ArrowRight":
          case "d":
          case "D":
          if (!isBottom.current && !RightCollision(tetro)) {
            tetro.x += 1; //Moving Tetris to the right. If x is more than column count, Math.min doesn't let the Tetromino go too far right as it the smaller bigger value (a, b)
          }
          break;

        case "ArrowDown":
          case "s":
          case "S":
          if (BottomCollision(tetro)) {
            //uses BottomCollision Function that checks bottom collision of Tetromino & and ensures stacking of Tetrominos
            isBottom.current = true;
          } else {
            tetro.y += 1; //moves it on y-axis
          }
          break;

        case "ArrowUp":
          case "w":
          case "W":
          Rotation();
          break;
      }

      Draw(); //draws out placed Tetrominos on bottom
      drawTetromino(tetrominoRef.current); //draws out current Tetromino
    }

    //Move function -> called every frame
    function Move() {
      if (!tetrominoRef.current) return;
      for( let i = 0; i < speed; i++){
      //checks if theres bottom collision made by the Tetromino
      if (BottomCollision(tetrominoRef.current)) {
        placedTetrominos.current.push(tetrominoRef.current); //pushes Tetromino values to array
        ClearLines();

        if (!NextTetrominoRef.current) {
          NextTetrominoRef.current = generateTetromino();
        }

        if (TopCollision(tetrominoRef.current)) {
          const GameOverDiv = document.querySelector(".GameOverUI") as HTMLDivElement | null;
          if (GameOverDiv) GameOverDiv.style.display = "block";
          return;
        }

        tetrominoRef.current = NextTetrominoRef.current;
        if (tetrominoRef.current) {
          tetrominoRef.current.x = 3;
          tetrominoRef.current.y = 0;
        }

        NextTetrominoRef.current = generateTetromino();
        isBottom.current = false; //sets boolean to false
        break
      } else {
        tetrominoRef.current.y += 1; //continues moving it downwards
      }}

      //calls draw functions
      Draw();
      drawTetromino(tetrominoRef.current);
      Next_Tetromino(NextTetrominoRef.current);
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
  });

  return (
    //this is where our UI elements are
    //by using the Ref variables, we create the base UI elements
    <div className="game-container">
      <canvas ref={canvasRef} className="canvas" style={{position:"relative"}} />
      <div style={{backgroundColor: "#111", display:"none", padding: "40px 50px", borderRadius: 20, textAlign: "center", position:"absolute", left:"6.5%", boxShadow: "0 0 30px rgba(0,0,0,0.8)"}} className="GameOverUI">
        <h1 style={{margin: 0, color: "#ff4444", fontSize: 48}}>GAME OVER</h1>
        <button onClick={()=> window.location.reload()} style={{marginTop: 20,padding: "14px 36px",fontSize: 18,fontWeight: "bold",letterSpacing: 1,color: "white",background: "linear-gradient(180deg, #ff4d4d, #c62828)",border: "2px solid #ff7777",borderRadius: 12,cursor: "pointer",boxShadow:"0 6px 0 #7f1d1d, 0 12px 25px rgba(0,0,0,0.6)",transition: "all 0.15s ease"}}>Try Again</button>
      </div>
      <div className="sidebar">
        <canvas ref={NextcanvasRef} width={110} />
        <h3 className="score" ref={scoreUI}>Score: {score}</h3>
        <h3 className="high_score" ref={highScoreUI}>Score: {score}</h3>
      </div>  
    </div>
  );
}

export default App;
