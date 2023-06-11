<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">SAKILA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ url('home/products') }}">Products</a>
        </li>
        <li class="nav-item">
          
          <a class="nav-link" href="{{ url('home/shoppingcart') }}">Shopping cart</a>
        </li>
      </ul>

      @if(Auth::guard()->check())
      <ul class="navbar-nav d-flex">
          @if(Auth::user()->is_admin == '1')
            <li class="nav-item">
              <a class="nav-link" href="{{ url('dash/') }}">Administrador</a>
            </li>
          @endif
          <li class="nav-item">
            <p class="nav-link">{{ Auth::user()->name }}</p>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ url('home/facture/') }}">Facturas</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ url('home/profile/editPerfil/edit') }}" >Perfil</a>
          </li>
          <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button  style='border: none; outline:none;' class="nav-link" type="submit">
                    {{ __('Log Out') }}
                </button>
            </form>
          </li>
      </ul>
      @else
        <ul class="navbar-nav d-flex">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('register') }}">SIGN IN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{ url('login') }}">LOGIN</a>
          </li>
        </ul>
      @endif
    </div>
  </div>
</nav>