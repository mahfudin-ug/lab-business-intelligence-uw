<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
        
        <a href="index.html" class="logo">
            <h2 class="text-white fw-bold">Business Intelligence</h2>
            {{-- <img src="{{ asset('/img/logo.svg') }}" alt="navbar brand" class="navbar-brand"> --}}
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                    </a>
                
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>

<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            
            <ul class="nav nav-primary">
                <li class="nav-item {{str_contains(URL::current(), 'home')  ? 'active' : ''}}">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        <p>Summary</p>
                        <span class="badge badge-success"></span>
                    </a>
                </li>

                <li class="nav-item {{str_contains(URL::current(), 'instructor')  ? 'active' : ''}}">
                    <a href="{{ route('instructor') }}">
                        <i class="fas fa-user-graduate"></i>
                        <p>Instructor</p>
                        <span class="badge badge-success"></span>
                    </a>
                </li>
                <li class="nav-item {{str_contains(URL::current(), 'course')  ? 'active' : ''}}">
                    <a href="{{ route('course') }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Course</p>
                        <span class="badge badge-success"></span>
                    </a>
                </li>
                <li class="nav-item {{str_contains(URL::current(), 'subject')  ? 'active' : ''}}">
                    <a href="{{ route('subject') }}">
                        <i class="fas fa-university"></i>
                        <p>Subject</p>
                        <span class="badge badge-success"></span>
                    </a>
                </li>

                {{-- <li class="nav-item {{str_contains(URL::current(), 'room')  ? 'active' : ''}}">
                        <a href="{{ route('room') }}">
                        <i class="fas fa-door-open"></i>
                        <p>Room</p>
                        <span class="badge badge-success"></span>
                    </a>
                </li> --}}
                
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->