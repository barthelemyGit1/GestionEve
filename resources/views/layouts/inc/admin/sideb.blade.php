<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url ('admin/dashboard') }}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Souscriptions</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url ('admin/dashboard') }}">Ajouter</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url ('admin/souscriptions') }}">Consulter</a></li>
    
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url ('admin/souscriptions/contrats') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Contrats</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">Patrimoine</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route ('logement.index') }}">Logements</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route ('parcelle.index') }}">Parcelles</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">payement</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url ('Paiement') }}">Historiques</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route ('versements.index') }}">Versements</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url ('Activite') }}">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">Activités</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="documentation/documentation.html">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>