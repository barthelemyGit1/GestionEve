<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url ('admin/dashboard') }}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Accueil</span>
            </a>
          </li>
 
          <li class="nav-item">
            <a class="nav-link" href="{{ url ('Activite') }}">
              <i class="mdi mdi-calendar-plus menu-icon"></i>
              <span class="menu-title">Evènements</span>
            </a>
          </li>
          <li class="nav-item">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-info"  href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="mdi mdi-human-greeting menu-icon"></i> 
                @if(auth()->user())
                Mr {{ Auth::user()->name }}
                @endif
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
            </li>
          </li>
         
        </ul>
      </nav>