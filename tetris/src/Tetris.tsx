import { useRef, useEffect } from "react";
import { generateTetromino, getTetrominoColor } from "./Tetromino";
// @ts-ignore
import './App.css';

function App() {
  const canvasRef = useRef<HTMLCanvasElement | null>(null);
  const tetrominoRef = useRef<ReturnType<typeof generateTetromino> | null>(null);
  const isRunning = useRef(false);

  useEffect(() => {
    const canvas = canvasRef.current!;
    const ctx = canvas.getContext("2d")!;
    ctx.fillStyle = "#000";

    const BLOCK_SIZE = 20;
    const COLS = 20;
    const ROWS = 40;
    const GRID_WIDTH = COLS * BLOCK_SIZE;
    const GRID_HEIGHT = ROWS * BLOCK_SIZE;

    canvas.width = GRID_WIDTH;
    canvas.height = GRID_HEIGHT;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    function Draw() {
      if (isRunning.current) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = "#000";
        ctx.fillRect(0, 0, canvas.width, canvas.height);
      }
    }

    function drawTetromino(){
      const tetromino = tetrominoRef.current;
      if(!tetromino) return;
      ctx.fillStyle = getTetrominoColor(tetromino.type);

      tetromino.shape.forEach((row, y) =>{
        row.forEach((cell,x)=>{
          if(cell){
            ctx.fillRect(
              (tetromino.x + x) * BLOCK_SIZE,
              (tetromino.y + y) * BLOCK_SIZE,
              BLOCK_SIZE,
              BLOCK_SIZE
            );
          }
        })
      });
    }



   function Controls(e: KeyboardEvent){

        if (!tetrominoRef.current) return;
  
        switch (e.key) {
          case "ArrowLeft":
            tetrominoRef.current.x -= 1; 
            break;
          case "ArrowRight":
            tetrominoRef.current.x += 1; 
            break;
          case "ArrowDown":
            tetrominoRef.current.y += 1; 
            break;
          case "ArrowUp":
            break;
        }

        Draw();
        drawTetromino();
    }

    function Move(){
      if(!tetrominoRef.current) return;
      tetrominoRef.current.y += 1;
      Draw();
      drawTetromino();
    }

    const handleKeyDown = (e: KeyboardEvent) => {
      Controls(e);
      if (e.code === "Space" && !isRunning.current) {
        isRunning.current = true;
        tetrominoRef.current = generateTetromino();
        Draw();
        drawTetromino();
        
        setInterval(() => {
          Move();
        }, 500); // moves every 500ms (adjust for speed)
      }
    };

    window.addEventListener("keydown", handleKeyDown);

    return () => {
      window.removeEventListener("keydown", handleKeyDown); // cleanup
    };
  }, []);

  return <canvas ref={canvasRef} className="canvas"></canvas>;
}

export default App;
