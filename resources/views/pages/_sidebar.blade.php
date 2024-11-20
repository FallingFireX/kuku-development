<ul class="text-center">
    <li class="sidebar-section p-2">
        @if(isset($featured) && $featured)
        <b><u>Kukuri of the Month</u></b>
            <div>
                <a href="{{ $featured->url }}"><img src="{{ $featured->image->thumbnailUrl }}" class="img-thumbnail" /></a>
            </div>
            <div class="mt-1">
                <a href="{{ $featured->url }}" class="h5 mb-0">@if(!$featured->is_visible) <i class="fas fa-eye-slash"></i> @endif {{ $featured->fullName }}</a>
            </div>
            <div class="small">
                {!! $featured->displayOwner !!}
            </div>
        @else
            <p>There is no featured character.</p>
        @endif
    </li>

    <li class="sidebar-section p-2">
            <div class="mt-1">
                <h3>Current Quest</h3>
                <br>
                <p>blah blah</p>
            </div>
            
    </li>

    <li class="sidebar-section p-2">
            <div class="mt-1">
            <b><u>Current Beauty Contest Theme</b></u>
                <br>
                <p>blah blah</p>
            </div>
            
    </li>
</ul>
