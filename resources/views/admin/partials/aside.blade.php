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
            <span>My Restaurant</span>
          </a>
        </li>

        <li>
          <a href={{ route('admin.restaurant.create') }}>
            <i class="fa-solid fa-square-plus"></i>
            <span>Add Restaurant</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.dish.index') }}">
            <i class="fa-solid fa-database"></i>
            <span>Dishes</span>
          </a>
        </li>
        <li>
          <a href={{ route('admin.dish.create') }}>
            <i class="fa-solid fa-square-plus"></i>
            <span>Add Dish</span>
          </a>
        </li>
      </div>

    </ul>
    <div class="mb-3">
      <ul>
        <li>
          <a href="#">
            <i class="fa-solid fa-gear"></i>
            <i>Settings</i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</aside>
