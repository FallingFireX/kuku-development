@extends('admin.layout')

@section('admin-title')
    Art Tracker Settings
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Art Tracker Settings' => 'admin/tracker-settings/']) !!}

    <h1>Art Tracker Settings</h1>

    <p>Edit all of the art tracker related settings here.</p>

    {!! Form::open(['url' => 'admin/tracker-settings', 'files' => true]) !!}

    <div class="card mb-4">
        <div class="card-header">
            <h3>Levels</h3>
            <p>Edit the leveling benchmarks across all characters. Start from the lowest rank to the highest.</p>
        </div>
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('Levels') !!}
                <div id="levelList">
                    @if ($levels)
                        @foreach ($levels as $name => $val)
                            <div class="level-row mb-2 d-flex">
                                {!! Form::text('level_name[]', $name, ['class' => 'form-control mr-2', 'placeholder' => 'Level Name']) !!}
                                {!! Form::number('level_threshold[]', $val, ['class' => 'form-control mr-2', 'min' => 0, 'placeholder' => 'Minimum Level Threshold']) !!}
                                <a href="#" class="remove-level btn btn-primary" data-toggle="tooltip" title="Remove Level">-</a>
                            </div>
                        @endforeach
                    @else
                        <div class="level-row mb-2 d-flex">
                            {!! Form::text('level_name[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Level Name']) !!}
                            {!! Form::number('level_threshold[]', null, ['class' => 'form-control mr-2', 'min' => 0, 'placeholder' => 'Minimum Level Threshold']) !!}
                            <a href="#" class="remove-level btn btn-primary" data-toggle="tooltip" title="Remove Level">-</a>
                        </div>
                    @endif
                </div>
                <div class="text-right">
                    <a href="#" id="add-level" class="add-level btn btn-primary" data-toggle="tooltip" title="Add Level">Add Level</a>
                </div>
                <div class="level-row hide mb-2">
                    {!! Form::text('level_name[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Level Name']) !!}
                    {!! Form::number('level_threshold[]', null, ['class' => 'form-control mr-2', 'min' => 0, 'placeholder' => 'Minimum Level Threshold']) !!}
                    <a href="#" class="remove-level btn btn-primary" data-toggle="tooltip" title="REmove Level">-</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>XP Calculator Settings</h3>
            <p>Configure the XP points here. You can group items to allow only one option in a group to be selected.</p>
        </div>
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('XP Calculator Options') !!}
                <div id="calcList">
                    <div class="option-row mb-2 p-2 border border-secondary rounded d-flex flex-column" field-id="0">
                        <div class="row-parent mb-2 d-flex">
                            {!! Form::text('field_name[]', null, ['class' => 'form-control mr-2', 'style' => 'width:40%', 'placeholder' => 'Field Name']) !!}
                            {!! Form::select('field_type[]', ['radio' => 'Radio Buttons', 'checkboxes' => 'Checkboxes', 'number' => 'Number'], null, ['class' => 'form-control mr-2 ftype', 'style' => 'width:40%', 'placeholder' => 'Please select a Field Type...']) !!}
                            {!! Form::text('field_desc[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Description']) !!}
                            <a href="#" class="remove-field btn btn-primary" data-toggle="tooltip" title="Remove Field">-</a>
                        </div>
                        <div class="mb-2 ml-3 border-left pl-3">
                            <h5>Field Options</h5>
                            <div class="row-children">
                                <div class="child-row row mb-2 px-3">
                                    <div class="col-md-2 px-1">
                                        {!! Form::number('sub_option_value_0[]', null, ['class' => 'form-control w-100', 'placeholder' => 'Point Value']) !!}
                                    </div>
                                    <div class="col-md-4 px-1">
                                        {!! Form::text('sub_option_label_0[]', null, ['class' => 'form-control w-100', 'placeholder' => 'Option Name']) !!}
                                    </div>
                                    <div class="col-md-6 px-1 d-flex">
                                        {!! Form::text('sub_option_desc_0[]', null, ['class' => 'form-control w-100', 'placeholder' => 'Option Description']) !!}
                                        <a href="#" class="remove-option ml-2 btn btn-primary" data-toggle="tooltip" title="Remove Option">-</a>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="#" id="add-option" class="add-op mt-2 btn btn-primary" data-toggle="tooltip" title="Add Option">Add Option</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right main-buttons">
                    <a href="#" id="add-field" class="add-field btn btn-primary" data-toggle="tooltip" title="Add Field">Add Field</a>
                </div>
                <!-- Field Template Start -->
                <div class="option-row template hide mb-2 p-2 border border-secondary rounded d-flex flex-column">
                    <div class="row-parent mb-2 d-flex">
                        {!! Form::text('field_name[]', null, ['class' => 'form-control mr-2', 'style' => 'width:40%', 'placeholder' => 'Field Name']) !!}
                        {!! Form::select('field_type[]', ['radio' => 'Radio Buttons', 'checkboxes' => 'Checkboxes', 'number' => 'Number'], null, ['class' => 'form-control mr-2 ftype', 'style' => 'width:40%', 'placeholder' => 'Please select a Field Type...']) !!}
                        {!! Form::text('field_desc[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Description']) !!}
                        <a href="#" class="remove-field btn btn-primary" data-toggle="tooltip" title="Remove Field">-</a>
                    </div>
                    <div class="optionsList hide mb-2 ml-3 border-left pl-3">
                        <h5>Field Options</h5>
                        <div class="row-children">
                            <div class="child-row hide row mb-2 px-3">
                                <div class="col-md-2 px-1">
                                    {!! Form::number('sub_option_value[]', null, ['class' => 'form-control w-100', 'placeholder' => 'Point Value']) !!}
                                </div>
                                <div class="col-md-4 px-1">
                                    {!! Form::text('sub_option_label[]', null, ['class' => 'form-control w-100', 'placeholder' => 'Option Name']) !!}
                                </div>
                                <div class="col-md-6 px-1 d-flex">
                                    {!! Form::text('sub_option_desc[]', null, ['class' => 'form-control w-100', 'placeholder' => 'Option Description']) !!}
                                    <a href="#" class="remove-option ml-2 btn btn-primary" data-toggle="tooltip" title="Remove Option">-</a>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="#" id="add-option" class="add-op mt-2 btn btn-primary" data-toggle="tooltip" title="Add Option">Add Option</a>
                        </div>
                    </div>
                </div>
                <!-- Field Template End -->
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3>Literature XP Calculator Settings</h3>
            <p>Configure the XP points for literature here. Note that this ONLY applies to word count, the rest is shared with the general XP calculator settings. Leave all blank to disable.</p>
        </div>
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('Word Count Options') !!}
                <p>This is the rate at which word count is converted to XP. To enter the conversion use "Points|Word Count". Example: 1|100 would be 1 XP every 100 words.</p>
                <div class="d-flex mb-2">
                    {!! Form::text('word_count_conversion_rate', $lit_settings->conversion_rate, ['class' => 'form-control mr-2', 'placeholder' => 'Word Count Conversion Rate']) !!}
                    {!! Form::number('round_to', $lit_settings->round_to, ['class' => 'form-control mr-2 roundTo', 'style' => $lit_settings->round_to ? '' : 'display:none;', 'placeholder' => 'Round to the Nearest']) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('enable_rounding', 1, $lit_settings->round_to ? 1 : 0, ['class' => 'form-check-input enable-rounding', 'data-toggle' => 'toggle']) !!}
                    {!! Form::label('enable_rounding', 'Enable Rounding', ['class' => 'form-check-label ml-3']) !!} {!! add_help('Enable to create a rounding rule for literature word counts.') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="text-right mt-4">
        {!! Form::submit('Save Settings', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {

            $field_count = 1;

            $('.enable-rounding').on('change', function() {
                console.log('rounding changed');
                if ($(this).is(':checked')) {
                    console.log('show!');
                    $('.roundTo').show();
                } else {
                    console.log('hide!');
                    $('.roundTo').hide();
                }
            });

            $i = 1;
            //Level Repeater
            $('#add-level').on('click', function(e) {
                e.preventDefault();
                addLevelRow();
            });
            $('.remove-level').on('click', function(e) {
                e.preventDefault();
                removeLevelRow($(this));
            })

            function addLevelRow() {
                var $clone = $('.level-row.hide').clone();
                $('#levelList').append($clone);
                $clone.removeClass('hide');
                $clone.addClass('d-flex');
                $clone.find('.remove-level').on('click', function(e) {
                    e.preventDefault();
                    removeLevelRow($(this));
                });
            }

            function removeLevelRow($trigger) {
                $trigger.parent().remove();
            }

            //Calculator Repeater
            // --- Groups
            $('#calcList').on('click', '#add-option', function(e) {
                e.preventDefault();
                addOption($(this).parent().prev());
            });
            $('.remove-option').on('click', function(e) {
                e.preventDefault();
                removeOption($(this));
            });

            function addOption($parent) {
                var $clone = $('.template .child-row.hide').clone();
                $childLength = $parent.children('.child-row').length;
                $field_id = $parent.parents('.option-row').attr('field-id');
                $unique_row_id = $field_id + '_' + $childLength;
                $parent.append($clone);
                $clone.removeClass('hide');
                $clone.attr('count', $i);
                //Rename the fields
                $inputs = $clone.find('input, select');
                $inputs.each(function(i, input) {
                    $old_name = $(input).attr('name');
                    $new_name = $old_name.replace('[]', '_') + $unique_row_id + '[]';
                    $(input).attr('name', $new_name);
                });
                $clone.find('.child-row').on('click', function(e) {
                    e.preventDefault();
                    removeOption($(this));
                });
                $i++;
            }

            function removeOption($trigger) {
                $trigger.parents('.child-row').remove();
            }

            // --- Options
            $('.main-buttons #add-field').on('click', function(e) {
                e.preventDefault();
                addField();
            });

            function addField($selector = '#calcList', $c = null) {
                var $clone = $('.option-row.hide').clone();
                $($selector).append($clone);
                $clone.removeClass('hide');
                $clone.removeClass('template');
                $clone.attr('field-id', $field_count);
                $clone.children('.child-row').first().attr('row-id', 0);
                if ($c !== null) {
                    $inputs = $clone.find('input, select');
                    $inputs.each(function(i, input) {
                        $old_name = $(input).attr('name');
                        $new_name = 'g_' + $old_name.replace('[]', '_') + $c + '[]';
                        $(input).attr('name', $new_name);
                    });
                }
                $clone.find('.remove-field').on('click', function(e) {
                    e.preventDefault();
                    removeField($(this));
                });
            }

            function removeField($trigger) {
                $trigger.parents('.option-row').remove();
            }

            //On Field Change
            $('#calcList').on('change', 'select.ftype', function() {
                var val = $(this).val();
                if (val == 'radio' || val == 'checkboxes') {
                    $(this).parents('.option-row').find('.optionsList').removeClass('hide');
                } else {
                    $(this).parents('.option-row').find('.optionsList').addClass('hide');
                }
            });

            //Double check for remove option
            $('#calcList').on('click', '.remove-option', function(e) {
                e.preventDefault();
                removeOption($(this));
            });

        });
    </script>
@endsection
