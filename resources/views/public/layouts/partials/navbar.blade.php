<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-lg-5">
        <a class="navbar-brand" href="#!">Sistema de Controle de ...</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a></li> <!--request()->is('url') verifica se a URL é igual à especificada, se sim adiciona a classe active-->
                <li class="nav-item"><a class="nav-link {{ request()->is('sobre-nos') ? 'active' : '' }}" href="sobre-nos">About</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('contato') ? 'active' : '' }}" href="contato">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>