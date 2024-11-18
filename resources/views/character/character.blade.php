@extends('character.layout', ['isMyo' => $character->is_myo_slot])

@section('profile-title') {{ $character->fullName }} @endsection

@section('meta-img') {{ $character->image->thumbnailUrl }} @endsection

@section('profile-content')

<!-- @include('widgets._awardcase_feature', ['target' => $character, 'count' => Config::get('lorekeeper.extensions.awards.character_featured'), 'float' => true]) -->

@if($character->is_myo_slot)
        {!! breadcrumbs(['MYO Slot Masterlist' => 'myos', $character->fullName => $character->url]) !!}
    @else
    {!! breadcrumbs([
            $character->category->masterlist_sub_id ? $character->category->sublist->name . ' Masterlist' : 'Character masterlist' => $character->category->masterlist_sub_id ? 'sublist/' . $character->category->sublist->key : 'masterlist',
            $character->fullName => $character->url,
        ]) !!}
@endif

@if(Auth::check() && (Auth::user()->settings->warning_visibility < 2) && isset($character->character_warning) || isset($character->character_warning) && !Auth::check())
<div id="warning" class="alert alert-danger" style="text-align:center;">
    <span style="float:right;"><a href="#" data-id="{{ $character->character_warning }}" onclick="changeStyle()"><i class="fas fa-times" aria-hidden="true"></i></a></span>
        <h1><i class="fa fa-exclamation-triangle mr-2"></i>Character Warning<i class="fa fa-exclamation-triangle ml-2"></i></h1>
        <h2><p>{!! nl2br(htmlentities($character->character_warning)) !!}</p></h2>
    <img src="{{ asset('/images/content_warning.png') }}" style="width:20%;" alt="Content Warning"></img>
</div>
@endif

@include('character._header', ['character' => $character])
    

    @if ($character->images()->where('is_valid', 1)->whereNotNull('transformation_id')->exists())
    <div class="card-header mb-2">
            <ul class="nav nav-tabs card-header-tabs">
                @foreach ($character->images()->where('is_valid', 1)->get() as $image)
                    <li class="nav-item">
                        <a class="nav-link form-data-button {{ $image->id == $character->image->id ? 'active' : '' }}" data-toggle="tab" role="tab" data-id="{{ $image->id }}">
                            {{ $image->transformation_id ? $image->transformation->name : 'Main' }} {{ $image->transformation_info ? ' ('.$image->transformation_info.')' : '' }}
                        </a>
                    </li>
                @endforeach
                <li>
                    <h3>{!! add_help('Click on a '.__('transformations.transformation').' to view the image. If you don\'t see the '.__('transformations.transformation').' you\'re looking for, it may not have been uploaded yet.') !!}</h3>
                </li>
            </ul>
        </div>
@endif

    {{-- Main Image --}}
    <div class="row mb-3" id="main-tab">
        <div class="col-md-7">
            <div class="text-center">
                <a href="{{ $character->image->canViewFull(Auth::check() ? Auth::user() : null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)) ? $character->image->fullsizeUrl : $character->image->imageUrl }}"
                    data-lightbox="entry" data-title="{{ $character->fullName }}">
                    <img src="{{ $character->image->canViewFull(Auth::check() ? Auth::user() : null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)) ? $character->image->fullsizeUrl : $character->image->imageUrl }}"
                        class="image" alt="{{ $character->fullName }}" />
                </a>
            </div>
            @if ($character->image->canViewFull(Auth::check() ? Auth::user() : null) && file_exists(public_path($character->image->imageDirectory . '/' . $character->image->fullsizeFileName)))
                <div class="text-right">You are viewing the full-size image. <a href="{{ $character->image->imageUrl }}">View watermarked image</a>?</div>
            @endif
            <br>
            <p></p>
            <br>
            <!--Pets relocation-->
            <div class="card mb-7">
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
        </div>
        
        @include('character._image_info', ['image' => $character->image])
    </div>
        
    <div class="my-3 card">
    <h5 class="card-header">
                    Award Wall
                </h5>
                
    @include('widgets._awardcase_feature', ['target' => $character, 'count' => Config::get('lorekeeper.extensions.awards.character_featured'), 'float' => true])
        <div class="ml-auto float-right mr-3">
            <a href="{{ $character->slug . '/'.__('awards.awardcase') }}" class="btn btn-outline-info btn-sm mb-2">View All</a>
        </div>  
        
    </div>    
        
    {{-- Info --}}
    <div class="card character-bio">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                
                <li class="nav-item">
                    <a class="nav-link active" id="notesTab" data-toggle="tab" href="#notes" role="tab">Description</a>
                </li>
                @if($character->getLineageBlacklistLevel() < 2)
                <li class="nav-item">
                    <a class="nav-link" id="lineageTab" data-toggle="tab" href="#lineage" role="tab">Lineage</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" id="skillsTab" data-toggle="tab" href="#skills" role="tab">Skills</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="statsTab" data-toggle="tab" href="#stats" role="tab">Stats</a>
                </li>
                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <li class="nav-item">
                        <a class="nav-link" id="settingsTab" data-toggle="tab" href="#settings-{{ $character->slug }}" role="tab"><i class="fas fa-cog"></i></a>
                    </li>
                @endif
                
            </ul>
        </div>
        <div class="card-body tab-content">
            <div class="tab-pane fade  show active" id="notes">
                @include('character._tab_notes', ['character' => $character])
            </div>
            @if($character->getLineageBlacklistLevel() < 2)
            <div class="tab-pane fade" id="lineage">
                @include('character._tab_lineage', ['character' => $character])
            </div>
            @endif
            <div class="tab-pane fade" id="skills">
                @include('character._tab_skills', ['character' => $character, 'skills' => $skills])
            </div>
            <div class="tab-pane fade" id="stats">
                @include('character._tab_stats', ['character' => $character])
            </div>
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
            
        </div>
    </div>
    <br>
    <p></p>
        
@endsection

@section('scripts')
    @parent
    @include('character._image_js', ['character' => $character])
    @include('character._transformation_js')
@endsection
