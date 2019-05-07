<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{'Administration '}}@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <!-- Data Tables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    @php
        $action = 'PagesController';
    @endphp
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Sidebar -->
            <aside class="col-md-3 px-1 px-md-0 bg-side h-100" id="sidebar" style="/*overflow-x:hidden;*/">
                <!-- Admin info block -->
                <div class="container-fluid px-0 text-center">
                    <!-- <img src="{{asset('img/logo2.png')}}" alt="Transport"> -->
                    <a href="{{url('/')}}">
                        <span class="bg-sombre">Retourner au site</span>
                    </a>

                    <div class="container-fluid w-50 mx-auto text-center">
                        <img src="{{asset('img/admin.jpg')}}" alt="" class="rounded-circle">
                        <h4>{{auth()->user()->name}}</h4>
                        <div class="container-fluid d-flex justify-content-around">
                            <a href="">
                                <span class="badge badge-dark rounded-circle">
                                    <i class="fa fa-settings">S</i>
                                </span>
                            </a>
                            <a href="">
                                <span class="badge badge-dark rounded-circle">
                                    <i class="fa fa-shutdown">L</i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Admin info block -->
                <!-- Admin Menu -->
                <div class="container-fluid bg-normal w-100 px-md-0 my-2 pt-2">
                    <a class="text pl-3 pl-md-3" data-toggle='collapse' data-target="#sidebar-nav">
                        Menu  
                    </a>
                    <div class="bg-sombre pl-3 pl-md-3">
                        <ul class="navbar-nav w-100 ml-5" id="sidebar-nav">
                            <li class="nav-item">
                            <a href="{{url('/dashboard/itineraires')}}" class="nav-link ">
                                    <span>Itineraires</span>
                                    <span class="badge bg-normal">{{App\Itineraire::count()}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/dashboard/newsletter')}}" class="nav-link ">
                                    <span>Mails</span>
                                    <span class="badge bg-normal">{{App\Newsletter::count()}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/dashboard/questions')}}" class="nav-link ">
                                    <span>Questions</span>
                                    <span class="badge bg-normal">{{App\Question::count()}}</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="{{url('/dashboard/roles')}}" class="nav-link ">
                                    <span>Roles</span>
                                    <span class="badge bg-normal">{{App\Role::count()}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/dashboard/villes')}}" class="nav-link "><span>Villes</span>
                                    <span class="badge bg-normal">{{App\Ville::count()}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/dashboard/voyageurs')}}" class="nav-link ">
                                    <span>Voyageurs</span>
                                    <span class="badge bg-normal">{{App\User::where('role_id', App\Role::where('role', 'Voyageur')->first()->id)->get()->count()}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/dashboard/voyages')}}" class="nav-link ">
                                    <span>Voyages</span>
                                    <span class="badge bg-normal">{{App\Voyage::count()}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Admin Menu -->
            </aside>
            <main class="col-md bg-normal p-0 h-100">
                <h2 class="bg-side w-100 text-center sticky-top" style="position:relative;">
                        <button class="btn btn-sm mt-1" type="button" data-toggle="collapse" data-target="#sidebar" style="position:absolute;left:1rem;">Menu</button>
                        <span class="" style="">{{'Tableau de bord'}}</span>
                        <span><a href=""></a></span>
                </h2>
                <!-- Main Content -->
                <div class="container">
                    @yield('content_')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
