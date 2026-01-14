<a href="{{ $image->canViewFull(Auth::check() ? Auth::user() : null) && file_exists(public_path($image->imageDirectory . '/' . $image->fullsizeFileName)) ? $image->fullsizeUrl : $image->imageUrl }}" data-lightbox="entry"
    data-title="{{ $character->fullName }}">
    <img src="{{ $image->canViewFull(Auth::check() ? Auth::user() : null) && file_exists(public_path($image->imageDirectory . '/' . $image->fullsizeFileName)) ? $image->fullsizeUrl : $image->imageUrl }}" class="image"
        alt="{{ $character->fullName }}" />
</a>
</div>
@if (empty($ajax))
    @if ($character->image->canViewFull(Auth::user() ?? null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)))
        <div class="text-right">
            You are viewing the full-size image.
            <a href="{{ $character->image->imageUrl }}">View watermarked image</a>?
        </div>
    @endif
@endif

</div>
