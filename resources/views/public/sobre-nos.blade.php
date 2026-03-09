@extends('public.layouts.layout_base')

@section('title','Sobre Nós')

@section('conteudo')

<!-- Navbar -->
@include('public.layouts.partials.navbar')

<!-- Header -->
@component('public.layouts.components.header', [
    'title' => 'Sobre Nós',
    'description' => 'Saiba mais sobre nossa missão, visão e valores!',
    'showButton' => false
])
@endcomponent

<!-- Conteúdo Sobre Nós -->
<section class="pt-4">
    <div class="container px-lg-5">
        <div class="row gx-lg-5">
            <div class="col-lg-12 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4">
                            <i class="bi bi-building"></i>
                        </div>
                        <h2 class="fs-4 fw-bold">Nossa Missão</h2>
                        <p class="mb-0">Nosso objetivo é fornecer soluções inovadoras para facilitar a vida dos nossos clientes, buscando sempre o melhor resultado em cada projeto.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h2 class="fs-4 fw-bold">Nossa Equipe</h2>
                        <p class="mb-0">Acreditamos que uma equipe engajada e capacitada é a chave para o sucesso. Trabalhamos juntos para alcançar os objetivos com eficiência e paixão.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
@include('public.layouts.partials.footer') <!--Inclui o conteúdo do arquivo footer.blade.php aqui-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@endsection