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
                    <div class="option-row mb-2 d-flex">
                        {!! Form::text('option_name[]', null, ['class' => 'form-control mr-2', 'style' => 'width:40%', 'placeholder' => 'Option Name']) !!}
                        {!! Form::text('option_desc[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Description']) !!}
                        {!! Form::number('option_value[]', null, ['class' => 'form-control mr-2', 'min' => 0, 'style' => 'width:40%', 'placeholder' => 'XP Value']) !!}
                        <a href="#" class="remove-option btn btn-primary" data-toggle="tooltip" title="Remove Option">-</a>
                    </div>
                </div>
                <div class="text-right main-buttons">
                    <a href="#" id="add-group" class="add-op-group btn btn-primary" data-toggle="tooltip" title="Add Group">Add Group</a>
                    <a href="#" id="add-option" class="add-op btn btn-primary" data-toggle="tooltip" title="Add Option">Add Option</a>
                </div>
                <div class="option-row hide mb-2 d-flex">
                    {!! Form::text('option_name[]', null, ['class' => 'form-control mr-2', 'style' => 'width:40%', 'placeholder' => 'Option Name']) !!}
                    {!! Form::text('option_desc[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Description']) !!}
                    {!! Form::number('option_value[]', null, ['class' => 'form-control mr-2', 'min' => 0, 'style' => 'width:40%', 'placeholder' => 'XP Value']) !!}
                    <a href="#" class="remove-option btn btn-primary" data-toggle="tooltip" title="Remove Option">-</a>
                </div>
                <div id="group[]" class="group-row hide p-3 border border-secondary rounded my-2">
                    <div class="row">
                        <div class="text-left col-md-6">
                            {!! Form::label('Group Name') !!}
                        </div>
                        <div class="text-right col-md-6">
                            <a href="#" class="remove-group btn btn-primary mb-2" data-toggle="tooltip" title="Delete Group">Delete Group</a>
                        </div>
                    </div>
                    {!! Form::text('group_name[]', null, ['class' => 'form-control mr-2 mb-4', 'placeholder' => 'Group Name']) !!}
                    <div class="calcList">
                        <h5>Group Options</h5>
                        <div class="option-row mb-2 d-flex">
                            {!! Form::text('g_option_name[]', null, ['class' => 'form-control mr-2', 'style' => 'width:40%', 'placeholder' => 'Option Name']) !!}
                            {!! Form::text('g_option_desc[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Description']) !!}
                            {!! Form::number('g_option_value[]', null, ['class' => 'form-control mr-2', 'min' => 0, 'style' => 'width:40%', 'placeholder' => 'XP Value']) !!}
                            <a href="#" class="remove-option btn btn-primary" data-toggle="tooltip" title="Remove Option">-</a>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="#" id="add-option" class="add-op btn btn-primary" data-toggle="tooltip" title="Add Option">Add Option</a>
                    </div>
                </div>
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
                <p>This is the rate at which word count is converted to XP. To enter the conversion use "Points|Word Count". Example: 1|100 would be 1 XP ever 100 words.</p>
                <div class="d-flex mb-2">
                    {!! Form::text('word_count_conversion_rate', null, ['class' => 'form-control mr-2', 'placeholder' => 'Word Count Conversion Rate']) !!}
                    {!! Form::number('round_to', null, ['class' => 'form-control mr-2 roundTo', 'style' => 'display:none;', 'placeholder' => 'Round to the Nearest']) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('enable_rounding', 1, old('enable_rounding'), ['class' => 'form-check-input enable-rounding', 'data-toggle' => 'toggle']) !!}
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
            $('#add-group').on('click', function(e) {
                e.preventDefault();
                addOptionGroup();
            });
            $('.remove-group').on('click', function(e) {
                e.preventDefault();
                removeOptionGroup($(this));
            });

            function addOptionGroup() {
                var $clone = $('.group-row.hide').clone();
                $('#calcList').append($clone);
                $clone.removeClass('hide');
                $clone.attr('count', $i);
                //Rename the fields
                $inputs = $clone.find('input');
                $inputs.each(function(i, input) {
                    $old_name = $(input).attr('name');
                    $new_name = $old_name.replace('[]', '_') + $i + '[]';
                    $(input).attr('name', $new_name);
                });
                $clone.find('.remove-group').on('click', function(e) {
                    e.preventDefault();
                    removeOptionGroup($(this));
                });
                $clone.find('.add-op').on('click', function(e) {
                    e.preventDefault();
                    $c = $(this).parents('.group-row').attr('count');
                    addOption('.group-row[count="' + $c + '"] .calcList', $c);
                });
                $i++;
            }

            function removeOptionGroup($trigger) {
                $trigger.parents('.group-row').remove();
            }

            // --- Options
            $('.main-buttons #add-option').on('click', function(e) {
                e.preventDefault();
                addOption();
            });

            function addOption($selector = '#calcList', $c = null) {
                var $clone = $('.option-row.hide').clone();
                $($selector).append($clone);
                $clone.removeClass('hide');
                if ($c !== null) {
                    $inputs = $clone.find('input');
                    $inputs.each(function(i, input) {
                        $old_name = $(input).attr('name');
                        $new_name = 'g_' + $old_name.replace('[]', '_') + $c + '[]';
                        $(input).attr('name', $new_name);
                    });
                }
                $clone.find('.remove-option').on('click', function(e) {
                    e.preventDefault();
                    removeOption($(this));
                });
            }

            function removeOption($trigger) {
                $trigger.parents('.option-row').remove();
            }

        });
    </script>
@endsection
