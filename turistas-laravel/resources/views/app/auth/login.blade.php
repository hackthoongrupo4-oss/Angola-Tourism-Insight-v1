 @extends('app.auth.templete')
@section('title', 'Login')

@section('content')
<style>
    :root{
        --lilac-500: #7f6df2;
        --lilac-600: #6b5de0;
        --muted: #6b5ca6;
        --bg-grad-start: #fbf8ff;
        --bg-grad-end: #ffffff;
    }

    body {
        background: linear-gradient(180deg, var(--bg-grad-start) 0%, var(--bg-grad-end) 60%);
    }

    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .auth-card {
        width: 100%;
        max-width: 520px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(69,56,160,0.08);
        border: 1px solid rgba(127,109,242,0.06);
        background: linear-gradient(180deg, #ffffff 0%, #fbf8ff 100%);
    }

    .auth-card .card-body{
        padding: 2.2rem;
    }

    /* Logo (svg + text) */
    .brand-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        justify-content: center;
    }
    .brand-mark {
        width: 64px;
        height: 64px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--lilac-500), var(--lilac-600));
        box-shadow: 0 8px 24px rgba(127,109,242,0.15);
    }
    .brand-mark svg { width: 36px; height: 36px; color: #fff; }

    .brand-text {
        font-weight: 700;
        font-size: 1.25rem;
        color: var(--lilac-600);
        letter-spacing: 0.2px;
    }
    .brand-sub {
        font-size: 0.8rem;
        color: var(--muted);
    }

    h1.auth-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #2b135d;
        margin-top: 0.6rem;
        text-align: center;
    }

    .form-footer small {
        color: var(--muted);
    }

    .btn-primary {
        background: linear-gradient(90deg,var(--lilac-500),var(--lilac-600));
        border: none;
    }

    .show-password-toggle {
        cursor: pointer;
        user-select: none;
    }

    @media (max-width: 576px) {
        .auth-card { margin: 0 1rem; }
        .brand-mark { width: 56px; height: 56px; }
    }
</style>

<div class="auth-wrapper">
    <div class="card auth-card">
        <div class="card-body">
            <div class="text-center mb-3">
                <!-- Logo: marca SVG + texto do sistema -->
                <a href="{{ url('/') }}" class="brand-logo text-decoration-none">
                    <div class="brand-mark">
                        <!-- Ícone simples (map + gráfico) -->
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M3 6c0-1.1.9-2 2-2h4l2 2h6a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H9l-2 2H5a2 2 0 0 1-2-2V6z" fill="#FFFFFF" opacity="0.06"/>
                            <path d="M6 8c0-1.1.9-2 2-2h2" stroke="#fff" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="9" y="10" width="2" height="6" rx="1" fill="#fff"/>
                            <rect x="13" y="8" width="2" height="8" rx="1" fill="#fff"/>
                            <rect x="17" y="12" width="2" height="4" rx="1" fill="#fff"/>
                        </svg>
                    </div>

                    <div class="text-start">
                        <div class="brand-text">Angola Tourism Insight</div>
                        <div class="brand-sub">Previsões & Gestão Turística</div>
                    </div>
                </a>
            </div>

            <h1 class="auth-title">Entrar na plataforma</h1>

            {{-- Erros --}}
            @if ($errors->any())
                <div class="alert alert-danger mt-3 mb-2">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="post" class="mt-3" onsubmit="this.querySelector('button[type=submit]').disabled=true;">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label small">Email</label>
                    <input type="email"
                           name="email"
                           id="email"
                           value="{{ old('email') }}"
                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                           placeholder="seu-email@exemplo.com"
                           required
                           autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 position-relative">
                    <label for="password" class="form-label small">Password</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                           placeholder="Digite a sua password"
                           required>
                    <div class="position-absolute" style="right:12px;top:38px;">
                        <small class="text-muted show-password-toggle" id="togglePassword" title="Mostrar/Ocultar password">Mostrar</small>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="text-end mt-2">
                        <a href="{{ route('password.request') }}" class="small link-secondary">Esqueceu-se da password?</a>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label small" for="remember">Lembrar-me</label>
                    </div>

                
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100">Entrar</button>
                </div>

                <div class="text-center small text-muted">
                    <div>ou aceda com</div>
                </div>

                <div class="d-flex gap-2 justify-content-center mt-3">
                    <!-- Placeholders para social auth ou quick links -->
                    <a href="#" class="btn btn-outline-secondary btn-sm" style="min-width:120px;" onclick="return false;">Google</a>
                    <a href="#" class="btn btn-outline-secondary btn-sm" style="min-width:120px;" onclick="return false;">Gov SSO</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    (function(){
        const pass = document.getElementById('password');
        const toggle = document.getElementById('togglePassword');
        if(toggle && pass){
            toggle.addEventListener('click', function(){
                if(pass.type === 'password'){
                    pass.type = 'text';
                    toggle.innerText = 'Ocultar';
                } else {
                    pass.type = 'password';
                    toggle.innerText = 'Mostrar';
                }
            });
        }
    })();
</script>
@endsection
