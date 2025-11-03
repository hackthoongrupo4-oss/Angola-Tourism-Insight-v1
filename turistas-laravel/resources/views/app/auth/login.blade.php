 @extends('app.auth.templete')
@section('title', 'Login')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4 shadow" style="width: 100%; max-width: 500px;">
              <div class="text-center mb-4">
                <a href="/">
                    <img src="/geral/img/logo.png" alt="Logo" style="max-height: 80px;">
                </a>
            </div>
            <div class="text-center mb-4">
                <h1>Entrar</h1>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="post" onsubmit="this.querySelector('button').disabled=true;">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Digite o seu melhor email" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Digite a tua password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="text-end mt-1">
                            <a href="{{ route('password.request') }}" class="link-secondary text-decoration-none">
                                Esqueceu-se da password?
                            </a>
                        </div>
                    </div>

                    <button class="btn btn-secondary w-100 mb-3" type="submit">
                        Entrar
                    </button>

                    <div class="text-center">
                        <span class="d-inline">Ainda não tem uma conta?</span>
                        <a href="{{ route('register') }}" class="link-secondary ">
                            Registrar
                        </a>
                    </div>
                     <div class="mt-2">
                                   <span class="link-secondary text-decoration-none"><a href="/">Pagina Inicial</a></span>
                            </div>
                </form>
            </div>
        </div>
    </div>
@endsection
