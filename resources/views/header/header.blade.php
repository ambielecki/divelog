<header>
    @include('flash_message')
    <ul id="login_dropdown" class="dropdown-content text-blue">
        <li><a href="{{ route('login') }}">Log In</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
    </ul>
    <ul id="logout_dropdown" class="dropdown-content text-blue">
        <li><a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Log Out</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        <li><a href="{{ route('user_settings') }}">Settings</a></li>
    </ul>
    <nav class="blue darken-4">
        <div class="nav-wrapper">
            <div class="row">
                <div class="col s12">
                    <a href="/" class="brand-logo">Dive Log Repeat</a>
                    <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="{{ route('calculator') }}">Dive Calculator</a></li>
                        <li><a href="{{ route('divelog_list') }}">Dive Log</a></li>
                        <li><a href="{{ route('updates_list') }}">Updates</a></li>
                        @if (Auth::check())
                            @isAdmin
                                <li><a href="{{ route('admin') }}">Admin</a></li>
                            @endAdmin
                            <li><a class="dropdown-trigger" href="#!" data-target="logout_dropdown">Log Out / Settings<i class="material-icons right">arrow_drop_down</i></a></li>
                        @else
                            <li><a class="dropdown-trigger" href="#!" data-target="login_dropdown">Log In / Register<i class="material-icons right">arrow_drop_down</i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <ul class="sidenav" id="mobile">
        <li><a href="/">Home</a></li>
        <li><a href="{{ route('calculator') }}">Dive Calculator</a></li>
        <li><a href="{{ route('divelog_list') }}">Dive Log</a></li>
        <li><a href="{{ route('updates_list') }}">Updates</a></li>
        @if (Auth::check())
            @isAdmin
                <li><a href="{{ route('admin') }}">Admin</a></li>
            @endAdmin
            <ul class="collapsible" data-collapsible="accordian">
                <li>
                    <div class="collapsible-header black-text">Log Out / Settings</div>
                    <div class="collapsible-body side_nav_collapse">
                        <ul>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            <li><a href="{{ route('user_settings') }}">Settings</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        @else
            <ul class="collapsible" data-collapsible="accordian">
                <li>
                    <div class="collapsible-header black-text">Log In / Register</div>
                    <div class="collapsible-body side_nav_collapse">
                        <ul>
                            <li><a href="{{ route('login') }}">Log In</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        @endif
    </ul>
</header>
