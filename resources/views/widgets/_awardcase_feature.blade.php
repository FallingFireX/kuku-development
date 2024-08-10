@if($target->awards->where('is_featured',1)->where('pivot.count','>',0)->count() && $count)
    <div class="my-3 card {{ $float ? 'float' : '' }}"><div class="row justify-content-center align-items-center">
        @foreach($target->awards->where('is_featured',1)->where('pivot.count','>',0)->unique()->take($count) as $award)
            <div class="text-center mb-1 px-1">
                <a href="{{$award->idUrl}}" class="alert"><img src="{{ $award->imageUrl }}" alt="{{ $award->name }}" data-toggle="tooltip" data-title="{{ $award->name }}"/></a>
            </div>
        @endforeach
        <div class="ml-auto float-right mr-3">
            <a href="{{ $character->url . '/pets' }}" class="btn btn-outline-info btn-sm">View All</a>
        </div>
    </div></div>
@endif