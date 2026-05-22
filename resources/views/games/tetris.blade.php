@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <a href="{{ route('games.index') }}" class="game-back-link">← GAMES_HUB</a>
            <h1 class="game-page-title mt-2">🧩 CYBER_TETRIS</h1>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <span class="info-badge" style="--bc:#00ff88">PUZZLE</span>
            <span class="info-badge" style="--bc:#00ff88">ARROW KEYS</span>
            <span class="info-badge" style="--bc:#f59e0b">MEDIUM</span>
        </div>
    </div>

    <div class="row g-4">
        {{-- Canvas --}}
        <div class="col-lg-8">
            <div class="game-canvas-wrap" style="--gc:#00ff88; background:#010d06; border-color:rgba(0,255,136,0.3); box-shadow:0 0 40px rgba(0,255,136,0.1);">
                <canvas id="tetrisCanvas" width="300" height="600" style="display:block; max-width:100%;"></canvas>
                <div id="tetris-overlay" class="game-overlay" style="background:rgba(0,13,26,0.9);">
                    <div class="overlay-content">
                        <div class="overlay-emoji">🧩</div>
                        <h2 class="overlay-title" style="color:#00ff88">CYBER_TETRIS</h2>
                        <p class="overlay-sub">Stack neon blocks and clear lines to score!<br>Speed increases with each level.</p>
                        <button id="tetris-start-btn" class="game-btn" style="--bc:#00ff88">▶ START GAME</button>
                    </div>
                </div>
                <div id="tetris-gameover" class="game-overlay" style="display:none; background:rgba(0,13,26,0.9);">
                    <div class="overlay-content">
                        <div class="overlay-emoji">💀</div>
                        <h2 class="overlay-title" style="color:#ef4444">GAME OVER</h2>
                        <p class="overlay-sub">Score: <span id="tet-final-score" style="color:#00ff88; font-family:'Orbitron',sans-serif; font-size:1.4rem; font-weight:700;">0</span></p>
                        <button id="tetris-restart-btn" class="game-btn" style="--bc:#00ff88">⟳ PLAY AGAIN</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4 d-flex flex-column gap-3">
            <div class="game-stat-panel" style="border-color:rgba(0,255,136,0.2);">
                <div class="stat-row"><span class="stat-lbl">SCORE</span><span class="stat-val" id="tet-score" style="color:#00ff88">0</span></div>
                <div class="stat-row"><span class="stat-lbl">HIGH SCORE</span><span class="stat-val" id="tet-hi" style="color:#f59e0b">0</span></div>
                <div class="stat-row"><span class="stat-lbl">LEVEL</span><span class="stat-val" id="tet-level" style="color:#a855f7">1</span></div>
                <div class="stat-row"><span class="stat-lbl">LINES</span><span class="stat-val" id="tet-lines" style="color:#10b981">0</span></div>
            </div>

            {{-- Next Piece --}}
            <div class="game-controls-panel" style="border-color:rgba(0,255,136,0.2);">
                <h6 class="panel-title" style="color:#6b7280">NEXT PIECE</h6>
                <div class="d-flex justify-content-center">
                    <canvas id="nextCanvas" width="100" height="100"></canvas>
                </div>
            </div>

            <div class="game-controls-panel" style="border-color:rgba(0,255,136,0.2);">
                <h6 class="panel-title">CONTROLS</h6>
                <div class="ctrl-list">
                    <div class="ctrl-item"><span class="ctrl-key">← →</span><span class="ctrl-desc">Move</span></div>
                    <div class="ctrl-item"><span class="ctrl-key">↑</span><span class="ctrl-desc">Rotate</span></div>
                    <div class="ctrl-item"><span class="ctrl-key">↓</span><span class="ctrl-desc">Soft Drop</span></div>
                    <div class="ctrl-item"><span class="ctrl-key">SPACE</span><span class="ctrl-desc">Hard Drop</span></div>
                    <div class="ctrl-item"><span class="ctrl-key">P</span><span class="ctrl-desc">Pause</span></div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button id="tet-pause-btn" class="game-btn flex-1" style="--bc:#f59e0b; font-size:0.7rem; padding:10px;">⏸ PAUSE</button>
                <button id="tet-reset-btn" class="game-btn flex-1" style="--bc:#ef4444; font-size:0.7rem; padding:10px;">↺ RESET</button>
            </div>
        </div>
    </div>
</div>

<style>
:root { --primary:#00ff88; }
.game-back-link { font-family:'Orbitron',sans-serif; font-size:0.7rem; color:#6b7280; text-decoration:none; letter-spacing:0.1em; transition:color 0.2s; }
.game-back-link:hover { color:var(--primary); }
.game-page-title { font-family:'Orbitron',sans-serif; font-size:clamp(1.4rem,3vw,2rem); color:#fff; margin:0; }
.info-badge { font-family:'Orbitron',sans-serif; font-size:0.65rem; letter-spacing:0.12em; color:var(--bc); border:1px solid color-mix(in srgb,var(--bc) 45%,transparent); padding:4px 12px; border-radius:100px; background:color-mix(in srgb,var(--bc) 8%,transparent); }
.game-canvas-wrap { position:relative; border-radius:12px; overflow:hidden; display:flex; align-items:center; justify-content:center; }
.game-overlay { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; text-align:center; backdrop-filter:blur(4px); z-index:10; }
.overlay-content { padding:30px; }
.overlay-emoji { font-size:4rem; margin-bottom:12px; }
.overlay-title { font-family:'Orbitron',sans-serif; font-size:1.8rem; margin-bottom:10px; }
.overlay-sub { color:#6b7280; font-size:0.9rem; line-height:1.6; margin-bottom:24px; }
.game-btn { display:inline-flex; align-items:center; justify-content:center; gap:8px; font-family:'Orbitron',sans-serif; font-weight:700; font-size:0.8rem; letter-spacing:0.12em; cursor:pointer; transition:all 0.3s ease; padding:13px 28px; border-radius:6px; text-transform:uppercase; border:1.5px solid var(--bc); background:transparent; color:var(--bc); }
.game-btn:hover { background:var(--bc); color:#010d06; box-shadow:0 0 30px color-mix(in srgb,var(--bc) 45%,transparent); transform:translateY(-2px); }
.game-stat-panel,.game-controls-panel { background:rgba(15,23,42,0.7); border:1px solid rgba(0,255,136,0.2); border-radius:12px; padding:20px; backdrop-filter:blur(8px); }
.stat-row { display:flex; justify-content:space-between; align-items:center; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.05); }
.stat-row:last-child { border:0; }
.stat-lbl { font-family:'Orbitron',sans-serif; font-size:0.65rem; color:#4b5563; letter-spacing:0.15em; }
.stat-val { font-family:'Orbitron',sans-serif; font-size:1.1rem; font-weight:700; }
.panel-title { font-family:'Orbitron',sans-serif; font-size:0.7rem; color:#6b7280; letter-spacing:0.2em; margin-bottom:14px; border-bottom:1px solid rgba(255,255,255,0.06); padding-bottom:8px; }
.ctrl-list { display:flex; flex-direction:column; gap:8px; }
.ctrl-item { display:flex; align-items:center; gap:12px; }
.ctrl-key { font-family:'Orbitron',sans-serif; font-size:0.65rem; background:rgba(0,255,136,0.1); border:1px solid rgba(0,255,136,0.25); border-radius:4px; padding:3px 8px; color:var(--primary); min-width:60px; text-align:center; }
.ctrl-desc { font-size:0.8rem; color:#9ca3af; }
.flex-1 { flex:1; }
</style>

<script>
const canvas  = document.getElementById('tetrisCanvas');
const ctx     = canvas.getContext('2d');
const nextCvs = document.getElementById('nextCanvas');
const nCtx    = nextCvs.getContext('2d');

const COLS=10, ROWS=20, SZ=30;

const PIECES = [
    {shape:[[1,1,1,1]],          color:'#00ff88', glow:'rgba(0,255,136,0.8)'},   // I
    {shape:[[1,1],[1,1]],        color:'#f59e0b', glow:'rgba(245,158,11,0.8)'},   // O
    {shape:[[0,1,0],[1,1,1]],    color:'#a855f7', glow:'rgba(168,85,247,0.8)'},   // T
    {shape:[[1,0,0],[1,1,1]],    color:'#ef4444', glow:'rgba(239,68,68,0.8)'},    // J
    {shape:[[0,0,1],[1,1,1]],    color:'#f97316', glow:'rgba(249,115,22,0.8)'},   // L
    {shape:[[0,1,1],[1,1,0]],    color:'#10b981', glow:'rgba(16,185,129,0.8)'},   // S
    {shape:[[1,1,0],[0,1,1]],    color:'#ec4899', glow:'rgba(236,72,153,0.8)'},   // Z
];

let board, current, next, score, hiScore, level, lines, running, paused, animId;
hiScore = parseInt(localStorage.getItem('tetris_hi')||'0');
document.getElementById('tet-hi').textContent = hiScore;

function newPiece() {
    const p = PIECES[Math.floor(Math.random()*PIECES.length)];
    return { shape:p.shape.map(r=>[...r]), color:p.color, glow:p.glow, x:Math.floor(COLS/2)-Math.floor(p.shape[0].length/2), y:0 };
}

function init() {
    board   = Array.from({length:ROWS},()=>Array(COLS).fill(null));
    current = newPiece();
    next    = newPiece();
    score   = 0; level = 1; lines = 0;
    running = false; paused = false;
    updateHUD();
    draw();
}

function updateHUD() {
    document.getElementById('tet-score').textContent = score;
    document.getElementById('tet-level').textContent = level;
    document.getElementById('tet-lines').textContent = lines;
    drawNext();
}

function drawCell(c, x, y, alpha=1) {
    if(!c) return;
    c.shadowColor = PIECES.find(p=>p.color===y?.color||false)?.glow || 'rgba(0,255,136,0.5)';
    c.shadowBlur  = 12;
    const g = c.createLinearGradient(x,y,x+SZ-2,y+SZ-2);
    g.addColorStop(0, alpha<1?`rgba(255,255,255,${alpha*0.3})`:'rgba(255,255,255,0.25)');
    g.addColorStop(1,'transparent');
    c.fillStyle = g; c.fillRect(x+1,y+1,SZ-2,SZ-2);
    c.shadowBlur=0;
}

function draw() {
    ctx.fillStyle='#010d06'; ctx.fillRect(0,0,canvas.width,canvas.height);

    // Grid lines
    ctx.strokeStyle='rgba(0,255,136,0.04)'; ctx.lineWidth=0.5;
    for(let r=0;r<ROWS;r++) for(let c=0;c<COLS;c++) ctx.strokeRect(c*SZ,r*SZ,SZ,SZ);

    // Board
    for(let r=0;r<ROWS;r++) for(let c=0;c<COLS;c++) {
        if(board[r][c]) {
            const col=board[r][c];
            ctx.shadowColor=PIECES.find(p=>p.color===col)?.glow||'rgba(0,255,136,0.5)';
            ctx.shadowBlur=8;
            ctx.fillStyle=col; ctx.fillRect(c*SZ+1,r*SZ+1,SZ-2,SZ-2);
            ctx.shadowBlur=0;
            // Shine
            ctx.fillStyle='rgba(255,255,255,0.15)'; ctx.fillRect(c*SZ+2,r*SZ+2,SZ/2,SZ/4);
        }
    }

    // Ghost piece
    let gy=current.y;
    while(!collision(current.x,gy+1,current.shape)) gy++;
    if(gy>current.y) {
        ctx.globalAlpha=0.18;
        current.shape.forEach((row,dr)=>row.forEach((v,dc)=>{ if(v){ctx.fillStyle=current.color; ctx.fillRect((current.x+dc)*SZ+1,(gy+dr)*SZ+1,SZ-2,SZ-2);} }));
        ctx.globalAlpha=1;
    }

    // Current
    current.shape.forEach((row,dr)=>row.forEach((v,dc)=>{ if(v){
        ctx.shadowColor=current.glow; ctx.shadowBlur=14;
        ctx.fillStyle=current.color; ctx.fillRect((current.x+dc)*SZ+1,(current.y+dr)*SZ+1,SZ-2,SZ-2);
        ctx.shadowBlur=0;
        ctx.fillStyle='rgba(255,255,255,0.2)'; ctx.fillRect((current.x+dc)*SZ+3,(current.y+dr)*SZ+3,SZ/2,SZ/5);
    }}));
}

function drawNext() {
    nCtx.fillStyle='transparent'; nCtx.clearRect(0,0,100,100);
    const s=20, os=(100-next.shape[0].length*s)/2, or=(100-next.shape.length*s)/2;
    next.shape.forEach((row,r)=>row.forEach((v,c)=>{ if(v){
        nCtx.shadowColor=next.glow; nCtx.shadowBlur=10;
        nCtx.fillStyle=next.color; nCtx.fillRect(os+c*s+1,or+r*s+1,s-2,s-2);
        nCtx.shadowBlur=0;
    }}));
}

function collision(nx,ny,shape) {
    return shape.some((row,dr)=>row.some((v,dc)=>{ if(!v) return false; const nb=ny+dr, nc=nx+dc; return nb<0||nb>=ROWS||nc<0||nc>=COLS||board[nb][nc]; }));
}

function merge() { current.shape.forEach((row,dr)=>row.forEach((v,dc)=>{ if(v) board[current.y+dr][current.x+dc]=current.color; })); }

function clearLines() {
    let cleared=0;
    for(let r=ROWS-1;r>=0;r--) {
        if(board[r].every(c=>c)) {
            board.splice(r,1); board.unshift(Array(COLS).fill(null)); cleared++; r++;
        }
    }
    if(cleared) {
        const pts=[0,100,300,500,800];
        score += (pts[cleared]||800)*level;
        lines += cleared;
        level  = Math.floor(lines/10)+1;
        if(score>hiScore){ hiScore=score; localStorage.setItem('tetris_hi',hiScore); document.getElementById('tet-hi').textContent=hiScore; }
        updateHUD();
    }
}

function getSpeed() { return Math.max(80, 600-level*50); }

let lastTime=0;
function gameLoop(ts) {
    if(!running||paused){ animId=requestAnimationFrame(gameLoop); return; }
    if(ts-lastTime > getSpeed()) {
        lastTime=ts;
        if(!collision(current.x,current.y+1,current.shape)) {
            current.y++;
        } else {
            merge(); clearLines();
            current=next; next=newPiece(); updateHUD();
            if(collision(current.x,current.y,current.shape)) { gameOver(); return; }
        }
    }
    draw();
    animId=requestAnimationFrame(gameLoop);
}

function startGame() {
    document.getElementById('tetris-overlay').style.display='none';
    document.getElementById('tetris-gameover').style.display='none';
    running=true; paused=false;
    lastTime=0;
    cancelAnimationFrame(animId);
    animId=requestAnimationFrame(gameLoop);
}

function gameOver() {
    running=false;
    document.getElementById('tet-final-score').textContent=score;
    document.getElementById('tetris-gameover').style.display='flex';
}

document.addEventListener('keydown',e=>{
    if(!running||paused) return;
    if(e.key==='ArrowLeft'){ if(!collision(current.x-1,current.y,current.shape)) current.x--; draw(); }
    if(e.key==='ArrowRight'){ if(!collision(current.x+1,current.y,current.shape)) current.x++; draw(); }
    if(e.key==='ArrowDown'){ if(!collision(current.x,current.y+1,current.shape)) current.y++; draw(); }
    if(e.key==='ArrowUp'){
        const rot=current.shape[0].map((_,i)=>current.shape.map(r=>r[i]).reverse());
        if(!collision(current.x,current.y,rot)){ current.shape=rot; draw(); }
    }
    if(e.key===' '){
        while(!collision(current.x,current.y+1,current.shape)) current.y++;
        merge(); clearLines(); current=next; next=newPiece(); updateHUD();
        if(collision(current.x,current.y,current.shape)) gameOver();
    }
    if(e.key==='p'||e.key==='P') togglePause();
    e.preventDefault();
});

document.getElementById('tetris-start-btn').addEventListener('click',()=>{ init(); startGame(); });
document.getElementById('tetris-restart-btn').addEventListener('click',()=>{ init(); startGame(); });
document.getElementById('tet-pause-btn').addEventListener('click',togglePause);
document.getElementById('tet-reset-btn').addEventListener('click',()=>{ running=false; cancelAnimationFrame(animId); init(); document.getElementById('tetris-overlay').style.display='flex'; document.getElementById('tetris-gameover').style.display='none'; });

function togglePause(){ if(!running) return; paused=!paused; document.getElementById('tet-pause-btn').textContent=paused?'▶ RESUME':'⏸ PAUSE'; }

init();
</script>
@endsection
