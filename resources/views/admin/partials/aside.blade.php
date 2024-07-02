<aside class="text-white ps-3">
  <nav class="d-flex flex-column justify-content-between">
    <ul class="d-flex flex-column align-items-start mt-3">
      <div>
        <div>
          <li class="border-bottom py-3">
            <a href="{{ route('admin.home') }}">
              <i class="fa-solid fa-house"></i>
              <span>Home</span>
            </a>
          </li>
        </div>

        <div>
          @if (Auth::user()->restaurant()->exists())
            <li class="border-bottom py-3">
              <a href="{{ route('admin.restaurant.index') }}">
                <i class="fa-solid fa-utensils"></i>
                <span>Il mio ristorante</span>
              </a>
            </li>
            <li class="border-bottom py-3">
              <a href="{{ route('admin.restaurant.edit', Auth::user()->restaurant) }}">
                <i class="fa-solid fa-pen"></i>
                <span>Modifica Ristorante</span>
              </a>
            </li>
          @else
            <li class="border-bottom py-3">
              <a href="{{ route('admin.restaurant.create') }}">
                <i class="fa-solid fa-plus"></i>
                <span>Aggiungi Ristorante</span>
              </a>
            </li>
          @endif
        </div>

        @if (Auth::user()->restaurant && Auth::user()->restaurant->dishes()->exists())
          <div>
            <li class="border-bottom py-3">
              <a href="{{ route('admin.dish.index') }}">
                <i class="fa-solid fa-bowl-rice"></i>
                <span>Piatti</span>
              </a>
            </li>
          </div>
        @endif
        @if (Auth::user()->restaurant()->exists())
          <div>
            <li class="border-bottom py-3">
              <a href="{{ route('admin.dish.create') }}">
                <i class="fa-solid fa-plus"></i>
                <span>Aggiungi Piatto</span>
              </a>
            </li>
          </div>
        @endif

        <div>
          <li class="border-bottom py-3">
            <a href="{{ route('admin.type.index') }}">
              <i class="fa-solid fa-layer-group"></i>
              <span>Tipologie</span>
            </a>
          </li>
        </div>

        <div>
          <li class="border-bottom py-3">
            <a href="{{ route('admin.order.index') }}">
              <i class="fa-solid fa-arrow-down-short-wide"></i>
              <span>Ordini</span>
            </a>
          </li>
        </div>
        <div>
          <li class="border-bottom py-3">
            <a href="{{ route('admin.dish.trashed') }}">
              <i class="fa-solid fa-trash-can-arrow-up"></i>
              <span>Piatti Eliminati</span>
            </a>
          </li>
        </div>
        <div>
          <li class="py-3">
            <a href="{{ route('admin.restaurant.trashed') }}">
              <i class="fa-solid fa-trash-arrow-up"></i>
              <span>Ristoranti Eliminati</span>
            </a>
          </li>
        </div>
      </div>
    </ul>
  </nav>
</aside>

<style>
  /* General Aside Styles */
  aside {
    max-width: 250px;
    background: #03071e;
    overflow-y: auto;
  }

  nav {
    height: auto;
  }

  ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  li {
    width: 100%;
  }

  li a {
    display: block;
    width: 100%;
    padding: 10px;
    color: white;
    text-decoration: none;
  }

  li a:hover {
    background-color: #495057;
  }

  .border-bottom {
    border-bottom: 1px solid #fff;
  }
</style>
