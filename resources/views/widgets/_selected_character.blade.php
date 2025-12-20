@if ($character)
    <div class="card mb-4">
        <div class="card-body text-center">
            <h5 class="card-title">Selected Character</h5>
            <div class="profile-assets-content">
                <div>
                    <a href="{{ $character->url }}">
                        <img src="{{ isset($fullImage) && $fullImage ? $character->image->imageUrl : $character->image->thumbnailUrl }}" class="{{ isset($fullImage) && $fullImage ? '' : 'img-thumbnail' }}" alt="{{ $character->fullName }}" />
                    </a>
                </div>
                <div class="my-1">
                    <a href="{{ $character->url }}" class="h5 mb-0">
                        @if (!$character->is_visible)
                            <i class="fas fa-eye-slash"></i>
                        @endif
                        {{ $character->fullName }}
                    </a>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ $user->url . '/characters' }}" class="btn btn-primary">View All Characters</a>
            </div>
        </div>
    </div>
@endif
