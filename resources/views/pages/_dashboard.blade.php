<h1>Welcome, {!! Auth::user()->displayName !!}!</h1>
<div class="card mb-4 timestamp">
    <div class="card-body">
        <i class="far fa-clock"></i> {!! LiveClock() !!}
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <h5>Game Activities</h5>
                    <p style="margin-bottom: 0.5rem">Quest
                    <br>Coliseum
                    <br>Activity Letters
                    <br>Traveling Merchant
                    <br>
                    <br>Hunting
                    <br>Gathering
                    <br>Excavating
                    <br>Traveling
                    <br>
                    <br>Breeding
                    <br>Breeding Slots (Sheet)
                    <br>Training
                    <br>Training Completion
                    <br>
                    <br>Illnesses and Injuries
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="https://kukuri-arpg.w3spaces.com/Graphics/Frontpagedoll.png" alt="Characters" class="card-img" style="max-width:100%; height:auto;"/>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <h5>Resources</h5>
                    <p style="margin-bottom: 0.5rem">Design Approvals
                    <br>Import Updates
                    <br>
                    <br>Genetics and Mutations
                    <br>Species Information
                    <br>Physical Features
                    <br>Blank Imports
                    <br>
                    <br>Adoption Center
                    <br>Status Updates
                    <br>Leasing
                    <br>
                    <br>Bank (Sheet)
                    <br>Shops
                    <br>
                    <br>Fate Points and Stat Points
                </p>
            </div>
        </div>
    </div>

</div>

<div class="card card-body">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card mb-4">
                <div class="card-body text-center">
                <img src="/images/avatars/{!! Auth::user()->avatar !!}" class="img-fluid rounded-circle" style="max-height: 150px;" alt="Avatar"/>
                    
                <br>
                <br><a href="{{ Auth::user()->url }}">Profile</a></li>
                <br><a href="{{ url('account/settings') }}">User Settings</a></li>
                <br><a href="{{ url('trades/open') }}">Trades</a></li>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ asset('images/characters.png') }}" alt="Characters" class="card-img" />
                    <br>
                    <br><a href="{{ url('characters') }}">My Characters</a></li>
                    <br><a href="{{ url('characters/myos') }}">My MYO Slots</a></li>
                    <br><a href="{{ url('characters/transfers/incoming') }}">Character Transfers</a></li>
                    </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card mb-4">
                <div class="card-body text-center" style="margin-bottom: 0.5rem">
                    <img src="{{ asset('images/inventory.png') }}" alt="Inventory" class="card-img" />
                    <br>
                    <br><a href="{{ url('inventory') }}">My Inventory</a></li>
                    <br><a href="{{ Auth::user()->url . '/item-logs' }}">Item Logs</a></li>
                    </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('images/currency.png') }}" alt="Bank" class="card-img" />
                    <br>
                    <br><a href="{{ url('bank') }}">Bank</a></li>
                    <br><a href="{{ Auth::user()->url . '/currency-logs' }}">Currency Logs</a></li>
                </div>
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
</div>

<a href="{{ url('users') }}">@include('widgets._online_count')</a>
@include('widgets._recent_gallery_submissions', ['gallerySubmissions' => $gallerySubmissions])
