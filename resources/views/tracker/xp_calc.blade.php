@extends('layouts.app')

@section('title')
    Submit XP Tracker
@endsection

@section('content')
    {!! breadcrumbs(['XP Calculator' => '/submit-xp']) !!}
    <h1>Submit XP Tracker</h1>
    <p>Fill out the corresponding options for your artwork/literature. Ensure to double check your points on the totals box and select a character. An admin will process your tracker card for approval. Leave fields blank if they do not apply to your submission.</p>

    <div class="site-page-content parsed-text">
        <pre style="background-color:#ccc;display:none;">
            {{ print_r($xp_calc_form, true) }}
        </pre>

    {!! Form::open(['url' => 'submit-xp', 'files' => false]) !!}
        <div class="row">
            <div class="col-md-8">
                <!-- Calculator Options -->
                @if($xp_calc_form)
                    @foreach($xp_calc_form as $field)
                        <div class="card mb-3">
                            <h5 class="card-header">{{ $field->field_name }}</h5>
                            <div class="card-body">
                                @if($field->field_description) <p>{!! $field->field_description !!}</p> @endif
                                    @switch($field->field_type)
                                        @case('number')
                                            {!! Form::number(($field->field_name), null, ['class' => 'form-control', 'placeholder' => 'Enter a number.']) !!}
                                            @break
                                        @case('radio')
                                            @if($field->field_options)
                                                @foreach($field->field_options as $option)
                                                    <div class="list-item">
                                                        {!! Form::radio($field->field_name, $option->point_value, false, ['class' => 'mr-2', 'id' => $option->label]) !!} <label for="{!! $option->label !!}"><strong>{!! $option->label !!}</strong> ({!! $option->point_value !!} XP) <br>{!! $option->description !!}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                            @break
                                        @csae('checkboxes')
                                            @if($field->field_options)
                                                @foreach($field->field_options as $option)
                                                    <div class="list-item">
                                                        {!! Form::checkbox($field->field_name, $option->point_value, false, ['class' => 'mr-2', 'id' => $option->label]) !!} <label for="{!! $option->label !!}"><strong>{!! $option->label !!}</strong> <br>{!! $option->description !!}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                            @break
                                        @default
                                            <div class="alert alert-danger" role="alert">
                                                There was an issue rendering the field.
                                            </div>
                                    @endswitch       
                            </div>
                        </div>
                    @endforeach
                @endif
                @if($lit_settings)
                    <div class="card mb-3">
                        <h5 class="card-header">Literature Word Count</h5>
                        <div class="card-body">
                            <p>Enter the word count for your work and it will automatically calculate the XP.
                                @if($lit_settings->round_to)
                                     Rounds to the nearest {!! $lit_settings->round_to !!}.
                                @endif
                            </p>
                            {!! Form::number('word_count', null, ['class' => 'form-control wordCount', 'rounding' => $lit_settings->round_to ?? '', 'conversion' => $lit_settings->conversion_rate, 'placeholder' => 'Enter the exact word count']) !!}
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card rounded border border-primary">
                    <div class="card-header"><h3>XP Totals</h3></div>
                    <div class="card-body">
                        <div class="p-2 border border-secondary rounded" id="calcTotals"></div>
                        <hr/>
                        {!! Form::label('Select Character') !!}
                        {!! Form::select('character', $users_character, null, ['class' => 'form-control mr-2 characterSelect', 'placeholder' => 'Select a Character...']) !!}
                        <hr/>
                        {!! Form::label('Select Gallery Submission (Optional)') !!}
                        {!! Form::select('gallery', $user_galleries, null, ['class' => 'form-control mr-2 gallerySelect', 'placeholder' => 'Select a Gallery...']) !!}
                        <div class="text-center my-2">
                            <h5>OR</h5>
                        </div>
                        {!! Form::url('tracker_url', null, ['class' => 'form-control mb-4', 'placeholder' => 'Enter a URL for your artwork or literature']) !!}
                        
                        {!! Form::label('Other Notes (Optional)') !!} {!! add_help('Let admins know any other details you may have for this card.') !!}
                        {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '4', 'placeholder' => 'Add optional notes to your tracker card.']) !!}
                    </div>
                </div>

                <div class="text-right mt-4">
                    {!! Form::submit('Submit Tracker Card for Review', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection

@section('scripts')
    @parent
<script>
    $(document).ready(function() {
        var totals = {};
        var target = $('#calcTotals');

        //On lit word count change
        $('.wordCount').on('change', function() {
            var wc = $(this).val();

            if(wc === 0 || wc === '') {
                delete totals['Word Count'];
                updateTotals();
                return;
            }

            var cr = ($(this).attr('conversion')).split('|');
            var ro = $(this).attr('rounding') ?? 1;

            var raw = (cr[0] * (Math.round(wc / ro) * ro)) / cr[1];
            var total = Math.round(raw * ro) / ro;

            totals['Word Count'] = total;
            updateTotals();
        });

        //On radio input changes
        $('input[type="radio"][name]').change(function() {
            var selected = $(this).val();
            var option_name = $(this).attr('id');
            var group = $(this).attr('name');

            //Find if this option already exists
            var totalKeys = Object.keys(totals);
            var matching = totalKeys.filter(key => key.toLowerCase().includes(group.toLowerCase()));
            if(matching.length > 0) {
                //One already exists!
                $.each(matching, function(k, v) {
                    delete totals[v];
                });
            }

            totals[group + ' - ' + option_name] = selected;
            updateTotals();
        });

        //On checkbox input changes
        $('input[type="checkbox"][name]').change(function() {
            var selected = $(this).val();
            var option_name = $(this).attr('id');
            var group = $(this).attr('name');

            //Find if this option already exists
            var totalKeys = Object.keys(totals);
            var matching = totalKeys.filter(key => key.toLowerCase().includes(group.toLowerCase()));
            if(matching.length > 0) {
                //One already exists!
                $.each(matching, function(k, v) {
                    delete totals[v];
                });
            }

            totals[group + ' - ' + option_name] = selected;
            updateTotals();
        });

        function updateTotals() {
            target.empty();

            $.each(totals, function(key, value) {
                var item = `<div class="d-flex justify-content-between"><strong>${key}:</strong> <span>${value}</span></div>`;
                target.append(item);
            });
        }
    });
</script>
@endsection
