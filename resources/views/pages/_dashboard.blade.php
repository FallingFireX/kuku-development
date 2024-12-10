<h1>Welcome, {!! Auth::user()->displayName !!}!</h1>
<!-- <div class="card mb-4 timestamp" style="background-color: rgba(0,0,0,0)">
    <div class="card-body">
        <i class="far fa-clock"></i> {!! LiveClock() !!}
    </div>
</div> -->

<br>
<div class="row">
    <div class="col-md-7">
    <div class="row">
            <div class="col-md-4">
            <div class="dropdown">
            <button type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false" style="background: transparent; border-width: 0px;">
                <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/2986889a-a8eb-4dfa-aac6-d65a72b03269/dip8zcw-d0fcf425-9428-43da-b20e-149f6157a2d0.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzI5ODY4ODlhLWE4ZWItNGRmYS1hYWM2LWQ2NWE3MmIwMzI2OVwvZGlwOHpjdy1kMGZjZjQyNS05NDI4LTQzZGEtYjIwZS0xNDlmNjE1N2EyZDAucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.B0lFyeaLNjm6H97ZIk-bMN1kcyKpKC8niUC14Bj_MBM"> 
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/activities/quests.html">Quest</a></li>
                <li><a class="dropdown-item" href="https://www.deviantart.com/kukuri-arpg/journal/Coliseum-830233023">Coliseum</a></li>
                <li><a class="dropdown-item" href="https://www.deviantart.com/momma-kuku/journal/Activity-letters-743764050">Activity Letters</a></li>
                <li><a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/activities/traveling-merchant.html">Traveling Merchant</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="https://kukuri-arpg.deviantart.com/journal/Hunting-604748328">Hunting</a></li>
                <li><a class="dropdown-item" href="https://kukuri-arpg.deviantart.com/journal/Gathering-604748136">Gathering</a></li>
                <li><a class="dropdown-item" href="https://kukuri-arpg.deviantart.com/journal/Excavating-629806452">Excavating</a></li>
                <li><a class="dropdown-item" href="https://www.deviantart.com/kukuri-arpg/journal/Traveling-629806543">Traveling</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/activities/breeding.html">Breeding</a></li>
                <li><a class="dropdown-item" href="https://docs.google.com/spreadsheets/d/1Re928vXBmaullAY_1SZSEQXEs3G48GfTl6LX3kdc1p4/edit?gid=1710681872#gid=1710681872">Breeding Slots</a></li>
                <li><a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/training/home.html">Training</a></li>
                <li><a class="dropdown-item" href="https://www.deviantart.com/momma-kuku/journal/Training-Completion-Mar-2021-872871365">Training Completion</a></li>
            </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dropdown">
            <button type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false" style="background: transparent; border-width: 0px;">
                <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/2986889a-a8eb-4dfa-aac6-d65a72b03269/dip8xps-615a2d06-2e80-49fd-8d09-a3e5cd798d19.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzI5ODY4ODlhLWE4ZWItNGRmYS1hYWM2LWQ2NWE3MmIwMzI2OVwvZGlwOHhwcy02MTVhMmQwNi0yZTgwLTQ5ZmQtOGQwOS1hM2U1Y2Q3OThkMTkucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.e7hFbyVwbl2mha8Q2h4GZH-qrKKhQleH7mSM64x0Fr0"> 
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="https://kukuri-arpg.deviantart.com/journal/Design-approval-570879060">Design Approval</a></li>
                <li><a class="dropdown-item" href="https://www.deviantart.com/momma-kuku/journal/Import-updates-September-19-811742986">Import Updates</a></li>
                <li><a class="dropdown-item" href="https://drive.google.com/drive/folders/1o2QmuzkdqtrNTaLEq6AgMP8r53E1nL1J">Blank Imports</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/genetics/genes-and-mutations.html">Genetics and Mutations</a></li>
                <li><a class="dropdown-item" href="https://www.deviantart.com/kukuri-arpg/journal/Traits-828401506">Traits</a></li>
                <li><a class="dropdown-item" href="https://www.kukuri-arpg.com/world/trait-categories">Physical Traits</a></li>
            </ul>
        </div>
            </div>
            <div class="col-md-4">
            <div class="dropdown">
            <button type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false" style="background: transparent; border-width: 0px;">
                <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/2986889a-a8eb-4dfa-aac6-d65a72b03269/dip8xq7-768ca1f2-c80e-475f-851f-fa2e6f14d525.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzI5ODY4ODlhLWE4ZWItNGRmYS1hYWM2LWQ2NWE3MmIwMzI2OVwvZGlwOHhxNy03NjhjYTFmMi1jODBlLTQ3NWYtODUxZi1mYTJlNmYxNGQ1MjUucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.5HO719_wI6keNtImo0DwtScn0yLs_fjohSIzwIia0uM"> 
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/activities/Illnesses-injuries.html">Illnesses and Injuries</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/adoption-center.html">Adoption Center</a></li>
                <li><a class="dropdown-item" href="https://kukuri-arpg.deviantart.com/journal/Leasing-629806120">Leasing</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="{{ url('shops') }}">Shops</a></li>
                <li><a class="dropdown-item" href="{{ url('crafting') }}">Crafting</a></li>
                <li><a class="dropdown-item" href="ttps://kukuri-arpg.deviantart.com/journal/The-Bank-570876859">Bank (Retired)</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/fate-points.html">Fate Points and Stat Points</a></li>
                <li><a class="dropdown-item" href="https://www.deviantart.com/kukuri-arpg/journal/Status-updates-589917887">Status Updates</a></li>
            </ul>
            </div>
        </div>
        
    </div>
    <br><br>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card-body text-center">
                    <img src="/images/avatars/{!! Auth::user()->avatar !!}" class="img-fluid rounded-circle" style="max-height: 150px;" alt="Avatar"/>
                    <br>
                    <br><a href="{{ Auth::user()->url }}">Profile</a></li>
                    <br><a href="{{ url('account/settings') }}">Settings</a></li>
                </div>
            </div>
            <div class="col-md-4">
                    <div class="card-body text-center">
                        <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/2986889a-a8eb-4dfa-aac6-d65a72b03269/dip9bic-14a6aa70-ff4e-4f9c-8dfb-b6c7ee52eb61.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzI5ODY4ODlhLWE4ZWItNGRmYS1hYWM2LWQ2NWE3MmIwMzI2OVwvZGlwOWJpYy0xNGE2YWE3MC1mZjRlLTRmOWMtOGRmYi1iNmM3ZWU1MmViNjEucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.SwJCh8a_-IVHA1JbW65GKL-2nNXp2OzFyP495uKgP30" alt="Characters" class="card-img" style="width:80%"/>
                        <br>
                        <br><a href="{{ url('characters') }}">My Kukuri</a></li>
                        <br><a href="{{ Auth::user()->url . '/pets' }}">Familiars</a></li>
                    </div>     
            </div>
            <div class="col-md-4">
                    <div class="card-body text-center" style="margin-bottom: 0.5rem">
                        <br>
                        <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/074ff87a-9880-4019-abec-2fc71c1f2a2b/da98h23-939a7749-ed94-41f4-bd7d-c1332cec4bcc.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzA3NGZmODdhLTk4ODAtNDAxOS1hYmVjLTJmYzcxYzFmMmEyYlwvZGE5OGgyMy05MzlhNzc0OS1lZDk0LTQxZjQtYmQ3ZC1jMTMzMmNlYzRiY2MucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0._bGRCKTEgATpA6-sET8DI71u8ohuTXpWFmFGMv-3WrY" alt="Inventory" class="card-img" />
                        <br>
                        <br><a href="{{ url('inventory') }}">Bank</a></li>
                        <br><a href="{{ url('bank') }}">Wallet</a></li>
                    </div> 
            </div>
        </div>
     
    <br>
    <div style="text-align:center">
        <a href="https://www.kukuri-arpg.com/info/games">
        <img src ="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/074ff87a-9880-4019-abec-2fc71c1f2a2b/dcfymqg-47ff87e6-d554-4c60-998a-1ea66419f1a5.png/v1/fit/w_825,h_458/monthly_familiar_july_2018___puuhka_by_momma_kuku_dcfymqg-414w-2x.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9NDU4IiwicGF0aCI6IlwvZlwvMDc0ZmY4N2EtOTg4MC00MDE5LWFiZWMtMmZjNzFjMWYyYTJiXC9kY2Z5bXFnLTQ3ZmY4N2U2LWQ1NTQtNGM2MC05OThhLTFlYTY2NDE5ZjFhNS5wbmciLCJ3aWR0aCI6Ijw9ODI1In1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmltYWdlLm9wZXJhdGlvbnMiXX0.9f6Z02kXkHzAlY-Qia_VoUJHTcI7bNsLqwONU7-nq0Q" style= "width:40%">
        </a>
        <br>
        <i>Play games, earn awards!</i>
        <br>
        <a href="https://www.kukuri-arpg.com/info/games"><b>Partake in Daily activites here!</b></a>
    </div>
</div>
    <div class="col-md-5">
        @include('widgets._news', ['textPreview' => true])
        @include('widgets._carousel')
        <br>
                <div class="card mb-3">
                    <div class="card-body">
                    <h5 class="card-title"  style="text-align: center">Queues <i class="fas fa-book"></i></h5>
                    <div class="row">
                        <div class="col-md-4">
                        <p class="card-text" style="font-size: 16px">
                            <b>Status Updates</b>: 
                            <br>
                            <b>Misc Queues</b>:
                            <br>
                            <b>Claims</b>:
                            </p>
                        </div>
                        <div class="col-md-3">
                        <p class="card-text" style="font-size: 16px">
                            @if ($fpCount)
                                {{ $fpCount }}
                            @else
                                Empty!
                            @endif
                            <br>
                            @if ($misc2Count)
                                {{ $misc2Count }}
                            @else
                                Empty!
                            @endif
                            <br>
                            @if ($claimCount)
                                {{ $claimCount }}
                            @else
                                Empty!
                            @endif
                            </p>
                        </div>
                        <div class="col-md-4" style="text-align: center">
                            test test
                        </div>
                    </div>
                    </div>
                </div>
                <a href="{{ url('users') }}">@include('widgets._online_count')</a>
                @include('widgets._recent_gallery_submissions', ['gallerySubmissions' => $gallerySubmissions])
    </div>




