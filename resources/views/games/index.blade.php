@extends('layouts.app')

@section('content')

{{-- Page Header --}}
<div class="games-hub-header text-center py-5 mb-5 position-relative overflow-hidden">
    <div class="hub-grid-bg"></div>
    <div class="orb-hub orb-hub-1"></div>
    <div class="orb-hub orb-hub-2"></div>
    <div class="position-relative" style="z-index:2;">
        <span class="hub-badge mb-3 d-inline-flex align-items-center gap-2">
            <span class="badge-dot" style="background:#a855f7; box-shadow:0 0 10px #a855f7;"></span>
            GAMES_HUB.exe — LOADED
        </span>
        <h1 class="hub-title">🎮 GAMES <span style="color:#a855f7; text-shadow:0 0 30px rgba(168,85,247,0.6);">HUB</span></h1>
        <p class="hub-subtitle">4 cyberpunk mini-games. Free to play. No login required.</p>
    </div>
</div>

{{-- Games Grid --}}
<div class="container pb-5">
    <div class="row g-4">

        {{-- NEON SNAKE --}}
        <div class="col-md-6 col-lg-3">
            <div class="game-card" style="--gc:#10b981">
                <div class="game-card-bg"></div>
                <div class="game-card-inner">
                    <div class="gc-tag">ARCADE</div>
                    <div class="gc-emoji">🐍</div>
                    <h3 class="gc-title">NEON_SNAKE</h3>
                    <p class="gc-desc">Classic snake with glowing neon trail effects. Eat the glowing dots, grow longer, and avoid hitting yourself!</p>
                    <div class="gc-meta">
                        <span class="gc-diff" style="color:#10b981">●●●○○ EASY</span>
                        <span class="gc-ctrl">⌨ ARROW KEYS</span>
                    </div>
                    <a href="{{ route('games.snake') }}" class="gc-play-btn">PLAY NOW ▶</a>
                </div>
            </div>
        </div>

        {{-- CYBER TETRIS --}}
        <div class="col-md-6 col-lg-3">
            <div class="game-card" style="--gc:#00d2ff">
                <div class="game-card-bg"></div>
                <div class="game-card-inner">
                    <div class="gc-tag">PUZZLE</div>
                    <div class="gc-emoji">🧩</div>
                    <h3 class="gc-title">CYBER_TETRIS</h3>
                    <p class="gc-desc">Stack glowing neon blocks in this cyberpunk Tetris. Clear lines to score, speed increases with level!</p>
                    <div class="gc-meta">
                        <span class="gc-diff" style="color:#f59e0b">●●●●○ MEDIUM</span>
                        <span class="gc-ctrl">⌨ ARROW KEYS</span>
                    </div>
                    <a href="{{ route('games.tetris') }}" class="gc-play-btn" style="border-color:#00d2ff; color:#00d2ff;">PLAY NOW ▶</a>
                </div>
            </div>
        </div>

        {{-- SPACE SHOOTER --}}
        <div class="col-md-6 col-lg-3">
            <div class="game-card" style="--gc:#ef4444">
                <div class="game-card-bg"></div>
                <div class="game-card-inner">
                    <div class="gc-tag">ACTION</div>
                    <div class="gc-emoji">🚀</div>
                    <h3 class="gc-title">SPACE_SHOOTER</h3>
                    <p class="gc-desc">Pilot your neon ship through enemy waves. Shoot, dodge, and survive the cosmic battlefield!</p>
                    <div class="gc-meta">
                        <span class="gc-diff" style="color:#ef4444">●●●●● HARD</span>
                        <span class="gc-ctrl">← → SPACE</span>
                    </div>
                    <a href="{{ route('games.shooter') }}" class="gc-play-btn" style="border-color:#ef4444; color:#ef4444;">PLAY NOW ▶</a>
                </div>
            </div>
        </div>

        {{-- MEMORY CARDS --}}
        <div class="col-md-6 col-lg-3">
            <div class="game-card" style="--gc:#f59e0b">
                <div class="game-card-bg"></div>
                <div class="game-card-inner">
                    <div class="gc-tag">BRAIN</div>
                    <div class="gc-emoji">🃏</div>
                    <h3 class="gc-title">MEMORY_CARDS</h3>
                    <p class="gc-desc">Flip and match toy-themed card pairs. Beat the clock and challenge your memory to the limit!</p>
                    <div class="gc-meta">
                        <span class="gc-diff" style="color:#10b981">●●○○○ CHILL</span>
                        <span class="gc-ctrl">🖱 CLICK</span>
                    </div>
                    <a href="{{ route('games.memory') }}" class="gc-play-btn" style="border-color:#f59e0b; color:#f59e0b;">PLAY NOW ▶</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Back to Shop --}}
    <div class="text-center mt-5 pt-3">
        <a href="{{ route('landing') }}" class="btn-cyber btn-cyber-outline me-3">← BACK_TO_HOME</a>
        <a href="{{ route('home') }}" class="btn-cyber btn-cyber-primary">ENTER_SHOP →</a>
    </div>
</div>

<style>
/* Hub Header */
.games-hub-header { background:rgba(15,23,42,0.5); border-bottom:1px solid rgba(168,85,247,0.2); position:relative; }
.hub-grid-bg { position:absolute; inset:0; background-image:linear-gradient(rgba(168,85,247,0.04) 1px,transparent 1px), linear-gradient(90deg,rgba(168,85,247,0.04) 1px,transparent 1px); background-size:40px 40px; }
.orb-hub { position:absolute; border-radius:50%; pointer-events:none; }
.orb-hub-1 { width:300px; height:300px; top:-100px; left:-50px; background:radial-gradient(circle,rgba(168,85,247,0.12) 0%,transparent 70%); }
.orb-hub-2 { width:250px; height:250px; bottom:-80px; right:-30px; background:radial-gradient(circle,rgba(0,210,255,0.1) 0%,transparent 70%); }
.hub-badge { background:rgba(168,85,247,0.1); border:1px solid rgba(168,85,247,0.3); border-radius:100px; padding:6px 16px; font-family:'Orbitron',sans-serif; font-size:0.65rem; color:#c4b5fd; letter-spacing:0.1em; }
.badge-dot { width:8px; height:8px; border-radius:50%; animation:pulse-dot 2s ease infinite; }
@keyframes pulse-dot { 0%,100%{opacity:1;} 50%{opacity:0.3;} }
.hub-title { font-family:'Orbitron',sans-serif; font-size:clamp(2rem,5vw,3.5rem); font-weight:900; color:#fff; margin:0; }
.hub-subtitle { color:#9ca3af; font-size:1rem; margin-top:10px; }

/* Game Cards */
.game-card { background:rgba(15,23,42,0.7); border:1px solid color-mix(in srgb,var(--gc) 25%,transparent); border-radius:16px; overflow:hidden; position:relative; transition:all 0.35s ease; height:100%; backdrop-filter:blur(12px); }
.game-card:hover { transform:translateY(-10px) scale(1.02); border-color:color-mix(in srgb,var(--gc) 65%,transparent); box-shadow:0 25px 60px rgba(0,0,0,0.5), 0 0 50px color-mix(in srgb,var(--gc) 12%,transparent); }
.game-card-bg { position:absolute; inset:0; background:radial-gradient(circle at 50% 0%,color-mix(in srgb,var(--gc) 12%,transparent) 0%,transparent 65%); opacity:0; transition:opacity 0.35s; }
.game-card:hover .game-card-bg { opacity:1; }
.game-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(90deg,transparent,var(--gc),transparent); opacity:0; transition:opacity 0.35s; }
.game-card:hover::before { opacity:1; }
.game-card-inner { padding:28px 22px; display:flex; flex-direction:column; height:100%; position:relative; z-index:1; }
.gc-tag { font-family:'Orbitron',sans-serif; font-size:0.6rem; letter-spacing:0.25em; color:var(--gc); border:1px solid color-mix(in srgb,var(--gc) 45%,transparent); padding:4px 12px; border-radius:100px; display:inline-block; margin-bottom:18px; align-self:flex-start; }
.gc-emoji { font-size:3.5rem; margin-bottom:14px; display:block; transition:transform 0.3s; }
.game-card:hover .gc-emoji { transform:scale(1.2) rotate(5deg); }
.gc-title { font-family:'Orbitron',sans-serif; font-size:0.9rem; color:#e5e7eb; letter-spacing:0.08em; margin-bottom:12px; }
.gc-desc { color:#6b7280; font-size:0.85rem; line-height:1.6; flex:1; margin-bottom:16px; }
.gc-meta { display:flex; flex-direction:column; gap:4px; margin-bottom:20px; }
.gc-diff,.gc-ctrl { font-family:'Orbitron',sans-serif; font-size:0.65rem; letter-spacing:0.1em; }
.gc-ctrl { color:#4b5563; }
.gc-play-btn { display:block; text-align:center; font-family:'Orbitron',sans-serif; font-size:0.75rem; font-weight:700; letter-spacing:0.15em; color:#10b981; border:1.5px solid rgba(16,185,129,0.5); border-radius:6px; padding:12px; text-decoration:none; transition:all 0.3s; }
.gc-play-btn:hover { background:var(--gc); color:#030712; border-color:var(--gc); box-shadow:0 0 20px color-mix(in srgb,var(--gc) 40%,transparent); }

/* Shared Buttons */
.btn-cyber { display:inline-flex; align-items:center; gap:8px; font-family:'Orbitron',sans-serif; font-weight:700; font-size:0.8rem; letter-spacing:0.1em; text-decoration:none; cursor:pointer; transition:all 0.3s ease; padding:12px 28px; border-radius:4px; text-transform:uppercase; border:none; }
.btn-cyber-primary { background:transparent; border:1.5px solid var(--primary); color:var(--primary); box-shadow:0 0 15px rgba(0,210,255,0.15); }
.btn-cyber-primary:hover { background:var(--primary); color:#030712; box-shadow:0 0 30px rgba(0,210,255,0.5); }
.btn-cyber-outline { background:transparent; border:1.5px solid rgba(255,255,255,0.2); color:#e5e7eb; }
.btn-cyber-outline:hover { border-color:rgba(168,85,247,0.6); color:#c4b5fd; box-shadow:0 0 15px rgba(168,85,247,0.2); }
</style>
@endsection
