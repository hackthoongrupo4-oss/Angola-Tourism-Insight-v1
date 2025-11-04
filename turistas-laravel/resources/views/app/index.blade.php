<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angola Tourism Insight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f7f4ff 0%, #e6e0ff 100%);
            color: #4b3f72;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #ffffff !important;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .navbar-brand {
            font-weight: 600;
            color: #5c4b9d !important;
        }

        .btn-primary {
            background-color: #7f6df2;
            border: none;
        }

        .btn-primary:hover {
            background-color: #6b5de0;
        }

        .hero {
            text-align: center;
            padding: 100px 20px;
            background: linear-gradient(135deg, #ffffff 0%, #edeaff 100%);
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #4a3d94;
        }

        .hero p {
            font-size: 1.2rem;
            color: #6b5ca6;
            max-width: 700px;
            margin: 20px auto;
        }

        .features {
            padding: 80px 0;
            background-color: #fff;
        }

        .feature-box {
            background: #f8f6ff;
            border-radius: 15px;
            padding: 30px;
            transition: all 0.3s ease-in-out;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            background: #f0edff;
        }

        .footer {
            background-color: #6c5ce7;
            color: #fff;
            text-align: center;
            padding: 30px 10px;
        }

        .footer a {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Angola Tourism Insight</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#sobre">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="#funcionalidades">Funcionalidades</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto">Contato</a></li>
                    @guest
                    <li class="nav-item"><a class="btn btn-primary ms-3" href="{{ route('login') }}">Entrar</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero" id="sobre">
        <div class="container">
            <h1>Bem-vindo ao Angola Tourism Insight 🌍</h1>
            <p>
                Uma plataforma inteligente para análise e previsão do turismo em Angola.
                O sistema fornece informações sobre fluxos turísticos, desempenho regional e
                projeções baseadas em dados climáticos, econômicos e sazonais.
            </p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg mt-3">Começar Agora</a>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section class="features" id="funcionalidades">
        <div class="container text-center">
            <h2 class="mb-5 fw-bold text-dark">Funcionalidades Principais</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-box h-100">
                        <i class="bx bx-line-chart display-5 text-primary mb-3"></i>
                        <h5>Previsão Turística</h5>
                        <p>Analise o fluxo de turistas por província e período, com base em dados históricos e variáveis ambientais.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box h-100">
                        <i class="bx bx-map display-5 text-primary mb-3"></i>
                        <h5>Gestão de Províncias</h5>
                        <p>Visualize o desempenho turístico de cada região e associe gestores a províncias específicas.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box h-100">
                        <i class="bx bx-group display-5 text-primary mb-3"></i>
                        <h5>Gestão de Usuários</h5>
                        <p>Controle de acesso por perfis e permissões, garantindo segurança e gestão eficiente dos dados.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="py-5 text-center" id="contacto" style="background-color:#f5f3ff;">
        <div class="container">
            <h2 class="fw-bold mb-4">Fale Conosco</h2>
            <p class="mb-4 text-secondary">Quer saber mais sobre o projeto ou colaborar? Entre em contato!</p>
            <a href="mailto:info@angolainsight.com" class="btn btn-primary">Enviar Email</a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <p class="mb-0">&copy; {{ date('Y') }} Angola Tourism Insight. Todos os direitos reservados.</p>
        <small>Desenvolvido por <a href="#">Equipa de Projeto</a></small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
