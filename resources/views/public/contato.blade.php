@extends('public.layouts.layout_base')

@section('title', 'Contato')

@section('conteudo')

    <!-- Navbar -->
    @include('public.layouts.partials.navbar')

    <!-- Header -->
    @component('public.layouts.components.header', [
        'title' => 'Entre em Contato',
        'description' => 'Estamos aqui para responder às suas dúvidas e oferecer suporte!',
        'showButton' => false,
    ])
    @endcomponent

    <!-- Formulário de Contato -->
    <section class="pt-4">
        <div class="container px-lg-5">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <!--Mensagem de Sucesso ao Enviar o Formulário-->
                    @if (session('success'))
                        <!--Verifica a existência da variável success-->
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!--Os valores escritos pelo usuário são enviados para o método index do ContatoController. O atributo id é usado para associar o rótulo (label) ao campo de entrada correspondente, melhorando a acessibilidade e a usabilidade do formulário.-->
                    <form action=" {{ route('contato') }}" method="post">
                        @csrf
                        <!--O token CSRF é um mecanismo de segurança que protege contra ataques de falsificação de solicitação entre sites. Ele é gerado pelo Laravel e incluído em formulários para garantir que as solicitações sejam legítimas e venham do próprio site.-->
                        <div class="mb-4">
                            <label for="nome" class="form-label">Nome</label>
                            <!--O atributo name é usado para identificar o campo de entrada e enviar os dados para o servidor quando o formulário é submetido. O atributo required indica que o campo é obrigatório e deve ser preenchido antes de enviar o formulário.-->
                            <input name="nome" value="{{ old('nome') }}" type="text" class="form-control"
                                id="nome" placeholder="Seu nome">
                            <div class='text-danger'>{{ $errors->has('nome') ? $errors->first('nome') : '' }}</div>
                            <!--Se houver um erro de validação no campo nome exibe uma mensagem de erro. Caso contrário, exibe uma string vazia.-->
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">E-mail</label>
                            <!--O atributo value é usado para definir o valor inicial do campo de entrada. A função old('email') do Laravel retorna o valor antigo do campo email, caso tenha havido um erro de validação e o formulário tenha sido redirecionado de volta para a página. Isso permite que o usuário veja o valor que ele havia digitado anteriormente, facilitando a correção dos erros sem precisar preencher novamente todos os campos.-->
                            <input name="email" value="{{ old('email') }}" type="email" class="form-control"
                                id="email" placeholder="Seu e-mail">
                            <div class='text-danger'>{{ $errors->has('email') ? $errors->first('email') : '' }}</div>
                        </div>
                        <div class="mb-4">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input name="telefone" value="{{ old('telefone') }}" type="tel" class="form-control"
                                id="telefone" placeholder="Seu telefone">
                            <div class='text-danger'>{{ $errors->has('telefone') ? $errors->first('telefone') : '' }}</div>
                        </div>
                        <div class="mb-4">
                            <label for="motivo_id" class="form-label">Qual é o motivo do contato?</label>
                            <select name="motivo_id" class="form-select" id="motivo_id">
                                @foreach ($motivos as $motivo)
                                    <option value={{ $motivo->id }}
                                        {{ old('motivo_id') == $motivo->id ? 'selected' : '' }}>
                                        {{ $motivo->motivo }}</option>
                                @endforeach
                            </select>
                            <div class='text-danger'>{{ $errors->has('motivo_id') ? $errors->first('motivo_id') : '' }}</div>
                        </div>
                        <div class="mb-4">
                            <label for="mensagem" class="form-label">Mensagem</label>
                            <textarea name="mensagem" value="{{ old('mensagem') }}" class="form-control" id="mensagem" rows="4"
                                placeholder="Sua mensagem"></textarea>
                            <div class='text-danger'>{{ $errors->has('mensagem') ? $errors->first('mensagem') : '' }}</div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-5">Enviar Mensagem</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Aplicação de máscara ao digitar no campo telefone -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#telefone').mask('(00) 00000-0000'); // Aplica a máscara de telefone

            $('form').on('submit', function(event) { // Limpa o campo de telefone antes de enviar o formulário
                var telefoneEl = $('#telefone');
                if (telefoneEl.length > 0) {
                    var telefoneLimpo = telefoneEl.val().replace(/\D/g,''); // Remove todos os caracteres não numéricos (como parênteses, espaço e hífen)
                    telefoneEl.val(telefoneLimpo); // Atualiza o valor do campo de telefone com apenas números
                }
            });
        });
    </script>

    <!-- Footer -->
    @include('public.layouts.partials.footer') <!--Inclui o conteúdo do arquivo footer.blade.php aqui-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection
