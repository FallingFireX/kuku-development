@php
    $shuffled = $featured->shuffle();
    $displayed = $shuffled->take(5);
@endphp

<div class="mt-2 text-center">
    <h5>Our Affiliates</h5>
    @if ($featured->count() > 0)
        <hr class="my-0">
        <div class="card-body py-2" style="background-color:rgba(0,0,0,.01)">
            @foreach ($displayed as $feat)
                <div class="mb-1">{!! $feat->icon !!}</div>
            @endforeach
        </div>
    @endif
    @if ($affiliates->count() > 0)
        <hr class="my-0">
        <div class="card-body py-2">
            @foreach ($affiliates as $affiliate)
                {!! $affiliate->icon !!}
            @endforeach
        </div>
    @endif
    <div class="row mx-2 my-1" style="font-size:0.9em;">
        <div class="col-6 text-left mx-0 px-0">
            @if ($open)
                <a href="{{ url('affiliates/apply') }}" style="color:var(--dark);"><b>Become an Affiliate!</b></a>
            @endif
        </div>
        <div class="col-6 text-right mx-0 px-0"><a href="{{ url('affiliates') }}" style="color:var(--dark);"><b>See All Affiliates</b></a></div>
    </div>
</div>

<style>
    /* You can edit this as you like for hover effects on affiliate icons! */
    .avatar {
        transition: 0.3s;
    }

    .avatar:hover {
        opacity: 1;
        filter: unset;
        transition: 0.3s;
    }
</style>
