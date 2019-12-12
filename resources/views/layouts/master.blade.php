<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">

</head>
<body>

  <!-- Side bar -->
  <div class="col-lg-2">
  <div id="sidebar-wrapper">
        <nav id="spy">
            <ul class="sidebar-nav nav">
                <li class="sidebar-brand">
                    <a href="#home"><span class="fa fa-home solo">Event Platform</span></a>
                </li>
                <li>
                    <a href="#anch1" data-scroll>
                        <span class="fa fa-anchor solo">Manage Events</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
  </div>
  
  <div class="col-lg-10">
  	<nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">WorldSkills</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign In</a></li>
        <!-- Edit for backend code -->
      </ul>
    </div>
  </nav>


  @yield('content')

  </div>
  <!-- End of col-lg-10 -->
	
	<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>