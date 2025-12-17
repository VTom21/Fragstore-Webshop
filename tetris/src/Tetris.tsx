import { useRef, useEffect } from "react";
import { generateTetromino, getTetrominoColor } from "./Tetromino";
// @ts-ignore
import './App.css';

function App() {
  const canvasRef = useRef<HTMLCanvasElement | null>(null);
  const tetrominoRef = useRef<ReturnType<typeof generateTetromino> | null>(null);
  const isRunning = useRef(false);
  const isBottom = useRef(false);
  const placedTetrominos = useRef<ReturnType<typeof generateTetromino>[]>([]); // store old blocks

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
      // Clear canvas
      ctx.fillStyle = "#000";
      ctx.fillRect(0, 0, canvas.width, canvas.height);

      // Draw all placed Tetrominos
      placedTetrominos.current.forEach(tetro => {
        ctx.fillStyle = getTetrominoColor(tetro.type);
        tetro.shape.forEach((row, y) => {
          row.forEach((cell, x) => {
            if (cell) {
              ctx.fillRect(
                (tetro.x + x) * BLOCK_SIZE,
                (tetro.y + y) * BLOCK_SIZE,
                BLOCK_SIZE,
                BLOCK_SIZE
              );
            }
          });
        });
      });
    }

    function drawTetromino(tetromino: typeof tetrominoRef.current) {
      if (!tetromino) return;
      ctx.fillStyle = getTetrominoColor(tetromino.type);

      tetromino.shape.forEach((row, y) => {
        row.forEach((cell, x) => {
          if (cell) {
            ctx.fillRect(
              (tetromino.x + x) * BLOCK_SIZE,
              (tetromino.y + y) * BLOCK_SIZE,
              BLOCK_SIZE,
              BLOCK_SIZE
            );
          }
        });
      });
    }

    function BottomCollision(tetromino: typeof tetrominoRef.current) {
      if (!tetromino) return;

      for (let y = 0; y < tetromino.shape.length; y++) {
        for (let x = 0; x < tetromino.shape[y].length; x++) {
          if (tetromino.shape[y][x]) {
            if (tetromino.y + y + 1 >= ROWS) {
              return true;
            }
            // Optional: check collisions with placed Tetrominos
            for (const placed of placedTetrominos.current) {
              if (
                placed.shape[y + tetromino.y + 1 - placed.y] &&
                placed.shape[y + tetromino.y + 1 - placed.y][x + tetromino.x - placed.x]
              ) {
                return true;
              }
            }
          }
        }
      }
      return false;
    }

    function Controls(e: KeyboardEvent) {
      if (!tetrominoRef.current) return;

      switch (e.key) {
        case "ArrowLeft":
          if (!isBottom.current) {
            tetrominoRef.current.x -= 1;
          }
          break;
        case "ArrowRight":
          if (!isBottom.current) {
            tetrominoRef.current.x += 1;
          }
          break;
        case "ArrowDown":
          if (BottomCollision(tetrominoRef.current)) {
            isBottom.current = true;
          } else {
            tetrominoRef.current.y += 1;
          }
          break;
        case "ArrowUp":
          break;
      }

      Draw();
      drawTetromino(tetrominoRef.current);
    }

    function Move() {
      if (!tetrominoRef.current) return;

      if (BottomCollision(tetrominoRef.current)) {
        // Add tetromino to placed list
        placedTetrominos.current.push(tetrominoRef.current);

        tetrominoRef.current = generateTetromino();
        isBottom.current = false;
      } else {
        tetrominoRef.current.y += 1;
      }

      Draw();
      drawTetromino(tetrominoRef.current);
    }

    const handleKeyDown = (e: KeyboardEvent) => {
      Controls(e);
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
