<style>
    .dropdown-hover:hover .dropdown-menu {
        display: block;
    }
</style>
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav"
        style="border-bottom: 3px solid rgb(81, 124, 46);">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                    aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('Bienvenido') }}">
                    <img src="{{ asset('images/logo2.png') }}" style="max-width: 5em" class="logo" alt="">

                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">

                    <li class="nav-item "><a class="nav-link" href="{{ route('Bienvenido') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('Productos') }}">Productos</a></li>


                   
                    @if (!empty(\Illuminate\Support\Facades\Auth::user()->name))
                        <li class="nav-item"><a class="nav-link" href="{{ route('verpedido') }}">Pedidos</a></li>
                    @else
                        {{--  --}}
                    @endif


                    <script>
                        function mostrarAlerta() {
                            alert("El carrito está vacío");
                            // Redireccionar a otra página
                            window.location.href = "{{ route('carrito') }}";
                        }
                    </script>

                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown-hover">
                                <a href="#" class="nav-link dropdown-toggle nav-link-lg nav-link-user"
                                    data-toggle="dropdown">
                                    Hola, {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                    <i class="fas fa-chevron-down" style="margin-left: 5px;"></i>
                                    <!-- Icono de flecha hacia abajo -->
                                </a>
                                <div class="dropdown-menu">
                                    @can('administrador')
                                        <a href="{{ url('/home') }}" class="nav-link">Panel</a>
                                    @endcan
                                    <!-- Contenido del menú desplegable -->
                                    <a class="dropdown-item" href="{{ route('newperfil') }}">
                                        <i class="fas fa-user"></i> <span>{{ __('Perfil') }}</span>
                                    </a>

                                    <a class="dropdown-item" href="{{ route('newcontrasena') }}">
                                        <i class="fas fa-lock"></i> <span>{{ __('Cambio de contraseña') }}</span>
                                    </a>
                                    <!-- ... Más opciones ... -->
                                    <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                                        onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Salir
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">Registro</a>
                                </li>
                            @endif
                        @endauth
                    @endif

 {{-- nav-link --}}
                    @if (empty(session('carrito.productos')))
                        <li class="nav-item"><a class="nav-link" href="{{ route('carrito') }}"><i
                                    class="fa fa-shopping-cart ">
                                    <span class="badge" id="carritoBadge"  style="font-size: 20px;padding: 0em;margin: 0em">
                                    </span>
                                </i></a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('carrito') }}"><i
                                    class="fa fa-shopping-cart ">
                                    <span class="badge"  style="font-size: 20px;padding: 0em;margin: 0em">
                                            {{ count(session('carrito.productos', [])) }}
                                    </span>
                                </i></a></li>
                    @endif
                    

                    <!-- End Carrito de compras -->
                    <!-- Código de autenticación -->

                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->

</header>
<script>
    function actualizarTotalCarrito(bool) {
        // Obtener el contenido del carrito almacenado en el Local Storage
        var carritoContenido = localStorage.getItem('carrito');
        var productosPersonalizados = localStorage.getItem('productosPersonalizados');

        // Convertir la cadena JSON en un objeto JavaScript
        var carritoObjeto = JSON.parse(carritoContenido) ||
    []; // Si el carrito está vacío, inicializar como array vacío
        var productosPersonalizadosObjeto = JSON.parse(productosPersonalizados) ||
    []; // Si los productos personalizados están vacíos, inicializar como array vacío

        // Obtener la cantidad de elementos en el carrito
        if (bool && carritoObjeto.length <= 0) {
            var cantidadEnCarrito = carritoObjeto.length + 1;
        } else {
            var cantidadEnCarrito = carritoObjeto.length;

        }
        var cantidadEnproductosPersonalizados = productosPersonalizadosObjeto.length;

        var cantida = cantidadEnCarrito + cantidadEnproductosPersonalizados;
        // Mostrar la cantidad en el elemento con el ID 'carritoBadge'
        document.getElementById('carritoBadge').textContent = cantida;
    }

    // Llamar a la función para actualizar el total al cargar la página y en cada cambio del Local Storage
    actualizarTotalCarrito(false);
</script>



<!-- End Main Top -->
<!-- ALL JS FILES -->
<script>
    document.getElementById("carrito-link").addEventListener("click", function(event) {
        event.preventDefault(); // Evita que el enlace se comporte como un enlace normal

        var sideDiv = document.querySelector(".side");
        sideDiv.classList.toggle("side-on"); // Agrega o quita la clase "side-on" al <div class="side">
    });
</script>

<script>
    $(document).ready(function() {
        $('.dropdown-hover').hover(function() {
            $(this).addClass('show');
        }, function() {
            $(this).removeClass('show');
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
