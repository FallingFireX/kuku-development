<head>
    <link rel="preload" as="image" href="https://www.kukuri-arpg.com/files/newside1.webp" fetchpriority="high">
</head>

<style>
    @media (max-width: 576px) {
        h4 {
            margin-top: 5rem;
        }
    }
</style>
@if (Request::is('/'))
    <ul class="text-center list-unstyled">

        <li class="rightSidebar-section p-2">
            <h5>Kukuri of the Month</h5>
            @if (isset($featured) && $featured)
                <div>
                    <a href="{{ $featured->url }}">
                        <img src="{{ $featured->image->thumbnailUrl }}" class="img-thumbnail" />
                    </a>
                </div>
                <div class="mt-1">
                    <a href="{{ $featured->url }}" class="h5 mb-0" style="color:var(--dark);">
                        @if (!$featured->is_visible)
                            <i class="fas fa-eye-slash"></i>
                        @endif
                        {{ $featured->fullName }}
                    </a>
                </div>
                <div class="small" style="color:var(--dark)!important;">
                    Owned by: {!! $featured->displayOwner !!}
                </div>
            @else
                <p>There is no featured character.</p>
            @endif
        </li>

        <li class="rightSidebar-section p-2">
            @include('widgets._affiliates', ['affiliates' => $affiliates, 'featured' => $featured_affiliates, 'open' => $open])
        </li>

        <li>
            <a href="https://discord.gg/XE25D68xMf">
                <img src="https://discordapp.com/api/guilds/152924425774170113/widget.png?style=banner2" alt="">
            </a>
        </li>

    </ul>
@endif
