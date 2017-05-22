<header>
    {{-- Flash Message Code --}}
    @if(\Session::has('flash_warning'))
        <div class="row flash">
            <div class="col s12 red darken-4 white-text">
                <span class="flow-text">{{\Session::get('flash_warning')}}</span>
            </div>
        </div>
    @endif
    @if(\Session::has('flash_success'))
        <div class="row flash">
            <div class="col s12 green darken-2 white-text">
                <span class="flow-text">{{\Session::get('flash_success')}}</span>
            </div>
        </div>
    @endif
    <nav class="blue darken-4">
        <div class="nav-wrapper">
            <div class="row">
                <div class="col s12">
                    <a href="/" class="brand-logo">Dive Log Repeat</a>
                    <a href="#" data-activates="mobile" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="{{ route('divelog') }}">Dive Log</a></li>
                        @if (Auth::check())
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Log Out</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <li><a href="/login">Log In</a></li>
                        @endif
                    </ul>
                    <ul class="side-nav" id="mobile">
                        <li><a href="{{ route('divelog') }}">Dive Log</a></li>
                        <li><a href="badges.html">Components</a></li>
                        @if (Auth::check())
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Log Out</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <li><a href="/login">Log In</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>