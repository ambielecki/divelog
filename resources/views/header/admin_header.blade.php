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
    <ul id="image_dropdown" class="dropdown-content text-blue">
        <li><a href="{{ route('image_list') }}">Image List</a></li>
        <li><a href="{{ route('image_upload') }}">Upload Image</a></li>
        <li><a href="{{ route('image_folder_list') }}">Image Folder List</a></li>
        <li><a href="{{ route('image_folder_create') }}">Add Image Folder</a></li>
    </ul>
    <ul id="page_dropdown" class="dropdown-content text-blue">
    <li><a href="{{ route('home_edit') }}">Edit Home Page</a></li>
    </ul>
    <nav class="blue darken-4">
        <div class="nav-wrapper">
            <div class="row">
                <div class="col s12">
                    <a href="/" class="brand-logo">Dive Log Repeat</a>
                    <a href="#" data-activates="mobile" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="{{ route('admin') }}">Admin Home</a></li>
                        <li><a class="dropdown-button" href="#!" data-activates="page_dropdown">Pages<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a class="dropdown-button" href="#!" data-activates="image_dropdown">Images<i class="material-icons right">arrow_drop_down</i></a></li>
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
                        <li><a href="{{ route('admin') }}">Admin Home</a></li>
                        <ul class="collapsible" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header black-text">Pages</div>
                                <div class="collapsible-body side_nav_collapse">
                                    <ul>
                                        <li><a href="{{ route('home_edit') }}">Edit Home Page</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <ul class="collapsible" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header black-text">Images</div>
                                <div class="collapsible-body side_nav_collapse">
                                    <ul>
                                        <li><a href="{{ route('image_list') }}">Image List</a></li>
                                        <li><a href="{{ route('image_upload') }}">Upload Image</a></li>
                                        <li><a href="{{ route('image_folder_list') }}">Image Folder List</a></li>
                                        <li><a href="{{ route('image_folder_create') }}">Add Image Folder</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
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