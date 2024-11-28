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
                <p style="font-size:16px"><b>Winter</b></p>
                <i>Check prey species in hunting for the correct season!</i>
            </div>
            
    </li>

    <li class="sidebar-section p-2">
            <div class="mt-1">
                <h5>Current Quest</h5>
                <br><a href="https://www.deviantart.com/momma-kuku/art/Present-717910237"><img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/074ff87a-9880-4019-abec-2fc71c1f2a2b/dbvfb31-71db40c0-59f6-4f80-84a0-5f681e71acf8.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzA3NGZmODdhLTk4ODAtNDAxOS1hYmVjLTJmYzcxYzFmMmEyYlwvZGJ2ZmIzMS03MWRiNDBjMC01OWY2LTRmODAtODRhMC01ZjY4MWU3MWFjZjgucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.dow4nw-YOxZ5utjdnGHh1CvJA2Uy00wBYiwVavIu4H8"></a>
                <p><b><u>Giving Gifts</u></b></p>
                <i>Its that time of year again, time to give gifts to those you care about and share the holiday cheer with everyone!</i>
                <br><b><a href="https://kukuri-arpg.w3spaces.com/activities/quests.html">Read more here </a></b>
            </div>
            
    </li>

    <li class="sidebar-section p-2">
            <div class="mt-1">
            <h5>Beauty Contest Theme</h5>
            <p style="font-size:16px"><b>Ghosts</b></p>
                <i>This contest ends December 15th!</i>
            </div>
            
    </li>
</ul>
