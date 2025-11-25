<aside class="main-sidebar sidebar-dark-primary elevation-4 overflowul">
  <!-- Brand Logo -->
  <a href="/" class="brand-link bg-white">
    <img class="main-sidebar-img" src="/img/panexpres_logo.png" alt="">
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @auth
        <img src="{{ auth()->user()->avatar_url }}" id="profileImage" class="img-circle elevation-2" alt="User Image">
        @endauth
      </div>
      <div class="info">
        @auth
        <a href="#" class="d-block" x-ref="username">{{ auth()->user()->name }}</a>
        @endauth
      </div>
    </div>

    <!-- Sidebar Menu -->
     
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Escritorio
            </p>
          </a>
        </li>

        @auth
          @if(auth()->user()->role == 'admin')
          
            <li class="nav-item">
              <a x-ref="profileLink" href="{{ route('admin.profile.edit') }}" class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Perfil
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('listPedidos', 1) }}" class="nav-link {{ request()->is('listPedidos') ? 'active' : '' }}">
                <i class="fa fa-solid fa-file-invoice-dollar"></i>
                <p>
                  Procesar Pedidos
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('listPedidosCliente') }}" class="nav-link {{ request()->is('listPedidosCliente') ? 'active' : '' }}">
                <i class="fa fa-solid fa-file-invoice-dollar"></i>
                <p>
                  Mis Pedidos
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('listClients', 1) }}" class="nav-link {{ request()->is('listClients') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Clientes
                </p>
              </a>
            </li>
            
            <!-- arbol -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Configurar Sitio
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview nav-link-sub">
                <li class="nav-item">
                  <a href="{{ route('star') }}" class="nav-link {{ request()->is('star') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Star
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('admin.listAreas') }}" class="nav-link {{ request()->is('admin/listAreas') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Área Económica
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="/listTasas/1" class="nav-link {{ request()->is('listTasas') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Tasa de cambio
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('emailexample') }}" class="nav-link {{ request()->is('emailexample') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Prueba de Email
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('emailFiles') }}" class="nav-link {{ request()->is('emailFiles') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Email con Files
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('file-import') }}" class="nav-link {{ request()->is('file-import') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                        Importar Usuarios
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="/api/apicontroller" class="nav-link {{ request()->is('api.apicontroller') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Probar Api
                    </p>
                  </a>
                </li>

                <li class="nav-item">                  
                  <a href="{{ route('listMetodosPagos') }}" class="nav-link {{ request()->is('listMetodosPagos') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Métodos de Pagos
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="/pasarela" class="nav-link {{ request()->is('pasarela') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Pasarela
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('admin.users') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Usuarios
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="/listPromociones" class="nav-link {{ request()->is('listPromociones') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Promociones
                    </p>
                  </a>
                </li>

              </ul>
            </li>
            <!-- fin arbol -->

            <!-- arbol -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Comercio
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview nav-link-sub">
                <li class="nav-item">
                  <a href="{{ route('listComercios', 1) }}" class="nav-link {{ request()->is('listComercios') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Comercios
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('settingComercio', 1) }}" class="nav-link {{ request()->is('settingComercio') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Configurar Comercio
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listDeliveryArea', 1) }}" class="nav-link {{ request()->is('listDeliveryArea') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Zona de entrega Delivery
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listCentrodistribucion', 1) }}" class="nav-link {{ request()->is('listCentrodistribucion') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Centro de Pickup
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listImpuestos', 1) }}" class="nav-link {{ request()->is('listImpuestos') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Listar Impuestos
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listMetodosPagosC', 1) }}" class="nav-link {{ request()->is('listMetodosPagosC') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Métodos de Pagos
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listMenus', 1) }}" class="nav-link {{ request()->is('listMenus') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Menú
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listTransacciones', 1) }}" class="nav-link {{ request()->is('listTransacciones') ? 'active' : '' }}">
                    <i class="fa fa-solid fa-file-invoice-dollar"></i>
                    <p>
                      Transacciones
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listPedidos', 1) }}" class="nav-link {{ request()->is('listPedidos') ? 'active' : '' }}">
                    <i class="fa fa-solid fa-file-invoice-dollar"></i>
                    <p>
                      Pedidos
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listStatusPedidos', 1) }}" class="nav-link {{ request()->is('listStatusPedidos') ? 'active' : '' }}">
                    <i class="fa fa-solid fa-file-invoice-dollar"></i>
                    <p>
                      Estado de Pedidos
                    </p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="{{ route('listClientesComercio', 1) }}" class="nav-link {{ request()->is('listClientesComercio') ? 'active' : '' }}">
                    <i class="fa fa-solid fa-car-side"></i>
                    <i class="fa fa-solid fa-motorcycle"></i>
                    <p>
                      Delivery
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listClientesComercio', 1) }}" class="nav-link {{ request()->is('listClientesComercio') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Clientes
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listUsersComercio', 1) }}" class="nav-link {{ request()->is('listUsersComercio') ? 'active' : '' }}">
                    <i class="fa fa-regular fa-user"></i>
                    <p>
                      Usuarios
                    </p>
                  </a>
                </li>
                
              </ul>
            </li>
            <!-- fin arbol -->

            <!-- arbol -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Producto
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview nav-link-sub">
                <li class="nav-item">
                  <a href="{{ route('listProducts', 1) }}" class="nav-link {{ request()->is('listProducts') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Afiliado / Productos
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listCombos', 1) }}" class="nav-link {{ request()->is('listCombos') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Afiliado / Combos
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listManufacturers', 1) }}" class="nav-link {{ request()->is('listManufacturers') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Fabricantes
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/listCategories/1" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>CATEGORIA</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listBrand', 1) }}" class="nav-link {{ request()->is('listBrand') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Afiliado / Marca
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('listContainers', 1) }}" class="nav-link {{ request()->is('listContainers') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-comments"></i>
                    <p>
                      Afiliado / Contenedor
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- fin arbol -->

            <li class="nav-item">
              <a href="{{ route('listNotificaciones', 1) }}" class="nav-link {{ request()->is('listNotificaciones') ? 'active' : '' }}">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                  Notificaciones
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('listCategorieslist', 1) }}" class="nav-link {{ request()->is('listCategorieslist') ? 'active' : '' }}">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                  Categorieslist
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('MakePayment', 1) }}" class="nav-link {{ request()->is('MakePayment') ? 'active' : '' }}">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                  Hacer Operacion
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Configuraciones
                </p>
              </a>
            </li>
          @endif

          @if(auth()->user()->role == 'cliente')
            <li class="nav-item">
              <a href="{{ route('listPedidosCliente') }}" class="nav-link {{ request()->is('listPedidosCliente') ? 'active' : '' }}">
                <i class="fa fa-solid fa-file-invoice-dollar"></i>
                <p>
                  Pedidos
                </p>
              </a>
            </li>
          @endif

          @if(auth()->user()->role == 'delivery')
            <li class="nav-item">
              <a href="{{ route('listPedidosDelivery') }}" class="nav-link {{ request()->is('listPedidosDelivery') ? 'active' : '' }}">
                <i class="fa fa-solid fa-file-invoice-dollar"></i>
                <p>
                  Pedidos Delivery
                </p>
              </a>
            </li>
            
          @endif

          @if(auth()->user()->role == 'afiliado')
            <li class="nav-item">
              <a href="{{ route('listComercios', auth()->user()->id) }}" class="nav-link {{ request()->is('listComercios') ? 'active' : '' }}">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                  Afiliado / Comercios
                </p>
              </a>
            </li>
            <!--  POR COMERCIO -->
            @if(count(auth()->user()->comercios) > 0)
              @foreach(auth()->user()->comercios as $comercio)
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                      {{$comercio->name}}
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">

                    <li class="nav-item">
                      <a href="{{ route('listManufacturers', $comercio->id) }}" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                          FABRICANTES
                        </p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="/listCategories/{{$comercio->id}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>CATEGORIA</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/listProducts/{{$comercio->id}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PRODUCTOS</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/listMetodosPagosC/{{$comercio->id}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>METODOS DE PAGOS</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/listTransacciones/{{$comercio->id}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>TRANSACCIONES</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/listClients/{{$comercio->id}}" class="nav-link {{ request()->is('listClients') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Clientes</p>
                      </a>
                    </li>
                  </ul>
                </li>
              @endforeach
            @endif
            <!--  FIN CATEGORIA POR COMERCIO -->
          @endif

          @if(auth()->user()->role == 'usuario' && auth()->user()->client->rolecomercio == 'admincomercio')
            <li class="nav-item">
              <a href="{{ route('listPedidosCliente') }}" class="nav-link {{ request()->is('listPedidosCliente') ? 'active' : '' }}">
                <i class="fa fa-solid fa-file-invoice-dollar"></i>
                <p>
                  Pedidos
                </p>
              </a>
            </li>
          @endif
        @endauth

        <!-- <li class="nav-item">
          <a href="{{ route('admin.messages') }}" class="nav-link {{ request()->is('admin/messages') ? 'active' : '' }}">
            <i class="nav-icon fas fa-comments"></i>
            <p>
              Messages
            </p>
          </a>
        </li> -->

        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Salir
              </p>
            </a>
          </form>
        </li>

        <!-- arbol -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Tables
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../tables/simple.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Simple Tables</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../tables/data.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>DataTables</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../tables/jsgrid.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>jsGrid</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- fin arbol -->
          
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
