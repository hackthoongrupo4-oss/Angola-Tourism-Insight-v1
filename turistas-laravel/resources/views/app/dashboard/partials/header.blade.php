 <!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="/" class="app-brand-link d-flex align-items-center gap-2">
       
      <div class="d-none d-xl-block">
        <div class="fw-bold text-primary" style="font-size:1rem;">Angola Tourism Insight</div>
        <div class="small text-muted">Previsões & Gestão</div>
      </div>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none" aria-label="Toggle menu">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
      <a href="{{ url('/') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Página Inicial">
        <i class="menu-icon tf-icons bx bx-home-alt" aria-hidden="true"></i>
        <div data-i18n="Home">Página Inicial</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('dashboard*') ? 'active' : '' }}">
      <a href="{{ url('/dashboard1') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Painel de controlo">
        <i class="menu-icon tf-icons bx bx-bar-chart-alt-2" aria-hidden="true"></i>
        <div data-i18n="Analytics">Painel</div>
      </a>
    </li>

    @role('admin')
    <!-- Sugestões -->
    <li class="menu-item {{ request()->is('sugestaos*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle" aria-expanded="{{ request()->is('sugestaos*') ? 'true' : 'false' }}">
        <i class="menu-icon tf-icons bx bx-bulb" aria-hidden="true"></i>
        <div data-i18n="Sugestoes">Tipos de Sugestões</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('sugestaos') ? 'active' : '' }}">
          <a href="{{ route('sugestaos.index') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Lista de sugestões">
            <i class="bx bx-list-ul me-1"></i>
            <div data-i18n="List">Sugestões</div>
          </a>
        </li>
      </ul>
    </li>

    <!-- Provincias -->
    <li class="menu-item {{ request()->is('provincias*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle" aria-expanded="{{ request()->is('provincias*') ? 'true' : 'false' }}">
        <i class="menu-icon tf-icons bx bx-map" aria-hidden="true"></i>
        <div data-i18n="Provincias">Províncias</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('provincias') ? 'active' : '' }}">
          <a href="{{ route('provincias.index') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Lista de províncias">
            <i class="bx bx-list-ul me-1"></i>
            <div data-i18n="List">Lista</div>
          </a>
        </li>
      </ul>
    </li>

    <!-- Previsões admin -->
    <li class="menu-item {{ request()->is('previsoes2*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle" aria-expanded="{{ request()->is('previsoes2*') ? 'true' : 'false' }}">
        <i class="menu-icon tf-icons bx bx-calendar-check" aria-hidden="true"></i>
        <div data-i18n="Previsoes">Previsões</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('previsoes2/create') ? 'active' : '' }}">
          <a href="{{ route('previsoes2.create') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Criar previsão">
            <i class="bx bx-plus-circle me-1"></i>
            <div>Criar</div>
          </a>
        </li>
        <li class="menu-item {{ request()->is('previsoes2') ? 'active' : '' }}">
          <a href="{{ route('previsoes2.index') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Históricos de previsões">
            <i class="bx bx-history me-1"></i>
            <div>Históricos</div>
          </a>
        </li>
      </ul>
    </li>



    <li class="menu-item {{ request()->is('arquivos2*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle" aria-expanded="{{ request()->is('arquivos2*') ? 'true' : 'false' }}">
        <i class="menu-icon tf-icons bx bx-calendar-event" aria-hidden="true"></i>
        <div data-i18n="Previsoes">Arquivos</div>
      </a>
      <ul class="menu-sub">
       
        

         <li class="menu-item {{ request()->is('arquivos2/index') ? 'active' : '' }}">
          <a href="{{ route('arquivos2.index') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Historico de arquivos">
            <i class="bx bx-plus-circle me-1"></i>
            <div>Historico</div>
          </a>
        </li>
      </ul>
    </li>
    @endrole

    @role('gestor')
    <!-- Previsões gestor -->
    <li class="menu-item {{ request()->is('previsoes*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle" aria-expanded="{{ request()->is('previsoes*') ? 'true' : 'false' }}">
        <i class="menu-icon tf-icons bx bx-calendar-event" aria-hidden="true"></i>
        <div data-i18n="Previsoes">Previsões</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('previsoes/create') ? 'active' : '' }}">
          <a href="{{ route('previsoes.create') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Criar previsão">
            <i class="bx bx-plus-circle me-1"></i>
            <div>Criar</div>
          </a>
        </li>
        <li class="menu-item {{ request()->is('previsoes') ? 'active' : '' }}">
          <a href="{{ route('previsoes.index') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Ver históricos">
            <i class="bx bx-folder-open me-1"></i>
            <div>Históricos</div>
          </a>
        </li>
      </ul>
    </li>
    @endrole



        @role('prestador')
    <!-- Previsões gestor -->
    <li class="menu-item {{ request()->is('arquivos*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle" aria-expanded="{{ request()->is('arquivos*') ? 'true' : 'false' }}">
        <i class="menu-icon tf-icons bx bx-calendar-event" aria-hidden="true"></i>
        <div data-i18n="Previsoes">Arquivos</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('arquivos/create') ? 'active' : '' }}">
          <a href="{{ route('arquivos.create') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Criar arquivo">
            <i class="bx bx-plus-circle me-1"></i>
            <div>Criar</div>
          </a>
        </li>
        

         <li class="menu-item {{ request()->is('arquivos/index') ? 'active' : '' }}">
          <a href="{{ route('arquivos.index') }}" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Historicos">
            <i class="bx bx-plus-circle me-1"></i>
            <div>Historico</div>
          </a>
        </li>
      </ul>
    </li>
    @endrole

    <!-- Perfil & Ajuda -->
     

    <li class="menu-item">
      <a href="" class="menu-link" data-bs-toggle="tooltip" data-bs-placement="right" title="Ajuda e Documentação">
        <i class="menu-icon tf-icons bx bx-book-bookmark" aria-hidden="true"></i>
        <div>Ajuda</div>
      </a>
    </li>

  </ul>
</aside>

<!-- Estilos extras para menu (adicionar ao teu ficheiro de estilos se preferires) -->
<style>
  /* Ícones com cor consistente e destaque no hover/activo */
  .menu-inner .menu-link { color: #2b135d; }
  .menu-inner .menu-icon { font-size: 1.25rem; display:inline-flex; align-items:center; justify-content:center; width:34px; height:34px; border-radius:8px; }
  .menu-inner .menu-item.active > .menu-link,
  .menu-inner .menu-item.open > .menu-link { background: linear-gradient(90deg, rgba(127,109,242,0.12), rgba(107,93,224,0.06)); border-radius:8px; }
  .menu-inner .menu-link:hover .menu-icon { transform: translateY(-2px); transition: transform .15s ease; }
  .menu-inner .menu-sub .menu-link .bx { font-size: 1rem; margin-right:6px; color: #6b5de0; }
  .menu-inner .menu-link[aria-current="page"] { font-weight:600; }
</style>

<!-- Inicialização de tooltips (Bootstrap 5) -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });
</script>
