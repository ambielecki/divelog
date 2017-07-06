@extends('layouts.standard')

@section('title')
    Dive Log Repeat - Dive Calculator
@stop

@section('content')
    <div class="row">
        <div class="col s12 m12 l4">
            <div class="card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">Calculate Your Dives</span>
                    <p>
                        Perform simple calculations for your dives according to PADI tables in Imperial Units.
                        This information is for testing only. All divers should check their own calculations using dive tables, computers, or other accepted tool.
                        We assume no liability for the use of this tool.
                    </p><br>
                    <span class="card-title blue-text text-darken-4">How to Use this Tool</span>
                    <p>
                        It's pretty simple, just add some data and calculate! <b>All times should be entered in minutes, and all depths in feet.</b>
                    </p>
                    <ul>
                        <li>Entering a value for Dive 1 Depth will give a max bottom time.</li>
                        <li>Enter a value for Dive 1 Bottom Time and get your pressure group.</li>
                        <li>Entering a Surface Interval will give you your post interval pressure group.</li>
                        <li>Enter a Dive 2 Depth and get your max time at that depth (accounting for residual nitrogen).</li>
                        <li>Finally, enter Dive 2 Bottom Time to get your pressure group after Dive 2.</li>
                    </ul>
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
                        </div>
                        <div class="input-field col s6 {{ $errors->has('dive_1_time') ? ' has-error' : '' }}">
                            <input id="dive_1_time" type="text" name="dive_1_time">
                            <label for="dive_1_time">Dive 1 Bottom Time</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6 {{ $errors->has('surface_interval') ? ' has-error' : '' }}">
                            <input id="surface_interval" type="text" name="surface_interval">
                            <label for="surface_interval">Surface Interval</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6 {{ $errors->has('dive_2_depth') ? ' has-error' : '' }}">
                            <input id="dive_2_depth" type="text" class="form-control" name="dive_2_depth" value="{{ old('dive_2_depth') }}">
                            <label for="dive_2_depth">Dive 2 Depth</label>
                        </div>
                        <div class="input-field col s6 {{ $errors->has('dive_2_time') ? ' has-error' : '' }}">
                            <input id="dive_2_time" type="text" name="dive_2_time">
                            <label for="dive_2_time">Dive 2 Bottom Time</label>
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
        <div class="col s12 m12 l4">
            <div class="card blue darken-4 white-text" id="results">
                <div class="card-content">
                    <span class="card-title">Get Your Results</span>
                    <table class="dive_results">
                        <tr is="dive-row" v-for="result in results" v-if="result.result" :component_message="result.message" :component_result="result.result"></tr>
                    </table>
                </div>
                <div v-if="error_messages" class="red darken-2 white-text dive_errors">
                    <dive-errors :dive_error_messages="error_messages"></dive-errors>
                </div>
            </div>
        </div>
    </div>
    @if (!Agent::isMobile())
        <div class="row">
            <div class="col s4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title blue-text text-darken-4">PADI Dive Table 1</span>
                        <p>
                            Dive Table 1 is used to calculate your pressure group after a dive.
                        </p><br>
                        <p>
                            To use this version of the table, match your max depth to the table header.
                            Move down until you find the table cell with the smallest value that is greater than your bottom time.
                            Your pressure group will be the leftmost value in that row.
                        </p>
                    </div>
                </div>
            </div>
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
            <div class="col s4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title blue-text text-darken-4">PADI Dive Table 2</span>
                        <p>
                            Dive Table 2 is used to calculate your new pressure group after a surface interval.
                        </p><br>
                        <p>
                            To use this version of the table, match your starting pressure group to the left column.
                            Move across until you find the table cell with values (in minutes) within which your surface interval time would fall.
                            Your post surface interval pressure group will be that column's header.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col s12 l8">
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
        <div class="row">
            <div class="col s4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title blue-text text-darken-4">PADI Dive Table 3</span>
                        <p>
                            Dive Table 3 is used to calculate residual nitrogen times after a surface interval.
                        </p><br>
                        <p>
                            To use this version of the table, match your post surface interval pressure group to the table headers.
                            Move down until you find your planned depth in the leftmost columnj.  This value is your Residual Nitrogen Time.  This value
                            is added to your dive's bottom time to calculate your new pressure group.  This time can also be subtracted from the
                            maximum bottom time at a give depth to get your adjusted maximum bottom time.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col s12 l8">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title blue-text text-darken-4">PADI Dive Table 3</span>
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
                            @foreach($table_3_body as $group => $row)
                                <tr>
                                    <th>{{ $group }}</th>
                                    @for($i = 0; $i < count($table_header); $i++)
                                        <td>
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
    @endif
@stop

@push('body_scripts')
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="/js/jquery.tablehover.min.js"></script>
    <script src="/js/dive_calculator.js"></script>
@endpush