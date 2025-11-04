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
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <h5>Total</h5><span class="font-weight-bold bg-primary text-white p-2 rounded">TOTAL {{ __('art_tracker.xp') }}</span>
        </div>
    </div>
@endif
