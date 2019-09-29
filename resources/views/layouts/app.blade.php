<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>

<div id="app">
        <nav class="navbar navbar-dark bg-dark" style="background-color:#1C78C0;">
            <div class="container">
                <a class="navbar-brand"  style="color:white;" href="{{ url('/') }}">
                    {{ 'Catalog' }}
                </a>
                @guest
                    <a class="navbar-brand"  style="color:white;" href="{{ route('login') }}">
                        {{ 'Login' }}
                    </a>
                    <a class="navbar-brand"  style="color:white;" href="{{ route('register') }}">
                        {{ 'Register' }}
                     </a>
                 @else
                    <a class="nav-item dropdown" align="right">
                        <a id="navbarDropdown" class="navbar-brand"  style="color:white;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </a>
                @endguest
              
                </div>
            </div>
        </nav>


        <div class="container">
            @yield('content')
        </div>
</body>
</html>