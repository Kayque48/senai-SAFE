<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SAFE — Login | SENAI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  @vite(['resources/css/filament-custom.css'])
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    
    :root {
      --bg: #09090b;
      --bg-surface: #1a1a2e;
      --bg-secondary: #16213e;
      --red: #E30613;
      --red-dark: #b0041a;
      --text-1: #f4f4f5;
      --text-2: #a1a1aa;
      --text-3: #71717a;
      --border: rgba(255,255,255,0.08);
      --border-hover: rgba(255,255,255,0.12);
      --glass: rgba(22,33,62,0.4);
    }

    html, body {
      width: 100%;
      height: 100%;
    }

    body {
      font-family: 'Inter', system-ui, -apple-system, sans-serif;
      background: linear-gradient(135deg, #09090b 0%, #1a1a2e 50%, #16213e 100%);
      color: var(--text-1);
      overflow: hidden;
      position: relative;
    }

    /* Grid background */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
      background-size: 40px 40px;
      pointer-events: none;
      z-index: 0;
    }

    /* Glow effects */
    body::after {
      content: '';
      position: fixed;
      width: 800px;
      height: 800px;
      top: -200px;
      right: -300px;
      background: radial-gradient(circle, rgba(227,6,19,0.06) 0%, transparent 70%);
      pointer-events: none;
      z-index: 0;
    }

    .login-container {
      position: relative;
      z-index: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      height: 100%;
      padding: 2rem;
    }

    .login-card {
      width: 100%;
      max-width: 420px;
      background: var(--glass);
      backdrop-filter: blur(40px);
      -webkit-backdrop-filter: blur(40px);
      border: 1px solid var(--border);
      padding: 3.5rem;
      position: relative;
      box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    }

    /* Top accent line */
    .login-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, var(--red), transparent);
      opacity: 0.5;
    }

    .login-header {
      text-align: center;
      margin-bottom: 2.5rem;
    }

    .login-logo {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 48px;
      height: 48px;
      background: var(--red);
      margin: 0 auto 1rem;
      box-shadow: 0 4px 16px rgba(227,6,19,0.25);
    }

    .login-logo svg {
      width: 28px;
      height: 28px;
      stroke: white;
      stroke-width: 2;
      fill: none;
    }

    .login-title {
      font-size: 26px;
      font-weight: 800;
      letter-spacing: -0.5px;
      margin-bottom: 0.5rem;
      color: var(--text-1);
    }

    .login-subtitle {
      font-size: 13px;
      color: var(--text-2);
      font-weight: 500;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .login-form {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      margin-top: 2rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .form-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
      color: var(--text-2);
      text-transform: uppercase;
    }

    .form-input {
      background: rgba(255,255,255,0.03);
      border: 1px solid var(--border);
      padding: 12px 16px;
      color: var(--text-1);
      font-size: 14px;
      font-family: inherit;
      transition: all 0.2s ease;
    }

    .form-input::placeholder {
      color: var(--text-3);
    }

    .form-input:focus {
      outline: none;
      background: rgba(255,255,255,0.06);
      border-color: var(--red);
      box-shadow: 0 0 0 3px rgba(227,6,19,0.1);
    }

    .form-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 12px;
      margin-top: 0.5rem;
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--text-2);
      cursor: pointer;
    }

    .remember-me input[type="checkbox"] {
      width: 16px;
      height: 16px;
      cursor: pointer;
      accent-color: var(--red);
    }

    .forgot-password {
      color: var(--red);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }

    .forgot-password:hover {
      color: #f87171;
    }

    .form-submit {
      background: var(--red);
      color: white;
      border: none;
      padding: 14px 24px;
      font-size: 14px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      cursor: pointer;
      transition: all 0.2s ease;
      margin-top: 1rem;
      position: relative;
      overflow: hidden;
    }

    .form-submit::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, transparent, rgba(255,255,255,0.1));
      opacity: 0;
      transition: opacity 0.2s;
    }

    .form-submit:hover {
      background: var(--red-dark);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(227,6,19,0.3);
    }

    .form-submit:hover::before {
      opacity: 1;
    }

    .form-submit:active {
      transform: translateY(0);
    }

    .login-footer {
      text-align: center;
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid var(--border);
      font-size: 12px;
      color: var(--text-3);
    }

    .login-footer a {
      color: var(--red);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }

    .login-footer a:hover {
      color: #f87171;
    }

    .error-message {
      background: rgba(227,6,19,0.15);
      border: 1px solid rgba(227,6,19,0.3);
      color: #fca5a5;
      padding: 12px 16px;
      border-radius: 0;
      font-size: 13px;
      margin-bottom: 1.5rem;
    }

    .back-to-home {
      position: absolute;
      top: 2rem;
      left: 2rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--text-2);
      text-decoration: none;
      font-size: 12px;
      font-weight: 600;
      transition: all 0.2s;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .back-to-home:hover {
      color: var(--red);
      transform: translateX(-4px);
    }

    .back-to-home svg {
      width: 16px;
      height: 16px;
      stroke: currentColor;
      stroke-width: 2;
    }

    /* Responsive */
    @media (max-width: 640px) {
      .login-card {
        padding: 2rem;
      }

      .login-container {
        padding: 1rem;
      }

      .login-title {
        font-size: 22px;
      }

      .back-to-home {
        top: 1rem;
        left: 1rem;
        font-size: 11px;
      }
    }
  </style>
</head>
<body>
  <a href="/" class="back-to-home">
    <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path d="M19 12H5M12 19l-7-7 7-7"/>
    </svg>
    Voltar
  </a>

  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <div class="login-logo">
          <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            <path d="M9 12l2 2 4-4" stroke-width="2"/>
          </svg>
        </div>
        <h1 class="login-title">SAFE</h1>
        <p class="login-subtitle">Sistema de Autorização e Fluxo Escolar</p>
      </div>

      @if ($this->hasErrorBags())
        <div class="error-message">
          @foreach ($this->getErrorBags() as $bag)
            @foreach ($bag->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          @endforeach
        </div>
      @endif

      <form class="login-form" wire:submit="authenticate">
        <div class="form-group">
          <label class="form-label" for="email">E-mail</label>
          <input
            class="form-input"
            id="email"
            type="email"
            wire:model="email"
            placeholder="seu@email.com"
            autofocus
            autocomplete="email"
            required
          />
          @error('email')
            <span class="error-message" style="margin-top: 0.5rem; margin-bottom: 0;">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Senha</label>
          <input
            class="form-input"
            id="password"
            type="password"
            wire:model="password"
            placeholder="Sua senha segura"
            autocomplete="current-password"
            required
          />
          @error('password')
            <span class="error-message" style="margin-top: 0.5rem; margin-bottom: 0;">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-actions">
          <label class="remember-me">
            <input type="checkbox" wire:model="remember" />
            <span>Lembrar-me</span>
          </label>
        </div>

        <button type="submit" class="form-submit" wire:loading.attr="disabled">
          <span wire:loading.remove>Acessar o Sistema</span>
          <span wire:loading>Carregando...</span>
        </button>
      </form>

      <div class="login-footer">
        Problemas para entrar? <a href="#">Contate o suporte</a>
      </div>
    </div>
  </div>
</body>
</html>