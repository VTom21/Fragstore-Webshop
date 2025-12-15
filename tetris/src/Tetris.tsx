import { useRef, useEffect } from "react";
import "./App.css";
import { generateTetromino } from "./Tetromino";

function App() {
  const canvasRef = useRef<HTMLCanvasElement | null>(null);
  const isRunning = useRef(false);

  useEffect(() => {
    const canvas = canvasRef.current!;
    const ctx = canvas.getContext("2d")!;
    ctx.fillStyle = "#000";

    const BLOCK_SIZE = 40;
    const COLS = 10;
    const ROWS = 20;
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

    const handleKeyDown = (e: KeyboardEvent) => {
      if (e.code === "Space" && !isRunning.current) {
        isRunning.current = true;
        Draw();
        generateTetromino();
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
