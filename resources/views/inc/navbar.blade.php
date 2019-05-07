
        <nav id="navigation" class="navbar navbar-expand-md navbar-light bg-light sticky-top p-0 mt-md-3">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto align-items-center">
                        <li class="nav-item">
                            <a href="{{ url('/')}}" class="navbar-brand">
                                <img src="{{asset('img/logo2.png')}}" class="p-0" alt="" width="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/')}}" class="nav-link">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/reservation')}}" class="nav-link">
                                Reserver une place
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/services')}}" class="nav-link">Services</a>
                        </li>
                    </ul>

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
                            {{-- @if (App\Role::find(Auth::user()->role_id)->role == '')
                                <li class="nav-item">
                                    <a href="{{url('/')}}" class="nav-link">
                                        Soumettre un plan
                                    </a>
                                </li>
                            @endif --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    @if (App\Role::find(Auth::user()->role_id)->role == 'Amane')
                                        <a href="{{url('/dashboard')}}" class="dropdown-item">
                                            Dashboard
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                                {{-- <li class="nav-item">
                                    <a href="{{url('/cart')}}" class="nav-link">
                                        @if (App\Role::find(Auth::user()->role_id)->role == 'Designer')
                                            Acheter un plan
                                        @else
                                            Panier
                                        @endif
                                    </a>
                                </li> --}}
                            @endguest
                    </ul>
                </div>
            </div>
        </nav>