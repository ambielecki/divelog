@extends('layouts.standard')

@section('title')
    Dive Log Repeat - Dive Calculator
@stop

@section('content')
    <div class="row">
        <div class="col l4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">Calculate Your Dives</span>
                    <p>
                        Perform simple calculations for your dives according to PADI tables in Imperial Units.
                        This information is for testing only. All divers should check their own calculations using dive tables, computers, or other accepted tool.
                        We assume no liability for the use of this tool.
                    </p>
                </div>
            </div>
        </div>
        <div class="col s12 m12 l4">
            <div class="card-panel">
                <form class="form-horizontal" id="dive_calculator" method="post">
                    <div class="row">
                        <div class="input-field col s6 {{ $errors->has('dive_1_depth') ? ' has-error' : '' }}">
                            <input id="dive_1_depth" type="text" class="form-control" name="dive_1_depth" value="{{ old('dive_1_depth') }}">
                            <label for="dive_1_depth">Dive 1 Depth</label>
                            @if ($errors->has('dive_1_depth'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('dive_1_depth') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-field col s6 {{ $errors->has('dive_1_time') ? ' has-error' : '' }}">
                            <input id="dive_1_time" type="text" name="dive_1_time">
                            <label for="dive_1_time">Dive 1 Bottom Time</label>
                            @if ($errors->has('dive_1_time'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('dive_1_time') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6 {{ $errors->has('surface_interval') ? ' has-error' : '' }}">
                            <input id="surface_interval" type="text" name="surface_interval">
                            <label for="surface_interval">Surface Interval</label>
                            @if ($errors->has('surface_interval'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('surface_interval') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6 {{ $errors->has('dive_2_depth') ? ' has-error' : '' }}">
                            <input id="dive_2_depth" type="text" class="form-control" name="dive_2_depth" value="{{ old('dive_2_depth') }}">
                            <label for="dive_2_depth">Dive 2 Depth</label>
                            @if ($errors->has('dive_2_depth'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('dive_2_depth') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-field col s6 {{ $errors->has('dive_2_time') ? ' has-error' : '' }}">
                            <input id="dive_2_time" type="text" name="dive_2_time">
                            <label for="dive_2_time">Dive 2 Bottom Time</label>
                            @if ($errors->has('dive_2_time'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('dive_2_time') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <button type="submit" class="btn blue darken-4">Calculate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col l4">
            <div class="card blue darken-4 white-text" id="results">
                <div class="card-content">
                    <span class="card-title">Get Your Results</span>
                    <table class="dive_results">
                        <tr is="dive-row" v-for="result in results" v-if="result.result" :component_message="result.message" :component_result="result.result"></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 l6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">PADI Dive Table 1</span>
                    <table class="bordered striped centered dive_table responsive">
                        <thead>
                        <tr>
                            <th></th>
                            @foreach($table_1_header as $cell)
                                <th>{{ $cell }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($table_1_body as $group => $row)
                            <tr>
                                <th>{{ $group }}</th>
                                @for($i = 0; $i < count($table_1_header); $i++)
                                    <td>{{ isset($row[$i]) ? $row[$i] : "" }}</td>
                                @endfor
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 l8 offset-l2">
            <div class="card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">PADI Dive Table 2</span>
                    <table class="bordered striped centered dive_table responsive">
                        <thead>
                        <tr>
                            <th></th>
                            @foreach($table_header as $cell)
                                <th>{{ $cell }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($table_2_body as $group => $row)
                            <tr>
                                <th>{{ $group }}</th>
                                @for($i = 0; $i < count($table_header); $i++)
                                    <td>
                                        {{ isset($row[$i]) ? isset($row[$i+1]) ? $row[$i+1] + 1 : 0 : '' }}<br>
                                        {{ isset($row[$i]) ? $row[$i] : "" }}
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@push('body_scripts')
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="/js/jquery.tablehover.min.js"></script>
    <script>
        $(document).ready(function () {
            $('table').tableHover({
                colClass: 'dive_hover',
                rowClass: 'dive_hover',
                headCols: true,
            });
        });
    </script>
    <script src="/js/dive_calculator.js"></script>
@endpush