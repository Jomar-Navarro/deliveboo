
<header>
    <nav class="navbar navbar-expand-lg text-white">
        <div class="container-fluid h-100">

            <div class="d-flex h-100 align-items-center w-75">

                <div class="logo d-flex justify-content-center">
                    <img class="rounded-circle img-fluid" src="/img/logo-dark.png" alt="">
                    {{-- <h3 class="d-flex align-items-center fw-bolder ps-2">Deliboo</h3> --}}
                </div>

                <div class="searchbar w-50">
                    <form class="d-flex" action="" method="GET" role="search">
                        <div class="search d-flex align-items-center">
                            <span class="pe-2">
                                <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                            </span>
                            <input class="form-control-plaintext me-3" type="search" placeholder="Search" name="stringSearch">
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex align-items-center ">

                <div class="d-flex align-items-center justify-content-between">
                    <div class="mx-2 fs-5"><i class="fa-regular fa-bell"></i></div>
                    <div class="mx-2 fs-5"><i class="ri-apps-2-line font-22"></i></div>
                </div>

                <div class="d-flex align-items-center p-3">
                    <div class="logo-user d-flex justify-content-center">
                        <img class="rounded-circle img-fluid" src="/img/logo-dark.png" alt="">
                    </div>
                    <li class="nav-item dropdown list-group px-2">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right bg-body-secondary" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a>
                            <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profilo')}}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                    {{ __('Esci') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </div>
            </div>

        </div>
    </nav>
</header>
