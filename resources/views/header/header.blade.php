<header>
    {{-- Flash Message Code --}}
    @if(\Session::has('flash_warning'))
        <div class="row flash">
            <div class="col s12 red darken-4 white-text">
                <span class="flow-text">{{ \Session::get('flash_warning') }}</span>
            </div>
        </div>
    @endif
    @if(\Session::has('flash_success'))
        <div class="row flash">
            <div class="col s12 green darken-2 white-text">
                <span class="flow-text">{{ \Session::get('flash_success') }}</span>
            </div>
        </div>
    @endif
    <ul id="login_dropdown" class="dropdown-content text-blue">
        <li><a href="{{ route('login') }}">Log In</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
    </ul>
    <nav class="blue darken-4">
        <div class="nav-wrapper">
            <div class="row">
                <div class="col s12">
                    <a href="/" class="brand-logo">Dive Log Repeat</a>
                    <a href="#" data-activates="mobile" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="{{ route('calculator') }}">Dive Calculator</a></li>
                        <li><a href="{{ route('divelog_list') }}">Dive Log</a></li>
                        <li><a href="{{ route('updates_list') }}">Updates</a></li>
                        @if (Auth::check())
                            @if (Auth::user()->level <= 1)
                                <li><a href="{{ 'admin' }}">Admin</a></li>
                            @endif
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Log Out</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-button" href="#!" data-activates="login_dropdown">Log In / Register<i class="material-icons right">arrow_drop_down</i></a></li>
                        @endif
                    </ul>
                    <ul class="side-nav" id="mobile">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('calculator') }}">Dive Calculator</a></li>
                        <li><a href="{{ route('divelog_list') }}">Dive Log</a></li>
                        <li><a href="{{ route('updates_list') }}">Updates</a></li>
                        @if (Auth::check())
                            @if (Auth::user()->level <= 1)
                                <li><a href="{{ 'admin' }}">Admin</a></li>
                            @endif
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Log Out</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
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
                </div>
            </div>
        </div>
    </nav>
</header>