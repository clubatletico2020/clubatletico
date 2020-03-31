<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('administracion.index')}}" class="brand-link">
      <img src="{{asset('backend/dist/img/favicon-club-deportivo.png')}}" alt="contech logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CLUB ATLETICO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{Auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @can('usuariogestion')
          <li class="nav-item">
            <a href="{{route('usuario.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          @endcan

          @can('slidergestion')
          <li class="nav-item">
            <a href="{{route('slider.index')}}" class="nav-link">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Slider /  Banner
              </p>
            </a>
          </li>
          @endcan

          @can('quienessomosgestion')
          <li class="nav-item">
            <a href="{{route('somos.index')}}" class="nav-link">
              <i class="nav-icon fab fa-slideshare"></i>
              <p>
                Quiénes Somos
              </p>
            </a>
          </li>
        @endcan

        @can('eventogestion')
          <li class="nav-item">
            <a href="{{route('evento.index')}}" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Eventos
              </p>
            </a>
          </li>
        @endcan

        @can('noticiagestion')
          <li class="nav-item">
            <a href="{{route('noticia.index')}}" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Noticias
              </p>
            </a>
          </li>
        @endcan

        @can('funcionariogestion')
          <li class="nav-item">
            <a href="{{route('funcionario.index')}}" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                <!-- Directorio -->
                Funcionarios
              </p>
            </a>
          </li>
        @endcan

        @can('subscripciongestion')
          <li class="nav-item">
            <a href="{{route('suscripcion.index')}}" class="nav-link">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                Suscripciones
              </p>
            </a>
          </li>
        @endcan 

        @can('slidergestion')
          <li class="nav-item">
            <a href="{{route('galeria.index')}}" class="nav-link">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Galeria
              </p>
            </a>
          </li>
        @endcan

        @can('contactogestion')
          <li class="nav-item">
            <a href="{{route('contacto.index')}}" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Contacto
              </p>
            </a>
          </li>
        @endcan             

        @can('redessocialesgestion')
          <li class="nav-item">
            <a href="{{route('usuario.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tablet-alt"></i>
              <p>
                Redes Sociales
              </p>
            </a>
          </li>
        @endcan
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
