@extends('user.layout', ['user' => isset($user) ? $user : null])

@section('profile-title')
    {{ $user->name }}'s Profile
    @if($user->profile->pronouns)
            <h5 class="card-header">
                {{ $user->profile->pronouns }}
            </h5>
            @endif
@endsection

@section('meta-img')
    {{ $user->avatarUrl }}
@endsection
@section('profile-content')
    {!! breadcrumbs(['Users' => 'users', $user->name => $user->url]) !!}
    @endsection

    



    <div class="card mb-3">
        <div class="card-body text-center">
            <h5 class="card-title">{{ ucfirst(__('awards.awards')) }}</h5>
            <div class="card-body">
                @if(count($awards))
                    <div class="row">
                        @foreach($awards as $award)
                            <div class="col-md-3 col-6 profile-inventory-item">
                                @if($award->imageUrl)
                                    <img src="{{ $award->imageUrl }}" data-toggle="tooltip" title="{{ $award->name }}" />
                                @else
                                    <p>{{ $award->name }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div>No {{ __('awards.awards') }} earned.</div>
                @endif
            </div>
            <div class="text-right"><a href="{{ $user->url.'/'.__('awards.awardcase') }}">View all...</a></div>
        </div>
    </div>

<!-- Uncomment this to restore the original character display.
    <h2>
        <a href="{{ $user->url.'/characters' }}">Characters</a>
        @if(isset($sublists) && $sublists->count() > 0)
            @foreach($sublists as $sublist)
            / <a href="{{ $user->url.'/sublist/'.$sublist->key }}">{{ $sublist->name }}</a>
            @endforeach
        @endif
    </h2>

    @foreach($characters->take(4)->get()->chunk(4) as $chunk)
        <div class="row mb-4">
            @foreach($chunk as $character)
                <div class="col-md-3 col-6 text-center">
                    <div>
                        <a href="{{ $character->url }}"><img src="{{ $character->image->thumbnailUrl }}" class="img-thumbnail" alt="{{ $character->fullName }}" /></a>
                    </div>
                    <div class="mt-1">
                        <a href="{{ $character->url }}" class="h5 mb-0"> @if(!$character->is_visible) <i class="fas fa-eye-slash"></i> @endif {{ $character->fullName }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    <div class="text-right"><a href="{{ $user->url.'/characters' }}">View all...</a></div>
    <hr>
    <br><br>
-->
    @if (mb_strtolower($user->name) != mb_strtolower($name))
        <div class="alert alert-info">This user has changed their name to <strong>{{ $user->name }}</strong>.</div>
    @endif

    @if ($user->is_banned)
        <div class="alert alert-danger">This user has been banned.</div>
    @endif

    @if ($user->is_deactivated)
        <div class="alert alert-info text-center">
            <h1>{!! $user->displayName !!}</h1>
            <p>This account is currently deactivated, be it by staff or the user's own action. All information herein is hidden until the account is reactivated.</p>
            @if (Auth::check() && Auth::user()->isStaff)
                <p class="mb-0">As you are staff, you can see the profile contents below and the sidebar contents.</p>
            @endif
        </div>
    @endif

    @if (!$user->is_deactivated || (Auth::check() && Auth::user()->isStaff))
        @include('user._profile_content', ['user' => $user, 'deactivated' => $user->is_deactivated])
    @endif

@endsection
@section('features')
    @include('widgets._awardcase_feature', ['target' => $user, 'count' => Config::get('lorekeeper.extensions.awards.user_featured'), 'float' => false])
    @include('widgets._selected_character', ['character' => $user->settings->selectedCharacter, 'user' => $user, 'fullImage' => false])
    @endsection