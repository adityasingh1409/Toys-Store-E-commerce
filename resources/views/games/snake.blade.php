@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <a href="{{ route('games.index') }}" class="game-back-link">← GAMES_HUB</a>
            <h1 class="game-page-title mt-2">🐍 NEON_SNAKE</h1>
        </div>
        <div class="game-info-badges d-flex gap-2 flex-wrap">
            <span class="info-badge" style="--bc:#10b981">ARCADE</span>
            <span class="info-badge" style="--bc:#10b981">ARROW KEYS</span>
            <span class="info-badge" style="--bc:#6b7280">EASY</span>
        </div>
    </div>

    <div class="row g-4">
        {{-- Game Canvas --}}
        <div class="col-lg-8">
            <div class="game-canvas-wrap" style="--gc:#10b981">
                <canvas id="snakeCanvas" width="480" height="480"></canvas>
                <div id="snake-overlay" class="game-overlay">
                    <div class="overlay-content">
                        <div class="overlay-emoji">🐍</div>
                        <h2 class="overlay-title">NEON_SNAKE</h2>
                        <p class="overlay-sub">Use arrow keys or WASD to control the snake.<br>Eat the glowing dots to grow and score points!</p>
                        <button id="snake-start-btn" class="game-btn" style="--bc:#10b981">▶ START GAME</button>
                    </div>
                </div>
                <div id="snake-gameover" class="game-overlay" style="display:none;">
                    <div class="overlay-content">
                        <div class="overlay-emoji">💀</div>
                        <h2 class="overlay-title" style="color:#ef4444">GAME OVER</h2>
                        <p class="overlay-sub">Score: <span id="final-score" class="score-highlight" style="color:#10b981">0</span></p>
                        <button id="snake-restart-btn" class="game-btn" style="--bc:#10b981">⟳ PLAY AGAIN</button>
                    </div>
                </div>
            </div>
            <div class="mobile-controls mt-3 d-flex flex-column align-items-center gap-2">
                <button class="mob-btn" id="mob-up">▲</button>
                <div class="d-flex gap-2">
                    <button class="mob-btn" id="mob-left">◄</button>
                    <button class="mob-btn" id="mob-down">▼</button>
                    <button class="mob-btn" id="mob-right">►</button>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4 d-flex flex-column gap-3">
            <div class="game-stat-panel">
                <div class="stat-row">
                    <span class="stat-lbl">SCORE</span>
                    <span class="stat-val" id="score-display" style="color:#10b981">0</span>
                </div>
                <div class="stat-row">
                    <span class="stat-lbl">HIGH SCORE</span>
                    <span class="stat-val" id="hi-score-display" style="color:#f59e0b">0</span>
                </div>
                <div class="stat-row">
                    <span class="stat-lbl">LENGTH</span>
                    <span class="stat-val" id="length-display" style="color:#a855f7">1</span>
                </div>
                <div class="stat-row">
                    <span class="stat-lbl">SPEED</span>
                    <span class="stat-val" id="speed-display" style="color:#00ff88">NORMAL</span>
                </div>
            </div>
            <div class="game-controls-panel">
                <h6 class="panel-title">CONTROLS</h6>
                <div class="ctrl-list">
                    <div class="ctrl-item"><span class="ctrl-key">↑ W</span><span class="ctrl-desc">Move Up</span></div>
                    <div class="ctrl-item"><span class="ctrl-key">↓ S</span><span class="ctrl-desc">Move Down</span></div>
                    <div class="ctrl-item"><span class="ctrl-key">← A</span><span class="ctrl-desc">Move Left</span></div>
                    <div class="ctrl-item"><span class="ctrl-key">→ D</span><span class="ctrl-desc">Move Right</span></div>
                    <div class="ctrl-item"><span class="ctrl-key">P</span><span class="ctrl-desc">Pause / Resume</span></div>
                </div>
            </div>
            <div class="game-rules-panel">
                <h6 class="panel-title">HOW TO PLAY</h6>
                <ul class="rules-list">
                    <li>🟢 Eat green dots to grow</li>
                    <li>⭐ Eat stars for bonus points</li>
                    <li>💀 Avoid walls & yourself</li>
                    <li>🚀 Speed increases as you grow</li>
                </ul>
            </div>
            <div class="d-flex gap-2">
                <button id="pause-btn" class="game-btn flex-1" style="--bc:#f59e0b; font-size:0.7rem; padding:10px;">⏸ PAUSE</button>
                <button id="reset-btn" class="game-btn flex-1" style="--bc:#ef4444; font-size:0.7rem; padding:10px;">↺ RESET</button>
            </div>
        </div>
    </div>
</div>

{{-- Shared Game Styles --}}
<style>
:root { --primary:#00ff88; }
.game-back-link { font-family:'Orbitron',sans-serif; font-size:0.7rem; color:#6b7280; text-decoration:none; letter-spacing:0.1em; transition:color 0.2s; }
.game-back-link:hover { color:var(--primary); }
.game-page-title { font-family:'Orbitron',sans-serif; font-size:clamp(1.4rem,3vw,2rem); color:#fff; margin:0; }
.info-badge { font-family:'Orbitron',sans-serif; font-size:0.65rem; letter-spacing:0.12em; color:var(--bc); border:1px solid color-mix(in srgb,var(--bc) 45%,transparent); padding:4px 12px; border-radius:100px; background:color-mix(in srgb,var(--bc) 8%,transparent); }
.game-canvas-wrap { position:relative; background:#010a05; border:1px solid rgba(16,185,129,0.3); border-radius:12px; overflow:hidden; box-shadow:0 0 40px rgba(16,185,129,0.1), inset 0 0 40px rgba(0,0,0,0.5); display:flex; align-items:center; justify-content:center; }
.game-canvas-wrap canvas { display:block; max-width:100%; }
.game-overlay { position:absolute; inset:0; background:rgba(1,10,5,0.88); display:flex; align-items:center; justify-content:center; text-align:center; backdrop-filter:blur(4px); z-index:10; }
.overlay-content { padding:30px; }
.overlay-emoji { font-size:4rem; margin-bottom:12px; }
.overlay-title { font-family:'Orbitron',sans-serif; font-size:1.8rem; color:#10b981; margin-bottom:10px; }
.overlay-sub { color:#6b7280; font-size:0.9rem; line-height:1.6; margin-bottom:24px; }
.score-highlight { font-family:'Orbitron',sans-serif; font-size:1.4rem; font-weight:700; }
.game-btn { display:inline-flex; align-items:center; justify-content:center; gap:8px; font-family:'Orbitron',sans-serif; font-weight:700; font-size:0.8rem; letter-spacing:0.12em; cursor:pointer; transition:all 0.3s ease; padding:13px 28px; border-radius:6px; text-transform:uppercase; border:1.5px solid var(--bc); background:transparent; color:var(--bc); box-shadow:0 0 15px color-mix(in srgb,var(--bc) 20%,transparent); }
.game-btn:hover { background:var(--bc); color:#010d06; box-shadow:0 0 30px color-mix(in srgb,var(--bc) 45%,transparent); transform:translateY(-2px); }
.game-stat-panel,.game-controls-panel,.game-rules-panel { background:rgba(15,23,42,0.7); border:1px solid rgba(16,185,129,0.2); border-radius:12px; padding:20px; backdrop-filter:blur(8px); }
.stat-row { display:flex; justify-content:space-between; align-items:center; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.05); }
.stat-row:last-child { border:0; }
.stat-lbl { font-family:'Orbitron',sans-serif; font-size:0.65rem; color:#4b5563; letter-spacing:0.15em; }
.stat-val { font-family:'Orbitron',sans-serif; font-size:1.1rem; font-weight:700; }
.panel-title { font-family:'Orbitron',sans-serif; font-size:0.7rem; color:#6b7280; letter-spacing:0.2em; margin-bottom:14px; border-bottom:1px solid rgba(255,255,255,0.06); padding-bottom:8px; }
.ctrl-list { display:flex; flex-direction:column; gap:8px; }
.ctrl-item { display:flex; align-items:center; gap:12px; }
.ctrl-key { font-family:'Orbitron',sans-serif; font-size:0.65rem; background:rgba(0,255,136,0.1); border:1px solid rgba(0,255,136,0.25); border-radius:4px; padding:3px 8px; color:var(--primary); min-width:50px; text-align:center; }
.ctrl-desc { font-size:0.8rem; color:#9ca3af; }
.rules-list { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px; }
.rules-list li { font-size:0.85rem; color:#9ca3af; }
.mobile-controls { display:none; }
@media(max-width:576px) { .mobile-controls { display:flex !important; } }
.mob-btn { background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.4); color:#10b981; font-size:1.2rem; width:52px; height:52px; border-radius:8px; cursor:pointer; transition:all 0.2s; display:flex; align-items:center; justify-content:center; }
.mob-btn:hover,.mob-btn:active { background:rgba(16,185,129,0.3); }
.flex-1 { flex:1; }
</style>

<script>
const canvas  = document.getElementById('snakeCanvas');
const ctx     = canvas.getContext('2d');

const GRID    = 20;
const COLS    = canvas.width  / GRID;
const ROWS    = canvas.height / GRID;

let snake, food, bonus, dir, nextDir, score, hiScore, running, paused, animId, interval;

hiScore = parseInt(localStorage.getItem('snake_hi') || '0');
document.getElementById('hi-score-display').textContent = hiScore;

function init() {
    snake   = [{x:10, y:10},{x:9,y:10},{x:8,y:10}];
    dir     = {x:1, y:0};
    nextDir = {x:1, y:0};
    score   = 0;
    running = false;
    paused  = false;
    food    = spawnFood();
    bonus   = null;
    updateHUD();
    drawFrame();
}

function spawnFood() {
    let pos;
    do { pos = {x: Math.floor(Math.random()*COLS), y: Math.floor(Math.random()*ROWS)}; }
    while (snake.some(s=>s.x===pos.x&&s.y===pos.y));
    return pos;
}

function spawnBonus() {
    if (Math.random() < 0.3) {
        let pos;
        do { pos = {x:Math.floor(Math.random()*COLS), y:Math.floor(Math.random()*ROWS)}; }
        while (snake.some(s=>s.x===pos.x&&s.y===pos.y));
        bonus = {x:pos.x, y:pos.y, timer:100};
    }
}

function updateHUD() {
    document.getElementById('score-display').textContent  = score;
    document.getElementById('length-display').textContent = snake.length;
    const spd = snake.length < 10 ? 'NORMAL' : snake.length < 20 ? 'FAST' : 'TURBO';
    document.getElementById('speed-display').textContent  = spd;
}

function getSpeed() {
    return Math.max(60, 150 - snake.length * 5);
}

function startGame() {
    document.getElementById('snake-overlay').style.display    = 'none';
    document.getElementById('snake-gameover').style.display   = 'none';
    running = true;
    paused  = false;
    clearInterval(interval);
    interval = setInterval(gameLoop, getSpeed());
    cancelAnimationFrame(animId);
    renderLoop();
}

function gameLoop() {
    if (!running || paused) return;

    dir = {...nextDir};
    const head = {x: snake[0].x + dir.x, y: snake[0].y + dir.y};

    // Wall collision
    if (head.x < 0 || head.x >= COLS || head.y < 0 || head.y >= ROWS) { gameOver(); return; }
    // Self collision
    if (snake.some(s=>s.x===head.x&&s.y===head.y)) { gameOver(); return; }

    snake.unshift(head);

    // Food
    if (head.x === food.x && head.y === food.y) {
        score += 10;
        food = spawnFood();
        spawnBonus();
        clearInterval(interval);
        interval = setInterval(gameLoop, getSpeed());
    } else {
        snake.pop();
    }

    // Bonus
    if (bonus) {
        bonus.timer--;
        if (head.x === bonus.x && head.y === bonus.y) { score += 30; bonus = null; }
        else if (bonus.timer <= 0) bonus = null;
    }

    if (score > hiScore) {
        hiScore = score;
        localStorage.setItem('snake_hi', hiScore);
        document.getElementById('hi-score-display').textContent = hiScore;
    }
    updateHUD();
}

let glowPhase = 0;
function renderLoop() {
    if (!running) return;
    glowPhase += 0.05;
    drawFrame();
    animId = requestAnimationFrame(renderLoop);
}

function drawFrame() {
    // Background
    ctx.fillStyle = '#010a05';
    ctx.fillRect(0,0,canvas.width,canvas.height);

    // Grid
    ctx.strokeStyle = 'rgba(16,185,129,0.06)';
    ctx.lineWidth = 0.5;
    for(let x=0;x<COLS;x++) for(let y=0;y<ROWS;y++) {
        ctx.strokeRect(x*GRID,y*GRID,GRID,GRID);
    }

    // Food glow
    const fg = ctx.createRadialGradient(food.x*GRID+GRID/2, food.y*GRID+GRID/2, 0, food.x*GRID+GRID/2, food.y*GRID+GRID/2, GRID);
    fg.addColorStop(0,'rgba(16,185,129,0.9)');
    fg.addColorStop(1,'rgba(16,185,129,0)');
    ctx.fillStyle = fg;
    ctx.beginPath();
    ctx.arc(food.x*GRID+GRID/2, food.y*GRID+GRID/2, GRID*(0.8+Math.sin(glowPhase)*0.15), 0, Math.PI*2);
    ctx.fill();
    ctx.fillStyle = '#ffffff';
    ctx.beginPath();
    ctx.arc(food.x*GRID+GRID/2, food.y*GRID+GRID/2, 3, 0, Math.PI*2);
    ctx.fill();

    // Bonus
    if (bonus) {
        ctx.shadowColor = '#f59e0b'; ctx.shadowBlur = 15;
        ctx.fillStyle = '#f59e0b';
        ctx.font = `${GRID-2}px serif`;
        ctx.textAlign='center'; ctx.textBaseline='middle';
        ctx.fillText('⭐', bonus.x*GRID+GRID/2, bonus.y*GRID+GRID/2);
        ctx.shadowBlur = 0;
    }

    // Snake
    snake.forEach((seg, i) => {
        const t = 1 - i/snake.length;
        const alpha = 0.3 + t*0.7;
        const size  = GRID - 2;
        const x     = seg.x*GRID + 1;
        const y_    = seg.y*GRID + 1;

        ctx.shadowColor = `rgba(16,185,129,${alpha*0.8})`;
        ctx.shadowBlur  = i===0 ? 20 : 8*t;

        const grad = ctx.createLinearGradient(x,y_,x+size,y_+size);
        if(i===0) { grad.addColorStop(0,'#6ee7b7'); grad.addColorStop(1,'#10b981'); }
        else       { grad.addColorStop(0,`rgba(16,185,129,${alpha})`); grad.addColorStop(1,`rgba(5,150,105,${alpha*0.7})`); }

        ctx.fillStyle = grad;
        ctx.beginPath();
        ctx.roundRect(x, y_, size, size, i===0 ? 6 : 3);
        ctx.fill();

        // Eyes on head
        if(i===0) {
            ctx.shadowBlur = 0;
            ctx.fillStyle  = '#010d06';
            const ex = dir.x===1 ? x+size-6 : dir.x===-1 ? x+2 : x+size/2-4;
            const ey = dir.y===1 ? y_+size-6 : dir.y===-1 ? y_+2 : y_+size/2-4;
            ctx.beginPath(); ctx.arc(ex,ey,2.5,0,Math.PI*2); ctx.fill();
            ctx.beginPath(); ctx.arc(ex+(dir.y!==0?8:0),ey+(dir.x!==0?8:0),2.5,0,Math.PI*2); ctx.fill();
        }
    });

    ctx.shadowBlur = 0;
}

function gameOver() {
    running = false;
    clearInterval(interval);
    cancelAnimationFrame(animId);
    document.getElementById('final-score').textContent = score;
    document.getElementById('snake-gameover').style.display = 'flex';
}

// Controls
document.addEventListener('keydown', e => {
    const map = {
        ArrowUp:{x:0,y:-1},    ArrowDown:{x:0,y:1},
        ArrowLeft:{x:-1,y:0},  ArrowRight:{x:1,y:0},
        w:{x:0,y:-1},          s:{x:0,y:1},
        a:{x:-1,y:0},          d:{x:1,y:0}
    };
    if(map[e.key]) {
        const nd = map[e.key];
        if(nd.x !== -dir.x || nd.y !== -dir.y) nextDir = nd;
        e.preventDefault();
    }
    if(e.key==='p'||e.key==='P') togglePause();
});

document.getElementById('snake-start-btn').addEventListener('click', () => { init(); startGame(); });
document.getElementById('snake-restart-btn').addEventListener('click', () => { init(); startGame(); });
document.getElementById('pause-btn').addEventListener('click', togglePause);
document.getElementById('reset-btn').addEventListener('click', () => {
    clearInterval(interval); cancelAnimationFrame(animId);
    init();
    document.getElementById('snake-overlay').style.display='flex';
    document.getElementById('snake-gameover').style.display='none';
});

// Mobile
['up','down','left','right'].forEach(d=>{
    const map={up:{x:0,y:-1},down:{x:0,y:1},left:{x:-1,y:0},right:{x:1,y:0}};
    document.getElementById(`mob-${d}`).addEventListener('click',()=>{
        const nd=map[d]; if(nd.x!==-dir.x||nd.y!==-dir.y) nextDir=nd;
    });
});

function togglePause() {
    if(!running) return;
    paused = !paused;
    document.getElementById('pause-btn').textContent = paused ? '▶ RESUME' : '⏸ PAUSE';
}

init();
</script>
@endsection
