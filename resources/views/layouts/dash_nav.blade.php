<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #001f3f!important">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
      <img src="{{asset('images/logo2.png')}}" alt="Logo" class="brand-image " style="opacity: .8; height: 250px!important;">
      <span class="brand-text font-weight-light">Bridge | Bénin PNR</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/uploads/users/{{ Auth::user()->avatar }}" class="img-circle elevation-2" alt="User">
        </div>
        <div class="info">
        @guest
              <a href="#" class="d-block">No name</a>
         @else
          <a href="#" class="d-block">
                  {{ Auth::user()->name }}
          </a>
        @endguest
    </ul>
        </div>
      </div>
     @if ((Auth::user()->level)=="super-admin" || (Auth::user()->level)=="admin" || (Auth::user()->level)=="standard" || (Auth::user()->level)=="caissier")
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview home0">
            <a href="#" class="nav-link home1">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Tableau de bord
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/home" class="nav-link home2">
                  <i class="fa fa-angle-right"></i>
                  <p>Accueil</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview citoyens0">
            <a href="#" class="nav-link citoyens1">
              <i class="nav-icon fa fa-users"></i>
              <p>
               Gestion des Citoyens
                 <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('citoyens.create')}}" class="nav-link citoyens22">
                  <i class="fa fa-angle-right"></i>
                  <p>Nouvelle entrée</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/citoyens" class="nav-link citoyens2">
                  <i class="fa fa-angle-right"></i>
                  <p>Citoyens</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="/cartes" class="nav-link cardsc">
              <i class="nav-icon fa fa-file-text"></i>
              <p>
               Cartes consulaire
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/pass" class="nav-link pass-card">
              <i class="nav-icon fa fa-book"></i>
              <p>
               Laissez-passer
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview pieces">
            <a href="#" class="nav-link pieces1">
              <i class="nav-icon fa fa-archive"></i>
              <p>
               Autres pièces
                 <i class="right fa fa-angle-left"></i>
              </p>
            </a>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/naissances" class="nav-link nais">
                  <i class="fa fa-angle-right"></i>
                  <p>Actes de naissance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/mariage" class="nav-link nais1">
                  <i class="fa fa-angle-right"></i>
                  <p>Actes de mariage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/deces" class="nav-link nais2">
                  <i class="fa fa-angle-right"></i>
                  <p>Actes de décès</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="/authorisations" class="nav-link auth">
                  <i class="fa fa-angle-right"></i>
                  <p>Autorisations Parentale</p>
                </a>
              </li>
                 <li class="nav-item">
                <a href="/procurations" class="nav-link procurations">
                  <i class="fa fa-angle-right"></i>
                  <p>Procurations</p>
                </a>
              </li>
                 <li class="nav-item">
                <a href="/legalisations" class="nav-link legalisations">
                  <i class="fa fa-angle-right"></i>
                  <p>Légalisations</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if ((Auth::user()->level)=="super-admin" || (Auth::user()->level)=="admin" || (Auth::user()->level)=="caissier")
          <li class="nav-item has-treeview caisse">
            <a href="#" class="nav-link caisse1">
              <i class="nav-icon fa fa-sack-dollar"></i>
              <p>
                 Caisse
                 <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('caisse.index')}}" class="nav-link caisse2">
                  <i class="fa fa-angle-right"></i>
                  <p>Gestion des entrées</p>
                </a>
                <a href="/sorties" class="nav-link sorties">
                  <i class="fa fa-angle-right"></i>
                  <p>Gestion des sorties</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/rapports" class="nav-link caisse3 rapports">
                  <i class="fa fa-angle-right"></i>
                  <p>Brouillard de caisse</p>
                </a>
              </li>

            </ul>
          </li>
             <li class="nav-item">
            <a href="/stocks" class="nav-link stocks">
              <i class="nav-icon fa fa-box"></i>
              <p>
                 Gestion des Stocks
              </p>
            </a>
          </li>
          @endif
          @if ((Auth::user()->level)=="super-admin" || (Auth::user()->level)=="admin")
          <li class="nav-item">
            <a href="/users" class="nav-link users">
              <i class="nav-icon fa fa-users-gear"></i>
              <p>
               Gestion des utilisateurs
              </p>
            </a>
          </li>
           @endif
          @if ((Auth::user()->level)=="super-admin")
          <li class="nav-item">
            <a href="/settings" class="nav-link settings">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
               Paramètres
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
