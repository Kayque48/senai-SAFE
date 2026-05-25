<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SAFE — Sistema de Autorização e Fluxo Escolar | SENAI Limeira</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800;900&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:           #09090b;
      --bg-surface:   #111318;
      --bg-card:      rgba(255,255,255,0.035);
      --red:          #E30613;
      --red-dark:     #b0041a;
      --red-glow:     rgba(227,6,19,0.18);
      --red-faint:    rgba(227,6,19,0.07);
      --white:        #f4f4f5;
      --text-1:       #f4f4f5;
      --text-2:       #a1a1aa;
      --text-3:       #52525b;
      --border:       rgba(255,255,255,0.07);
      --border-hover: rgba(255,255,255,0.14);
      --border-red:   rgba(227,6,19,0.3);
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Barlow', system-ui, sans-serif;
      background: var(--bg);
      color: var(--text-1);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ── Grid texture overlay ── */
    body::before {
      content: '';
      position: fixed; inset: 0; z-index: 0; pointer-events: none;
      background-image:
        linear-gradient(rgba(255,255,255,0.012) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.012) 1px, transparent 1px);
      background-size: 48px 48px;
    }

    /* ── Red ambient glow ── */
    .ambient {
      position: fixed; inset: 0; z-index: 0; pointer-events: none; overflow: hidden;
    }
    .ambient-1 {
      position: absolute; width: 800px; height: 800px;
      top: -300px; right: -200px;
      background: radial-gradient(circle, rgba(227,6,19,0.08) 0%, transparent 65%);
    }
    .ambient-2 {
      position: absolute; width: 600px; height: 600px;
      bottom: 20%; left: -150px;
      background: radial-gradient(circle, rgba(227,6,19,0.05) 0%, transparent 65%);
    }

    /* ── Layout wrapper ── */
    .page { position: relative; z-index: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ═══════════════ NAV ═══════════════ */
    .nav {
      position: sticky; top: 0; z-index: 100;
      height: 64px;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 3rem;
      background: rgba(9,9,11,0.85);
      backdrop-filter: blur(20px) saturate(140%);
      -webkit-backdrop-filter: blur(20px) saturate(140%);
      border-bottom: 1px solid var(--border);
    }

    .nav-brand {
      display: flex; align-items: center; gap: 14px;
    }
    .nav-logo {
      width: 36px; height: 36px;
      background: var(--red);
      display: flex; align-items: center; justify-content: center;
      border-radius: 4px;
      flex-shrink: 0;
    }
    .nav-logo svg { display: block; }

    .nav-text-group { display: flex; flex-direction: column; gap: 1px; }
    .nav-name {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 20px; font-weight: 800; letter-spacing: 4px;
      color: var(--white); line-height: 1;
    }
    .nav-sub {
      font-size: 10px; font-weight: 500; letter-spacing: 2.5px;
      color: var(--text-3); text-transform: uppercase; line-height: 1;
    }

    .nav-right { display: flex; align-items: center; gap: 20px; }
    .nav-divider {
      display: flex; align-items: center; gap: 6px;
      font-size: 11px; font-weight: 500; letter-spacing: 1px;
      color: var(--text-3);
    }
    .nav-dot { width: 6px; height: 6px; border-radius: 50%; background: #22c55e; box-shadow: 0 0 8px #22c55e; }

    .nav-btn {
      background: var(--red);
      color: #fff;
      border: none; padding: 8px 22px;
      border-radius: 3px;
      font-family: 'Barlow Condensed', sans-serif;
      font-weight: 700; font-size: 14px; letter-spacing: 2px;
      cursor: pointer; text-decoration: none; display: inline-block;
      text-transform: uppercase;
      transition: background 0.2s, transform 0.15s;
    }
    .nav-btn:hover { background: var(--red-dark); transform: translateY(-1px); }

    /* ═══════════════ HERO ═══════════════ */
    .hero {
      display: grid;
      grid-template-columns: 1fr 1fr;
      align-items: center;
      min-height: calc(100vh - 64px);
      padding: 0 3rem;
      gap: 4rem;
      border-bottom: 1px solid var(--border);
      position: relative;
      overflow: hidden;
    }

    /* Red accent line on left edge of hero */
    .hero::before {
      content: '';
      position: absolute; left: 0; top: 10%; bottom: 10%; width: 3px;
      background: linear-gradient(180deg, transparent, var(--red) 30%, var(--red) 70%, transparent);
    }

    .hero-left { padding: 4rem 0; }

    .hero-badge {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 5px 14px;
      border: 1px solid var(--border-red);
      border-radius: 2px;
      background: var(--red-faint);
      font-size: 10px; font-weight: 600; letter-spacing: 3px;
      color: #f87171; text-transform: uppercase;
      margin-bottom: 2rem;
    }
    .hero-badge::before {
      content: ''; width: 5px; height: 5px; border-radius: 50%;
      background: var(--red); box-shadow: 0 0 8px var(--red);
    }

    .hero h1 {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: clamp(80px, 11vw, 140px);
      font-weight: 900; letter-spacing: 8px; line-height: 0.88;
      color: var(--white);
      margin-bottom: 1rem;
    }
    .hero h1 span {
      color: var(--red);
      display: block;
    }

    .hero-tagline {
      font-size: 11px; font-weight: 600; letter-spacing: 3.5px;
      color: var(--text-3); text-transform: uppercase;
      margin-bottom: 1.8rem;
      padding-left: 2px;
    }

    .hero-desc {
      font-size: 16px; line-height: 1.8;
      color: var(--text-2);
      max-width: 420px;
      margin-bottom: 2.5rem;
    }

    .hero-actions { display: flex; gap: 12px; align-items: center; }

    .btn-primary {
      background: var(--red);
      color: #fff;
      border: none; padding: 14px 36px;
      border-radius: 3px;
      font-family: 'Barlow Condensed', sans-serif;
      font-weight: 700; font-size: 15px; letter-spacing: 2.5px;
      cursor: pointer; text-decoration: none; display: inline-block;
      text-transform: uppercase;
      transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    }
    .btn-primary:hover {
      background: var(--red-dark);
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(227,6,19,0.35);
    }

    .btn-ghost {
      background: transparent;
      color: var(--text-2);
      border: 1px solid var(--border-hover);
      padding: 13px 28px;
      border-radius: 3px;
      font-family: 'Barlow Condensed', sans-serif;
      font-weight: 600; font-size: 15px; letter-spacing: 2px;
      cursor: pointer; text-decoration: none; display: inline-block;
      text-transform: uppercase;
      transition: border-color 0.2s, color 0.2s, transform 0.15s;
    }
    .btn-ghost:hover {
      border-color: rgba(255,255,255,0.3);
      color: var(--white);
      transform: translateY(-2px);
    }

    /* ── Hero right: visual ── */
    .hero-right {
      display: flex; align-items: center; justify-content: center;
      position: relative;
      padding: 3rem 0;
    }

    .hero-visual {
      width: 100%; max-width: 520px;
      aspect-ratio: 1;
      position: relative;
    }

    /* Rotating ring */
    .ring-outer {
      position: absolute; inset: 0;
      border: 1px solid rgba(227,6,19,0.15);
      border-radius: 50%;
      animation: spin 30s linear infinite;
    }
    .ring-outer::before {
      content: ''; position: absolute; top: -4px; left: 50%;
      width: 8px; height: 8px; border-radius: 50%;
      background: var(--red); box-shadow: 0 0 16px var(--red);
      transform: translateX(-50%);
    }
    .ring-mid {
      position: absolute; inset: 15%;
      border: 1px solid rgba(227,6,19,0.1);
      border-radius: 50%;
      animation: spin 20s linear infinite reverse;
    }
    .ring-mid::before {
      content: ''; position: absolute; bottom: -4px; left: 50%;
      width: 6px; height: 6px; border-radius: 50%;
      background: rgba(227,6,19,0.6); box-shadow: 0 0 10px rgba(227,6,19,0.6);
      transform: translateX(-50%);
    }
    @keyframes spin {
      from { transform: rotate(0deg); }
      to   { transform: rotate(360deg); }
    }

    /* Center shield */
    .shield-wrap {
      position: absolute; inset: 28%;
      background: rgba(227,6,19,0.08);
      border: 1px solid rgba(227,6,19,0.25);
      border-radius: 4px;
      display: flex; align-items: center; justify-content: center;
      backdrop-filter: blur(8px);
    }
    .shield-wrap svg { width: 52%; height: 52%; }

    /* Corner nodes */
    .node {
      position: absolute;
      width: 80px; height: 80px;
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: 4px;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center; gap: 5px;
      backdrop-filter: blur(8px);
      transition: border-color 0.3s;
    }
    .node:hover { border-color: var(--border-red); }
    .node-label {
      font-size: 9px; font-weight: 600; letter-spacing: 1.5px;
      color: var(--text-3); text-transform: uppercase;
    }
    .node-icon { width: 22px; height: 22px; }
    .node-1 { top: 4%; left: 50%; transform: translateX(-50%); }
    .node-2 { top: 50%; right: 2%; transform: translateY(-50%); }
    .node-3 { bottom: 4%; left: 50%; transform: translateX(-50%); }
    .node-4 { top: 50%; left: 2%; transform: translateY(-50%); }

    /* Connector lines (SVG overlay) */
    .visual-svg {
      position: absolute; inset: 0; width: 100%; height: 100%;
      pointer-events: none;
    }

    /* ═══════════════ STATS STRIP ═══════════════ */
    .stats {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      border-bottom: 1px solid var(--border);
      background: var(--bg-surface);
    }
    .stat {
      padding: 1.8rem 2rem;
      border-right: 1px solid var(--border);
      display: flex; flex-direction: column; gap: 4px;
    }
    .stat:last-child { border-right: none; }
    .stat-num {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 30px; font-weight: 800; color: var(--white);
      letter-spacing: 1px; line-height: 1;
    }
    .stat-num span { color: var(--red); }
    .stat-label {
      font-size: 10px; font-weight: 600; letter-spacing: 2.5px;
      color: var(--text-3); text-transform: uppercase;
    }

    /* ═══════════════ FEATURES ═══════════════ */
    .features {
      padding: 6rem 3rem;
      max-width: 1280px; margin: 0 auto; width: 100%;
    }
    .section-eyebrow {
      font-size: 10px; font-weight: 600; letter-spacing: 3.5px;
      color: var(--red); text-transform: uppercase;
      margin-bottom: 0.5rem;
      display: flex; align-items: center; gap: 10px;
    }
    .section-eyebrow::before {
      content: ''; width: 24px; height: 1px; background: var(--red);
    }
    .section-title {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: clamp(28px, 3vw, 40px);
      font-weight: 800; letter-spacing: 2px;
      color: var(--white); margin-bottom: 3rem;
      text-transform: uppercase; line-height: 1.1;
    }
    .section-title span { color: var(--red); }

    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1px;
      border: 1px solid var(--border);
      background: var(--border);
    }

    .card {
      background: var(--bg-surface);
      padding: 2rem;
      position: relative;
      overflow: hidden;
      transition: background 0.25s;
    }
    .card::after {
      content: '';
      position: absolute; top: 0; left: 0; right: 0; height: 2px;
      background: var(--red);
      transform: scaleX(0); transform-origin: left;
      transition: transform 0.3s ease;
    }
    .card:hover { background: rgba(227,6,19,0.04); }
    .card:hover::after { transform: scaleX(1); }

    .card-icon {
      width: 40px; height: 40px;
      border: 1px solid var(--border-red);
      background: var(--red-faint);
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 1.2rem;
      border-radius: 2px;
    }
    .card-icon svg { width: 20px; height: 20px; stroke: #f87171; }
    .card h3 {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 16px; font-weight: 700; letter-spacing: 1px;
      color: var(--white); text-transform: uppercase;
      margin-bottom: 8px;
    }
    .card p { font-size: 13.5px; color: var(--text-2); line-height: 1.7; }

    /* ═══════════════ FLOW ═══════════════ */
    .flow {
      background: var(--bg-surface);
      border-top: 1px solid var(--border);
      border-bottom: 1px solid var(--border);
      padding: 5rem 3rem;
    }
    .flow-inner { max-width: 1280px; margin: 0 auto; }

    .steps {
      display: grid;
      grid-template-columns: 1fr auto 1fr auto 1fr auto 1fr;
      align-items: center;
      gap: 0;
      margin-top: 2.5rem;
    }

    .step {
      background: var(--bg-card);
      border: 1px solid var(--border);
      padding: 1.5rem;
      position: relative;
      transition: border-color 0.25s, background 0.25s;
    }
    .step:hover {
      border-color: var(--border-red);
      background: rgba(227,6,19,0.04);
    }
    .step-num {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 42px; font-weight: 900;
      color: rgba(227,6,19,0.15);
      line-height: 1; margin-bottom: 6px;
    }
    .step h4 {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 16px; font-weight: 700; letter-spacing: 1.5px;
      color: var(--white); text-transform: uppercase;
      margin-bottom: 4px;
    }
    .step p { font-size: 12px; color: var(--text-3); line-height: 1.5; }

    .step-arrow {
      display: flex; align-items: center; justify-content: center;
      padding: 0 1rem;
      color: var(--red);
      flex-shrink: 0;
    }

    /* ═══════════════ CTA ═══════════════ */
    .cta-section {
      padding: 6rem 3rem;
    }
    .cta-inner {
      max-width: 1280px; margin: 0 auto;
      display: grid; grid-template-columns: 1fr auto;
      align-items: center; gap: 3rem;
      border: 1px solid var(--border);
      padding: 3rem;
      background: var(--bg-surface);
      position: relative; overflow: hidden;
    }
    .cta-inner::before {
      content: '';
      position: absolute; left: 0; top: 0; bottom: 0; width: 3px;
      background: var(--red);
    }
    .cta-tag {
      font-size: 10px; font-weight: 600; letter-spacing: 3px;
      color: var(--red); text-transform: uppercase;
      margin-bottom: 0.75rem;
    }
    .cta-inner h2 {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: clamp(24px, 3vw, 36px);
      font-weight: 800; letter-spacing: 2px;
      color: var(--white); text-transform: uppercase;
      margin-bottom: 0.5rem; line-height: 1.1;
    }
    .cta-inner p { font-size: 14px; color: var(--text-2); max-width: 480px; line-height: 1.7; }

    /* ═══════════════ FOOTER ═══════════════ */
    .footer {
      padding: 1.5rem 3rem;
      border-top: 1px solid var(--border);
      background: var(--bg-surface);
      display: flex; align-items: center; justify-content: space-between;
    }
    .footer-brand {
      display: flex; align-items: center; gap: 10px;
    }
    .footer-logo {
      width: 24px; height: 24px; background: var(--red);
      display: flex; align-items: center; justify-content: center;
      border-radius: 2px; flex-shrink: 0;
    }
    .footer-logo svg { width: 12px; height: 12px; }
    .footer-name {
      font-family: 'Barlow Condensed', sans-serif;
      font-size: 14px; font-weight: 800; letter-spacing: 3px; color: var(--white);
    }
    .footer p {
      font-size: 11.5px; color: var(--text-3); letter-spacing: 0.5px;
    }
    .footer-credits {
      font-size: 11px; color: var(--text-3);
    }
    .footer-credits span { color: var(--red); }

    /* ═══════════════ RESPONSIVE ═══════════════ */
    @media (max-width: 900px) {
      .hero { grid-template-columns: 1fr; min-height: auto; padding: 4rem 1.5rem; gap: 2rem; }
      .hero::before { display: none; }
      .hero-right { display: none; }
      .nav { padding: 0 1.5rem; }
      .nav-divider { display: none; }
      .stats { grid-template-columns: repeat(2, 1fr); }
      .stat:nth-child(2) { border-right: none; }
      .features { padding: 4rem 1.5rem; }
      .flow { padding: 4rem 1.5rem; }
      .steps {
        grid-template-columns: 1fr;
        gap: 1px; background: var(--border);
      }
      .step-arrow { display: none; }
      .cta-section { padding: 4rem 1.5rem; }
      .cta-inner { grid-template-columns: 1fr; gap: 2rem; }
      .footer { flex-direction: column; gap: 1rem; padding: 1.5rem; text-align: center; }
    }

    @media (max-width: 500px) {
      .hero h1 { font-size: 72px; letter-spacing: 6px; }
      .stats { grid-template-columns: 1fr 1fr; }
      .stat { padding: 1.2rem 1rem; }
    }
  </style>
</head>
<body>

<div class="ambient">
  <div class="ambient-1"></div>
  <div class="ambient-2"></div>
</div>

<div class="page">

  <!-- NAV -->
  <nav class="nav">
    <div class="nav-brand">
      <div class="nav-logo">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
      </div>
      <div class="nav-text-group">
        <div class="nav-name">SAFE</div>
        <div class="nav-sub">SENAI Limeira</div>
      </div>
    </div>
    <div class="nav-right">
      <div class="nav-divider">
        <div class="nav-dot"></div>
        Sistema ativo
      </div>
      <a class="nav-btn" href="{{ route('filament.admin.auth.login') }}">Acessar</a>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-left">
      <div class="hero-badge">SENAI Limeira · 2026</div>
      <h1><span>SAFE</span></h1>
      <div class="hero-tagline">Sistema de Autorização e Fluxo Escolar</div>
      <p class="hero-desc">
        Controle digital de entrada e saída de alunos com autorização em tempo real,
        notificações automáticas para responsáveis e registro completo de movimentações.
      </p>
      <div class="hero-actions">
        <a class="btn-primary" href="{{ route('filament.admin.auth.login') }}">Acessar o sistema</a>
        <a class="btn-ghost" href="#features">Ver funcionalidades</a>
      </div>
    </div>

    <div class="hero-right">
      <div class="hero-visual">
        <!-- Rotating rings -->
        <div class="ring-outer"></div>
        <div class="ring-mid"></div>

        <!-- Center shield -->
        <div class="shield-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="#E30613" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            <path d="M9 12l2 2 4-4" stroke="#f87171" stroke-width="1.5"/>
          </svg>
        </div>

        <!-- Corner nodes -->
        <div class="node node-1">
          <svg class="node-icon" viewBox="0 0 24 24" fill="none" stroke="#E30613" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
          </svg>
          <span class="node-label">AQV</span>
        </div>
        <div class="node node-2">
          <svg class="node-icon" viewBox="0 0 24 24" fill="none" stroke="#E30613" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
          </svg>
          <span class="node-label">Professor</span>
        </div>
        <div class="node node-3">
          <svg class="node-icon" viewBox="0 0 24 24" fill="none" stroke="#E30613" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
          </svg>
          <span class="node-label">Portaria</span>
        </div>
        <div class="node node-4">
          <svg class="node-icon" viewBox="0 0 24 24" fill="none" stroke="#E30613" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.22 1.18C.22.6.72.08 1.36.02h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L5.85 7.44a16 16 0 006.73 6.73l.82-.82a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
          </svg>
          <span class="node-label">Responsável</span>
        </div>

        <!-- SVG connector lines -->
        <svg class="visual-svg" viewBox="0 0 520 520" xmlns="http://www.w3.org/2000/svg">
          <line x1="260" y1="80" x2="260" y2="185" stroke="rgba(227,6,19,0.25)" stroke-width="1" stroke-dasharray="4,4"/>
          <line x1="336" y1="260" x2="435" y2="260" stroke="rgba(227,6,19,0.25)" stroke-width="1" stroke-dasharray="4,4"/>
          <line x1="260" y1="336" x2="260" y2="440" stroke="rgba(227,6,19,0.25)" stroke-width="1" stroke-dasharray="4,4"/>
          <line x1="184" y1="260" x2="85" y2="260" stroke="rgba(227,6,19,0.25)" stroke-width="1" stroke-dasharray="4,4"/>
        </svg>
      </div>
    </div>
  </section>

  <!-- STATS -->
  <div class="stats">
    <div class="stat">
      <div class="stat-num"><span>100</span>%</div>
      <div class="stat-label">Processos Digitais</div>
    </div>
    <div class="stat">
      <div class="stat-num">Tempo<span> real</span></div>
      <div class="stat-label">Notificações automáticas</div>
    </div>
    <div class="stat">
      <div class="stat-num"><span>4</span> etapas</div>
      <div class="stat-label">Fluxo de autorização</div>
    </div>
    <div class="stat">
      <div class="stat-num">Zero<span> papel</span></div>
      <div class="stat-label">Autorização documentada</div>
    </div>
  </div>

  <!-- FEATURES -->
  <section class="features" id="features">
    <div class="section-eyebrow">Funcionalidades</div>
    <h2 class="section-title">Como o SAFE <span>protege</span><br>os alunos do SENAI</h2>

    <div class="cards">
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
        <h3>Autorização digital</h3>
        <p>AQV cria autorizações digitais com validade controlada, histórico e rastreamento para cada aluno individualmente.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
          </svg>
        </div>
        <h3>Controle por sala</h3>
        <p>Professor valida e confirma a saída do aluno diretamente no sistema antes que a portaria libere a passagem.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
          </svg>
        </div>
        <h3>Notificação imediata</h3>
        <p>Responsáveis recebem email automático no momento exato da movimentação, com todos os detalhes da ocorrência.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
          </svg>
        </div>
        <h3>Registro completo</h3>
        <p>Histórico detalhado e auditável de todas as movimentações com horário, responsável e status em tempo real.</p>
      </div>
    </div>
  </section>

  <!-- FLOW -->
  <div class="flow" id="flow">
    <div class="flow-inner">
      <div class="section-eyebrow">Passo a passo</div>
      <h2 class="section-title">Fluxo de <span>autorização</span></h2>

      <div class="steps">
        <div class="step">
          <div class="step-num">01</div>
          <h4>AQV</h4>
          <p>Cria a autorização digital com prazo e motivo</p>
        </div>
        <div class="step-arrow">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7"/>
          </svg>
        </div>
        <div class="step">
          <div class="step-num">02</div>
          <h4>Professor</h4>
          <p>Valida e libera o aluno da sala de aula</p>
        </div>
        <div class="step-arrow">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7"/>
          </svg>
        </div>
        <div class="step">
          <div class="step-num">03</div>
          <h4>Portaria</h4>
          <p>Registra a saída e confirma no sistema</p>
        </div>
        <div class="step-arrow">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7"/>
          </svg>
        </div>
        <div class="step">
          <div class="step-num">04</div>
          <h4>Responsável</h4>
          <p>Recebe notificação imediata por email</p>
        </div>
      </div>
    </div>
  </div>

  <!-- CTA -->
  <section class="cta-section">
    <div class="cta-inner">
      <div>
        <div class="cta-tag">Acesso ao sistema</div>
        <h2>Pronto para começar?</h2>
        <p>Acesse o painel administrativo e gerencie autorizações, alunos, professores e registros de forma centralizada e segura.</p>
      </div>
      <a class="btn-primary" href="{{ route('filament.admin.auth.login') }}" style="white-space: nowrap;">
        Acessar o sistema
      </a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-brand">
      <div class="footer-logo">
        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
      </div>
      <span class="footer-name">SAFE</span>
      <p style="margin-left:8px; font-size:11px; color:var(--text-3);">· Sistema de Autorização e Fluxo Escolar</p>
    </div>
    <div class="footer-credits">
      <span>SENAI Limeira</span> · Desenvolvido por @jggoncalez
    </div>
  </footer>

</div>
</body>
</html>