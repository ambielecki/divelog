@extends('layouts.standard')

@section('title')
    Dive Log - List
@stop

@section('content')
    <div class="container">
        @if (!count($dive_logs))
            <div class="card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">No Dives Logged</span>
                    <p>You haven't logged any dives yet, so go ahead and get started.</p>
                    <a href="{{ route('divelog_create') }}" class="btn blue darken-4">Log A Dive!</a>
                </div>
            </div>
        @else
            <div class="card blue darken-4">
                <div class="card-content white-text">
                    <span class="card-title white-text">Dive Stats</span>
                    <p>Logged Dives: {{ $logged_dives }}</p>
                    <p>Bottom Time to Date: {{ $bottom_time }}</p>
                    <p>Last Dive: {{ $last_dive ? date_format(date_create_from_format('Y-m-d', $last_dive), 'M j, Y') : 'No Dates Logged' }}</p>
                    <a href="{{ route('divelog_create') }}" class="btn white blue-text tdarken-4">Log A Dive!</a>
                </div>
            </div>
            @foreach ($dive_logs as $dive_log)
                <div class="card">
                    <div class="card-content">
                        <span class="card-title blue-text text-darken-4">{{ $dive_log->dive_number }}: {{ $dive_log->location ?? '' }}{{ $dive_log->dive_site ? ' - ' . $dive_log->dive_site : '' }}</span>
                        <span class="card-title blue-text text-darken-4">{{ $dive_log->date ? date_format(date_create_from_format('Y-m-d', $dive_log->date), 'M j, Y') : '' }}</span>
                        @if ($dive_log->comments)
                            <p>{!! $dive_log->comments !!}</p>
                        @endif
                        <a href="{{ route('divelog_edit', ['id' => $dive_log->id]) }}" class="btn blue darken-4">Edit this Dive</a>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="row">
            <div class="col s4">
                <div class="row white">
                    <div class="input-field col s12">
                        <select name="dives" id="dives">
                            <option value="5" {{ 5 == $limit ? 'selected' : '' }}>5</option>
                            <option value="10" {{ 10 == $limit ? 'selected' : '' }}>10</option>
                            <option value="25" {{ 25 == $limit ? 'selected' : ''}}>25</option>
                            <option value="100" {{ 100 == $limit ? 'selected' : ''}}>100</option>
                        </select>
                        <label for="am_pm">Dives per Page</label>
                    </div>
                </div>
            </div>
            @include('pagination', ['route' => 'divelog_list'])
        </div>
    </div>
@stop

@push('body_scripts')
<script src="/js/divelog/divelog_list.js"></script>
@endpush
