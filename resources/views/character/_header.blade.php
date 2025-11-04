@if (!$character->is_myo_slot && config('lorekeeper.extensions.previous_and_next_characters.display') && isset($extPrevAndNextBtnsUrl))
    @if ($extPrevAndNextBtns['prevCharName'] || $extPrevAndNextBtns['nextCharName'])
        <div class="row mb-4">
            @if ($extPrevAndNextBtns['prevCharName'])
                <div class="col text-left float-left">
                    <a class="btn btn-outline-success text-success" href="{{ $extPrevAndNextBtns['prevCharUrl'] }}{!! $extPrevAndNextBtnsUrl !!}">
                        <i class="fas fa-angle-double-left"></i> Previous Character ・ <span class="text-primary">{!! $extPrevAndNextBtns['prevCharName'] !!}</span>
                    </a>
                </div>
            @endif
            @if ($extPrevAndNextBtns['nextCharName'])
                <div class="col text-right float-right">
                    <a class="btn btn-outline-success text-success" href="{{ $extPrevAndNextBtns['nextCharUrl'] }}{!! $extPrevAndNextBtnsUrl !!}">
                        <span class="text-primary">{!! $extPrevAndNextBtns['nextCharName'] !!}</span> ・ Next Character <i class="fas fa-angle-double-right"></i><br />
                    </a>
                </div>
            @endif
        </div>
    @endif
@endif
<div class="character-masterlist-categories">
    @if (!$character->is_myo_slot)
        {!! $character->category?->displayName ?? 'None' !!} ・ {!! $character->image->species?->displayName ?? 'None' !!} ・ {!! $character->image->rarity?->displayName ?? 'None' !!}
    @else
        MYO Slot @if ($character->image->species_id)
            ・ {!! $character->image->species->displayName !!}
            @endif @if ($character->image->rarity_id)
                ・ {!! $character->image->rarity->displayName !!}
            @endif
        @endif
</div>
<h1 class="mb-0 text-center">
    @if ($character->is_visible && Auth::check() && $character->user_id != Auth::user()->id)
        <?php $bookmark = Auth::user()->hasBookmarked($character); ?>
        <a href="#" class="btn btn-outline-info float-right bookmark-button ml-2" data-id="{{ $bookmark ? $bookmark->id : 0 }}" data-character-id="{{ $character->id }}"><i class="fas fa-bookmark"></i>
            {{ $bookmark ? 'Edit Bookmark' : 'Bookmark' }}</a>
    @endif
 
    @if (!$character->is_visible)
        <i class="fas fa-eye-slash"></i>
    @endif
    
    {!! $character->displayName !!}
    @if (!$character->is_myo_slot)
        <i data-toggle="tooltip" title="Click to Copy the Character Code" id="copy" style="font-size: 14px; vertical-align: middle; " class="far fa-copy text-small"></i>
    @endif

</h1>
<div class="mb-3" style="text-align:center;">
    Owner: {!! $character->displayOwner !!}
</div>


<script>
    $('#copy').on('click', async (e) => {
        await window.navigator.clipboard.writeText("{{ $character->slug }}");
        e.currentTarget.classList.remove('toCopy');
        e.currentTarget.classList.add('toCheck');
        setTimeout(() => {
            e.currentTarget.classList.remove('toCheck');
            e.currentTarget.classList.add('toCopy');
        }, 2000);
    });
</script>
