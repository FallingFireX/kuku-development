@php
    $traitgroup = $image->features()->get()->groupBy('feature_category_id');
@endphp

@if ($image->features()->count())
    {{-- Changed to check for category 14 specifically to prevent "Undefined Index" errors --}}
    @if (isset($traitgroup[14])) 
        <div class="mb-2" style="font-size: 0.85rem">
            <strong>Special origin:</strong>
            @foreach ($traitgroup[14] as $feature)
                @php
                    $name = $feature->feature->displayName;
                @endphp

                @if (stripos($name, 'admin') !== false)
                    <span data-toggle="tooltip" title="This kukuri cant be sold, traded, or gifted. Only donated to the adoption center!">
                        <i class="fas fa-dragon"></i>
                    </span>
                @elseif (stripos($name, 'raffle') !== false) {{-- Fixed: Changed to @elseif --}}
                    <span data-toggle="tooltip" title="This kukuri cant be sold, traded, or gifted. Only donated to the adoption center!">
                        <i class="fas fa-ticket"></i>
                    </span>
                @endif

                {!! $name !!}

                @if ($feature->data)
                    ({{ $feature->data }})
                @endif
            @endforeach
        </div>
    @endif
@endif


@if ($character->lineage !== null)
    <?php $line = $character->lineage; ?>
    @include('character._tab_lineage_tree', [
        'line' => [
            'sire' => $line->getDisplayName('sire'),
            'sire_sire' => $line->getDisplayName('sire_sire'),
            'sire_sire_sire' => $line->getDisplayName('sire_sire_sire'),
            'sire_sire_dam' => $line->getDisplayName('sire_sire_dam'),
            'sire_dam' => $line->getDisplayName('sire_dam'),
            'sire_dam_sire' => $line->getDisplayName('sire_dam_sire'),
            'sire_dam_dam' => $line->getDisplayName('sire_dam_dam'),
            'dam' => $line->getDisplayName('dam'),
            'dam_sire' => $line->getDisplayName('dam_sire'),
            'dam_sire_sire' => $line->getDisplayName('dam_sire_sire'),
            'dam_sire_dam' => $line->getDisplayName('dam_sire_dam'),
            'dam_dam' => $line->getDisplayName('dam_dam'),
            'dam_dam_sire' => $line->getDisplayName('dam_dam_sire'),
            'dam_dam_dam' => $line->getDisplayName('dam_dam_dam'),
        ],
    ])
@else
    @include('character._tab_lineage_tree', [
        'line' => [
            'sire' => 'Unknown',
            'sire_sire' => 'Unknown',
            'sire_sire_sire' => 'Unknown',
            'sire_sire_dam' => 'Unknown',
            'sire_dam' => 'Unknown',
            'sire_dam_sire' => 'Unknown',
            'sire_dam_dam' => 'Unknown',
            'dam' => 'Unknown',
            'dam_sire' => 'Unknown',
            'dam_sire_sire' => 'Unknown',
            'dam_sire_dam' => 'Unknown',
            'dam_dam' => 'Unknown',
            'dam_dam_sire' => 'Unknown',
            'dam_dam_dam' => 'Unknown',
        ],
    ])
@endif



@if (Auth::check() && Auth::user()->hasPower('manage_characters'))
    <div class="mt-3">
        <a href="#" class="btn btn-outline-info btn-sm edit-lineage" data-{{ $character->is_myo_slot ? 'id' : 'slug' }}="{{ $character->is_myo_slot ? $character->id : $character->slug }}"><i class="fas fa-cog"></i> Edit</a>
    </div>
@endif
