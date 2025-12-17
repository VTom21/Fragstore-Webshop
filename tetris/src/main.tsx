import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import Tetris from './Tetris.tsx'
// eslint-disable-next-line @typescript-eslint/ban-ts-comment
//@ts-ignore
import "./App.css"; //stylesheet

createRoot(document.getElementById('root')!).render(
  <StrictMode>
    <Tetris />
  </StrictMode>,
)
