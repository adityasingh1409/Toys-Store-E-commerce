@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <a href="{{ route('games.index') }}" class="game-back-link">← GAMES_HUB</a>
            <h1 class="game-page-title mt-2">🃏 MEMORY_CARDS</h1>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <span class="info-badge" style="--bc:#f59e0b">BRAIN</span>
            <span class="info-badge" style="--bc:#f59e0b">CLICK / TAP</span>
            <span class="info-badge" style="--bc:#10b981">CHILL</span>
        </div>
    </div>

    {{-- HUD --}}
    <div class="memory-hud mb-4">
        <div class="hud-stat"><span class="hud-lbl">MOVES</span><span class="hud-val" id="mem-moves" style="color:#f59e0b">0</span></div>
        <div class="hud-stat"><span class="hud-lbl">MATCHES</span><span class="hud-val" id="mem-matches" style="color:#10b981">0/8</span></div>
        <div class="hud-stat"><span class="hud-lbl">TIME</span><span class="hud-val" id="mem-time" style="color:#00ff88">00:00</span></div>
        <div class="hud-stat"><span class="hud-lbl">BEST TIME</span><span class="hud-val" id="mem-best" style="color:#a855f7">--:--</span></div>
        <div class="ms-auto d-flex gap-2 align-items-center flex-wrap">
            <select id="difficulty-select" class="difficulty-select">
                <option value="easy">EASY (4×4)</option>
                <option value="medium">MEDIUM (4×5)</option>
                <option value="hard">HARD (5×6)</option>
            </select>
            <button id="mem-restart" class="game-btn-sm" style="--bc:#f59e0b">⟳ NEW GAME</button>
        </div>
    </div>

    {{-- Card Grid --}}
    <div class="memory-arena">
        <div id="mem-start-overlay" class="mem-overlay">
            <div class="overlay-content">
                <div style="font-size:3.5rem; margin-bottom:12px;">🃏</div>
                <h2 style="font-family:'Orbitron',sans-serif; color:#f59e0b; font-size:1.6rem; margin-bottom:10px;">MEMORY_CARDS</h2>
                <p style="color:#6b7280; margin-bottom:24px;">Flip cards and find matching pairs!<br>Complete the board as fast as possible.</p>
                <button id="mem-start-btn" class="game-btn" style="--bc:#f59e0b">▶ START GAME</button>
            </div>
        </div>
        <div id="mem-win-overlay" class="mem-overlay" style="display:none;">
            <div class="overlay-content">
                <div style="font-size:3.5rem; margin-bottom:12px;">🏆</div>
                <h2 style="font-family:'Orbitron',sans-serif; color:#10b981; font-size:1.6rem; margin-bottom:6px;">BOARD CLEARED!</h2>
                <p style="color:#9ca3af; margin-bottom:4px;">Time: <span id="win-time" style="color:#00ff88; font-family:'Orbitron',sans-serif; font-weight:700; font-size:1.2rem;"></span></p>
                <p style="color:#9ca3af; margin-bottom:20px;">Moves: <span id="win-moves" style="color:#f59e0b; font-family:'Orbitron',sans-serif; font-weight:700; font-size:1.2rem;"></span></p>
                <button id="mem-win-btn" class="game-btn" style="--bc:#10b981">▶ PLAY AGAIN</button>
            </div>
        </div>
        <div id="card-grid" class="card-grid"></div>
    </div>
</div>

<style>
:root { --primary:#00ff88; }
.game-back-link { font-family:'Orbitron',sans-serif; font-size:0.7rem; color:#6b7280; text-decoration:none; letter-spacing:0.1em; transition:color 0.2s; }
.game-back-link:hover { color:var(--primary); }
.game-page-title { font-family:'Orbitron',sans-serif; font-size:clamp(1.4rem,3vw,2rem); color:#fff; margin:0; }
.info-badge { font-family:'Orbitron',sans-serif; font-size:0.65rem; letter-spacing:0.12em; color:var(--bc); border:1px solid color-mix(in srgb,var(--bc) 45%,transparent); padding:4px 12px; border-radius:100px; background:color-mix(in srgb,var(--bc) 8%,transparent); }

/* HUD */
.memory-hud { display:flex; align-items:center; gap:20px; flex-wrap:wrap; background:rgba(15,23,42,0.7); border:1px solid rgba(245,158,11,0.2); border-radius:12px; padding:16px 24px; backdrop-filter:blur(8px); }
.hud-stat { display:flex; flex-direction:column; gap:2px; }
.hud-lbl { font-family:'Orbitron',sans-serif; font-size:0.58rem; color:#4b5563; letter-spacing:0.2em; }
.hud-val { font-family:'Orbitron',sans-serif; font-size:1.2rem; font-weight:700; }
.difficulty-select { background:rgba(15,23,42,0.8); border:1px solid rgba(245,158,11,0.3); color:#e5e7eb; font-family:'Orbitron',sans-serif; font-size:0.7rem; padding:8px 12px; border-radius:6px; cursor:pointer; letter-spacing:0.05em; }
.difficulty-select:focus { outline:none; border-color:rgba(245,158,11,0.6); box-shadow:0 0 0 2px rgba(245,158,11,0.15); }
.game-btn-sm { font-family:'Orbitron',sans-serif; font-weight:700; font-size:0.7rem; letter-spacing:0.12em; cursor:pointer; transition:all 0.3s ease; padding:9px 18px; border-radius:6px; text-transform:uppercase; border:1.5px solid var(--bc); background:transparent; color:var(--bc); }
.game-btn-sm:hover { background:var(--bc); color:#010d06; }
.game-btn { display:inline-flex; align-items:center; justify-content:center; gap:8px; font-family:'Orbitron',sans-serif; font-weight:700; font-size:0.8rem; letter-spacing:0.12em; cursor:pointer; transition:all 0.3s ease; padding:13px 28px; border-radius:6px; text-transform:uppercase; border:1.5px solid var(--bc); background:transparent; color:var(--bc); }
.game-btn:hover { background:var(--bc); color:#010d06; box-shadow:0 0 30px color-mix(in srgb,var(--bc) 45%,transparent); transform:translateY(-2px); }

/* Arena */
.memory-arena { background:rgba(15,23,42,0.5); border:1px solid rgba(245,158,11,0.15); border-radius:16px; padding:30px; position:relative; min-height:300px; backdrop-filter:blur(8px); }
.mem-overlay { position:absolute; inset:0; background:rgba(0,0,0,0.85); display:flex; align-items:center; justify-content:center; text-align:center; border-radius:16px; z-index:20; backdrop-filter:blur(6px); }
.overlay-content { padding:30px; }

/* Card Grid */
.card-grid { display:grid; gap:12px; justify-content:center; }
.card-grid.grid-4x4 { grid-template-columns: repeat(4, 1fr); max-width:480px; margin:auto; }
.card-grid.grid-4x5 { grid-template-columns: repeat(5, 1fr); max-width:580px; margin:auto; }
.card-grid.grid-5x6 { grid-template-columns: repeat(6, 1fr); max-width:680px; margin:auto; }

/* Individual Cards */
.mem-card { aspect-ratio:1; cursor:pointer; perspective:600px; user-select:none; }
.mem-card-inner { width:100%; height:100%; position:relative; transform-style:preserve-3d; transition:transform 0.45s cubic-bezier(0.4,0,0.2,1); }
.mem-card.flipped .mem-card-inner { transform:rotateY(180deg); }
.mem-card.matched .mem-card-inner { transform:rotateY(180deg); }
.mem-card-front,.mem-card-back { position:absolute; inset:0; border-radius:10px; backface-visibility:hidden; display:flex; align-items:center; justify-content:center; }
.mem-card-back { background:rgba(15,23,42,0.9); border:1.5px solid rgba(245,158,11,0.3); font-size:1.5rem; transition:border-color 0.3s; }
.mem-card:hover:not(.flipped):not(.matched) .mem-card-back { border-color:rgba(245,158,11,0.7); box-shadow:0 0 15px rgba(245,158,11,0.2); }
.mem-card-front { background:rgba(15,23,42,0.95); border:1.5px solid rgba(16,185,129,0.4); transform:rotateY(180deg); font-size:2rem; }
.mem-card.matched .mem-card-front { border-color:rgba(16,185,129,0.8); background:rgba(16,185,129,0.1); box-shadow:0 0 20px rgba(16,185,129,0.3); animation:match-pop 0.4s ease forwards; }
@keyframes match-pop { 0%{transform:rotateY(180deg) scale(1);} 50%{transform:rotateY(180deg) scale(1.12);} 100%{transform:rotateY(180deg) scale(1);} }
.card-question { font-size:1.4rem; color:rgba(245,158,11,0.6); }
</style>

<script>
const ICONS_POOL = ['🚀','🤖','🎮','🧸','🎯','🎲','🏎️','🎪','🔭','🎸','🦄','🎨','🧩','⚡','🌟','🎠','🦋','🎃','🎭','🎬'];

let cards=[], flipped=[], matched=0, moves=0, totalPairs=8, gameTimer=null, elapsed=0, gameRunning=false, lockInput=false;

const bestKey = () => `memory_best_${document.getElementById('difficulty-select').value}`;
function loadBest(){ const b=localStorage.getItem(bestKey()); document.getElementById('mem-best').textContent=b?fmtTime(parseInt(b)):'--:--'; }
loadBest();

function getGridConfig(){
    const d=document.getElementById('difficulty-select').value;
    if(d==='easy')   return {cols:4,rows:4,pairs:8,cls:'grid-4x4'};
    if(d==='medium') return {cols:5,rows:4,pairs:10,cls:'grid-4x5'};
    if(d==='hard')   return {cols:6,rows:5,pairs:15,cls:'grid-5x6'};
}

function buildGrid(){
    const cfg=getGridConfig();
    totalPairs=cfg.pairs;
    const icons=ICONS_POOL.slice(0,cfg.pairs);
    const deck=[...icons,...icons].sort(()=>Math.random()-0.5);

    const grid=document.getElementById('card-grid');
    grid.innerHTML='';
    grid.className=`card-grid ${cfg.cls}`;

    cards=deck.map((icon,i)=>{
        const card=document.createElement('div');
        card.className='mem-card';
        card.dataset.icon=icon;
        card.dataset.idx=i;
        card.innerHTML=`<div class="mem-card-inner"><div class="mem-card-back"><span class="card-question">?</span></div><div class="mem-card-front">${icon}</div></div>`;
        card.addEventListener('click',()=>onCardClick(card));
        grid.appendChild(card);
        return card;
    });

    matched=0; moves=0; flipped=[]; lockInput=false;
    document.getElementById('mem-moves').textContent=moves;
    document.getElementById('mem-matches').textContent=`0/${totalPairs}`;
}

function onCardClick(card){
    if(lockInput||card.classList.contains('flipped')||card.classList.contains('matched')||!gameRunning) return;
    card.classList.add('flipped');
    flipped.push(card);
    if(flipped.length===2){
        moves++;
        document.getElementById('mem-moves').textContent=moves;
        lockInput=true;
        checkMatch();
    }
}

function checkMatch(){
    const [a,b]=flipped;
    if(a.dataset.icon===b.dataset.icon){
        a.classList.add('matched'); b.classList.add('matched');
        matched++;
        document.getElementById('mem-matches').textContent=`${matched}/${totalPairs}`;
        flipped=[]; lockInput=false;
        if(matched===totalPairs) onWin();
    } else {
        setTimeout(()=>{ a.classList.remove('flipped'); b.classList.remove('flipped'); flipped=[]; lockInput=false; },900);
    }
}

function startTimer(){
    elapsed=0;
    clearInterval(gameTimer);
    gameTimer=setInterval(()=>{ elapsed++; document.getElementById('mem-time').textContent=fmtTime(elapsed); },1000);
}

function fmtTime(s){ const m=Math.floor(s/60), sec=s%60; return `${String(m).padStart(2,'0')}:${String(sec).padStart(2,'0')}`; }

function onWin(){
    clearInterval(gameTimer); gameRunning=false;
    const prev=parseInt(localStorage.getItem(bestKey())||'99999');
    if(elapsed<prev){ localStorage.setItem(bestKey(),elapsed); loadBest(); }
    document.getElementById('win-time').textContent=fmtTime(elapsed);
    document.getElementById('win-moves').textContent=moves;
    document.getElementById('mem-win-overlay').style.display='flex';
}

function newGame(){
    clearInterval(gameTimer);
    document.getElementById('mem-win-overlay').style.display='none';
    document.getElementById('mem-start-overlay').style.display='none';
    buildGrid();
    elapsed=0;
    document.getElementById('mem-time').textContent='00:00';
    gameRunning=true;
    startTimer();
    loadBest();
}

document.getElementById('mem-start-btn').addEventListener('click',newGame);
document.getElementById('mem-win-btn').addEventListener('click',newGame);
document.getElementById('mem-restart').addEventListener('click',newGame);
document.getElementById('difficulty-select').addEventListener('change',()=>{ loadBest(); if(gameRunning) newGame(); });

// Pre-build grid for visual preview
buildGrid();
</script>
@endsection
