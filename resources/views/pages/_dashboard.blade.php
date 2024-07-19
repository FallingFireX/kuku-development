<h1>Welcome, {!! Auth::user()->displayName !!}!</h1>
<div class="card mb-4 timestamp">
    <div class="card-body">
        <i class="far fa-clock"></i> {!! format_date(Carbon\Carbon::now()) !!}
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <h5>Game Activities</h5>
                <p>Quest<br>Coliseum<br>Activity Letters<br><br>Hunting<br>Gathering<br>Excavating<br>Traveling<br><br>Breeding<br>Training</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="https://kukuri-arpg.w3spaces.com/Graphics/Frontpagedoll.png" alt="Characters" class="card-img" />
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <h5>Resources</h5>
                <p>Bank<br>Design Approvals<br>Import Updates<br><br>Genetics and Mutations<br>Adoption Center<br>Status Updates<br></p>
            </div>
        </div>
    </div>

</div>

<div class="row justify-content-center">
    <div class="col-md-2">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{ asset('images/account.png') }}" alt="Account" class="card-img" />
                
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ Auth::user()->url }}">Profile</a></li>
                <li class="list-group-item"><a href="{{ url('account/settings') }}">User Settings</a></li>
                <li class="list-group-item"><a href="{{ url('trades/open') }}">Trades</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{ asset('images/characters.png') }}" alt="Characters" class="card-img" />
                
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ url('characters') }}">My Characters</a></li>
                <li class="list-group-item"><a href="{{ url('characters/myos') }}">My MYO Slots</a></li>
                <li class="list-group-item"><a href="{{ url('characters/transfers/incoming') }}">Character Transfers</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{ asset('images/inventory.png') }}" alt="Inventory" class="card-img" />
                
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ url('inventory') }}">My Inventory</a></li>
                <li class="list-group-item"><a href="{{ Auth::user()->url . '/item-logs' }}">Item Logs</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{ asset('images/currency.png') }}" alt="Bank" class="card-img" />
                
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ url('bank') }}">Bank</a></li>
                <li class="list-group-item"><a href="{{ Auth::user()->url . '/currency-logs' }}">Currency Logs</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-12">
            <div class="card-body text-center">
                <img src="{{ asset('images/awards.png') }}" class="card-img" />
                <!--<h5 class="card-title">{{ ucfirst(__('awards.awards')) }}</h5>-->
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ Auth::user()->url . '/awardcase' }}">My {{ ucfirst(__('awards.award')) }}</a></li>
                <li class="list-group-item"><a href="{{ Auth::user()->url . '/award-logs' }}">{{ ucfirst(__('awards.award')) }} Logs</a></li>
            </ul>
        </div>
    </div>
</div>

<a href="{{ url('users') }}">@include('widgets._online_count')</a>
@include('widgets._recent_gallery_submissions', ['gallerySubmissions' => $gallerySubmissions])
