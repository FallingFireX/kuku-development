<h1>Welcome, {!! Auth::user()->displayName !!}!</h1>
<!-- <div class="card mb-4 timestamp" style="background-color: rgba(0,0,0,0)">
    <div class="card-body">
        <i class="far fa-clock"></i> {!! LiveClock() !!}
    </div>
</div> -->
<div class="row">
    <div class="col-md-6">
        @include('widgets._news', ['textPreview' => true])
    </div>
    <div class="col-md-6">
        @include('widgets._carousel')
    </div>
</div>
<!-- <div class="col-md-5">
@include('widgets._news', ['textPreview' => true])
</div> -->
<br>
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <h5>Game Activities</h5>
                    <p style="margin-bottom: 0.5rem">
                    <a href="https://kukuri-arpg.w3spaces.com/activities/quests.html">Quest</a>
                    <br><a href="https://www.deviantart.com/kukuri-arpg/journal/Coliseum-830233023">Coliseum</a>
                    <br><a href="https://www.deviantart.com/momma-kuku/journal/Activity-letters-743764050">Activity Letters</a>
                    <br><a href="https://kukuri-arpg.w3spaces.com/activities/traveling-merchant.html">Traveling Merchant</a>
                    <br>
                    <br><a href="https://kukuri-arpg.deviantart.com/journal/Hunting-604748328">Hunting</a>
                    <br><a href="https://kukuri-arpg.deviantart.com/journal/Gathering-604748136">Gathering</a>
                    <br><a href="https://kukuri-arpg.deviantart.com/journal/Excavating-629806452">Excavating</a>
                    <br><a href="https://kukuri-arpg.deviantart.com/journal/Excavating-629806452">Traveling</a>
                    <br>
                    <br><a href="https://kukuri-arpg.w3spaces.com/activities/breeding.html">Breeding</a>
                    <br><a href="https://docs.google.com/spreadsheets/d/1Re928vXBmaullAY_1SZSEQXEs3G48GfTl6LX3kdc1p4/edit?gid=1710681872#gid=1710681872">Breeding Slots (Sheet)</a>
                    <br><a href="https://kukuri-arpg.w3spaces.com/training/home.html">Training</a>
                    <br><a href="https://www.deviantart.com/momma-kuku/journal/Training-Completion-Mar-2021-872871365">Training Completion</a>
                    <br>
                    <br><a href="https://kukuri-arpg.w3spaces.com/activities/Illnesses-injuries.html">Illnesses and Injuries</a>
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
                    <p style="margin-bottom: 0.5rem">
                    <a href="https://kukuri-arpg.deviantart.com/journal/Design-approval-570879060">Design Approvals</a>
                    <br><a href="https://www.deviantart.com/momma-kuku/journal/Import-updates-September-19-811742986">Import Updates</a>
                    <br>
                    <br><a href="https://kukuri-arpg.w3spaces.com/genetics/genes-and-mutations.html">Genetics and Mutations</a>
                    <br><a href="https://kukuri-arpg.w3spaces.com/genetics/species-info.html">Species Information</a>
                    <br><a href="https://www.deviantart.com/kukuri-arpg/journal/Traits-828401506">Physical Features</a>
                    <br><a href="https://drive.google.com/drive/folders/1o2QmuzkdqtrNTaLEq6AgMP8r53E1nL1J">Blank Imports</a>
                    <br>
                    <br><a href="https://kukuri-arpg.w3spaces.com/adoption-center.html">Adoption Center</a>
                    <br><a href="https://www.deviantart.com/kukuri-arpg/journal/Status-updates-589917887">Status Updates</a>
                    <br><a href="https://kukuri-arpg.deviantart.com/journal/Leasing-629806120">Leasing</a>
                    <br>
                    <br><a href="https://kukuri-arpg.deviantart.com/journal/The-Bank-570876859">Bank (Sheet)</a>
                    <br><a href="{{ url('shops') }}">Shops</a>
                    <br>
                    <br><a href="https://kukuri-arpg.w3spaces.com/fate-points.html">Fate Points and Stat Points</a>
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
                    <br><a href="{{ url('inventory') }}">My Bank</a></li>
                    <br><a href="{{ Auth::user()->url . '/item-logs' }}">Bank Logs</a></li>
                    </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('images/currency.png') }}" alt="Bank" class="card-img" />
                    <br><a href="{{ url('bank') }}">Wallet</a></li>
                    <br><a href="{{ Auth::user()->url . '/currency-logs' }}">Wallet Logs</a></li>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card mb-12">
                <div class="card-body text-center">
                    <img src="{{ asset('images/awards.png') }}" class="card-img" />
                    <!--<h5 class="card-title">{{ ucfirst(__('awards.awards')) }}</h5>-->
                    <br>
                    <br><a href="{{ Auth::user()->url . '/pets' }}">My Familiars</a></li>
                    <br><a href="{{ Auth::user()->url . '/pet-logs' }}">Familiar Logs</a></li>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>

<a href="{{ url('users') }}">@include('widgets._online_count')</a>
@include('widgets._recent_gallery_submissions', ['gallerySubmissions' => $gallerySubmissions])
