@extends('public.layouts.layout_base')

@section('title', 'Contato')

@section('conteudo')

    <!-- Navbar -->
    @include('public.layouts.partials.navbar')

    <!-- Header -->
    @component('public.layouts.components.header', [
        'title' => 'Login',
        'description' => '',
        'showButton' => false,
    ])
    @endcomponent

    <!-- Formulário de Login -->
    <div class="container d-flex justify-content-center align-items-center">
        <form class="col-md-3 mb-5" action="{{ route('login') }}" method="POST">
            @csrf
            <h3 class="fw-normal mb-5 text-center text-primary-color">Acesse sua conta</h3>
            <div class="mb-4">
                <input class="form-control" value="{{ old('email') }}" placeholder="E-mail" name="email" />
                <div class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</div>
                <!--Mantém o valor do campo email preenchido caso haja um erro de validação-->
            </div>
            <div class="mb-4">
                <input class="form-control" value="{{ old('senha') }}" type="password" placeholder="Senha"
                    name="senha" />
                <div class="text-danger">{{ $errors->has('senha') ? $errors->first('senha') : '' }}</div>
            </div>
            <button class="btn btn-primary mb-4 w-100" type="submit">Fazer Login</button>
            @if (session('mensagem_de_erro'))
                <div class="mb-4 text-center text-danger">
                    {{ session('mensagem_de_erro') }}
                </div>
            @endif
        </form>
    </div>

    <!-- Footer -->
    @include('public.layouts.partials.footer') <!--Inclui o conteúdo do arquivo footer.blade.php aqui-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection
