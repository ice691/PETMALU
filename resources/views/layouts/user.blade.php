<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          @auth
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Impound Requests
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('user.pet-registration.index') }}">Track Requests</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('user.pet-registration.create') }}">New Request</a>
              </div>
            </li>
          <li class="nav-item"><a href="{{ route('user.adoption-request.index') }}" class="nav-link">Adoption Requests</a></li>
          </ul>
          @endauth
          <ul class="navbar-nav ml-auto">
            @auth
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hello, {{ auth()->user()->name }}!
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#profile-modal"><i class="fa fa-user fa-fw"></i> Profile</a>

                @if(auth()->user()->is('admin'))
                <a class="dropdown-item" href="{{ route('admin.pet-registration.index') }}"><i class="fa fa-diamond fa-fw"></i> Admin Page</a>
                @endif

                <div class="dropdown-divider"></div>
                <a class="dropdown-item logout" href="#" class=""><i class="fa fa-sign-out fa-fw"></i> Log me out</a>
                {!! Form::open(['url' => url('logout'), 'method' => 'POST', 'id' => 'logout-form']) !!}
                {!! Form::close() !!}
              </div>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#registration-modal" href="javascript:void(0)">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#login-modal" href="javascript:void(0)">Login</a>
            </li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->

    <div class="container pt-3">
      @if(!isset($hidePageHeader))
        <div class="row align-items-center mb-3">
            <div class="col">
                <h4 class="mb-0">@yield('title')</h4>
            </div>
            <div class="col text-right">
                 @if(MyHelper::resourceMethodIn(['create', 'edit']))
                    <a href="{{ MyHelper::resource('index') }}" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Back to list</a>
                  @elseif(MyHelper::resourceMethodIn(['index']))
                    <a href="{{ MyHelper::resource('create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> New entry</a>
                  @endif
            </div>
        </div>
      @endif
      @if($flash = session('message'))
        <div class="row">
          <div class="col">
            <div class="alert alert-{{ $flash['status'] }}">
                {{ $flash['message'] }}
            </div>
          </div>
        </div>
      @endif
      @yield('content')

  </div>
    <!-- Modals -->
    @includeWhen(auth::guest(), 'partials.registration-modal')
    @includeWhen(auth::guest(), 'partials.login-modal')
    @includeWhen(auth::check(), 'partials.profile-modal')
    @stack('modals')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('js')


</body>
</html>
