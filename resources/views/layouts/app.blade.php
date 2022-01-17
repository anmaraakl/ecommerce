<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">@lang('admin.home')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/myInfo') }}">@lang('admin.my_profile')
                        </a>
                    </li>
                    @if (Auth::user()!=null)
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{route('/home')}}">My Products</a> --}}
                       <li class="nav-item"> <a class="nav-link" href="/myProduct">@lang('admin.my_products')
                    </a> </li>
                    </li>
                    @endif

                    @if (Auth::user()!=null)
                    @if (Auth::user()->role=="admin")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/users') }}">@lang('admin.All_Users')
                        </a>
                    </li>
                    @endif
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contactus') }}">@lang('admin.contact')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/configAccount') }}"> config
                        </a>
                    </li>
                    @if (Auth::user()!=null)
                     <li class="nav-item">  <a class="nav-link" href="{{route('products.create')}}">Add Product</a>

                    </li>
                    @endif


                </ul>






                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      langauge
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="{{route('lang','en')}}">English</a>
                      <a class="dropdown-item" href="{{route('lang','ar')}}">Arabic</a>
                    </div>
                  </div>



                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container ">
            @yield('content')
            <div class="container text-center"> @include('inc.messages')</div>
        </main>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>

</body>
</html>
