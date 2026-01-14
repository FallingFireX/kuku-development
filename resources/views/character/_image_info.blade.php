{{-- Image Data --}}
<div class="col-md-5 d-flex">
    <div class="card character-bio w-100">
        @if ((isset($image->content_warnings) && !Auth::check()) || (Auth::check() && Auth::user()->settings->content_warning_visibility < 2 && isset($image->content_warnings)))
            <div class="alert alert-danger text-center">
                <span class="float-right">
                    <a href="#" data-dismiss="alert" class="close">
                        <i class="fas fa-times" aria-hidden="true"></i>
                    </a>
                </span>
                <img src="{{ asset('images/content-warning.png') }}" class="mb-1" alt="Content Warning" style="height: 10vh;" />
                <h5>
                    <i class="fa fa-exclamation-triangle mr-2"></i>Character Warnings<i class="fa fa-exclamation-triangle ml-2"></i>
                </h5>
                <div>{!! implode(', ', $image->content_warnings) !!}</div>
            </div>
        @endif
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="infoTab-{{ $image->id }}" data-toggle="tab" href="#info-{{ $image->id }}" role="tab">Info</a>
                </li>


                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <li class="nav-item">
                        <a class="nav-link" id="settingsTab-{{ $image->id }}" data-toggle="tab" href="#settings-{{ $image->id }}" role="tab"><i class="fas fa-cog"></i></a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="card-body tab-content">

            @if ($image->character->getStatusEffects()->count())
                <b style="font-size:16px">{!! $image->character->fullName !!} currently has</b>
                @foreach ($image->character->getStatusEffects() as $status)
                    <a href="{{ $character->url . '/status-effects' }}" class="{{ set_active('character/' . $character->slug . '/status-effects') }}">
                        <div class="btn" style="color: red; font-size:16px">
                            <h5>{!! $status->displaySeverity($status->quantity) !!}</h5>
                        </div>
                    </a>
                @endforeach
                <br>

            @endif

            <div class="position-relative">
                @if ($character->adoption != null)
                    <span class="btn badge-info position-absolute" style="top: 0; right: 0; z-index: 10;" data-toggle="tooltip" title="This kukuri was adopted on {{ $character->adoption }}">
                        <i class="fas fa-heart"></i>
                    </span>
                @endif
                @if ($character->donation != null)
                    <span class="btn badge-info position-absolute" style="top: 0; right: 0; z-index: 10;" data-toggle="tooltip" title="This kukuri was donated to the adoption center on {{ $character->donation }}">
                        <i class="fas fa-hand-holding-heart"></i>
                    </span>
                @endif
            </div>
            @if (!$image->character->is_myo_slot && !$image->is_valid)
                <div class="alert alert-danger">
                    This version of this {{ __('lorekeeper.character') }} is outdated, and only noted here for recordkeeping purposes. Do not use as an official reference.
                </div>
            @endif

            {{-- Basic info --}}
            <div class="tab-pane fade show active" id="info-{{ $image->id }}">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4">
                        <b>Species</b>
                    </div>
                    <div class="col-lg-8 col-md-6 col-8">{!! $image->species_id ? $image->species->displayName : 'None' !!}</div>
                </div>
                @if ($image->subtype_id)
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <b>Breed</b>
                        </div>
                        <div class="col-lg-8 col-md-6 col-8">{!! $image->subtype_id ? $image->subtype->displayName : 'None' !!}</div>
                    </div>
                @endif
                @if ($image->character->homeSetting)
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <h5>Home</h5>
                        </div>
                        <div class="col-lg-8 col-md-6 col-8">{!! $image->character->location ? $image->character->location : 'None' !!}</div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><strong>Gender</strong></div>
                    <div class="col-lg-8 col-md-6 col-8">
                        <span data-toggle="tooltip" title="A Rook is a Male Kukuri, while a Dove is a Female!">
                            {!! $image->gender ? $image->gender : 'None' !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><strong>Eyecolor</strong></div>
                    <div class="col-lg-8 col-md-6 col-8">{!! $image->eyecolor ? $image->eyecolor : 'None' !!}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><strong>Genotype</strong></div>
                    <div class="col-lg-8 col-md-6 col-8">
                        @if ($character->base)
                            {!! $geno !!}
                        @else
                            {!! $image->genotype ? $image->genotype : 'None' !!}
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><strong>Phenotype</strong></div>

                    <div class="col-lg-8 col-md-6 col-8">
                        @if ($character->base)
                            {!! $pheno !!}
                        @else
                            {!! $image->phenotype ? $image->phenotype : 'None' !!}
                        @endif
                    </div>
                </div>
                <br>


                <div class="mb-2">
                    <div>
                        @php
                            $traitgroup = $image->features()->get()->groupBy('feature_category_id');
                        @endphp

                        @if ($image->features()->count())
                            @foreach ($traitgroup as $key => $group)
                                {{-- Skip category null (rank) and category 1 --}}
                                @if ($key && $key != 1)
                                    <div class="mb-2">
                                        <strong>{!! $group->first()->feature->category->displayName !!}:</strong>
                                        @foreach ($group as $feature)
                                            {!! $feature->feature->displayName !!}
                                            @if ($feature->data)
                                                ({{ $feature->data }})
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div>Your kukuri doesnt have traits added! Please submit an import error prompt to get this fixed!</div>
                        @endif
                    </div>
                </div>


                <div class="row pt-3">
                    <div class="col-lg-4 col-md-6 col-4"><strong>Biorhythm </strong></div>
                    <div class="col-lg-8 col-md-6 col-8">{!! $image->bio ? $image->bio : 'not set' !!}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><strong>Diet </strong></div>
                    <div class="col-lg-8 col-md-6 col-8">{!! $image->diet ? $image->diet : 'not set' !!}</div>
                </div>

                <div class="row pt-3">
                    <div class="col-lg-4 col-md-6 col-4"><strong>Stats</strong></div>
                    <div class="col-lg-2 col-md-6 col-8">{!! '<strong>ATK: </strong> ', $image->atk ? $image->atk : '0' !!}</div>
                    <div class="col-lg-2 col-md-6 col-8">{!! '<strong>DEF: </strong> ', $image->def ? $image->def : '0' !!}</div>
                    <div class="col-lg-2 col-md-6 col-8">{!! '<strong>SPD: </strong> ', $image->spd ? $image->spd : '0' !!}</div>
                </div>


                <!--rank-->
                <div class="mt-4">
                    @php
                        $traitgroup = $image->features()->get()->groupBy('feature_category_id');
                    @endphp

                    @if ($image->features()->count())

                        {{-- Handle Rank (null category) --}}
                        @if ($traitgroup->has(null))
                            <div class="mb-2">
                                <strong>Rank:</strong>
                                @foreach ($traitgroup[null] as $feature)
                                    {!! $feature->feature->displayName !!}
                                    @if ($feature->data)
                                        ({{ $feature->data }})
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div><b>Rank:</b> None</div>
                        @endif
                    @else
                        <div>No traits listed.</div>
                    @endif
                </div>




                <!--Items-->
                <div class="pt-3">
                    @if ($image->parsed_description)
                        <b>Items</b>:
                        <div class="parsed-text imagenoteseditingparse">{!! $image->parsed_description !!}</div>
                    @else
                        <div class="imagenoteseditingparse"><b>Items</b>: None</div>
                    @endif
                </div>

                @php
                    // check if there is a type for this object if not passed
                    // for characters first check subtype (since it takes precedence)
                    $type = \App\Models\Element\Typing::where('typing_model', 'App\Models\Character\CharacterImage')->where('typing_id', $image->id)->first();
                    if (!isset($type) && $image->subtype_id) {
                        $type = \App\Models\Element\Typing::where('typing_model', 'App\Models\Species\Subtype')->where('typing_id', $image->subtype_id)->first();
                    }
                    if (!isset($type)) {
                        $type = \App\Models\Element\Typing::where('typing_model', 'App\Models\Species\Species')->where('typing_id', $image->species_id)->first();
                    }
                    $type = $type ?? null;
                @endphp


                @if ($type || (Auth::check() && Auth::user()->hasPower('manage_characters')))
                    <div class="row pt-3">
                        <div class="col-lg-4 col-md-6 col-4">
                            <b>Magic:</b> {!! $type?->displayElements ? $type?->displayElements : 'None' !!}
                        </div>
                    </div>
                @endif

                @if ($image->character->factionSetting)
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-4">
                            <b>Tribe/Guild:</b> {!! $image->character->faction ? $image->character->currentFaction : 'None' !!}{!! $character->factionRank ? ' (' . $character->factionRank->name . ')' : null !!}
                        </div>
                    </div>
                @endif

                <hr>
                <div class="row no-gutters mb-2 mt-2">
                    <div class="col-lg-4 col-4">
                        <b>Design by: </b>
                    </div>
                    <div class="col-lg-8 col-8">
                        @foreach ($image->designers as $designer)
                            <div>{!! $designer->displayLink() !!}</div>
                        @endforeach
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-4 col-4">
                        <b>Modifications by: </b>
                    </div>
                    <div class="col-lg-8 col-8">
                        @foreach ($image->artists as $artist)
                            <div>{!! $artist->displayLink() !!}</div>
                        @endforeach
                    </div>
                </div>
                <br>
                <div>
                    <strong>Uploaded:</strong> {!! pretty_date($image->created_at) !!}
                </div>
                <div>
                    <strong>Last Edited:</strong> {!! pretty_date($image->updated_at) !!}
                </div>

                <!--Admin tools-->


                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <hr>
                    <b>Admin tools</b>
                    <br><i>You can see these because you are an admin with the power to edit characters.</i>
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-features mb-3" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit Traits</a>
                        <a href="#" class="btn btn-outline-info btn-sm edit-notes mb-3" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Add items</a>
                        <a href="#" class="btn btn-outline-info btn-sm edit-typing mb-3" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> {{ $type ? 'Edit' : 'Add Magic' }}</a>
                        <a href="#" class="btn btn-outline-info btn-sm edit-stats mb-3" data-{{ $character->is_myo_slot ? 'id' : 'slug' }}="{{ $character->is_myo_slot ? $character->id : $character->slug }}"><i class="fas fa-cog"></i>
                            Edit</a>
                    </div>
                    <hr>
                @endif
                <div class="text-right mb-1">
                    <div class="badge badge-primary">Image #{{ $image->id }}</div>
                </div>

            </div>

            @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                <div class="tab-pane fade" id="settings-{{ $image->id }}">
                    {!! Form::open(['url' => 'admin/character/image/' . $image->id . '/settings']) !!}
                    <div class="form-group">
                        {!! Form::checkbox('is_visible', 1, $image->is_visible, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                        {!! Form::label('is_visible', 'Is Viewable', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is turned off, the image will not be visible by anyone without the Manage Masterlist power.') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::checkbox('is_valid', 1, $image->is_valid, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                        {!! Form::label('is_valid', 'Is Valid', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is turned off, the image will still be visible, but displayed with a note that the image is not a valid reference.') !!}
                    </div>
                    @if (config('lorekeeper.settings.enable_character_content_warnings'))
                        <div class="form-group">
                            {!! Form::label('Content Warnings') !!} {!! add_help('These warnings will be displayed on the character\'s page. They are not required, but are recommended if the character contains sensitive content.') !!}
                            {!! Form::text('content_warnings', null, ['class' => 'form-control', 'id' => 'warningList', 'data-init-value' => $image->editWarnings]) !!}
                        </div>
                    @endif
                    <div class="text-right">
                        {!! Form::submit('Edit', ['class' => 'btn btn-primary mb-3']) !!}
                    </div>
                    {!! Form::close() !!}

                    <div class="text-right">
                        @if ($character->character_image_id != $image->id)
                            <a href="#" class="btn btn-outline-info btn-sm active-image" data-id="{{ $image->id }}">Set Active</a>
                        @endif <a href="#" class="btn btn-outline-info btn-sm reupload-image" data-id="{{ $image->id }}">Reupload Image</a> <a href="#" class="btn btn-outline-danger btn-sm delete-image"
                            data-id="{{ $image->id }}">Delete</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


@include('widgets._character_warning_js')
