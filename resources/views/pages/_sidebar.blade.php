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
            <h5>Current Season</h5>
                {!! $sidebar->box1content !!}
                <i>Check prey species in hunting for the correct season!</i>
            </div>
            
    </li>

    <li class="sidebar-section p-2">
            <div class="mt-1">
                <h5>Current Quest</h5>
                <br>
                {!! $sidebar->box2content !!}
                
                <b><a href="https://kukuri-arpg.w3spaces.com/activities/quests.html">Read more here </a></b>
            </div>
            
    </li>

    <li class="sidebar-section p-2">
            <div class="mt-1">
            <h5>Beauty Contest Theme</h5>
            {!! $sidebar->box3content !!}
            </div>
            
    </li>
</ul>
