@extends('layouts.standard')

@section('title')
    Dive Log Repeat - Dive Calculator
@stop

@section('content')
    <div class="row">
        <div class="col s12 l6">
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
    <div class="row">
        <div class="col s12 l12">
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
                            <td>{{ isset($row[$i]) ? $row[$i] : "" }}</td>
                        @endfor
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@push('body_scripts')
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
@endpush