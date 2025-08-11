<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}">
    @section('styles')
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('home.index')}}"><img style="width:100px" src="{{asset('images/app_logo.png')}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link @yield('home-active')" aria-current="page" href="{{route('home.index')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle @yield('document-drop-menu-active' , 'text-secondary') " type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Records 
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="nav-link @yield('documents-active')" href="{{route('documents.index')}}">Documents</a></li>
                                    <li><a class="nav-link @yield('categories-active')" href="{{route('categories.index')}}">Categories</a></li>
                                    <li></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('about-app-active')" href="{{route('about-app.index')}}">About App</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class= "mb-5">
            @yield('content')
        </div>

        <script src="{{ asset('js/lib/bootstrap.bundle.min.js') }}"></script>
        @yield('scripts')
    </body>

    </html>
