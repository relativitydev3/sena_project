<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">

    @can('dashboard')
    <a class="nav-link" href="/admin/grafica">
        <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
    </a>
    @endcan

    @can('roles')
    <a class="nav-link" href="/roles">
        <i class="fas fa-user-tag"></i><span>Roles</span>
    </a>
    @endcan
    @can('usuarios')
    <a class="nav-link" href="/usuarios">
        <i class="fas fa-users"></i><span>Usuarios</span>
    </a>
    @endcan
    @can('clientes')
    <a class="nav-link" href="{{ route('A_clientes.index') }}">
        <i class="fas fa-user-tie"></i><span>Clientes</span>
    </a>
    @endcan
    @can('insumos')
    <a class="nav-link" href="{{route('insumo.index')}}">
        <i class="fas fa-box"></i><span>Insumos</span>
    </a>
    @endcan
    @can('categoria de productos')
    <a class="nav-link" href="{{route('categoria.index')}}">
        <i class="fas fa-tags"></i><span>Categoria de productos</span>
    </a>
    @endcan

    @can('productos')
    <a class="nav-link" href="{{route('productos.index')}}">
        <i class="fas fa-cubes"></i><span>Productos</span>
    </a>
    @endcan
    
    @can('pedidos')
    <a class="nav-link" href="{{route('pedidos.index')}}">
        <i class="fas fa-boxes"></i><span>Pedidos</span>
    </a>
    @endcan
    @can('ventas')
    <a class="nav-link" href="{{route('ventas.index')}}">
        <i class="fas fa-shopping-cart"></i><span>Ventas</span>
    </a>
    @endcan
    {{-- Linkeamiento a productos --}}
    
    {{-- Linkeamiento a insumos --}}
    
    
</li>
