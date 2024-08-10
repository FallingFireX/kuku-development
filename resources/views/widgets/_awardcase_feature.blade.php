@if($target->awards->where('is_featured',1)->where('pivot.count','>',0)->count() && $count)
    <div class="row justify-content-center align-items-center">
        @foreach($target->awards->where('is_featured',1)->where('pivot.count','>',0)->unique()->take($count) as $award)
            <div class="text-center mb-1 px-1 my-4">
                <a href="{{$award->idUrl}}" class="alert"><img src="{{ $award->imageUrl }}" alt="{{ $award->name }}" data-toggle="tooltip" data-title="{{ $award->name }}" width="80%"/></a>
            </div>
        @endforeach
        
    </div>
@endif