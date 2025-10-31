{!! Form::open(['url' => 'admin/character/image/' . $image->id . '/traits']) !!}
<div class="form-group">
    {!! Form::label('Species') !!}
    {!! Form::select('species_id', $specieses, $image->species_id, ['class' => 'form-control', 'id' => 'species']) !!}
</div>

<div class="form-group" id="subtypes">
    {!! Form::label('Subtypes (Optional)') !!}
    {!! Form::select('subtype_ids[]', $subtypes, $image->subtypes()->pluck('subtype_id')->toArray() ?? [], ['class' => 'form-control', 'id' => 'subtype', 'multiple']) !!}
</div>


<hr>
<h5>{{ ucfirst(__('transformations.transformations')) }}</h5>
<div class="form-group" id="transformations">
    {!! Form::label(ucfirst(__('transformations.transformation')) . ' (Optional)') !!}
    {!! Form::select('transformation_id', $transformations, $image->transformation_id, ['class' => 'form-control', 'id' => 'transformation']) !!}
</div>
<div class="form-group">
    {!! Form::label(ucfirst(__('transformations.transformation')) . ' Tab Info (Optional)') !!}{!! add_help('This is text that will show alongside the ' . __('transformations.transformation') . ' name in the tabs, so try to keep it short.') !!}
    {!! Form::text('transformation_info', $image->transformation_info, ['class' => 'form-control mr-2', 'placeholder' => 'Tab Info (Optional)']) !!}
</div>
<div class="form-group">
    {!! Form::label(ucfirst(__('transformations.transformation')) . ' Origin/Lore (Optional)') !!}{!! add_help('This is text that will show alongside the ' . __('transformations.transformation') . ' name on the image info area. Explains why the character takes this form, how, etc. Should be pretty short.') !!}
    {!! Form::text('transformation_description', $image->transformation_description, ['class' => 'form-control mr-2', 'placeholder' => 'Origin Info (Optional)']) !!}
</div>
<hr>

<div class="form-group">
    {!! Form::label('Character Rarity') !!}
    {!! Form::select('rarity_id', $rarities, $image->rarity_id, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Traits') !!}
    <div><a href="#" class="btn btn-primary mb-2" id="add-feature">Add Trait</a></div>
    <div id="featureList">
        @foreach ($image->features as $feature)
            <div class="d-flex mb-2">
                {!! Form::select('feature_id[]', $features, $feature->feature_id, ['class' => 'form-control mr-2 feature-select original', 'placeholder' => 'Select Trait']) !!}
                {!! Form::text('feature_data[]', $feature->data, ['class' => 'form-control mr-2', 'placeholder' => 'Extra Info (Optional)']) !!}
                <a href="#" class="remove-feature btn btn-danger mb-2">×</a>
            </div>
        @endforeach
    </div>
    <div class="feature-row hide mb-2">
        {!! Form::select('feature_id[]', $features, null, ['class' => 'form-control mr-2 feature-select', 'placeholder' => 'Select Trait']) !!}
        {!! Form::text('feature_data[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Extra Info (Optional)']) !!}
        <a href="#" class="remove-feature btn btn-danger mb-2">×</a>
    </div>
</div>

 <div class="form-group" id='gender'>
            {!! Form::label('gender') !!}
            {!! Form::select('gender', ['Rook' => 'Rook', 'Dove' => 'Dove'], $image->gender, ['class' => 'form-control']) !!}
        </div>
<div class="form-group" id='eyecolor'>
            {!! Form::label('eyecolor') !!}
            {!! Form::text('eyecolor', $image->eyecolor, ['class' => 'form-control mr-2']) !!}
        </div>

        
<div class="form-group" id='genotype'>
            {!! Form::label('genotype') !!}
            {!! Form::text('genotype', $image->genotype, ['class' => 'form-control mr-2']) !!}
        </div>
 <div class="form-group" id='phenotype'>
            {!! Form::label('phenotype') !!}
            {!! Form::text('phenotype', $image->phenotype, ['class' => 'form-control mr-2']) !!}
        </div>

<div class="form-group" id='stats'>
            {!! Form::label('Stats (atk/def/spd)') !!}
            {!! Form::text('atk', $image->atk, ['class' => 'form-control mr-2']) !!}
            {!! Form::text('def', $image->def, ['class' => 'form-control mr-2']) !!}
            {!! Form::text('spd', $image->spd, ['class' => 'form-control mr-2']) !!}
        </div>

<div class="form-group" id='bio'>
            {!! Form::label('bio') !!}
            {!! Form::select('bio', ['Diurnal' => 'Diurnal', 'Crepuscular' => 'Crepuscular', 'Nocturnal' => 'Nocturnal', 'Diurnal (originally Nocturnal)' => 'Diurnal (originally Nocturnal)', 'Diurnal (originally Crepuscular)' => 'Diurnal (originally Crepuscular)', 'Crepuscular (originally Diurnal)' => 'Crepuscular (originally Diurnal)', 'Crepuscular (originally Nocturnal)' => 'Crepuscular (originally Nocturnal)', 'Nocturnal (originally Diurnal)' => 'Nocturnal (originally Diurnal)', 'Nocturnal (originally Crepuscular)' => 'Nocturnal (originally Crepuscular)'], $image->bio, ['class' => 'form-control']) !!}
        </div>

<div class="form-group" id='diet'>
            {!! Form::label('diet') !!}
            {!! Form::select('diet', ['Carnivore' => 'Carnivore', 'Omnivore' => 'Omnivore', 'Herbivore' => 'Herbivore', 'Carnivore (originally Herbivore)' => 'Carnivore (originally Herbivore)', 'Omnivore (originally Carnivore)' =>'Omnivore (originally Carnivore)', 'Carnivore (originally Omnivore)' => 'Carnivore (originally Omnivore)', 'Herbivore (originally Carnivore)' => 'Herbivore (originally Carnivore)', 'Herbivore (originally Omnivore)' => 'Herbivore (originally Omnivore)', 'Omnivore (originally Herbivore)' => 'Omnivore (originally Herbivore)', 'Herbivore (originally Carnivore)' => 'Herbivore (originally Carnivore)'], $image->diet, ['class' => 'form-control']) !!}
        </div>
 
<div class="text-right">
    {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

<script>
    $(document).ready(function() {
        @if (config('lorekeeper.extensions.organised_traits_dropdown'))
            $('.original.feature-select').selectize({
                render: {
                    item: featureSelectedRender
                }
            });
        @else
            $('.original.feature-select').selectize();
        @endif
        $('#add-feature').on('click', function(e) {
            e.preventDefault();
            addFeatureRow();
        });
        $('.remove-feature').on('click', function(e) {
            e.preventDefault();
            removeFeatureRow($(this));
        })

        function addFeatureRow() {
            var $clone = $('.feature-row').clone();
            $('#featureList').append($clone);
            $clone.removeClass('hide feature-row');
            $clone.addClass('d-flex');
            $clone.find('.remove-feature').on('click', function(e) {
                e.preventDefault();
                removeFeatureRow($(this));
            })

            @if (config('lorekeeper.extensions.organised_traits_dropdown'))
                $clone.find('.feature-select').selectize({
                    render: {
                        item: featureSelectedRender
                    }
                });
            @else
                $clone.find('.feature-select').selectize();
            @endif
        }

        function removeFeatureRow($trigger) {
            $trigger.parent().remove();
        }

        function featureSelectedRender(item, escape) {
            return '<div><span>' + escape(item["text"].trim()) + ' (' + escape(item["optgroup"].trim()) + ')' + '</span></div>';
        }
        refreshSubtype();
    });

    function refreshSubtype() {
        var species = $('#species').val();
        var id = '<?php echo $image->id; ?>';
        $.ajax({
            type: "GET",
            url: "{{ url('admin/character/image/traits/subtype') }}?species=" + species + "&id=" + id,
            dataType: "text"
        }).done(function(res) {
            $("#subtypes").html(res);
            $("#subtype").selectize({
                maxItems: {{ config('lorekeeper.extensions.multiple_subtype_limit') }},
            });
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert("AJAX call failed: " + textStatus + ", " + errorThrown);
        });
        $.ajax({
            type: "GET",
            url: "{{ url('admin/character/image/traits/transformation') }}?species=" + species + "&id=" + id,
            dataType: "text"
        }).done(function(res) {
            $("#transformations").html(res);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert("AJAX call failed: " + textStatus + ", " + errorThrown);
        });
    };

    $("#subtype").selectize({
        maxItems: {{ config('lorekeeper.extensions.multiple_subtype_limit') }},
    });
</script>
