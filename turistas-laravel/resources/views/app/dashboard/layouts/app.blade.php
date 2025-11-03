<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/dashboard/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/dashboard/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/dashboard/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/dashboard/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/dashboard/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/dashboard/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/dashboard/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/dashboard/assets/vendor/js/helpers.js"></script>

      <script src="/dashboard/assets/js/config.js"></script>
   <link rel="stylesheet" href="/dashboard/assets/css/toastr.min.css">
  </head>

  <body>
    @php
 
 use Illuminate\Support\Str;
@endphp
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
       
        @include('app.dashboard.partials.header')
        <!-- Layout container -->
        <div class="layout-page">
         
         @include('app.dashboard.partials.navbar')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            

          @yield('content')

          @include('app.dashboard.partials.footer')

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- / Layout wrapper -->

      <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Confirmação de Saida</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem a certeza de que deseja sair?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline"  onsubmit="this.querySelector('button').disabled=true;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Sair</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<!-- MODAL ÚNICO: Regras e Políticas -->
<div class="modal fade" id="modalRegras" tabindex="-1" aria-labelledby="modalRegrasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <!-- Cabeçalho -->
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold text-white" id="modalRegrasLabel">
                    📜 Regras e Políticas da Plataforma
                </h5>
                <button type="button" class="btn-close btn-close-danger" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <!-- Corpo -->
            <div class="modal-body">
                <!-- Assinatura -->
                <h6 class="fw-bold mb-3 text-black">📦 Assinatura de Planos</h6>
                <ul class="list-group mb-4">
                    <li class="list-group-item">Assim que um <strong>prestador se cadastrar pela primeira vez</strong>, o <strong>plano gratuito</strong> é ativado automaticamente.</li>
                    <li class="list-group-item">A assinatura de planos pagos é feita por meio de um <strong>código de recarga</strong>.</li>
                    <li class="list-group-item">
                        Para adquirir o código:
                        <br>
                        📞 <a href="tel:+244{{ $empresa->telefone1 ?? '938531896' }}" class="text-decoration-none">
                            <i class="fa fa-phone me-2"></i> +244 {{ $empresa->telefone1 ?? '938531896' }}
                        </a>
                        <br>
                        💬 <a href="https://wa.me/244{{ $empresa->telefone2 ?? '938531896' }}?text={{ urlencode('Olá, pretendo adquirir o código de recarga do plano "') }}" 
                              target="_blank" class="text-decoration-none">
                            <i class="fa fa-whatsapp me-2"></i> +244 {{ $empresa->telefone2 ?? '938531896' }}
                        </a>
                    </li>
                    <li class="list-group-item">Cada plano tem uma <strong>duração de 30 dias</strong>.</li>
                    <li class="list-group-item">Após expirar, o usuário é migrado para o <strong>plano gratuito</strong>.</li>
                    <li class="list-group-item">Ao assinar um novo plano diferente, o anterior é <strong>cancelado automaticamente</strong>.</li>
                    <li class="list-group-item">Cada plano tem um <strong>número limitado de serviços</strong>. Apenas o <strong>último plano</strong> oferece <strong>serviços ilimitados</strong>.</li>
                </ul>

                <!-- Serviços -->
                <h6 class="fw-bold mb-3 text-black">♻️ Serviços</h6>
                <ul class="list-group mb-4">
                    <li class="list-group-item">Tenha muita atenção ao cadastrar um serviço.</li>
                    <li class="list-group-item">Cada plano define o <strong>número máximo de serviços visíveis</strong> para todos os usuários. Se o limite for 4, apenas os 4 últimos serviços inseridos ou atualizados estarão visíveis.</li>
                    <li class="list-group-item">Os <strong>serviços mais recentes</strong> (inseridos ou atualizados) são sempre priorizados no <strong>topo</strong> da lista de visíveis.</li>
                    <li class="list-group-item">Se desejar que um serviço seja priorizado no topo, basta <strong>entrar nele e clicar em "Salvar alterações"</strong>, mesmo sem mudar nada.</li>
                    <li class="list-group-item">Uma vez cadastrado, o serviço contará nas estatísticas do plano, mesmo que seja <strong>eliminado</strong>.</li>
                    <li class="list-group-item">Cada plano também possui um <strong>número limitado de imagens por serviço</strong>. Portanto, a quantidade de <strong>fotos visíveis</strong> em cada serviço dependerá do limite de imagens permitido pelo plano.</li>
                </ul>

                <p class="small text-muted">
                    Em caso de dúvidas, entre em contato pelos meios acima ou consulte nossa página de Políticas da Plataforma.
                </p>
            </div>

            <!-- Rodapé -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/dashboard/assets/vendor/libs/popper/popper.js"></script>
    <script src="/dashboard/assets/vendor/js/bootstrap.js"></script>
    <script src="/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/dashboard/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/dashboard/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="/dashboard/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/dashboard/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="/dashboard/assets/js/toastr.min.js"></script>

        
@if (session('logout'))
<script>
    "use strict";
    var o = "rtl" === $("html").attr("data-textdirection");

        toastr.success("{{ session('logout') }}",
            '', {
                closeButton: !0,
                tapToDismiss: !0,
                progressBar: !0,
                positionClass: "toast-bottom-right",
                rtl: o
            }
        );
   
</script>
 @endif

@if (session('login'))
    <script>
        $(document).ready(function() {
            var o = $("html").attr("data-textdirection") === "rtl";
            toastr.success("{{ session('login') }}", "", {
                closeButton: true,
                tapToDismiss: true,
                progressBar: true,
                positionClass: "toast-bottom-right",
                rtl: o
            });
        });
    </script>
@endif

@if (session('success'))
    <script>
        $(document).ready(function() {
            var o = $("html").attr("data-textdirection") === "rtl";
            toastr.success("{{ session('success') }}", "", {
                closeButton: true,
                tapToDismiss: true,
                progressBar: true,
                positionClass: "toast-bottom-right",
                rtl: o
            });
        });
    </script>
@endif
@if (session('error'))
    <script>
        $(document).ready(function() {
            var o = $("html").attr("data-textdirection") === "rtl";
            toastr.error("{{ session('error') }}", "", {
                closeButton: true,
                tapToDismiss: true,
                progressBar: true,
                positionClass: "toast-bottom-right",
                rtl: o
            });
        });
    </script>
@endif
  </body>
</html>
