@if ($characters->count())
    @foreach($characters as $key => $group)
    <div class="card mb-3 inventory-category">
        <a href="{{ $group->first()->folder ? $group->first()->folder->url : '#' }}">
            <h5 class="card-header inventory-header">
                <span data-toggle="tooltip" title="{{ $group->first()->folder ? $group->first()->folder->description : 'Characters without a folder.'}}">{{ $key }}</span>
            </h5>
        </a>
            
        <div class="card-body inventory-body">
            <div class="row mb-2">
                @foreach ($character as $character)
                    <div class="col-md-3 col-6 text-center mb-2">
                        @if(Auth::check() && (Auth::user()->settings->warning_visibility == 0) && isset($character->character_warning) || isset($character->character_warning) && !Auth::check())
                        <a href="{{ $character->url }}"><img class="img-thumbnail" src="{{ asset('/images/content_warning.png') }}" alt="Content Warning"/></a>
                        @else    
                        <a href="{{ $character->url }}"><img src="{{ $character->image->thumbnailUrl }}" class="img-thumbnail" alt="Thumbnail for {{ $character->fullName }}"/></a>
                        @endif
                        
                        <div class="mt-1">
                            <a href="{{ $character->url }}" class="h5 mb-0">
                                @if (!$character->is_visible)
                                    <i class="fas fa-eye-slash"></i>
                                @endif {{ Illuminate\Support\Str::limit($character->fullName, 20, $end = '...') }}
                            </a>
                        </div>
                        @if(Auth::check() && (Auth::user()->settings->warning_visibility < 2) && isset($character->character_warning) || isset($character->character_warning) && !Auth::check())
                         <div class="small">
                         <p><span class="text-danger"><strong>Character Warning:</strong></span> {!! nl2br(htmlentities($character->character_warning)) !!}</p>
                         </div>
                         @else
                         <div class="small">
                            {!! $character->image->species_id ? $character->image->species->displayName : 'No Species' !!} ・ {!! $character->image->rarity_id ? $character->image->rarity->displayName : 'No Rarity' !!}
                        </div>
                         @endif

                        
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
@else
    <p>No {{ $myo ? 'MYO slots' : 'characters' }} found.</p>
@endif

<!-- <div>
                            <a href="{{ $character->url }}"><img src="{{ $character->image->thumbnailUrl }}" class="img-thumbnail" alt="Thumbnail for {{ $character->fullName }}" /></a>
                        </div>
                        <div class="mt-1">
                            <a href="{{ $character->url }}" class="h5 mb-0">
                                @if (!$character->is_visible)
                                    <i class="fas fa-eye-slash"></i>
                                @endif {{ Illuminate\Support\Str::limit($character->fullName, 20, $end = '...') }}
                            </a>
                        </div>
                        <div class="small">
                            {!! $character->image->species_id ? $character->image->species->displayName : 'No Species' !!} ・ {!! $character->image->rarity_id ? $character->image->rarity->displayName : 'No Rarity' !!}
                        </div> -->