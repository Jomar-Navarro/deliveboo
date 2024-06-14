
<header>

    <nav class="navbar navbar-expand-lg bg-body-tertiary fs-5 fw-semibold border-bottom py-0">
        <div class="container-fluid mx-5">
            <a class="navbar-brand ms-5 px-4" href="{{ route('home') }}">Visualizza il Sito</a>

            <div class="d-flex align-items-center">
                <div class="me-5">
                    <form class="d-flex" action="{{ route('admin.restaurants.index') }}" method="GET" role="search">
                        <input class="form-control me-3" type="search" placeholder="Search Project" name="stringSearch">
                        <button class="btn btn-success me-5" type="submit">Cerca</button>
                    </form>
                </div>

                <p class="fw-bold  text-capitalize fs-4 m-0 me-5">{{ Auth::user()->name }}</p>

                <form class="mb-0" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger fw-semibold fs-5 rounded-5 px-3 py-1">Log Out</button>
                </form>
            </div>
        </div>
    </nav>

</header>
