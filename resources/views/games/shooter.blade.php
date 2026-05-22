@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <a href="{{ route('games.index') }}" class="game-back-link">← GAMES_HUB</a>
            <h1 class="game-page-title mt-2">🚀 SPACE_SHOOTER</h1>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <span class="info-badge" style="--bc:#ef4444">ACTION</span>
            <span class="info-badge" style="--bc:#ef4444">← → SPACE</span>
            <span class="info-badge" style="--bc:#ef4444">HARD</span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="game-canvas-wrap" style="--gc:#ef4444; background:#000308; border:1px solid rgba(239,68,68,0.3); border-radius:12px; overflow:hidden; box-shadow:0 0 40px rgba(239,68,68,0.1); display:flex; align-items:center; justify-content:center; position:relative;">
                <canvas id="shooterCanvas" width="480" height="540" style="display:block; max-width:100%;"></canvas>
                <div id="shooter-overlay" class="game-overlay" style="background:rgba(0,3,8,0.9);">
                    <div class="overlay-content">
                        <div class="overlay-emoji">🚀</div>
                        <h2 class="overlay-title" style="color:#ef4444">SPACE_SHOOTER</h2>
                        <p class="overlay-sub">Use ← → to move, SPACE to shoot.<br>Destroy all enemies before they reach you!</p>
                        <button id="shooter-start-btn" class="game-btn" style="--bc:#ef4444">▶ LAUNCH SHIP</button>
                    </div>
                </div>
                <div id="shooter-gameover" class="game-overlay" style="display:none; background:rgba(0,3,8,0.9);">
                    <div class="overlay-content">
                        <div class="overlay-emoji">💥</div>
                        <h2 class="overlay-title" style="color:#ef4444">SHIP_DESTROYED</h2>
                        <p class="overlay-sub">Score: <span id="sh-final" style="color:#ef4444; font-family:'Orbitron',sans-serif; font-size:1.4rem; font-weight:700;">0</span></p>
                        <p class="overlay-sub" style="margin-top:-10px;">Wave: <span id="sh-final-wave" style="color:#f59e0b; font-family:'Orbitron',sans-serif;">1</span></p>
                        <button id="shooter-restart-btn" class="game-btn" style="--bc:#ef4444">⟳ TRY AGAIN</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 d-flex flex-column gap-3">
            <div class="game-stat-panel" style="border-color:rgba(239,68,68,0.2);">
                <div class="stat-row"><span class="stat-lbl">SCORE</span><span class="stat-val" id="sh-score" style="color:#ef4444">0</span></div>
                <div class="stat-row"><span class="stat-lbl">HIGH SCORE</span><span class="stat-val" id="sh-hi" style="color:#f59e0b">0</span></div>
                <div class="stat-row"><span class="stat-lbl">LIVES</span><span class="stat-val" id="sh-lives" style="color:#10b981">❤️❤️❤️</span></div>
                <div class="stat-row"><span class="stat-lbl">WAVE</span><span class="stat-val" id="sh-wave" style="color:#a855f7">1</span></div>
            </div>
            <div class="game-controls-panel" style="border-color:rgba(239,68,68,0.2);">
                <h6 class="panel-title">CONTROLS</h6>
                <div class="ctrl-list">
                    <div class="ctrl-item"><span class="ctrl-key" style="color:#ef4444; border-color:rgba(239,68,68,0.3); background:rgba(239,68,68,0.08);">← →</span><span class="ctrl-desc">Move Ship</span></div>
                    <div class="ctrl-item"><span class="ctrl-key" style="color:#ef4444; border-color:rgba(239,68,68,0.3); background:rgba(239,68,68,0.08);">SPACE</span><span class="ctrl-desc">Shoot</span></div>
                    <div class="ctrl-item"><span class="ctrl-key" style="color:#ef4444; border-color:rgba(239,68,68,0.3); background:rgba(239,68,68,0.08);">P</span><span class="ctrl-desc">Pause</span></div>
                </div>
            </div>
            <div class="game-controls-panel" style="border-color:rgba(239,68,68,0.2);">
                <h6 class="panel-title">HOW TO PLAY</h6>
                <ul class="rules-list">
                    <li>🔴 Shoot enemy ships = +10 pts</li>
                    <li>💥 Destroy all in wave = bonus!</li>
                    <li>❤️ You have 3 lives total</li>
                    <li>🚀 Enemies speed up each wave</li>
                    <li>⭐ Stars drop for extra points</li>
                </ul>
            </div>
            <div class="d-flex gap-2">
                <button id="sh-pause-btn" class="game-btn flex-1" style="--bc:#f59e0b; font-size:0.7rem; padding:10px;">⏸ PAUSE</button>
                <button id="sh-reset-btn" class="game-btn flex-1" style="--bc:#ef4444; font-size:0.7rem; padding:10px;">↺ RESET</button>
            </div>
            {{-- Mobile Controls --}}
            <div class="d-flex gap-2 justify-content-center" id="mob-shoot-controls">
                <button class="mob-btn" id="mob-sh-left" style="border-color:rgba(239,68,68,0.4); color:#ef4444; background:rgba(239,68,68,0.1);">◄</button>
                <button class="mob-btn" id="mob-sh-fire" style="border-color:rgba(239,68,68,0.6); color:#ef4444; background:rgba(239,68,68,0.2); width:80px; font-size:0.7rem; font-family:'Orbitron',sans-serif;">FIRE</button>
                <button class="mob-btn" id="mob-sh-right" style="border-color:rgba(239,68,68,0.4); color:#ef4444; background:rgba(239,68,68,0.1);">►</button>
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
.game-overlay { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; text-align:center; backdrop-filter:blur(4px); z-index:10; }
.overlay-content { padding:30px; }
.overlay-emoji { font-size:4rem; margin-bottom:12px; }
.overlay-title { font-family:'Orbitron',sans-serif; font-size:1.8rem; margin-bottom:10px; }
.overlay-sub { color:#6b7280; font-size:0.9rem; line-height:1.6; margin-bottom:24px; }
.game-btn { display:inline-flex; align-items:center; justify-content:center; gap:8px; font-family:'Orbitron',sans-serif; font-weight:700; font-size:0.8rem; letter-spacing:0.12em; cursor:pointer; transition:all 0.3s ease; padding:13px 28px; border-radius:6px; text-transform:uppercase; border:1.5px solid var(--bc); background:transparent; color:var(--bc); }
.game-btn:hover { background:var(--bc); color:#010d06; box-shadow:0 0 30px color-mix(in srgb,var(--bc) 45%,transparent); transform:translateY(-2px); }
.game-stat-panel,.game-controls-panel { background:rgba(15,23,42,0.7); border:1px solid rgba(239,68,68,0.2); border-radius:12px; padding:20px; backdrop-filter:blur(8px); }
.stat-row { display:flex; justify-content:space-between; align-items:center; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.05); }
.stat-row:last-child { border:0; }
.stat-lbl { font-family:'Orbitron',sans-serif; font-size:0.65rem; color:#4b5563; letter-spacing:0.15em; }
.stat-val { font-family:'Orbitron',sans-serif; font-size:1.1rem; font-weight:700; }
.panel-title { font-family:'Orbitron',sans-serif; font-size:0.7rem; color:#6b7280; letter-spacing:0.2em; margin-bottom:14px; border-bottom:1px solid rgba(255,255,255,0.06); padding-bottom:8px; }
.ctrl-list { display:flex; flex-direction:column; gap:8px; }
.ctrl-item { display:flex; align-items:center; gap:12px; }
.ctrl-key { font-family:'Orbitron',sans-serif; font-size:0.65rem; background:rgba(0,255,136,0.1); border:1px solid rgba(0,255,136,0.25); border-radius:4px; padding:3px 8px; color:var(--primary); min-width:60px; text-align:center; }
.ctrl-desc { font-size:0.8rem; color:#9ca3af; }
.rules-list { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px; }
.rules-list li { font-size:0.85rem; color:#9ca3af; }
.mob-btn { display:flex; align-items:center; justify-content:center; border:1px solid rgba(0,255,136,0.4); color:var(--primary); font-size:1.2rem; width:52px; height:52px; border-radius:8px; cursor:pointer; transition:all 0.2s; background:rgba(0,255,136,0.08); }
.mob-btn:hover,.mob-btn:active { background:rgba(239,68,68,0.3); }
.flex-1 { flex:1; }
</style>

<script>
const canvas = document.getElementById('shooterCanvas');
const ctx    = canvas.getContext('2d');
const W=canvas.width, H=canvas.height;

let player, bullets, enemies, particles, stars, score, hiScore, lives, wave, running, paused, animId, shootCooldown, keys;
hiScore = parseInt(localStorage.getItem('shooter_hi')||'0');
document.getElementById('sh-hi').textContent = hiScore;

function initGame() {
    player   = {x:W/2, y:H-60, w:36, h:30, speed:5, invincible:0};
    bullets  = [];
    enemies  = [];
    particles= [];
    stars    = Array.from({length:80},()=>({x:Math.random()*W, y:Math.random()*H, r:Math.random()*1.5+0.3, speed:Math.random()*1.5+0.3, alpha:Math.random()}));
    score    = 0; lives = 3; wave = 1;
    running  = false; paused = false;
    shootCooldown = 0;
    keys     = {};
    spawnWave();
    updateHUD();
}

function spawnWave() {
    enemies = [];
    const cols=Math.min(8+wave,12), rows=Math.min(2+Math.floor(wave/2),5);
    for(let r=0;r<rows;r++) for(let c=0;c<cols;c++) {
        enemies.push({x:50+c*(W-100)/cols, y:30+r*40, w:28, h:20, hp:1, speed:(0.4+wave*0.15)*((Math.random()*0.4)+0.8), dir:1, color:r===0?'#ef4444':r===1?'#f59e0b':'#a855f7', shootTimer:Math.random()*120+60});
    }
}

function updateHUD() {
    document.getElementById('sh-score').textContent = score;
    document.getElementById('sh-wave').textContent  = wave;
    document.getElementById('sh-lives').textContent = '❤️'.repeat(Math.max(0,lives));
}

let lastTime=0, enemyBullets=[];
function gameLoop(ts) {
    if(!running){animId=requestAnimationFrame(gameLoop);return;}
    const dt=Math.min(ts-lastTime,50); lastTime=ts;
    if(!paused) update(dt);
    render();
    animId=requestAnimationFrame(gameLoop);
}

function update(dt) {
    // Player movement
    if((keys['ArrowLeft']||keys['a'])&&player.x>player.w/2) player.x-=player.speed;
    if((keys['ArrowRight']||keys['d'])&&player.x<W-player.w/2) player.x+=player.speed;
    if((keys[' ']||keys['Space'])&&shootCooldown<=0) { fireBullet(); shootCooldown=18; }
    if(shootCooldown>0) shootCooldown--;
    if(player.invincible>0) player.invincible--;

    // Player bullets
    bullets.forEach(b=>b.y-=12);
    bullets = bullets.filter(b=>b.y>0);

    // Enemy bullets
    enemyBullets.forEach(b=>b.y+=4+wave*0.3);
    enemyBullets = enemyBullets.filter(b=>b.y<H);

    // Enemies
    let edgeHit=false;
    enemies.forEach(e=>{
        e.x += e.speed * e.dir;
        if(e.x>=W-30||e.x<=30) edgeHit=true;
        e.shootTimer--;
        if(e.shootTimer<=0) { enemyBullets.push({x:e.x,y:e.y+10,r:3,color:e.color}); e.shootTimer=Math.random()*100+60; }
    });
    if(edgeHit) { enemies.forEach(e=>{e.dir*=-1; e.y+=10;}); }

    // Bullet-Enemy collisions
    bullets.forEach(b=>{
        enemies.forEach((e,ei)=>{
            if(Math.abs(b.x-e.x)<e.w/2+4 && Math.abs(b.y-e.y)<e.h/2+4) {
                e.hp--; b.dead=true;
                spawnParticles(e.x,e.y,e.color,8);
                if(e.hp<=0){score+=10; e.dead=true;}
            }
        });
    });
    bullets = bullets.filter(b=>!b.dead);
    enemies = enemies.filter(e=>!e.dead);
    if(score>hiScore){hiScore=score; localStorage.setItem('shooter_hi',hiScore); document.getElementById('sh-hi').textContent=hiScore;}

    // Enemy-bullet hits player
    if(player.invincible<=0) {
        enemyBullets.forEach((b,bi)=>{
            if(Math.abs(b.x-player.x)<player.w/2+2&&Math.abs(b.y-player.y)<player.h/2+2) {
                b.dead=true; lives--; player.invincible=90;
                spawnParticles(player.x,player.y,'#ef4444',12);
                updateHUD();
                if(lives<=0){ endGame(); }
            }
        });
        enemyBullets = enemyBullets.filter(b=>!b.dead);
    }

    // Enemy reaches bottom
    if(enemies.some(e=>e.y>H-80)) { lives=0; endGame(); return; }

    // Wave clear
    if(enemies.length===0) { wave++; spawnWave(); updateHUD(); score+=wave*50; }

    // Particles
    particles.forEach(p=>{p.x+=p.vx; p.y+=p.vy; p.life--; p.vy+=0.1;});
    particles=particles.filter(p=>p.life>0);

    // Stars parallax
    stars.forEach(s=>{s.y+=s.speed; if(s.y>H){s.y=0;s.x=Math.random()*W;}});

    updateHUD();
}

function fireBullet(){ bullets.push({x:player.x,y:player.y-player.h/2}); }

function spawnParticles(x,y,color,n){
    for(let i=0;i<n;i++) particles.push({x,y,color,vx:(Math.random()-0.5)*5,vy:(Math.random()-0.5)*5-2,life:30+Math.random()*20,r:Math.random()*3+1});
}

function render(){
    ctx.fillStyle='#000308'; ctx.fillRect(0,0,W,H);

    // Stars
    stars.forEach(s=>{ ctx.globalAlpha=s.alpha; ctx.fillStyle='#fff'; ctx.beginPath(); ctx.arc(s.x,s.y,s.r,0,Math.PI*2); ctx.fill(); });
    ctx.globalAlpha=1;

    // Enemy bullets
    enemyBullets.forEach(b=>{ ctx.shadowColor=b.color; ctx.shadowBlur=8; ctx.fillStyle=b.color; ctx.beginPath(); ctx.arc(b.x,b.y,b.r,0,Math.PI*2); ctx.fill(); ctx.shadowBlur=0; });

    // Enemies
    enemies.forEach(e=>{
        ctx.shadowColor=e.color; ctx.shadowBlur=12;
        ctx.fillStyle=e.color;
        // UFO body
        ctx.beginPath(); ctx.ellipse(e.x,e.y+4,e.w/2,e.h/4,0,0,Math.PI*2); ctx.fill();
        ctx.beginPath(); ctx.ellipse(e.x,e.y-2,e.w/3,e.h/2.5,0,0,Math.PI*2); ctx.fill();
        ctx.shadowBlur=0;
        ctx.fillStyle='rgba(255,255,255,0.4)';
        ctx.beginPath(); ctx.arc(e.x,e.y-4,3,0,Math.PI*2); ctx.fill();
    });

    // Player
    const px=player.x, py=player.y;
    if(player.invincible>0&&Math.floor(player.invincible/6)%2===0){ /* blink */ } else {
        ctx.shadowColor='#00ff88'; ctx.shadowBlur=20;
        // Ship body
        ctx.fillStyle='#00ff88';
        ctx.beginPath(); ctx.moveTo(px,py-player.h/2); ctx.lineTo(px-player.w/2,py+player.h/2); ctx.lineTo(px,py+player.h/4); ctx.lineTo(px+player.w/2,py+player.h/2); ctx.closePath(); ctx.fill();
        // Engine glow
        ctx.shadowColor='#a855f7'; ctx.shadowBlur=15;
        ctx.fillStyle='#a855f7';
        ctx.beginPath(); ctx.ellipse(px,py+player.h/2,6,4,0,0,Math.PI*2); ctx.fill();
        ctx.shadowBlur=0;
        // Cockpit
        ctx.fillStyle='rgba(255,255,255,0.3)';
        ctx.beginPath(); ctx.ellipse(px,py,5,8,0,0,Math.PI*2); ctx.fill();
    }

    // Bullets
    bullets.forEach(b=>{ ctx.shadowColor='#f59e0b'; ctx.shadowBlur=12; ctx.fillStyle='#fcd34d'; ctx.fillRect(b.x-2,b.y-8,4,12); ctx.shadowBlur=0; });

    // Particles
    particles.forEach(p=>{ ctx.globalAlpha=p.life/50; ctx.shadowColor=p.color; ctx.shadowBlur=8; ctx.fillStyle=p.color; ctx.beginPath(); ctx.arc(p.x,p.y,p.r,0,Math.PI*2); ctx.fill(); });
    ctx.globalAlpha=1; ctx.shadowBlur=0;

    // HUD wave text
    ctx.font='bold 11px Orbitron,monospace'; ctx.fillStyle='rgba(168,85,247,0.5)'; ctx.textAlign='left';
    ctx.fillText(`WAVE ${wave}`, 10, 20);
}

function endGame(){
    running=false; cancelAnimationFrame(animId);
    document.getElementById('sh-final').textContent=score;
    document.getElementById('sh-final-wave').textContent=wave;
    document.getElementById('shooter-gameover').style.display='flex';
}

function startGame(){
    document.getElementById('shooter-overlay').style.display='none';
    document.getElementById('shooter-gameover').style.display='none';
    running=true; paused=false; lastTime=0;
    cancelAnimationFrame(animId);
    animId=requestAnimationFrame(gameLoop);
}

document.addEventListener('keydown',e=>{ keys[e.key]=true; if([' ','ArrowUp','ArrowDown','ArrowLeft','ArrowRight'].includes(e.key)) e.preventDefault(); if(e.key==='p'||e.key==='P') togglePause(); });
document.addEventListener('keyup',e=>{ keys[e.key]=false; });

// Mobile
document.getElementById('mob-sh-left').addEventListener('mousedown',()=>keys['ArrowLeft']=true);
document.getElementById('mob-sh-left').addEventListener('mouseup',()=>keys['ArrowLeft']=false);
document.getElementById('mob-sh-right').addEventListener('mousedown',()=>keys['ArrowRight']=true);
document.getElementById('mob-sh-right').addEventListener('mouseup',()=>keys['ArrowRight']=false);
document.getElementById('mob-sh-fire').addEventListener('click',()=>{ if(shootCooldown<=0){fireBullet();shootCooldown=18;} });
// Touch events
['mob-sh-left','mob-sh-right'].forEach(id=>{
    const btn=document.getElementById(id);
    const key=id.includes('left')?'ArrowLeft':'ArrowRight';
    btn.addEventListener('touchstart',e=>{keys[key]=true;e.preventDefault();},{passive:false});
    btn.addEventListener('touchend',e=>{keys[key]=false;e.preventDefault();},{passive:false});
});

document.getElementById('shooter-start-btn').addEventListener('click',()=>{ initGame(); startGame(); });
document.getElementById('shooter-restart-btn').addEventListener('click',()=>{ initGame(); startGame(); });
document.getElementById('sh-pause-btn').addEventListener('click',togglePause);
document.getElementById('sh-reset-btn').addEventListener('click',()=>{ running=false; cancelAnimationFrame(animId); initGame(); document.getElementById('shooter-overlay').style.display='flex'; document.getElementById('shooter-gameover').style.display='none'; });

function togglePause(){ if(!running) return; paused=!paused; document.getElementById('sh-pause-btn').textContent=paused?'▶ RESUME':'⏸ PAUSE'; }

initGame();
</script>
@endsection
