{{-- Image Data --}}
<div class="col-md-5 d-flex">
    <div class="card character-bio w-100">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="infoTab-{{ $image->id }}" data-toggle="tab" href="#info-{{ $image->id }}" role="tab">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="notesTab-{{ $image->id }}" data-toggle="tab" href="#notes-{{ $image->id }}" role="tab">Items</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" id="creditsTab-{{ $image->id }}" data-toggle="tab" href="#credits-{{ $image->id }}" role="tab">Credits</a>
                </li>
                @if (isset($showMention) && $showMention)
                    <li class="nav-item">
                        <a class="nav-link" id="mentionTab-{{ $image->id }}" data-toggle="tab" href="#mention-{{ $image->id }}" role="tab">Mention</a>
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <li class="nav-item">
                        <a class="nav-link" id="settingsTab-{{ $image->id }}" data-toggle="tab" href="#settings-{{ $image->id }}" role="tab"><i class="fas fa-cog"></i></a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="card-body tab-content">
            <div class="text-right mb-1">
                <div class="badge badge-primary">Image #{{ $image->id }}</div>
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
                    <div class="col-lg-8 col-md-6 col-8">{!! $image->genotype ? $image->genotype : 'None' !!}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><strong>Phenotype</strong></div>
                    <div class="col-lg-8 col-md-6 col-8">{!! $image->phenotype ? $image->phenotype : 'None' !!}</div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><strong>Stats</strong></div>
                    <div class="col-lg-2 col-md-6 col-8">{!! '<strong>ATK: </strong> ', $image->atk ? $image->atk : '0' !!}</div>
                    <div class="col-lg-2 col-md-6 col-8">{!! '<strong>DEF: </strong> ', $image->def ? $image->def : '0' !!}</div>
                    <div class="col-lg-2 col-md-6 col-8">{!! '<strong>SPD: </strong> ', $image->spd ? $image->spd : '0' !!}</div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><strong>Biorhythm </strong></div>
                    <div class="col-lg-8 col-md-6 col-8">{!! $image->bio ? $image->bio : 'not set' !!}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4"><strong>Diet </strong></div>
                    <div class="col-lg-8 col-md-6 col-8">{!! $image->diet ? $image->diet : 'not set' !!}</div>
                </div>
                
                <br><p></p>
                <div class="mb-3">
                   
                    @if (config('lorekeeper.extensions.traits_by_category'))
                        <div>
                            @php
                                $traitgroup = $image
                                    ->features()
                                    ->get()
                                    ->groupBy('feature_category_id');
                            @endphp
                            @if ($image->features()->count())
                                @foreach ($traitgroup as $key => $group)
                                    <div class="mb-2">
                                        @if ($key)
                                            <strong>{!! $group->first()->feature->category->displayName !!}: </strong>
                                        @else
                                            <strong>Rank:</strong>
                                        @endif
                                        @foreach ($group as $feature)
                                            {!! $feature->feature->displayName !!} 
                                            @if ($feature->data) 
                                                    ({{ $feature->data }})
                                                @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            @else
                                <div>No traits listed.</div>
                            @endif
                        </div>
                    @else
                        <div>
                            <?php $features = $image
                                ->features()
                                ->with('feature.category')
                                ->get(); ?>
                            @if ($features->count())
                                @foreach ($features as $feature)
                                    <div>
                                        @if ($feature->feature->feature_category_id)
                                            <strong>{!! $feature->feature->category->displayName !!}:</strong>
                                            @endif {!! $feature->feature->displayName !!} @if ($feature->data)
                                                ({{ $feature->data }})
                                            @endif
                                    </div>
                                @endforeach
                            @else
                                <div>No traits listed.</div>
                            @endif
                        </div>
                    @endif
                </div>
                @php
                    // check if there is a type for this object if not passed
                    // for characters first check subtype (since it takes precedence)
                    $type = \App\Models\Element\Typing::where('typing_model', 'App\Models\Character\CharacterImage')
                        ->where('typing_id', $image->id)
                        ->first();
                    if (!isset($type) && $image->subtype_id) {
                        $type = \App\Models\Element\Typing::where('typing_model', 'App\Models\Species\Subtype')
                            ->where('typing_id', $image->subtype_id)
                            ->first();
                    }
                    if (!isset($type)) {
                        $type = \App\Models\Element\Typing::where('typing_model', 'App\Models\Species\Species')
                            ->where('typing_id', $image->species_id)
                            ->first();
                    }
                    $type = $type ?? null;
                @endphp
                <div class="row">
                        <div class="col-lg-6 col-md-6 col-4">
                        <!-- STATUSES -->
                        @php
                            $statuses = \App\Models\Status\StatusEffect::orderBy('name')->pluck('name', 'id');
                        @endphp
                        @if ($character->image->character->statuses)
                        
                        <div class="row">
                                @foreach($statuses as $status)    
                                        <div class="col-lg-2 col-md-3 col-6 text-right">
                                            <div class="btn btn-danger create-folder mx-1">
                                                {!! $status->displaySeverity !!}
                                            </div>
                                        </div>   
                                @endforeach
                        </div>
                        @else
                        <div class="btn btn-success create-folder mx-1">
                                Healthy
                        </div>
                    @endif
                    </div>
                    </div>
                    <br>
                @if ($type || (Auth::check() && Auth::user()->hasPower('manage_characters')))
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <b>Magic:</b>  {!! $type?->displayElements ? $type?->displayElements : 'None' !!}
                        </div>
                        <div class="col-lg-8 col-md-6 col-8 row">
                            <!-- <b>{!! $type?->displayElements !!}</b> -->
                            @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                                {!! add_help('Typing is assigned on an image basis') !!}
                                <div class="ml-auto">
                                    <a href="#" class="btn btn-outline-info btn-sm edit-typing" data-id="{{ $image->id }}">
                                        <i class="fas fa-cog"></i> {{ $type ? 'Edit' : 'Create' }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                    <br>
                <div>
                    <strong>Uploaded:</strong> {!! pretty_date($image->created_at) !!}
                </div>
                <div>
                    <strong>Last Edited:</strong> {!! pretty_date($image->updated_at) !!}
                </div>

                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-features mb-3" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit</a>
                    </div>
                @endif
                
                @if (count($image->character->equipment()))
                    <div class="mb-1 mt-4">
                        <div class="mb-0">
                            <h5>Equipment</h5>
                        </div>
                        <div class="text-center row">
                            @foreach ($image->character->equipment()->take(5) as $equipment)
                                <div class="col-md-2">
                                    @if ($equipment->has_image)
                                        <img class="rounded" src="{{ $equipment->imageUrl }}" data-toggle="tooltip" title="{{ $equipment->equipment->name }}" style="max-width: 75px;" />
                                    @elseif($equipment->equipment->imageurl)
                                        <img class="rounded" src="{{ $equipment->equipment->imageUrl }}" data-toggle="tooltip" title="{{ $equipment->equipment->name }}" style="max-width: 75px;" />
                                    @else
                                        {!! $equipment->equipment->displayName !!}
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="float-right">
                            <a href="{{ $character->url . '/stats' }}">View All...</a>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Image notes --}}
            <div class="tab-pane fade" id="notes-{{ $image->id }}">
                @if ($image->parsed_description)
                    <div class="parsed-text imagenoteseditingparse">{!! $image->parsed_description !!}</div>
                @else
                    <div class="imagenoteseditingparse">No Items have been used on this kukuri.</div>
                @endif
                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-notes" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit</a>
                    </div>
                @endif
            </div>

            {{-- Image credits --}}
            <div class="tab-pane fade" id="credits-{{ $image->id }}">

                <div class="row mb-2">
                    <div class="col-lg-4 col-md-6 col-4">
                        <h5>Design</h5>
                    </div>
                    <div class="col-lg-8 col-md-6 col-8">
                        @foreach ($image->designers as $designer)
                            <div>{!! $designer->displayLink() !!}</div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4">
                        <h5>Art</h5>
                    </div>
                    <div class="col-lg-8 col-md-6 col-8">
                        @foreach ($image->artists as $artist)
                            <div>{!! $artist->displayLink() !!}</div>
                        @endforeach
                    </div>
                </div>
                    <hr>
                    <h5>Mention this Kukuri</h5>
                    In the rich text editor:
                    <div class="alert alert-secondary">
                        [character={{ $character->slug }}]
                    </div>
                    In a comment:
                    <div class="alert alert-secondary">
                        [{{ $character->fullName }}]({{ $character->url }})
                    </div>
                    <hr>
                    <div class="my-2">
                        <strong>For Thumbnails:</strong>
                    </div>
                    In the rich text editor:
                    <div class="alert alert-secondary">
                        [charthumb={{ $character->slug }}]
                    </div>
                    In a comment:
                    <div class="alert alert-secondary">
                        [![Thumbnail of {{ $character->fullName }}]({{ $character->image->thumbnailUrl }})]({{ $character->url }})
                    </div>

                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-credits" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit</a>
                    </div>
                @endif
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
                    <div class="text-right">
                        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                    <hr />
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
