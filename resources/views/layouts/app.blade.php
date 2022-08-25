<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Domine&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Jobsite') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/8.3.0/nouislider.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/8.3.0/nouislider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="{{ asset('js/stripe.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
    <script>
        
        $( document ).ready(function() {
            $(".dropdown-trigger").dropdown();
            $('.sidenav').sidenav();
            $('.user').show();
            $('.tabs').tabs();
            $('.modal').modal();
            const calender = document.querySelectorAll('.datepicker');
            M.Datepicker.init(calender, {
                format: 'yyyy-mm-dd'
            });
        }); 
    </script>
    
    @yield('stylesheets')
</head>
<body>
    <div id="app">
        <!-- Dropdown Structure -->
        <ul id="employer-dropdown" class="dropdown-content">
            @if(Auth::user('employer'))
            <li><a href='/employer'>Dashboard</a></li>
            <li class="divider"></li>
            <li><a href="/employer/logout">Log out</a></li> 
            <li class="divider"></li> 
            <li>
                <form id='delete-my-profile' method='POST' action="/employer/deleteprofile/{{Auth::user()->id}}">
                {{ method_field('DELETE') }}
                <input class='form-control' type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <a class='delete-my-profile'>Delete my profile</a>
                </form>
            </li>
            @else
            <li><a href='/employer'>Dashboard</a></li>
            <li class="divider"></li>
            <li><a href="/employer/login">Login</a></li>
            <li class="divider"></li>
            <li><a href="/employer/signup">Register</a></li>     
            @endif
            
        </ul>
        <ul id="jobseeker-dropdown" class="dropdown-content">
            @if(Auth::user('jobseeker'))
            <li><a href='/jobseeker'>Dashboard</a></li>
            <li><a href='/jobseeker/profile'>Profile</a></li>
            <li><a href="/jobseeker/logout">Log out</a>  
            @else                     
            <li><a href='/jobseeker'>Dashboard</a></li>
            <li class="divider"></li>
            <li><a href="/jobseeker/login">Login</a></li>
            <li class="divider"></li>
            <li><a href="/jobseeker/signup">Register</a></li> 
            </li>
            @endif
        </ul>
        <ul id="employer-dropdown-mobile" class="dropdown-content">
            @if(Auth::user('employer'))
            <li><a href='/employer'>Dashboard</a></li>
            <li><a href="/employer/logout">Log out</a></li>  
            @else
            <li><a href='/employer'>Dashboard</a></li>
            <li class="divider"></li>
            <li><a href="/employer/login">Login</a></li>
            <li class="divider"></li>
            <li><a href="/employer/signup">Register</a></li>     
            @endif
        </ul>
        <ul id="jobseeker-dropdown-mobile" class="dropdown-content">
            @if(Auth::user('jobseeker'))
            <li><a href='/jobseeker'>Dashboard</a></li>
            <li><a href='/jobseeker/profile'>Profile</a></li>
            <li><a href="/jobseeker/logout">Log out</a>  
            @else                     
            <li><a href='/jobseeker'>Dashboard</a></li>
            <li class="divider"></li>
            <li><a href="/jobseeker/login">Login</a></li>
            <li class="divider"></li>
            <li><a href="/jobseeker/signup">Register</a></li> 
            </li>
            @endif
        </ul>
        <nav class='transparent'>
            <div class="nav-wrapper">
                <a href="{{ url('/') }}" class="brand-logo left">
                    <img src="{{ asset('images/jobsite-logo.png') }}">
                </a>
                <a href="#" data-target="mobile-menu" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                @if(Auth::guest())
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a class="dropdown-trigger" href="#" data-target="employer-dropdown">Employer<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-trigger" href="#" data-target="jobseeker-dropdown">Jobseeker<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
                @elseif(Auth::guard('employer')->user())
                <li><a href="{{route('employer.job.create')}}">Create a Job</a></li>
                <li class="nav-item dropdown" >
                    <a id="navbarDropdown" class="dropdown-trigger" href="#" data-target="employer-dropdown-notification">
                        <span class='glyphicon glyphicon-globe'></span>Notifications<span class="badge" style='margin-left: -0.5em;'>{{count(auth()->user()->unreadNotifications)}}</span>
                        <i style='margin-left: -0.5em;' class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
                <ul class='dropdown-content' id='employer-dropdown-notification'>
                        @forelse(auth()->user()->unreadNotifications as $notification)
                        <li>
                        @include('notifications.'.snake_case(class_basename($notification->type)))
                        </li>
                        @empty
                        <a href='#'>No unread notifications</a>
                        @endforelse
                </ul>
                <li><a class="dropdown-trigger" href="#" data-target="employer-dropdown">{{ Auth::guard('employer')->user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
                @elseif(Auth::guard('jobseeker')->user())
                <li><a class="dropdown-trigger" href="#" data-target="jobseeker-dropdown">{{ Auth::guard('jobseeker')->user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
                @else
                
                @endif
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-menu">
            @if(Auth::guest())
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a class="dropdown-trigger" href="#" data-target="employer-dropdown-mobile">Employer<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-trigger" href="#" data-target="jobseeker-dropdown-mobile">Jobseeker<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a href="{{ url('/') }}">Contact</a></li>
                @elseif(Auth::guard('employer')->user())
                <li><a href="{{route('employer.job.create')}}">Create a Job</a></li>
                <li class="nav-item dropdown" >
                    <a id="navbarDropdown" class="dropdown-trigger" href="#" data-target="employer-dropdown-notification-mobile">
                        <span class='glyphicon glyphicon-globe'></span>Notifications<span class="badge" style='margin-left: -0.5em;'>{{count(auth()->user()->unreadNotifications)}}</span>
                        <i style='margin-left: -0.5em;' class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
                <ul class='dropdown-content' id='employer-dropdown-notification-mobile'>
                        @forelse(auth()->user()->unreadNotifications as $notification)
                        <li>
                        @include('notifications.'.snake_case(class_basename($notification->type)))
                        </li>
                        @empty
                        <a href='#'>No unread notifications</a>
                        @endforelse
                </ul>
                <li><a class="dropdown-trigger" href="#" data-target="employer-dropdown-mobile">{{ Auth::guard('employer')->user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
                @elseif(Auth::guard('jobseeker')->user())
                <li><a class="dropdown-trigger" href="#" data-target="jobseeker-dropdown-mobile">{{ Auth::guard('jobseeker')->user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
                @else
                
                @endif
        </ul>
        @yield('content')
    </div>
     <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">About us</h5>
                <p class="grey-text text-lighten-4">You can use this site to post or apply jobs. By registering with us, gives employer more control over the jobs they list with us. For jobseeker, they get email updated for their saved job alert.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                  <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="/jobseeker">Applied jobs</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Saved Jobs</a></li>
                  <li><a class="grey-text text-lighten-3" href="/contact">Contact</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container center-align">
            &copy; Rowtram <?php echo date('Y'); ?>
            </div>
          </div>
        </footer>
    
    
</body>

</html>
