import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import Tetris from './Tetris.tsx'

createRoot(document.getElementById('root')!).render(
  <StrictMode>
    <Tetris />
  </StrictMode>,
)
