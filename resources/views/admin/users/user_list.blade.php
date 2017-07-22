@extends('layouts.admin_layout')

@section('title')
    Users
@stop

@section('content')
    <div class="container">
        @foreach ($users as $key => $user)
            <div class="card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-4">{{ $user->name }}</span>
                    <div class="row">
                        <div class="col s6 l2">
                            <a href="{{ route('user_edit', ['id' => $user->id]) }}" class="btn blue darken-4">Edit User</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if ($pages > 1)
            <ul class="pagination">
                @if ($current_page != 1)
                    <li class="disabled"><a href="{{ route('user_list', ['page' => ($current_page - 1), 'limit' => $limit]) }}"><i class="material-icons">chevron_left</i></a></li>
                @endif
                @for ($i = 1; $i <= $pages; $i++)
                    <li class="{{ $i == $current_page ? 'blue darken-2' : 'blue darken-4' }} white-text"><a class="white-text" href="{{ route('user_list', ['page' => $i]) }}">{{ $i }}</a></li>
                @endfor
                @if ($current_page != $pages)
                    <li class="waves-effect"><a href="{{ route('user_list', ['page' => ($current_page + 1)]) }}"><i class="material-icons">chevron_right</i></a></li>
                @endif
            </ul>
        @endif
    </div>
@stop