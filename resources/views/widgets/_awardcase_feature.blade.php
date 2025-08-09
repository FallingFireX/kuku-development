@php
    $awards = $target->awards
        ->where('is_featured', 1)
        ->where('pivot.count', '>', 0);

    
    if (!empty($filterCategory)) {
        $awards = $awards->filter(function ($award) use ($filterCategory) {
            return $award->category && $award->category->name === $filterCategory;
        });
    }

    $awards = $awards->unique()->take($count);
@endphp

@if($awards->count() && $count)
    <div class="row justify-content-center align-items-center">
        @foreach($awards as $award)
            <div class="text-center my-2">
                <a href="{{ $award->idUrl }}" class="alert">
                    <img src="{{ $award->imageUrl }}" alt="{{ $award->name }}" data-toggle="tooltip" data-title="{{ $award->name }}" width="55%" />
                </a>
            </div>
        @endforeach
    </div>
@endif
