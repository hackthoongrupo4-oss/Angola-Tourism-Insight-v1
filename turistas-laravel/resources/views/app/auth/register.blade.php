@extends('app.auth.templete')
@section('title', 'Cadastrar')

@section('content')
<div class="container p-4 d-flex justify-content-center">
    <div class="row w-auto">
        <div class="col-12">
               <div class="text-center mb-4">
                <a href="/">
                    <img src="/geral/img/logo.png" alt="Logo" style="max-height: 80px;">
                </a>
            </div>
            <div class="login-container text-center">
                <h1>Registrar</h1>
            </div>
        </div>

        <div class="col-12 container-login">
            <div class="card p-4 shadow">
                <div class="card-body">
               
                    <form action="{{ route('register') }}" method="POST" onsubmit="this.querySelector('button').disabled=true;">
                        @csrf

                        <!-- Nome Completo -->
                        <div class="mb-3 container-email">
                            <label for="name" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Digite o seu nome completo"  minlength="4" required
         pattern="^[^\s].{3,}$"
         title="O nome deve ter pelo menos 4 caracteres e não pode começar com espaço.">
                            @if($errors->has('name'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <!-- Email -->
                        <div class="mb-3 container-email">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Digite o seu melhor email" required>
                            @if($errors->has('email'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                       

                     
                     <div class="mb-3 row">
                                    <div class="mb-3 col-6">
                                        <label for="provincia" class="form-label">Província <span class="mandatorio text-danger">*</span></label>
                                        <select class="form-control" id="provincia" name="provincia_id" required>
                                            <option selected disabled>Seleciona a província</option>
                                            @foreach($provincias as $provincia)
                                                <option value="{{ $provincia->id }}">{{ $provincia->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label for="municipio" class="form-label">Município <span class="mandatorio text-danger">*</span></label>
                                        <select class="form-control" id="municipio" name="municipio_id" required>
                                            <option selected disabled>Seleciona o município</option>
                                        </select>
                                    </div>
                                </div>
                        <!-- Senha -->
                        <div class="mb-3 container-password">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Digite a tua password" required>
                            @if($errors->has('password'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <!-- Confirmar Senha -->
                        <div class="mb-3 container-password">
                            <label for="password_confirmation" class="form-label">Confirmar Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirme a tua password" required>
                            @if($errors->has('password_confirmation'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>
                        <div class="mb-3 container-password">
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" id="checkb" name="checkando">
                            <label class="form-check-label" for="show_password">Cadastrar Como Prestador?</label>
                        </div>
                    </div>
                        
                        <div id="organizador">

                        </div>

                        <!-- Botão de Registro -->
                        <div class="container-login-button">
                            <button class="btn btn-secondary w-100" type="submit">Registrar</button>

                            <div class="mt-2">
                                <span class="link-secondary text-decoration-none">Já tem uma conta?</span>
                                <a href="{{ route('login') }}" class="link-secondary ">Entrar</a>
                                  </div>
                              <div class="mt-2">
                                   <span class="link-secondary text-decoration-none"><a href="/">Pagina Inicial</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
<script>
        document.getElementById('provincia').addEventListener('change',function(){
            const provinciaId=this.value;
            fetch(`/municipios/${provinciaId}`)
            .then(response=>response.json())
            .then(data=>{
                let municipioSelect=document.getElementById('municipio')
                municipioSelect.innerHTML='<option selected>Seleciona o município</option>';
                data.forEach(municipio=>{
                    let option =document.createElement('option')
                    option.value=municipio.id
                    option.text=municipio.nome
                    municipioSelect.appendChild(option)
                })
            })
        })
</script>
<script>




    document.getElementById("checkb").addEventListener("change",function(){
        if(this.checked){
            document.getElementById("organizador").innerHTML=`    <div class="mb-3 container-password">
                     <label for="categoria_evento" class="form-label">Whatsap</label>
                      <input type="text" class="form-control" id="telefone1" name="telefone1" 
                       required minlength="9" maxlength="9" pattern="[0-9]{9}" title="O telefone deve ter exatamente 9 dígitos numéricos"  >                 
                    
                    </div>
        
                    
                    <div class="mb-3 container-password">
                     <label for="categoria_evento" class="form-label">Nº para chamadas</label>
                      <input type="text" class="form-control" id="telefone2" name="telefone2" 
                       required minlength="9" maxlength="9" pattern="[0-9]{9}" title="O telefone deve ter exatamente 9 dígitos numéricos"  >                 
                    
                    </div>
                    `
                    
                    ;
        }else{
            document.getElementById("organizador").innerHTML=``;
        }
    })
</script>

<script>
    document.getElementById('telefone1').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove qualquer caractere que não seja número
        if (value.length > 9) {
            value = value.substring(0, 9); // Limita a 9 caracteres
        }
        e.target.value = value;
    });
    </script>
     <script>
    document.getElementById('telefone2').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove qualquer caractere que não seja número
        if (value.length > 9) {
            value = value.substring(0, 9); // Limita a 9 caracteres
        }
        e.target.value = value;
    });
    </script>
@endsection
