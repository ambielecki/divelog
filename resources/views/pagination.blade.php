@if ($pages > 1)
    <div class="col s8">
        <ul class="pagination">
            @if ($current_page != 1)
                <li class="disabled"><a href="{{ route($route, ['page' => ($current_page - 1), 'limit' => $limit]) }}"><i class="material-icons">chevron_left</i></a></li>
            @endif
            @for ($i = 1; $i <= $pages; $i++)
                <li class="{{ $i == $current_page ? 'blue darken-2' : 'blue darken-4' }} white-text"><a class="white-text" href="{{ route($route, ['page' => $i, 'limit' => $limit]) }}">{{ $i }}</a></li>
            @endfor
            @if ($current_page != $pages)
                <li class="waves-effect"><a href="{{ route($route, ['page' => ($current_page + 1), 'limit' => $limit]) }}"><i class="material-icons">chevron_right</i></a></li>
            @endif
        </ul>
    </div>
@endif