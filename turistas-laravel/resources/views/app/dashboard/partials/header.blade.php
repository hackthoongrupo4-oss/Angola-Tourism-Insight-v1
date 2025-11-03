 <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
        
 <a href="/" class="app-brand-link"> 

  @if( $empresa!=null &&   $empresa->logo)
                <img src="{{ asset('storage/'.$empresa->logo) }}" alt="Logo" class="img-fluid" style="max-height: 60px;" >
            @else
                <img src="/geral/img/logo.png" alt="Logo" class="img-fluid" style="max-height: 60px;">
            @endif

</a>


            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="/" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Pagina Inicial</div>
              </a>
        
            </li>
                  <li class="menu-item ">
              <a href="/dashboard1" class="menu-link">
                 <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                <div data-i18n="Analytics">Painel</div>
              </a>

            </li>
            @hasanyrole('prestador')
            <!-- Layouts -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                   <i class="menu-icon tf-icons bx bx-briefcase-alt-2"></i>
                <div data-i18n="Layouts">Serviços</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('servicos.create')}}" class="menu-link">
                    <div data-i18n="Without menu">Criar serviço</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{route('servicos.index')}}" class="menu-link">
                    <div data-i18n="Without navbar">Ver Serviços</div>
                  </a>
                </li>
                
              </ul>
            </li>

                       <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Layouts">Planos</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('planos.disponiveis')}}" class="menu-link">
                    <div data-i18n="Without menu">Disponiveis</div>
                  </a>
                </li>

                   <li class="menu-item">
                  <a href="{{route('plano.ativo')}}" class="menu-link">
                    <div data-i18n="Without menu">Ativo</div>
                  </a>
                </li>
                   <li class="menu-item">
                  <a href="{{route('assinaturas.minha')}}" class="menu-link">
                    <div data-i18n="Without menu">Historico</div>
                  </a>
                </li>
                
              </ul>
            </li>


            
                       <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Layouts">Tipos Destaques</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('prestador.tiposDestaque')}}" class="menu-link">
                    <div data-i18n="Without menu">Disponiveis</div>
                  </a>
                </li>

                    
                   <li class="menu-item">
                  <a href="{{route('prestador.historicoDestaque')}}" class="menu-link">
                    <div data-i18n="Without menu">Historico</div>
                  </a>
                </li>
                
              </ul>
            </li>
            @endhasanyrole

            @hasanyrole('admin|secret')
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Configurações</span>
            </li>

                      @hasanyrole('admin|secret')

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Account Settings">Categorias</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('categorias.index')}}" class="menu-link">
                    <div data-i18n="Account">Lista</div>
                  </a>
                </li>
               
                 
              </ul>
 
            </li>
            @endrole

  <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-dollar-circle"></i>
                <div data-i18n="Account Settings">Planos</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('planos.index')}}" class="menu-link">
                    <div data-i18n="Account">Lista</div>
                  </a>
                </li>
               
                 
              </ul>
            </li>

  <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
             <i class="menu-icon tf-icons bx bx-receipt"></i>
                <div data-i18n="Account Settings">Assinaturas</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('assinaturas.index')}}" class="menu-link">
                    <div data-i18n="Account">Lista</div>
                  </a>
                </li>
               
                 
              </ul>
            </li>

             <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-map"></i>
                <div data-i18n="Account Settings">Provincias</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('provincias.index')}}" class="menu-link">
                    <div data-i18n="Account">Lista</div>
                  </a>
                </li>
               
                 
              </ul>
            </li>


                        <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-star"></i>
                <div data-i18n="Account Settings">Destaques</div>
              </a>
             

                 <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('tipos_destaque.index')}}" class="menu-link">
                    <div data-i18n="Account">Tipos destaques</div>
                  </a>
                </li>
                              <li class="menu-item">
                  <a href="{{route('destaques2.index')}}" class="menu-link">
                    <div data-i18n="Account">Destaques</div>
                  </a>
                </li>
                 
              </ul>
            </li>

            @role('admin')

                  <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div data-i18n="Account Settings">Empresa</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('empresas.index')}}" class="menu-link">
                    <div data-i18n="Account">Listar</div>
                  </a>
                </li>
             
                 
              </ul>
            </li>

  @endrole
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div data-i18n="Account Settings">Prestadores</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('lista.prestadores')}}" class="menu-link">
                    <div data-i18n="Account">Listar</div>
                  </a>
                </li>
               
                 
              </ul>
            </li>


            @endhasanyrole
        

         @hasanyrole('admin|secret|prestador')
   <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                 <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div data-i18n="Account Settings">Regras</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href=""        data-bs-toggle="modal" data-bs-target="#modalRegras" class="menu-link">
                    <div data-i18n="Account">Ver regras</div>
                  </a>
                </li>
               
                 
              </ul>
            </li>
 @endhasanyrole
          </ul>
        </aside>
        <!-- / Menu -->