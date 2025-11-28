@php
    use Illuminate\Support\Facades\Auth;
@endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <title>Change.org</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>


    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand text-danger fs-2" href="{{route('home')}}">Change.org</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link fs-4 m-2" href="{{route('petitions.index')}}">Más Peticiones</a>
                    </li>
                    <li class="nav-item">
                        <!--       <a class="nav-link fs-4 m-2" href="{{route('petitions.create')}}">Inicia una petición</a> -->
                    </li>
                    <?php if (Auth::check() ){?>
                    <li class="nav-item">
                        <a class="nav-link fs-4 m-2" href="{{route('petitions.mine')}}">Mis petitions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-4 m-2" href="{{route('petitions.petitionsSigned')}}">Mis firmas</a>
                    </li>
                    <?php }?>
                    {{--        <?php if (Auth::check() && Auth::user()->role_id==2){ ?>
                            <li class="nav-item">
                                <a class="nav-link fs-4 m-2 link-danger" href="{{route('admin.petitions.index')}}">Admin</a>
                            </li>
                            <?php }?>
                    --}}
                </ul>
            </div>

            <?php if(Auth::check()){?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <img class="img-xs rounded-circle" src="{{asset('vendor/assets/images/faces/face8.jpg')}}" alt="Profile image"> </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <p class="mb-1 mt-3 font-weight-semibold"><?=Auth::user()->name?></p>
                            <p class="font-weight-light text-muted mb-0"><?=Auth::user()->email?></p>
                        </div>
                        <a class="dropdown-item" href ="{{route('profile.edit')}}">My Profile <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
                        <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout').submit();" >Sign Out<i class="dropdown-item-icon ti-dashboard"></i></a>
                        <form id="logout" action="{{route('logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>

            <?php }else{  ?>

            <a class="nav-link fs-5 m-2 link-danger" href="{{route('register')}}">Register</a>
            <a class="nav-link fs-5 m-2 link-danger" href="{{route('login')}}">Login</a>

            <?php } ?>

        </div>
    </nav>
