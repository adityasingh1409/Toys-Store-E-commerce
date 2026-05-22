@extends('layouts.app')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section id="hero" style="min-height: 90vh; display: flex; align-items: center; position: relative; overflow: hidden; margin-top: -30px;">
    {{-- Animated background grid --}}
    <div id="hero-grid" style="position:absolute;inset:0;pointer-events:none;z-index:0;"></div>
    {{-- Floating orbs --}}
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="container position-relative" style="z-index:2;">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-badge mb-3">
                    <span class="badge-dot"></span>
                    <span>SYSTEM ONLINE // v2.0.47</span>
                </div>
                <h1 class="hero-title">
                    <span class="glitch" data-text="TOY">TOY</span><br>
                    <span class="glitch neon-purple" data-text="STORE">STORE</span><br>
                    <span class="glitch neon-green" data-text="OS">OS</span>
                </h1>
                <p class="hero-subtitle mt-3 mb-4">
                    Next-gen toy shopping experience. <br>
                    <span style="color:var(--primary);">Browse, play, and explore</span> in a cyberpunk universe.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('home') }}" class="btn-cyber btn-cyber-primary">
                        <span>ENTER_SHOP</span>
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                    </a>
                    <a href="{{ route('games.index') }}" class="btn-cyber btn-cyber-purple">
                        <span>PLAY_GAMES</span>
                        <span style="font-size:1.1em;">🎮</span>
                    </a>
                </div>
                <div class="hero-stats mt-5 d-flex gap-4 flex-wrap">
                    <div class="stat-item">
                        <span class="stat-num" id="stat-products">{{ $totalProducts }}</span>
                        <span class="stat-label">PRODUCTS</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">{{ $categories->count() }}</span>
                        <span class="stat-label">CATEGORIES</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">4</span>
                        <span class="stat-label">MINI_GAMES</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
                <div class="hero-visual">
                    <div class="hex-ring"></div>
                    <div class="hex-ring hex-ring-2"></div>
                    <div class="hero-icon-grid">
                        <div class="toy-float" style="animation-delay:0s">🚀</div>
                        <div class="toy-float" style="animation-delay:0.3s">🎯</div>
                        <div class="toy-float" style="animation-delay:0.6s">🤖</div>
                        <div class="toy-float" style="animation-delay:0.9s">🎮</div>
                        <div class="toy-float" style="animation-delay:1.2s">🧩</div>
                        <div class="toy-float" style="animation-delay:1.5s">🎲</div>
                        <div class="toy-float" style="animation-delay:1.8s">⚡</div>
                        <div class="toy-float" style="animation-delay:2.1s">🎪</div>
                        <div class="hero-center-badge">
                            <span>TOY<br>STORE</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== MARQUEE STRIP ===== --}}
<div class="marquee-strip my-2">
    <div class="marquee-inner">
        @foreach(['🚀 ROCKETS', '🤖 ROBOTS', '🎯 TARGETS', '🧩 PUZZLES', '🎮 GAMING', '🎲 DICE', '🏎️ RACING', '🧸 PLUSH', '⚡ ELECTRIC', '🎪 FUN'] as $item)
            <span class="marquee-item">{{ $item }}</span>
            <span class="marquee-dot">◆</span>
        @endforeach
        @foreach(['🚀 ROCKETS', '🤖 ROBOTS', '🎯 TARGETS', '🧩 PUZZLES', '🎮 GAMING', '🎲 DICE', '🏎️ RACING', '🧸 PLUSH', '⚡ ELECTRIC', '🎪 FUN'] as $item)
            <span class="marquee-item">{{ $item }}</span>
            <span class="marquee-dot">◆</span>
        @endforeach
    </div>
</div>

{{-- ===== FEATURES SECTION ===== --}}
<section class="py-5 my-4">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-tag">// SYSTEM_FEATURES</span>
            <h2 class="section-title mt-2">WHY CHOOSE <span style="color:var(--primary)">TOY_STORE_OS</span></h2>
        </div>
        <div class="row g-4">
            @php
            $features = [
                ['icon'=>'🚚', 'title'=>'FREE_SHIPPING', 'desc'=>'On all orders above $50. Fast delivery to your doorstep with real-time tracking.', 'color'=>'#00ff88'],
                ['icon'=>'🔒', 'title'=>'SECURE_PAYMENT', 'desc'=>'256-bit SSL encrypted transactions. Your data is protected at every step.', 'color'=>'#a855f7'],
                ['icon'=>'🤖', 'title'=>'AI_RECOMMENDATIONS', 'desc'=>'Smart toy suggestions based on age, interests, and play patterns.', 'color'=>'#10b981'],
                ['icon'=>'🎮', 'title'=>'PLAY_WHILE_SHOP', 'desc'=>'Enjoy 4 exclusive mini-games while you browse. Fun for everyone!', 'color'=>'#f59e0b'],
                ['icon'=>'🔄', 'title'=>'EASY_RETURNS', 'desc'=>'30-day no-hassle return policy. Not happy? We make it right.', 'color'=>'#ef4444'],
                ['icon'=>'⚡', 'title'=>'INSTANT_SUPPORT', 'desc'=>'24/7 customer support team. Get answers in seconds, not days.', 'color'=>'#00ff88'],
            ];
            @endphp
            @foreach($features as $f)
            <div class="col-md-6 col-lg-4">
                <div class="feature-card" style="--accent: {{ $f['color'] }}">
                    <div class="feature-icon">{{ $f['icon'] }}</div>
                    <h5 class="feature-title">{{ $f['title'] }}</h5>
                    <p class="feature-desc">{{ $f['desc'] }}</p>
                    <div class="feature-line"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== FEATURED PRODUCTS ===== --}}
@if($featuredProducts->count() > 0)
<section class="py-5" style="background: rgba(0,255,136,0.02); border-top: 1px solid rgba(0,255,136,0.1); border-bottom: 1px solid rgba(0,255,136,0.1);">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
            <div>
                <span class="section-tag">// FEATURED_PRODUCTS</span>
                <h2 class="section-title mt-1">LATEST <span style="color:var(--primary)">ARRIVALS</span></h2>
            </div>
            <a href="{{ route('home') }}" class="btn-cyber btn-cyber-sm btn-cyber-primary">VIEW_ALL →</a>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($featuredProducts as $product)
            <div class="col">
                <div class="product-card-landing h-100">
                    <div class="product-img-wrap">
                        @if($product->image)
                            <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/'.$product->image) }}"
                                 alt="{{ $product->name }}" class="product-img">
                        @else
                            <div class="product-img-placeholder">
                                <span>🧸</span>
                            </div>
                        @endif
                        <div class="product-overlay">
                            <a href="{{ route('product.show', $product) }}" class="btn-cyber btn-cyber-sm btn-cyber-primary">VIEW_ITEM</a>
                        </div>
                    </div>
                    <div class="product-info">
                        <h6 class="product-name">{{ $product->name }}</h6>
                        <p class="product-desc">{{ \Illuminate\Support\Str::limit($product->description, 55) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto pt-2">
                            <span class="product-price">${{ $product->price }}</span>
                            <a href="{{ route('product.show', $product) }}" class="product-link">DETAILS →</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== GAMES HUB TEASER ===== --}}
<section class="py-5 my-4">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-tag" style="color:#a855f7; border-color:#a855f7;">// GAMES_HUB.exe</span>
            <h2 class="section-title mt-2">PLAY WHILE YOU <span style="color:#a855f7; text-shadow:0 0 20px rgba(168,85,247,0.5)">SHOP</span></h2>
            <p class="text-muted mt-2">4 exclusive cyberpunk mini-games. Free to play. No login required.</p>
        </div>
        <div class="row g-4 justify-content-center">
            @php
            $games = [
                ['name'=>'NEON_SNAKE', 'emoji'=>'🐍', 'desc'=>'Classic snake with a glowing neon trail. Grow longer, avoid yourself!', 'color'=>'#10b981', 'route'=>'games.snake', 'tag'=>'ARCADE'],
                ['name'=>'CYBER_TETRIS', 'emoji'=>'🧩', 'desc'=>'Stack glowing blocks in this cyberpunk twist on the classic.', 'color'=>'#00ff88', 'route'=>'games.tetris', 'tag'=>'PUZZLE'],
                ['name'=>'SPACE_SHOOTER', 'emoji'=>'🚀', 'desc'=>'Pilot your ship. Blast asteroids. Survive the neon cosmos.', 'color'=>'#ef4444', 'route'=>'games.shooter', 'tag'=>'ACTION'],
                ['name'=>'MEMORY_CARDS', 'emoji'=>'🃏', 'desc'=>'Match toy-themed pairs. Test your memory in record time!', 'color'=>'#f59e0b', 'route'=>'games.memory', 'tag'=>'BRAIN'],
            ];
            @endphp
            @foreach($games as $g)
            <div class="col-sm-6 col-lg-3">
                <a href="{{ route($g['route']) }}" class="game-card-link">
                    <div class="game-teaser-card" style="--gcolor: {{ $g['color'] }}">
                        <div class="game-tag">{{ $g['tag'] }}</div>
                        <div class="game-emoji">{{ $g['emoji'] }}</div>
                        <h5 class="game-name">{{ $g['name'] }}</h5>
                        <p class="game-desc">{{ $g['desc'] }}</p>
                        <div class="game-play-btn">PLAY NOW ▶</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('games.index') }}" class="btn-cyber btn-cyber-purple" style="font-size:1rem; padding: 14px 40px;">
                🎮 OPEN GAMES_HUB
            </a>
        </div>
    </div>
</section>

{{-- ===== CATEGORIES SECTION ===== --}}
@if($categories->count() > 0)
<section class="py-5" style="background: rgba(168,85,247,0.03); border-top: 1px solid rgba(168,85,247,0.1);">
    <div class="container">
        <div class="section-header text-center mb-4">
            <span class="section-tag" style="color:#a855f7; border-color:#a855f7;">// BROWSE_CATEGORIES</span>
            <h2 class="section-title mt-2">EXPLORE BY <span style="color:#a855f7">CATEGORY</span></h2>
        </div>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            @foreach($categories as $cat)
            <a href="{{ route('home', ['category_id' => $cat->id]) }}" class="category-chip" style="--gcolor:#a855f7">
                <span class="chip-count">{{ $cat->products_count }}</span>
                {{ strtoupper($cat->name) }}
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== CTA SECTION ===== --}}
<section class="py-5 my-4">
    <div class="container">
        <div class="cta-box text-center">
            <div class="cta-glow"></div>
            <span class="section-tag mb-3 d-block">// READY_TO_START?</span>
            <h2 class="section-title" style="font-size:clamp(1.5rem, 4vw, 2.8rem);">JOIN THE <span style="color:var(--primary)">TOY_STORE</span> UNIVERSE</h2>
            <p class="text-muted mt-3 mb-4" style="max-width:500px; margin-inline:auto;">
                Create your account today. Shop premium toys, play exclusive games, and be part of the next-gen shopping experience.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                @guest
                    <a href="{{ route('register') }}" class="btn-cyber btn-cyber-primary" style="padding:14px 36px;">CREATE_ACCOUNT</a>
                    <a href="{{ route('login') }}" class="btn-cyber btn-cyber-outline" style="padding:14px 36px;">LOGIN →</a>
                @endguest
                @auth
                    <a href="{{ route('home') }}" class="btn-cyber btn-cyber-primary" style="padding:14px 36px;">GO_TO_SHOP →</a>
                @endauth
            </div>
        </div>
    </div>
</section>

{{-- ===== LANDING PAGE STYLES ===== --}}
<style>
/* ─── Orbs ─────────────────────────────────────────────── */
.orb { position:absolute; border-radius:50%; pointer-events:none; animation: orb-drift 8s ease-in-out infinite alternate; }
.orb-1 { width:400px; height:400px; top:-100px; right:-100px; background:radial-gradient(circle, rgba(0,255,136,0.12) 0%, transparent 70%); animation-duration:9s; }
.orb-2 { width:300px; height:300px; bottom:-50px; left:-80px; background:radial-gradient(circle, rgba(168,85,247,0.12) 0%, transparent 70%); animation-duration:7s; animation-delay:2s; }
.orb-3 { width:200px; height:200px; top:50%; left:50%; transform:translate(-50%,-50%); background:radial-gradient(circle, rgba(16,185,129,0.06) 0%, transparent 70%); animation-duration:11s; animation-delay:4s; }
@keyframes orb-drift { from{transform:translate(0,0) scale(1);} to{transform:translate(30px,20px) scale(1.15);} }

/* ─── Hero Badge ────────────────────────────────────────── */
.hero-badge { display:inline-flex; align-items:center; gap:8px; background:rgba(0,255,136,0.08); border:1px solid rgba(0,255,136,0.25); border-radius:100px; padding:6px 16px; font-family:'Orbitron',sans-serif; font-size:0.7rem; color:var(--primary); letter-spacing:0.1em; }
.badge-dot { width:8px; height:8px; border-radius:50%; background:var(--primary); box-shadow:0 0 8px var(--primary); animation: pulse-dot 2s ease infinite; }
@keyframes pulse-dot { 0%,100%{opacity:1;} 50%{opacity:0.4;} }

/* ─── Hero Title Glitch ──────────────────────────────────── */
.hero-title { font-size:clamp(3rem,8vw,6rem); line-height:1; font-family:'Orbitron',sans-serif; font-weight:900; }
.glitch { position:relative; display:inline-block; color:white; }
.glitch::before,.glitch::after { content:attr(data-text); position:absolute; left:0; top:0; }
.glitch::before { color:var(--primary); animation: glitch1 3s infinite; clip-path:polygon(0 0,100% 0,100% 35%,0 35%); }
.glitch::after { color:#ff00c1; animation: glitch2 3s infinite; clip-path:polygon(0 65%,100% 65%,100% 100%,0 100%); }
.neon-purple { color:#a855f7 !important; }
.neon-purple::before { color:#a855f7; }
.neon-purple::after { color:#7c3aed; }
.neon-green { color:#10b981 !important; }
.neon-green::before { color:#10b981; }
.neon-green::after { color:#059669; }
@keyframes glitch1 { 0%,100%{transform:none;opacity:1;} 7%{transform:skew(-0.5deg,-0.9deg);opacity:0.75;} 10%{transform:none;opacity:1;} 27%{transform:none;} 28%{transform:translate(7px);} 35%{transform:translate(0);} }
@keyframes glitch2 { 0%,100%{transform:none;opacity:1;} 7%{transform:skew(-0.5deg,-0.9deg) translateX(-5px);opacity:0.75;} 10%{transform:none;opacity:1;} 45%{transform:none;} 46%{transform:translate(-3px);} 50%{transform:translate(0);} }

/* ─── Hero Subtitle ─────────────────────────────────────── */
.hero-subtitle { font-size:1.15rem; color:#9ca3af; line-height:1.7; }

/* ─── Stats ─────────────────────────────────────────────── */
.hero-stats { border-top:1px solid rgba(255,255,255,0.08); padding-top:1.5rem; }
.stat-item { display:flex; flex-direction:column; }
.stat-num { font-family:'Orbitron',sans-serif; font-size:1.8rem; font-weight:700; color:var(--primary); text-shadow:0 0 15px rgba(0,255,136,0.5); }
.stat-label { font-size:0.65rem; color:#6b7280; letter-spacing:0.15em; margin-top:2px; }
.stat-divider { width:1px; background:rgba(255,255,255,0.1); align-self:stretch; }

/* ─── Hero Visual ───────────────────────────────────────── */
.hero-visual { position:relative; width:380px; height:380px; }
.hex-ring { position:absolute; inset:0; border-radius:50%; border:1px solid rgba(0,255,136,0.2); animation: spin-slow 20s linear infinite; }
.hex-ring::before,.hex-ring::after { content:''; position:absolute; border-radius:50%; border:1px solid rgba(0,255,136,0.1); inset:-20px; animation: spin-slow 30s linear infinite reverse; }
.hex-ring-2 { border-color:rgba(168,85,247,0.2); animation-duration:30s; animation-direction:reverse; }
.hex-ring-2::before { border-color:rgba(168,85,247,0.1); }
@keyframes spin-slow { from{transform:rotate(0deg);} to{transform:rotate(360deg);} }
.hero-icon-grid { position:absolute; inset:0; display:grid; grid-template-columns:repeat(3,1fr); grid-template-rows:repeat(3,1fr); padding:30px; }
.toy-float { display:flex; align-items:center; justify-content:center; font-size:2rem; animation: toy-float 3s ease-in-out infinite alternate; }
@keyframes toy-float { from{transform:translateY(0) rotate(-5deg);} to{transform:translateY(-8px) rotate(5deg);} }
.hero-center-badge { grid-column:2; grid-row:2; display:flex; align-items:center; justify-content:center; background:rgba(0,255,136,0.1); border:1px solid rgba(0,255,136,0.3); border-radius:50%; font-family:'Orbitron',sans-serif; font-size:0.65rem; font-weight:700; color:var(--primary); text-align:center; line-height:1.3; box-shadow:0 0 30px rgba(0,255,136,0.2), inset 0 0 30px rgba(0,255,136,0.05); }

/* ─── Buttons ───────────────────────────────────────────── */
.btn-cyber { display:inline-flex; align-items:center; gap:8px; font-family:'Orbitron',sans-serif; font-weight:700; font-size:0.8rem; letter-spacing:0.1em; text-decoration:none; border:none; cursor:pointer; transition:all 0.3s ease; padding:12px 28px; border-radius:4px; text-transform:uppercase; }
.btn-cyber-primary { background:transparent; border:1.5px solid var(--primary); color:var(--primary); box-shadow:0 0 15px rgba(0,255,136,0.15); }
.btn-cyber-primary:hover { background:var(--primary); color:#010d06; box-shadow:0 0 30px rgba(0,255,136,0.5); transform:translateY(-2px); }
.btn-cyber-purple { background:transparent; border:1.5px solid #a855f7; color:#a855f7; box-shadow:0 0 15px rgba(168,85,247,0.15); }
.btn-cyber-purple:hover { background:#a855f7; color:#fff; box-shadow:0 0 30px rgba(168,85,247,0.5); transform:translateY(-2px); }
.btn-cyber-outline { background:transparent; border:1.5px solid rgba(255,255,255,0.2); color:#e5e7eb; }
.btn-cyber-outline:hover { border-color:var(--primary); color:var(--primary); box-shadow:0 0 15px rgba(0,255,136,0.2); }
.btn-cyber-sm { padding:8px 18px; font-size:0.7rem; }

/* ─── Marquee ───────────────────────────────────────────── */
.marquee-strip { background:rgba(0,255,136,0.05); border-top:1px solid rgba(0,255,136,0.15); border-bottom:1px solid rgba(0,255,136,0.15); overflow:hidden; padding:10px 0; }
.marquee-inner { display:flex; gap:0; white-space:nowrap; animation: marquee 30s linear infinite; }
.marquee-item { font-family:'Orbitron',sans-serif; font-size:0.75rem; color:var(--primary); letter-spacing:0.15em; padding:0 20px; }
.marquee-dot { color:rgba(0,255,136,0.4); font-size:0.5rem; vertical-align:middle; }
@keyframes marquee { from{transform:translateX(0);} to{transform:translateX(-50%);} }

/* ─── Section Headings ──────────────────────────────────── */
.section-tag { font-family:'Orbitron',sans-serif; font-size:0.7rem; letter-spacing:0.2em; color:var(--primary); border:1px solid rgba(0,255,136,0.25); padding:4px 12px; border-radius:100px; display:inline-block; }
.section-title { font-family:'Orbitron',sans-serif; font-size:clamp(1.4rem,3vw,2rem); font-weight:900; color:#fff; }

/* ─── Feature Cards ─────────────────────────────────────── */
.feature-card { background:rgba(0,20,10,0.6); border:1px solid rgba(255,255,255,0.06); border-radius:12px; padding:28px; height:100%; transition:all 0.3s ease; position:relative; overflow:hidden; backdrop-filter:blur(10px); }
.feature-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(90deg, transparent, var(--accent), transparent); opacity:0; transition:opacity 0.3s; }
.feature-card:hover { border-color:color-mix(in srgb, var(--accent) 40%, transparent); transform:translateY(-4px); box-shadow:0 20px 40px rgba(0,0,0,0.3); }
.feature-card:hover::before { opacity:1; }
.feature-icon { font-size:2.5rem; margin-bottom:16px; display:block; }
.feature-title { font-family:'Orbitron',sans-serif; font-size:0.85rem; color:var(--accent); letter-spacing:0.1em; margin-bottom:10px; }
.feature-desc { color:#9ca3af; font-size:0.9rem; line-height:1.6; margin:0; }
.feature-line { width:40px; height:2px; background:var(--accent); margin-top:16px; border-radius:2px; opacity:0.5; transition:width 0.3s; }
.feature-card:hover .feature-line { width:80px; opacity:1; }

/* ─── Product Cards Landing ─────────────────────────────── */
.product-card-landing { background:rgba(0,20,10,0.65); border:1px solid rgba(255,255,255,0.06); border-radius:12px; overflow:hidden; display:flex; flex-direction:column; transition:all 0.3s ease; backdrop-filter:blur(10px); }
.product-card-landing:hover { border-color:rgba(0,255,136,0.3); transform:translateY(-5px); box-shadow:0 20px 40px rgba(0,0,0,0.4); }
.product-img-wrap { position:relative; overflow:hidden; aspect-ratio:4/3; }
.product-img { width:100%; height:100%; object-fit:cover; transition:transform 0.4s ease; filter:grayscale(20%); }
.product-card-landing:hover .product-img { transform:scale(1.08); filter:grayscale(0%); }
.product-img-placeholder { width:100%; height:100%; background:rgba(0,255,136,0.05); display:flex; align-items:center; justify-content:center; font-size:4rem; }
.product-overlay { position:absolute; inset:0; background:rgba(3,7,18,0.7); display:flex; align-items:center; justify-content:center; opacity:0; transition:opacity 0.3s; backdrop-filter:blur(4px); }
.product-card-landing:hover .product-overlay { opacity:1; }
.product-info { padding:18px; display:flex; flex-direction:column; flex:1; }
.product-name { font-family:'Orbitron',sans-serif; font-size:0.85rem; color:#e5e7eb; letter-spacing:0.05em; margin-bottom:8px; }
.product-desc { color:#6b7280; font-size:0.85rem; line-height:1.5; flex:1; }
.product-price { font-family:'Orbitron',sans-serif; font-size:1.2rem; color:var(--primary); font-weight:700; text-shadow:0 0 10px rgba(0,255,136,0.4); }
.product-link { font-family:'Orbitron',sans-serif; font-size:0.7rem; color:var(--primary); text-decoration:none; letter-spacing:0.1em; transition:all 0.2s; }
.product-link:hover { text-shadow:0 0 8px rgba(0,255,136,0.6); }

/* ─── Game Teaser Cards ─────────────────────────────────── */
.game-card-link { text-decoration:none; display:block; }
.game-teaser-card { background:rgba(0,20,10,0.65); border:1px solid color-mix(in srgb, var(--gcolor) 25%, transparent); border-radius:16px; padding:28px 20px; text-align:center; transition:all 0.35s ease; position:relative; overflow:hidden; backdrop-filter:blur(10px); }
.game-teaser-card::before { content:''; position:absolute; inset:0; background:radial-gradient(circle at 50% 0%, color-mix(in srgb, var(--gcolor) 15%, transparent) 0%, transparent 60%); opacity:0; transition:opacity 0.35s; }
.game-teaser-card:hover { transform:translateY(-8px) scale(1.02); border-color:color-mix(in srgb, var(--gcolor) 60%, transparent); box-shadow:0 20px 50px rgba(0,0,0,0.4), 0 0 40px color-mix(in srgb, var(--gcolor) 15%, transparent); }
.game-teaser-card:hover::before { opacity:1; }
.game-tag { font-family:'Orbitron',sans-serif; font-size:0.6rem; letter-spacing:0.2em; color:var(--gcolor); border:1px solid color-mix(in srgb, var(--gcolor) 40%, transparent); padding:3px 10px; border-radius:100px; display:inline-block; margin-bottom:16px; }
.game-emoji { font-size:3.5rem; margin-bottom:12px; display:block; animation: game-pulse 2s ease infinite alternate; }
@keyframes game-pulse { from{transform:scale(1);} to{transform:scale(1.1);} }
.game-name { font-family:'Orbitron',sans-serif; font-size:0.85rem; color:#e5e7eb; letter-spacing:0.08em; margin-bottom:10px; }
.game-desc { color:#6b7280; font-size:0.8rem; line-height:1.5; margin-bottom:16px; }
.game-play-btn { font-family:'Orbitron',sans-serif; font-size:0.7rem; color:var(--gcolor); letter-spacing:0.15em; padding:8px 16px; border:1px solid color-mix(in srgb, var(--gcolor) 40%, transparent); border-radius:4px; transition:all 0.3s; display:inline-block; }
.game-teaser-card:hover .game-play-btn { background:var(--gcolor); color:#010d06; border-color:var(--gcolor); }

/* ─── Category Chips ────────────────────────────────────── */
.category-chip { display:inline-flex; align-items:center; gap:8px; background:rgba(0,20,10,0.6); border:1px solid rgba(168,85,247,0.25); border-radius:100px; padding:10px 20px; font-family:'Orbitron',sans-serif; font-size:0.75rem; color:#c4b5fd; text-decoration:none; transition:all 0.3s; letter-spacing:0.1em; }
.category-chip:hover { background:rgba(168,85,247,0.15); border-color:rgba(168,85,247,0.6); color:#e9d5ff; box-shadow:0 0 20px rgba(168,85,247,0.2); transform:translateY(-2px); }
.chip-count { background:rgba(168,85,247,0.2); border-radius:100px; padding:2px 8px; font-size:0.65rem; color:#a855f7; }

/* ─── CTA Box ───────────────────────────────────────────── */
.cta-box { background:rgba(0,20,10,0.7); border:1px solid rgba(0,255,136,0.15); border-radius:24px; padding:60px 40px; position:relative; overflow:hidden; backdrop-filter:blur(10px); }
.cta-glow { position:absolute; width:500px; height:500px; top:50%; left:50%; transform:translate(-50%,-50%); background:radial-gradient(circle, rgba(0,255,136,0.06) 0%, transparent 70%); pointer-events:none; }

/* ─── Canvas grid background ────────────────────────────── */
#hero-grid { background-image: linear-gradient(rgba(0,255,136,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(0,255,136,0.04) 1px, transparent 1px); background-size: 40px 40px; animation: grid-shift 20s linear infinite; }
@keyframes grid-shift { from{background-position: 0 0;} to{background-position: 40px 40px;} }
</style>

@endsection

