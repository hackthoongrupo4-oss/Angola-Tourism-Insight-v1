{{-- Adiciona no head (se ainda não tens) --}}
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
  :root{
    --lilac-500: #7f6df2;
    --lilac-600: #6b5de0;
    --muted: #6b5ca6;
  }

  .navbar-custom {
    background: linear-gradient(90deg, rgba(127,109,242,0.06), rgba(107,93,224,0.03));
    border-bottom: 1px solid rgba(107,93,224,0.06);
    backdrop-filter: blur(6px);
  }

  .navbar-brand {
    display:flex;
    gap:.6rem;
    align-items:center;
    font-weight:700;
    color:var(--lilac-600) !important;
  }

  .brand-mark {
    width:40px; height:40px; border-radius:8px;
    background: linear-gradient(135deg,var(--lilac-500),var(--lilac-600));
    display:inline-flex; align-items:center; justify-content:center;
    color:#fff; box-shadow: 0 6px 18px rgba(107,93,224,0.12);
  }

  .nav-link { color: #2e2a57; }
  .nav-link:hover { color: var(--lilac-600); }

  .btn-primary-gradient {
    background: linear-gradient(90deg,var(--lilac-500),var(--lilac-600));
    border: none;
    box-shadow: 0 6px 18px rgba(107,93,224,0.12);
  }

  /* Mega dropdown */
  .mega-menu { width: 720px; max-width: calc(100vw - 48px); }
  .mega-menu .col a { display:block; padding:.25rem 0; color:#222; }
  .mega-menu .col a small { display:block; color:var(--muted); }

  /* small avatar */
  .nav-avatar {
    width:36px; height:36px; border-radius:50%;
    object-fit:cover; border:2px solid #fff; box-shadow:0 4px 12px rgba(0,0,0,0.06);
  }

  /* subtle hover for action icons */
  .action-icon { transition: transform .12s ease, color .12s ease; }
  .action-icon:hover { transform: translateY(-3px); color:var(--lilac-600); }

  @media (max-width: 991px){
    .mega-menu { width:100%; }
  }
</style>

<nav class="navbar navbar-expand-lg navbar-custom shadow-sm py-2">
  <div class="container">

    <a class="navbar-brand" href="{{ url('/') }}">
      <span class="brand-mark" aria-hidden="true">
        <i class="bx bx-map-alt" style="font-size:18px;"></i>
      </span>
      <div class="d-none d-md-block">
        <div>Angola Tourism Insight</div>
        <small class="text-muted" style="font-size:.75rem;">Previsões & Gestão Turística</small>
      </div>
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
      <i class="bx bx-menu"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav me-auto align-items-lg-center">
        <li class="nav-item px-2">
          <a class="nav-link fw-medium" href="/#sobre">Sobre</a>
        </li>

        <li class="nav-item px-2">
          <a class="nav-link fw-medium" href="/#funcionalidades">Funcionalidades</a>
        </li>

 <li class="nav-item px-2">
          <a class="nav-link fw-medium" href="{{route('arquivos.lista')}}">Repositorios</a>
        </li>

        <li class="nav-item px-2">
          <a class="nav-link fw-medium" href="/#contacto">Contato</a>
        </li>
      </ul>

      <!-- Right side: search, notifications, auth -->
      <div class="d-flex align-items-center gap-2">

        <!-- Search (compact) -->
        <form class="d-flex me-2" role="search" action="">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-sm" type="search" name="q" placeholder="Pesquisar repositórios..." aria-label="Pesquisar">
            <button class="btn btn-outline-secondary" type="submit"><i class="bx bx-search"></i></button>
          </div>
        </form>

        <!-- Notifications -->
        

        @guest
          <a class="btn btn-outline-primary btn-sm me-1" href="{{ route('login') }}">Entrar</a>
          <a class="btn btn-primary-gradient btn-sm text-white" href="{{ route('create_user') }}">Registrar</a>
        @endguest

        @auth
          <!-- User dropdown -->
          <div class="nav-item dropdown">
            <a class="d-flex align-items-center text-decoration-none" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
               <div class="d-none d-lg-block text-start">
                <div class="small text-muted">Olá,</div>
                <div class="fw-semibold">{{ Str::limit(Auth::user()->name,18) }}</div>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ route('dashboard1') }}"><i class="bx bx-grid-alt me-2"></i> Painel</a></li>
                 <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="dropdown-item" type="submit"><i class="bx bx-power-off me-2"></i> Sair</button>
                </form>
              </li>
            </ul>
          </div>
        @endauth

      </div>
    </div>
  </div>
</nav>
