@extends('character.layout', ['isMyo' => $character->is_myo_slot])

@section('profile-title')
    {{ $character->fullName }}
@endsection

@section('profile-content')


    <!-- @include('widgets._awardcase_feature', ['target' => $character, 'count' => Config::get('lorekeeper.extensions.awards.character_featured'), 'float' => true]) -->

    @if ($character->is_myo_slot)
        {!! breadcrumbs(['MYO Slot Masterlist' => 'myos', $character->fullName => $character->url]) !!}
    @else
        {!! breadcrumbs([
            $character->category->masterlist_sub_id ? $character->category->sublist->name . ' Masterlist' : 'Character masterlist' => $character->category->masterlist_sub_id ? 'sublist/' . $character->category->sublist->key : 'masterlist',
            $character->fullName => $character->url,
        ]) !!}
    @endif

    @if ((Auth::check() && Auth::user()->settings->warning_visibility < 2 && isset($character->character_warning) && strlen($character->character_warning) > 1) || (isset($character->character_warning) && !Auth::check()))
        <div id="warning" class="alert alert-danger" style="text-align:center;">
            <span style="float:right;"><a href="#" data-id="{{ $character->character_warning }}" onclick="changeStyle()"><i class="fas fa-times" aria-hidden="true"></i></a></span>
            <h1><i class="fa fa-exclamation-triangle mr-2"></i>Character Warning<i class="fa fa-exclamation-triangle ml-2"></i></h1>
            <h2>
                <p>{!! nl2br(htmlentities($character->character_warning)) !!}</p>
            </h2>
            <img src="{{ asset('/images/content_warning.png') }}" style="width:20%;" alt="Content Warning"></img>
        </div>
    @endif

    @include('character._header', ['character' => $character])

    @php
        $images = $character->images()->where('is_valid', 1)->get();
        $hasTransformations = $images->pluck('transformation_id')->filter()->isNotEmpty();
    @endphp

    {{-- Main Image --}}
    <div class="row mb-3 align-items-stretch">
        <div class="col-md-10">
            <div class="text-center">
                <div id="main-tab">
                    <a href="{{ $character->image->canViewFull(Auth::user() ?? null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)) ? $character->image->fullsizeUrl : $character->image->imageUrl }}"
                        data-lightbox="entry" data-title="{{ $character->fullName }}">
                        <img src="{{ $character->image->canViewFull(Auth::user() ?? null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)) ? $character->image->fullsizeUrl : $character->image->imageUrl }}"
                            class="image {{ $character->image->showContentWarnings(Auth::user() ?? null) ? 'content-warning' : '' }}" alt="{{ $character->fullName }}" />
                    </a>
                </div>
            </div>
            @if ($character->image->canViewFull(Auth::user() ?? null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)))
                <div class="text-right">You are viewing the full-size image. <a href="{{ $character->image->imageUrl }}">View watermarked image</a>?</div>
            @endif
        </div>


        <div class="col-md-2 overflow-auto">
            @if (config('lorekeeper.extensions.character_status_badges'))
                <!-- character trade/gift status badges -->
                <div class="justify-content-center text-center">
                    <span class="btn {{ $character->is_trading ? 'badge-success' : 'badge-danger' }} mt-1" data-toggle="tooltip" title="{{ $character->is_trading ? 'OPEN for sale and trade offers.' : 'CLOSED for sale and trade offers.' }}"><i
                            class="fas fa-comments-dollar"></i></span>
                    @if (!$character->is_myo_slot)
                        <span class="btn {{ $character->is_gift_writing_allowed == 1 ? 'badge-success' : ($character->is_gift_writing_allowed == 2 ? 'badge-warning text-light' : 'badge-danger') }} mt-1 " data-toggle="tooltip"
                            title="{{ $character->is_gift_writing_allowed == 1 ? 'OPEN for gift writing.' : ($character->is_gift_writing_allowed == 2 ? 'PLEASE ASK before gift writing.' : 'CLOSED for gift writing.') }} mt-1"><i
                                class="fas fa-file-alt"></i></span>
                        <span class="btn {{ $character->is_gift_art_allowed == 1 ? 'badge-success' : ($character->is_gift_art_allowed == 2 ? 'badge-warning text-light' : 'badge-danger') }} mt-1 " data-toggle="tooltip"
                            title="{{ $character->is_gift_art_allowed == 1 ? 'OPEN for gift art.' : ($character->is_gift_art_allowed == 2 ? 'PLEASE ASK before gift art.' : 'CLOSED for gift art.') }} mt-1"><i class="fas fa-pencil-ruler"></i></span>
                        @if ($character->kotm == 1)
                            <span class="btn badge-info  mt-1" data-toggle="tooltip" title="{{ $character->kotm == 1 ? 'Previously been Kukuri of the Month' : 'CLOSED for link requests.' }}"><i class="fas fa-award"></i></span>
                        @endif
                    @endif
                    <ul class="nav nav-pills flex-column mt-2 ">
                        @if (config('lorekeeper.extensions.character_TH_profile_link') && $character->profile->link)
                            <a class="btn btn-outline-info mb-3" data-character-id="{{ $character->id }}" href="{{ $character->profile->link }}"><i class="fab fa-deviantart"></i> DA Import</a>
                        @endif
                    </ul>

                    <!--Health-->
                    <div class="row">
                        <div class="col-md-5">
                            <div style="font-size:16px"><b>Status: </b></div>
                        </div>
                        <div class="col-md-7 mb-3">
                            @if ($character->getStatusEffects()->count())
                                <a href="{{ $character->url . '/status-effects' }}" class="{{ set_active('character/' . $character->slug . '/status-effects') }}">
                                    <div style="color: red; font-size:16px">Sick/Injured</div>
                                </a>
                            @else
                                <a href="{{ $character->url . '/status-effects' }}" class="{{ set_active('character/' . $character->slug . '/status-effects') }}">
                                    <div style="color: green; font-size:16px">Healthy</div>
                                </a>
                            @endif
            @endif
        </div>
    </div>
    @include('widgets._awardcase_feature', ['target' => $character, 'count' => Config::get('lorekeeper.extensions.awards.character_featured'), 'float' => true, 'filterCategory' => 'Ranks'])
    <hr>
    @if ($hasTransformations)
        <ul class="nav nav-pills flex-column mt-3 mb-3">
            @if ($images->count() > 1)
                <h5>Images {!! add_help('If your kukuri has any Other Side, Original (unmodded) or other aiding images, those appear in this list') !!}</h5>
                <ul class="nav flex-column">
                    @foreach ($images as $image)
                        <li class="nav-item">
                            <a class="nav-link form-data-button {{ $image->id == $character->image->id ? 'active' : '' }}" data-id="{{ $image->id }}">
                                <img src="{{ $image->thumbnail_url ?? $image->url }}" alt="Thumbnail" style="width: 100%; height: auto; border-radius: 5px;">
                                <div>{{ $image->transformation_id ? $image->transformation->name : 'Main' }}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </ul>
    @endif
    </div>
    </div>


    </div>
    <!--FAMILIARS-->
    <div class="row mb-3 " id="main-tab-row">
        <div class="col-md-7">

            <div class="card mb-7 ">
                <h5 class="card-header">
                    Familiars
                </h5>
                <div class="card-body">
                    @php
                        $pets = \App\Models\Pet\Pet::orderBy('name')->pluck('name', 'id');
                    @endphp
                    @if (count($character->image->character->pets))
                        <div class="row justify-content-center text-center">
                            {{-- get one random pet --}}
                            @php
                                $pets = $character->image->character->pets()->orderBy('sort', 'DESC')->limit(config('lorekeeper.pets.display_pet_count'))->get();
                            @endphp
                            @foreach ($pets as $pet)
                                @if (config('lorekeeper.pets.pet_bonding_enabled'))
                                    @include('character._pet_bonding_info', ['pet' => $pet])
                                @else
                                    <div class="col">
                                        <img src="{{ $pet->pet->variantImage($pet->id) }}" style="max-width: 100%;" />
                                        <br>
                                        <span class="text-light" style="font-size:95%;">{!! $pet->pet_name !!}</span>
                                        <br>
                                        <span class="text-dark" style="font-size:95%;">{!! $pet->pet->displayName !!}</span>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <div class="ml-auto float-right mr-3">
                            <a href="{{ $character->url . '/pets' }}" class="btn btn-outline-info btn-sm">View All</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="my-3 card">
                <h5 class="card-header">
                    Award Wall
                </h5>

                @include('widgets._awardcase_feature', ['target' => $character, 'count' => Config::get('lorekeeper.extensions.awards.character_featured'), 'float' => true])
                <div class="ml-auto float-right mr-3">
                    <a href="{{ $character->slug . '/' . __('awards.awardcase') }}" class="btn btn-outline-info btn-sm mb-2">View All</a>
                </div>

            </div>




            {{-- Info --}}
            <div class="card character-bio flex-fill">
                <h5 class="card-header">
                    Lineage
                </h5>
                <div class="mx-auto mt-3">
                    <p><i>This is your kukuri's immediate family tree, you can compare this to other kukuri to see who they are safe to breed to.</i></p>
                    <br>
                    @include('character._tab_lineage', ['character' => $character])
                    <br>
                    View Offspring here:
                    <br>
                    <div class="text-left mb-2">
                        <a class="btn btn-primary create-folder mx-1" href="{{ $character->url . '/lineage' }}" class="{{ set_active('character/' . $character->slug . '/lineage') }}"><i class="fas fa-code-branch"></i> Descendants</a>
                    </div>
                </div>

                <br>

            </div>
        </div>

        @include('character._image_info', ['image' => $character->image])
    </div>



    {{-- Info --}}
    <div class="card character-bio">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">

                <li class="nav-item">
                    <a class="nav-link active" id="notesTab" data-toggle="tab" href="#personality" role="tab">Personality</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="notesTab" data-toggle="tab" href="#notes" role="tab">DA Data</a>
                </li>
                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <li class="nav-item">
                        <a class="nav-link" id="settingsTab" data-toggle="tab" href="#settings-{{ $character->slug }}" role="tab"><i class="fas fa-cog"></i></a>
                    </li>
                @endif

            </ul>
        </div>
        <div class="card-body tab-content">
            <!-- PERSONALITY -->
            <div class="tab-pane fade  show active" id="personality">
                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="text-right mb-2">
                        <a class="btn btn-primary create-folder mx-1" href="{{ $character->url . '/profile/edit' }}" class="{{ set_active('character/' . $character->slug . '/profile/edit') }}"><i class="fas fa-edit"></i> Edit personality</a>
                    </div>
                @endif
                @if ($character->profile->parsed_text)
                    {!! $character->profile->parsed_text !!}
                @endif
            </div>


            <br>

            @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                <div class="tab-pane fade" id="settings-{{ $character->slug }}">
                    {!! Form::open(['url' => $character->is_myo_slot ? 'admin/myo/' . $character->id . '/settings' : 'admin/character/' . $character->slug . '/settings']) !!}
                    <div class="form-group">
                        {!! Form::checkbox('is_visible', 1, $character->is_visible, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                        {!! Form::label('is_visible', 'Is Visible', ['class' => 'form-check-label ml-3']) !!} {!! add_help('Turn this off to hide the character. Only mods with the Manage Masterlist power (that\'s you!) can view it - the owner will also not be able to see the character\'s page.') !!}
                    </div>
                    <div class="text-right">
                        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                    <hr />
                    <div class="text-right">
                        <a href="#" class="btn btn-outline-danger btn-sm delete-character" data-slug="{{ $character->slug }}">Delete</a>
                    </div>
                </div>
            @endif
            <!-- DA Data -->
            <div class="tab-pane fade" id="notes">
                @include('character._tab_notes', ['character' => $character])
            </div>
        </div>
    </div>



@endsection

@section('scripts')
    @parent
    @include('character._image_js', ['character' => $character])
    @include('character._transformation_js')
@endsection
