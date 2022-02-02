<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.css') }}">
    @yield('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
    
    </head>
<body>
	<nav class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-2 shadow-sm">
	  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 bg-light" href="{{ route('home') }}">{{ config('app.name', 'Fulcrum') }}</a>
	  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <ul class="navbar-nav px-3">
	    <li class="nav-item text-nowrap">
	      <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>
	    </li>
	    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
	  </ul>
	</nav>
	<div class="container-fluid">
	  <div class="row">
	    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
	      <div class="sidebar-sticky pt-3">
	        <ul class="nav flex-column">
	        	<li class="nav-item">
	            <a class="nav-link btn btn-success btn-md text-white" href="{{ route('parcel.new') }}">
	              <i class="fas fa-plus-circle"></i>&nbsp;New Parcel
	            </a>
	          </li>
	          <li class="nav-item">
	            <a class="nav-link" href="{{ route('parcel.all') }}">
	              <span class="fas fa-truck"></span>
	              Parcels
	            </a>
	          </li>
	      	</ul>
	      	   <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
		          <span>Filters</span>
		          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
		            <span data-feather="plus-circle"></span>
		          </a>
		        </h6>
		        {{-- <ul class="nav flex-column">
		        	<li class="nav-item">
		        		<a href="#" class="nav-link"><i class="fas fa-plus-circle"></i>&nbsp;New Client</a>
		        	</li>
		        	<li class="nav-item">
		        		<a href="{{ route('parcel.new') }}" class="nav-link"> <i class="fas fa-plus-circle"></i>&nbsp;New Parcel</a>
		        	</li>
		        </ul> --}}
	  	</div>
	  </nav>
	  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
	      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	        <h1 class="h2">@yield('pagetitle')</h1>
	        <div class="btn-toolbar mb-2 mb-md-0">
	          <div class="btn-group mr-2">
	            {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Share</button> --}}
	            @yield('buttons')
	          </div>
	          {{-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
	            <span data-feather="calendar"></span>
	            This week
	          </button> --}}
	        </div>
	      </div>
	      @if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			@if(session()->has('success'))
			    <div class="alert alert-success alert-dismissible fade">
			        {{ session()->get('success') }}
			    </div>
			@endif
	      @yield('content')
  		</main>
  	</div>
  </div>

	 <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
@yield('js')
</body>
</html>
