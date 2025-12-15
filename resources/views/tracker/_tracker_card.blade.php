@if ($tracker)

    <?php
    if ($tracker->gallery_id) {
        $image_data = [
            'url' => $tracker->gallery->getUrlAttribute(),
            'image' => $tracker->gallery->getThumbnailUrlAttribute() ?? url('/') . '/images/tracker_fallback.png',
            'alt' => $tracker->gallery->title,
        ];
    } else {
        $image_data = [
            'url' => $tracker->url,
            'image' => $tracker->url ?? url('/') . '/images/tracker_fallback.png',
            'alt' => 'Tracker Card Image (#' . $tracker->id . ')',
        ];
    }
    $image_html = '<a href="' . $image_data['url'] . '"><img class="img-fluid mr-3" src="' . $image_data['image'] . '" alt="' . $image_data['alt'] . '"/></a>';
    ?>

    <div class="card">
        <h4 class="card-header justify-content-between d-flex">Tracker Card (#{{ $tracker->id }}) <span class="badge badge-pill badge-{{ $tracker->status === 'Pending' ? 'warning' : 'success' }}">{{ $tracker->status }}</span></h4>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    {!! $image_html !!}
                </div>
                <div class="col-md-9">
                    <?php
                    $data = $tracker->getDataAttribute();
                    $cards = [];
                    $total = 0;
                    ?>
                    @if ($tracker->status === 'Pending' || !$editable)
                        @if (count($data) > 1)
                            @foreach ($data as $i => $card)
                                @foreach ($card as $title => $value)
                                    @if (gettype($value) === 'array')
                                        <div class="line-group border border-secondary my-2">
                                            <h4 class="line-header text-uppercase font-weight-bold p-2">{{ $title }}</h4>
                                            @foreach ($value as $sub_title => $sub_val)
                                                @if ($sub_title === 'sub_card')
                                                    @foreach ($sub_val as $sub_sub_title => $sub_sub_val)
                                                        <div class="line-item w-100 d-inline-flex justify-content-between p-2">
                                                            <h5 class="lh-1 m-0">{{ $sub_sub_title }}</h5>
                                                            <p class="lh-1 m-0">{{ $sub_sub_val }} {{ __('art_tracker.xp') }}</p>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="line-item w-100 d-inline-flex justify-content-between p-2">
                                                        <h5 class="lh-1 m-0">{{ $sub_title }}</h5>
                                                        <p class="lh-1 m-0">{{ $sub_val }} {{ __('art_tracker.xp') }}</p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="line-item w-100 d-inline-flex justify-content-between p-2">
                                            <h5 class="lh-1 m-0">{{ $title }}</h5>
                                            <p class="lh-1 m-0">{{ $value }} {{ __('art_tracker.xp') }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            @foreach ($data as $i => $subcard)
                                @if (gettype($subcard) === 'array')
                                    @foreach ($subcard as $group_title => $lines)
                                        <div class="line-group border border-secondary my-2">
                                            <h4 class="line-header text-uppercase font-weight-bold p-2">{{ $group_title }}</h4>
                                            @if (gettype($lines) === 'array')
                                                @foreach ($lines as $sub_title => $sub_val)
                                                    <div class="line-item w-100 d-inline-flex justify-content-between p-2">
                                                        <h5 class="lh-1 m-0">{{ $sub_title }}</h5>
                                                        <p class="lh-1 m-0">{{ $sub_val }} {{ __('art_tracker.xp') }}</p>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="line-item w-100 d-inline-flex justify-content-between p-2">
                                                    <h5 class="lh-1 m-0">{{ $group_title }}</h5>
                                                    <p class="lh-1 m-0">{{ $lines }} {{ __('art_tracker.xp') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="line-item w-100 d-inline-flex justify-content-between p-2">
                                        <h5 class="lh-1 m-0">{{ $i }}</h5>
                                        <p class="lh-1 m-0">{{ $subcard }} {{ __('art_tracker.xp') }}</p>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @else
                        <?php
                        $total = 0;
                        $i = 0;
                        ?>
                        <div class="line-rows">
                            <?php
                            $total = 0;
                            $i = 0;
                            ?>
                            @foreach ($cardData as $title => $value)
                                @if (gettype($value) === 'array')
                                    <div class="line-group border border-secondary my-2" data-id="{{ $i }}">
                                        <div class="line-header p-2">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>Group</h5>
                                                <a href="#" class="remove-group btn btn-sm btn-danger ml-2">-</a>
                                            </div>
                                            {!! Form::text('card[' . $i . '][title]', $title, ['class' => 'form-control']) !!}
                                        </div>
                                        <hr class="my-1 border border-secondary" />
                                        <?php $si = 0; ?>
                                        @foreach ($value as $title => $sub_val)
                                            <div class="line-item w-100 d-inline-flex align-items-center justify-content-between p-2">
                                                {!! Form::text('card[' . $i . '][sub_card][' . $si . '][title]', $title, ['class' => 'form-control']) !!}
                                                {!! Form::number('card[' . $i . '][sub_card][' . $si . '][value]', $sub_val, ['class' => 'form-control w-25 ml-2']) !!} <span class="badge ml-2">{{ __('art_tracker.xp') }}</span>
                                                <a href="#" class="remove-line btn btn-sm btn-danger ml-2">-</a>
                                            </div>
                                            <?php
                                            $total += $sub_val;
                                            $si++;
                                            ?>
                                        @endforeach
                                        <div class="text-right">
                                            <a href="#" id="addSubLine" class="btn btn-sm btn-primary m-2">Add Sub Line</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="line-item w-100 d-inline-flex align-items-center justify-content-between p-2" data-id="{{ $i }}">
                                        {!! Form::text('card[' . $i . '][title]', $title, ['class' => 'form-control']) !!}
                                        {!! Form::number('card[' . $i . '][value]', $value, ['class' => 'form-control w-25 ml-2']) !!} <span class="badge ml-2">{{ __('art_tracker.xp') }}</span>
                                        <a href="#" class="remove-line btn btn-sm btn-danger ml-2">-</a>
                                    </div>
                                    <?php $total += $value; ?>
                                @endif
                                <?php
                                $i++;
                                ?>
                            @endforeach
                        </div>
                        <div class="text-right">
                            <a href="#" id="addGroup" class="btn btn-sm btn-primary mt-2">Add Group</a>
                            <a href="#" id="addLine" class="btn btn-sm btn-primary mt-2">Add Line</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <h5>Total</h5><span class="font-weight-bold bg-primary text-white p-2 rounded">TOTAL {{ __('art_tracker.xp') }}</span>
        </div>
    </div>

    @if ($editable)
        <div class="template hide">
            <!-- Grouped Template -->
            <div class="line-group border border-secondary my-2" data-id="__INDEX__">
                <div class="line-header p-2">
                    <div class="d-flex justify-content-between mb-2">
                        <h5>Group</h5>
                        <a href="#" class="remove-group btn btn-sm btn-danger ml-2">-</a>
                    </div>
                    {!! Form::text('card[__INDEX__][title]', null, ['class' => 'form-control']) !!}
                </div>
                <hr class="my-1 border border-secondary" />
                <div class="line-item w-100 d-inline-flex align-items-center justify-content-between p-2">
                    {!! Form::text('card[__INDEX__][sub_card][__SUB_INDEX__][title]', null, ['class' => 'form-control']) !!}
                    {!! Form::number('card[__INDEX__][sub_card][__SUB_INDEX__][value]', 1, ['class' => 'form-control w-25 ml-2']) !!} <span class="badge ml-2">{{ __('art_tracker.xp') }}</span>
                    <a href="#" class="remove-line btn btn-sm btn-danger ml-2">-</a>
                </div>
                <div class="text-right">
                    <a href="#" id="addSubLine" class="btn btn-sm btn-primary m-2">Add Sub Line</a>
                </div>
            </div>
            <!-- Single Line Template -->
            <div class="line-item w-100 d-inline-flex align-items-center justify-content-between p-2" data-id="__INDEX__">
                {!! Form::text('card[__INDEX__][title]', null, ['class' => 'form-control']) !!}
                {!! Form::number('card[__INDEX__][value]', 1, ['class' => 'form-control w-25 ml-2']) !!} <span class="badge ml-2">{{ __('art_tracker.xp') }}</span>
                <a href="#" class="remove-line btn btn-sm btn-danger ml-2">-</a>
            </div>
        </div>
    @endif
@endif
@section('scripts')
    @parent
    @if ($editable)
        <script>
            $(document).ready(function() {
                // Tracker editor JS
                $('#addLine').on('click', function(e) {
                    e.preventDefault();
                    var index = $('.line-rows .line-item, .line-rows .line-group').length;
                    var template = $('.template > .line-item').prop('outerHTML').replace(/__INDEX__/g, index);
                    $('.line-rows').append(template);
                });

                $('#addGroup').on('click', function(e) {
                    e.preventDefault();
                    var index = $('.line-rows .line-item, .line-rows .line-group').length;
                    var template = $('.template > .line-group').prop('outerHTML').replace(/__INDEX__/g, index).replace(/__SUB_INDEX__/g, 0);
                    $('.line-rows').append(template);
                });

                $(document).on('click', '#addSubLine', function(e) {
                    e.preventDefault();
                    var $group = $(this).closest('.line-group');
                    var index = $(this).closest('.line-group').data('id');
                    var subIndex = $group.find('.line-item').length;
                    var template = $('.template .line-group .line-item').prop('outerHTML')
                        .replace(/__INDEX__/g, index)
                        .replace(/__SUB_INDEX__/g, subIndex);
                    $group.find('.text-right').before(template);
                });

                $(document).on('click', '.remove-line', function(e) {
                    e.preventDefault();
                    $(this).closest('.line-item').remove();
                });

                $(document).on('click', '.remove-group', function(e) {
                    e.preventDefault();
                    $(this).closest('.line-group').remove();
                });

            });
        </script>
    @endif
@endsection
