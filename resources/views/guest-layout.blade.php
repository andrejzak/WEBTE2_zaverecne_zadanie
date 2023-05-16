<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('icon.png') }}">
    <!-- Include Flag Icon CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <title>WEBTE2-FINAL</title>
</head>

<body>
  <header>
      <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
          <form id="logout-form" action="{{ route('logout-form') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <div class="container-fluid">
              <a class="navbar-brand" href="{{url('/')}}">WEBTE 2</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                  aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarText">
                  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{url('/guide')}}">{{ __('messages.guide') }}</a>
                    </li>
                    @if(Auth::user() && Auth::user()->role->value === "student")
                      <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{url('/student')}}">{{ __('messages.dashboard') }}</a>
                      </li>
                    @endif
                    @if(Auth::user() && Auth::user()->role->value === "teacher")
                      <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{url('/teacher')}}">{{ __('messages.dashboard') }}</a>
                      </li>
                    @endif
                    @if (Auth::user())
                      <li class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <a class="nav-link" aria-current="page" href="#">{{ __('messages.logout') }}</a>
                      </li>                  
                    @endif
                    @if(!Auth::user())
                      <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{url('/login')}}">{{ __('messages.login') }}</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{url('/registration')}}">{{ __('messages.registration') }}</a>
                      </li>
                    @endif
                  </ul>
              </div>
          </div>
      </nav>
  </header>
  <main class="content">  
    <div class="language">
        <a href="{{ route('language.change', 'sk') }}"><span class="flag-icon flag-icon-sk"></span></a>
        <a href="{{ route('language.change', 'en') }}"><span class="flag-icon flag-icon-gb"></span></a>
    </div>
      @yield('login')
      @yield('registration')
      @yield('student')
      @yield('teacher')
      @yield('guide')
      @yield('main')
  </main>
  <footer>
      <div class="container">VR-AŽ-TS-MR &copy; 2023</div>
  </footer>
</body>
</html>