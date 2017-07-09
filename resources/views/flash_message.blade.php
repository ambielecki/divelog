{{-- Flash Message Code --}}
@if(\Session::has('flash_warning'))
    <div class="row flash">
        <div class="col s12 red darken-4 white-text">
            <span class="flow-text">{{ \Session::get('flash_warning') }} <i class="fa fa-window-close flash_close" aria-hidden="true"></i></span>
        </div>
    </div>
@endif
@if(\Session::has('flash_success'))
    <div class="row flash">
        <div class="col s12 green darken-2 white-text">
            <span class="flow-text">{{ \Session::get('flash_success') }} <i class="fa fa-window-close flash_close" aria-hidden="true"></i></span>
        </div>
    </div>
@endif