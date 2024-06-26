<header>
  <nav class="navbar navbar-expand-lg text-white">
    <div class="container-fluid h-100">

      <div class="d-flex h-100 align-items-center w-75">

        <div class="logo d-flex justify-content-center">
          <img class="rounded-circle img-fluid logo" src="/img/logo-final.png" alt="">
          {{-- <h3 class="d-flex align-items-center fw-bolder ps-2">Deliboo</h3> --}}
        </div>


      </div>

      <div class="d-flex align-items-center ">



        <div class="d-flex align-items-center p-3">

          <li class="nav-item dropdown list-group px-2">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right bg-body-secondary" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ url('admin') }}">{{ __('Dashboard') }}</a>
              <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
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
