<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(View::hasSection('title')) @yield('title') - @endif {{ config('app.name', 'FFI Caribe') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.6.3/font-awesome.min.css" integrity="sha384-Wrgq82RsEean5tP3NK3zWAemiNEXofJsTwTyHmNb/iL3dP/sZJ4+7sOld1uqYJtE" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet">

    <link href="/css/bootstrap-tags-input/bootstrap-tags-input.css" rel="stylesheet">
    <link href="/css/datetimepicker/datetimepicker.css" rel="stylesheet">

    <!-- Scripts -->

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ URL::asset('/img/FFI-Logo.png') }}">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @if(!Auth::guest())
                        {{-- @if(config('app.stage_id')==1)
                            <li>
                                <a href="{{ url('/preinscription') }}">Preinscripción</a>
                            </li>
                        @endif --}}
                        @if(Auth::user()->isAdmin() || (Auth::user()->isEmpresario() && Auth::user()->company))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Proyectos <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                @can('create-project')
                                <li>
                                    <a href="{{ url('/projects/register') }}">Registrar Proyecto</a>
                                </li>
                                @endcan
                                <li>
                                    <a href="{{ url('/projects') }}">Ver Proyectos</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user()->isEmpresario())
                        @can('create-entity')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Entidades <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/entities/register') }}">Registrar Entidad</a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @endif
                    @endif
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Inicia Sesión</a></li>
                        <li><a href="{{ url('/register') }}">Registrate</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/users/' . Auth::user()->id) }}">Mi Perfil</a>
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @if(Session::has('status'))
        <div class="container">
            <div class="alert {{ 'alert-' . Session::get('status') }}" align="center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p>{{ Session::get('message') }}</p>
            </div>
        </div>
    @endif
    @yield('content')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment-with-locales.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="{{ URL::asset('/js/bootstrap-tags-input/bootstrap-tags-input.min.js') }}"></script>
    <script src="{{ URL::asset('/js/datetimepicker/datetimepicker.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
