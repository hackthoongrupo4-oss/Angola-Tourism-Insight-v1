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
                    
                        
                        

                        <!-- Botão de Registro -->
                        <div class="container-login-button">
                            <button class="btn btn-secondary w-100" type="submit">Registrar</button>

                            <div class="mt-2">
                                <span class="link-secondary text-decoration-none">Já tem uma conta?</span>
                                <a href="{{ route('login') }}" class="link-secondary ">Entrar</a>
                                  </div>
                             
                        </div>
                    </form>