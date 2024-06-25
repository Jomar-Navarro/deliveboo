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
        </div>

        <div class="border-bottom py-3">
          <h6 class="text-uppercase mt-2">Tipologie</h6>
          <li>
            <a href="{{ route('admin.type.index') }}">
              <i class="fa-solid fa-layer-group"></i></i>
              <span>Tipologie</span>
            </a>
          </li>
        </div>

        <div class="border-bottom py-3">
          <h6 class="text-uppercase mt-2">Ordini</h6>
          <li>
            <a href="{{ route('admin.order.index') }}">
              <i class="fa-solid fa-layer-group"></i></i>
              <span>Ordini</span>
            </a>
          </li>
        </div>

        {{-- DROPDOWN TRASH --}}
        <div class="dropdown-trash">
          <button class="dropdown-btn text-white" aria-label="menu button" aria-haspopup="menu" aria-expanded="false"
            aria-controls="dropdown-menu">
            <i class="fa-solid fa-trash-arrow-up"></i>
            <span>Cestino</span>
            <span class="arrow"></span>
          </button>
          <ul class="dropdown-content list-unstyled" role="menu" id="dropdown-menu">

            <li style="--delay: 1;" class="mb-2">
              <a href="{{ route('admin.dish.trashed') }}">
                <span>Piatti Eliminati</span>
              </a>
            </li>

            <li style="--delay: 2;">
              <a href="{{ route('admin.restaurant.trashed') }}">
                <span>Ristoranti Eliminati</span>
              </a>
            </li>

          </ul>
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





<style>
  /* DROPDOWN TRASH */
  .dropdown-trash {
    max-width: 13em;
    margin: 30px auto 0;
    position: relative;
    width: 100%;
  }

  .dropdown-btn {
    background: #03071e;
    font-size: 18px;
    width: 100%;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.7em 0.5em;
    border-radius: 0.5em;
    cursor: pointer;
  }

  .dropdown-btn:hover {
    transition: all ease-in 0.2s;
    background-color: rgb(18, 18, 18)
  }

  .arrow {
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 6px solid #fff;
    transition: transform ease-in 0.3s;
  }

  .dropdown-content {
    position: absolute;
    top: 3.2em;
    width: 100%;
    visibility: hidden;
    overflow: hidden;
  }

  .dropdown-content li {
    background: #03071e;
    border-radius: 0.5em;
    position: relative;
    left: 100%;
    transition: 0.5s;
    transition-delay: calc(60ms * var(--delay));
  }

  .dropdown-content.menu-open li {
    left: 0;
  }

  .dropdown-content.menu-open {
    visibility: visible;
  }

  .arrow.arrow-rotate {
    transform: rotate(180deg);
  }

  .dropdown-content li:hover {
    transition: transform ease-in 0.3s;
    background: #181a1f;
  }

  .dropdown-content li a {
    display: block;
    padding: 0 10px;
    text-decoration: none;
  }

  /* DROPDOWN TRASH */
</style>





<script>
  /* DROPDOWN TRASH */
  const dropdownBtn = document.querySelector(".dropdown-btn");
  const dropdownCaret = document.querySelector(".arrow");
  const dropdownContent = document.querySelector(".dropdown-content");

  // add click event to dropdown button
  dropdownBtn.addEventListener("click", () => {
    // add rotate to caret element
    dropdownCaret.classList.toggle("arrow-rotate");
    // add open styles to menu element
    dropdownContent.classList.toggle("menu-open");
    dropdownBtn.setAttribute(
      "aria-expanded",
      dropdownBtn.getAttribute("aria-expanded") === "true" ? "false" : "true"
    );
  });
  /* DROPDOWN TRASH */
</script>
