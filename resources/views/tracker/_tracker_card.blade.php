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
                    @if( $tracker->status === 'Pending' || !$editable )
                        @foreach ($data as $title => $value)
                            @if (gettype($value) === 'array')
                                <div class="line-group border border-secondary my-2">
                                    <h4 class="line-header text-uppercase font-weight-bold p-2">{{ $title }}</h4>
                                    @foreach ($value as $sub_title => $sub_val)
                                        <div class="line-item w-100 d-inline-flex justify-content-between p-2">
                                            <h5 class="lh-1 m-0">{{ $sub_title }}</h5>
                                            <p class="lh-1 m-0">{{ $sub_val }} {{ __('art_tracker.xp') }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="line-item w-100 d-inline-flex justify-content-between p-2">
                                    <h5 class="lh-1 m-0">{{ $title }}</h5>
                                    <p class="lh-1 m-0">{{ $value }} {{ __('art_tracker.xp') }}</p>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <?php
                            $total = 0;
                            $i = 0;
                            ?>
                            @foreach ($cardData as $title => $value)
                                @if (gettype($value) === 'array')
                                    <div class="line-group border border-secondary my-2">
                                        <div class="line-header p-2">
                                            <h5>Group</h5>
                                            {!! Form::text('card__' . $i . '_title', $title, ['class' => 'form-control']) !!}
                                            <hr class="my-1" />
                                        </div>
                                        @foreach ($value as $title => $sub_val)
                                            <?php $si = 0; ?>
                                            <div class="line-item w-100 d-inline-flex align-items-center justify-content-between p-2">
                                                {!! Form::text('card__' . $i . '_sub_card__' . $si . '_title', $title, ['class' => 'form-control']) !!}
                                                {!! Form::number('card__' . $i . '_sub_card__' . $si . '_value', $sub_val, ['class' => 'form-control w-25 ml-2']) !!} <span class="badge ml-2">{{ __('art_tracker.xp') }}</span>
                                            </div>
                                            <?php
                                            $total += $sub_val;
                                            $si++;
                                            ?>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="line-item w-100 d-inline-flex align-items-center justify-content-between p-2">
                                        {!! Form::text('card__' . $i . '_title', $title, ['class' => 'form-control']) !!}
                                        {!! Form::number('card__' . $i . '_value', $sub_val, ['class' => 'form-control w-25 ml-2']) !!} <span class="badge ml-2">{{ __('art_tracker.xp') }}</span>
                                    </div>
                                    <?php $total += $value; ?>
                                @endif
                                <?php
                                $i++;
                                ?>
                            @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <h5>Total</h5><span class="font-weight-bold bg-primary text-white p-2 rounded">TOTAL {{ __('art_tracker.xp') }}</span>
        </div>
    </div>
@endif
