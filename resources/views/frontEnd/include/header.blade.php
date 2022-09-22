<header class="top-header">
    <nav class="navbar header-nav navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('frontEndAsset') }}/images/logo.png"
                    alt="image"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd"
                aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                <ul class="navbar-nav">
                    <li><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
                    <li><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li><a class="nav-link" href="{{ route('course') }}">Courses</a></li>
                    <li><a class="nav-link" href="{{ route('contact') }}">Contact us</a></li>
                    @if (Session::get('teacherId'))
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Session::get('teacherName') }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="nav-link" href="{{ route('teacher.dashboard') }}"">Dashboard</a>
                                </li>
                                <li><a class="nav-link" href="{{ route('teacher.logout') }}">Logout</a></li>

                            </div>
                        </div>
                    @else
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Login
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="nav-link" href="{{ route('student.login') }}">Student Login</a></li>
                                <li><a class="nav-link" href="{{ route('teacher.login') }}">Teacher Login</a></li>

                            </div>
                        </div>
                    @endif


                </ul>
            </div>

        </div>
    </nav>
</header>
