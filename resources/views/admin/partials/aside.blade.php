<aside class="text-white">
  <nav class="d-flex flex-column justify-content-between h-100">
    <ul class="d-flex flex-column align-items-start mt-3">
      <div>
        <li>
          <a href="{{ route('admin.home') }}">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
          </a>
        </li>

        <li>
          <a href="{{ route('admin.restaurant.index') }}">
            <i class="fa-solid fa-utensils"></i>
            <span>I Miei Ristoranti</span>
          </a>
        </li>

        <li>
          <a href={{ route('admin.restaurant.create') }}>
            <i class="fa-solid fa-plus"></i>
            <span>Aggiungi Ristoranti</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.dish.index') }}">
            <i class="fa-solid fa-bowl-rice"></i>
            <span>Piatti</span>
          </a>
        </li>
        <li>
          <a href={{ route('admin.dish.create') }}>
            <i class="fa-solid fa-plus"></i>
            <span>Aggiungi Piatto</span>
          </a>
        </li>

        <li>
          <a href={{ route('admin.dish.trashed') }}>
            <i class="fa-solid fa-trash-arrow-up"></i>
            <span>Piatti Eliminati</span>
          </a>
        </li>

      </div>

    </ul>
    <div class="mb-3">
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
