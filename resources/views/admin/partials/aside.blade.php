<aside class="text-white">
  <nav class="d-flex flex-column justify-content-between h-100">
    <ul class="d-flex flex-column align-items-start mt-3">
      <div class="">

        <div class="py-3">
          <h6 class="text-uppercase">Dashboard</h6>
          <li class="">
            <a href="{{ route('admin.home') }}">
              <i class="fa-solid fa-house"></i>
              <span>Home</span>
            </a>
          </li>
        </div>

        <div class="border-top border-bottom py-3">
          <h6 class="text-uppercase mt-2">Ristorante</h6>
          @if (Auth::user()->restaurant()->exists())
            <li>
              <a href="{{ route('admin.restaurant.index') }}">
                <i class="fa-solid fa-utensils"></i>
                <span>Il mio ristorante</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.restaurant.edit', Auth::user()->restaurant) }}">
                <i class="fa-solid fa-pen"></i>
                <span>Modifica Ristorante</span>
              </a>
            </li>
          @else
            <li>
              <a href="{{ route('admin.restaurant.create') }}">
                <i class="fa-solid fa-plus"></i>
                <span>Aggiungi Ristorante</span>
              </a>
            </li>
          @endif
        </div>

        <div class="border-bottom py-3">
          <h6 class="text-uppercase mt-2">Piatti</h6>
          <li>
            <a href="{{ route('admin.dish.index') }}">
              <i class="fa-solid fa-bowl-rice"></i>
              <span>Piatti</span>
            </a>
          </li>

          <li>
            <a href="{{ route('admin.dish.create') }}">
              <i class="fa-solid fa-plus"></i>
              <span>Aggiungi Piatto</span>
            </a>
          </li>

          <li>
            <a href="{{ route('admin.type.index') }}">
              <i class="fa-solid fa-plus"></i>
              <span>Tipologie</span>
            </a>
          </li>

        </div>

        <div class="py-3">
          <h6></h6>
          <li>
            <a href="{{ route('admin.dish.trashed') }}">
              <i class="fa-solid fa-trash-arrow-up"></i>
              <span>Piatti Eliminati</span>
            </a>
          </li>
        </div>

      </div>
    </ul>

    <div class=" mb-3">
      <ul>
        <li>
          <a href="#">
            <i class="fa-solid fa-gear"></i>
            <i>Impostazioni</i>
          </a>
        </li>
      </ul>
    </div>

  </nav>
</aside>
