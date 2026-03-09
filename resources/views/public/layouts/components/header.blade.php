<!-- Header-->
<header class="py-5">
    <div class="container px-lg-5">
        <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-5">
                <h1 class="display-5 fw-bold"> {{ $title }} </h1>
                <p class="fs-4">{{$description}}</p>
                @if ($showButton == true)
                    <a class="btn btn-primary btn-lg" href="#!">Call to action</a>
                @endif
            </div>
        </div>
    </div>
</header>