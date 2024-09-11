@extends('shops.layout')

@section('shops-title')
    {{ $shop->name }}
@endsection

@section('shops-content')
    <x-admin-edit title="Shop" :object="$shop" />
    {!! breadcrumbs(['Shops' => 'shops', $shop->name => $shop->url]) !!}

    <h1>
        {{ $shop->name }}
    </h1>

    @if ($shop->use_coupons)
        <div class="alert alert-success">You can use coupons in this store!</div>
        @if ($shop->allowed_coupons && count(json_decode($shop->allowed_coupons, 1)))
            <div class="alert alert-info">You can use the following coupons: @foreach ($shop->allAllowedCoupons as $coupon)
                    {!! $coupon->displayName !!}{{ $loop->last ? '' : ', ' }}
                @endforeach
            </div>
        @endif
    @endif

    <div class="text-center">
        @if ($shop->has_image)
            <img src="{{ $shop->shopImageUrl }}" style="max-width:100%" alt="{{ $shop->name }}" />
        @endif
        <p>{!! $shop->parsed_description !!}</p>
    </div>

    @foreach ($stocks as $type => $stock)
        @if (count($stock))
            <h3>
                {{ $type . (substr($type, -1) == 's' ? '' : 's') }}
            </h3>
        @endif
        @if (Settings::get('shop_type'))
            @include('shops._tab', ['items' => $stock, 'shop' => $shop])
        @else
            @foreach ($stock as $categoryId => $categoryItems)
                @php
                    $visible = '';
                    // check if method exists
                    if (method_exists($categoryItems->first(), 'is_visible') && !$categories[$categoryId]->is_visible) {
                        $visible = '<i class="fas fa-eye-slash mr-1"></i>';
                    }
                @endphp
                <ul class="nav nav-tabs card-header-tabs">
        @foreach ($items as $categoryId => $categoryItems)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="categoryTab-{{ isset($categories[$categoryId]) ? $categoryId : 'misc' }}" data-toggle="tab" href="#category-{{ isset($categories[$categoryId]) ? $categoryId : 'misc' }}"
                    role="tab">
                    {!! isset($categories[$categoryId]) ? $categories[$categoryId]->name : 'Miscellaneous' !!}
                </a>
            </li>
        @endforeach
    </ul>
</div>
<div class="card-body tab-content">
    @foreach ($items as $categoryId => $categoryItems)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="category-{{ isset($categories[$categoryId]) ? $categoryId : 'misc' }}">
            @foreach ($categoryItems->chunk(4) as $chunk)
                <div class="row mb-3">
                    @foreach ($chunk as $itemId => $stack)
                        <div class="col-sm-3 col-6 text-center inventory-item" data-id="{{ $stack->first()->pivot->id }}" data-name="{{ $user->name }}'s {{ $stack->first()->name }}">
                            @if ($stack->first()->has_image)
                                <div class="mb-1">
                                    <a href="#" class="inventory-stack">
                                        <img src="{{ $stack->first()->imageUrl }}" style="height: 125px;" alt="{{ $stack->first()->name }}" />
                                    </a>
                                </div>
                            @endif
                            <div>
                                <a href="#" class="inventory-stack inventory-stack-name">{{ $stack->first()->name }} x{{ $stack->sum('pivot.count') }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endforeach
</div>
            @endforeach
        @endif
    @endforeach
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.inventory-item').on('click', function(e) {
                e.preventDefault();

                loadModal("{{ url('shops/' . $shop->id) }}/" + $(this).data('id'), 'Purchase Item');
            });
        });
    </script>
@endsection
