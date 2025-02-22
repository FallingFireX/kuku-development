<div class="mx-auto test-center d-flex justify-content-center" style="margin-right: 16.67% !important">
            
                    <a class="currency-nav bg-dark" href="{{ url('/bank') }}">
                    @if(Auth::check())
                    @foreach(Auth::user()->getCurrencies(true) as $currency)
                        {!!$currency->display($currency->quantity) !!} <i>&nbsp;&nbsp;</i>
                    @endforeach
                    @endif
                    </a>
                
    <div class="clock-styling bg-dark">
        
        <i class="far fa-clock"></i> <span id="clock" class="text-right" style="font-size:13px"></span>
    </div>
</div>

<nav class="navbar navbar-expand-md navbar-dark bg-dark col-lg-8" id="headerNav" style="margin:auto; border-radius: 10px 0px 0px 0px">

    <div class="container-fluid">
         <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('lorekeeper.settings.site_name', 'Lorekeeper') }}
        </a> 
       
        </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    @if (Auth::check() && Auth::user()->is_news_unread && config('lorekeeper.extensions.navbar_news_notif'))
                        <a class="nav-link d-flex text-warning" href="{{ url('news') }}"><strong>News</strong><i class="fas fa-bell"></i></a>
                    @else
                        <a class="nav-link" href="{{ url('news') }}">News</a>
                    @endif
                </li>
                @if(Auth::check() && Auth::user()->is_dev_logs_unread && Auth::user()->settings->dev_log_notif && Config::get('lorekeeper.extensions.navbar_news_notif'))
                    <li class="nav-item">
                        <a class="nav-link d-flex text-warning" href="{{ url('devlogs') }}"><strong>Devlog</strong><i class="fas fa-bell"></i></a>
                    </li>
                @endif
                <li class="nav-item">
                    @if (Auth::check() && Auth::user()->is_sales_unread && config('lorekeeper.extensions.navbar_news_notif'))
                        <a class="nav-link d-flex text-warning" href="{{ url('sales') }}"><strong>Sales</strong><i class="fas fa-bell"></i></a>
                    @else
                        <a class="nav-link" href="{{ url('sales') }}">Divine Shop</a>
                    @endif
                </li>
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Home
                        </a>

                        <div class="dropdown-menu" aria-labelledby="inventoryDropdown">
                            <a class="dropdown-item" href="{{ Auth::user()->url . '/characters' }}">
                                My Kukuri
                            </a>
                            <!-- <a class="dropdown-item" href="{{ url('characters/myos') }}">
                                My MYO Slots
                            </a> -->
                            <!-- <a class="dropdown-item" href="{{ url('breeding-permissions') }}">
                                My Breeding Slots
                                </a> -->
                            <a class="dropdown-item" href="{{ url('pets') }}">
                                My Familiars
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('inventory') }}">
                                My Bank
                            </a>
                            <a class="dropdown-item" href="{{ url('bank') }}">
                                My Wallet
                            </a>
                            <!-- <a class="dropdown-item" href="{{ Auth::user()->url . '/awardcase' }}">
                                {{ ucfirst(__('awards.awards')) }}
                                </a> -->
                            <!-- <a class="dropdown-item" href="{{ url('stats') }}">
                                Stat Information
                            </a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('comments/liked') }}">
                                Liked Comments
                            </a>
                            @if (Auth::check() && Auth::user()->is_raffles_unread && config('lorekeeper.extensions.navbar_news_notif'))
                                <a class="dropdown-item text-warning" href="{{ url('raffles') }}">
                                    Raffles <i class="fas fa-bell"></i>
                                </a>
                            @else
                                <a class="dropdown-item" href="{{ url('raffles') }}">
                                    Raffles
                                </a>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="queueDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Activity
                        </a>
                        <div class="dropdown-menu" aria-labelledby="queueDropdown">
                           
                            
                            <a class="dropdown-item" href="{{ url('prompts/prompts') }}">
                                Activities
                            </a>
                            <a class="dropdown-item" href="{{ url('https://kukuri-arpg.w3spaces.com/activities/quests.html') }}">
                                Current Quest
                            </a>
                            <a class="dropdown-item" href="{{ url('crafting') }}">
                                Crafting
                            </a>
                            <a class="dropdown-item" href="{{ url('https://kukuri-arpg.w3spaces.com/activities/breeding.html') }}">
                                Breeding
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ url('/fp-calculator') }}">
                                FP Calculator
                            </a>
                            <a class="dropdown-item" href="{{ url('/info/games') }}">
                                Minigames
                            </a>
                            <a class="dropdown-item" href="{{ url('generators') }}">
                                Random Generators
                            </a>
                            <a class="dropdown-item" href="{{ url('world/info') }}">
                                World Expanded
                            </a>
                           
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ url('submissions') }}">
                                My Submissions
                            </a>
                            <a class="dropdown-item" href="{{ url('submissions?type=draft') }}">
                                Submission Drafts
                            </a>
                            <a class="dropdown-item" href="{{ url('claims') }}">
                                My Claims
                            </a>
                            <a class="dropdown-item" href="{{ url('claims?type=draft') }}">
                                Claim Drafts
                            </a>
                            <a class="dropdown-item" href="{{ url('reports') }}">
                                Reports
                            </a>
                            <!-- <a class="dropdown-item" href="{{ url('designs') }}">
                                Design Approvals
                            </a> -->
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('characters/transfers/incoming') }}">
                                Character Transfers
                            </a>
                            <a class="dropdown-item" href="{{ url('trades/open') }}">
                                Trades
                            </a>
                            <a class="dropdown-item" href="{{ url('shops') }}">
                                Shops
                            </a>
                        </div>
                    </li>
                @endif
                <li class="nav-item dropdown">

                    @if (Auth::check() && Auth::user()->is_raffles_unread && config('lorekeeper.extensions.navbar_news_notif'))
                        <a id="browseDropdown" class="nav-link dropdown-toggle text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <strong>About Us</strong> <i class="fas fa-bell"></i>
                        </a>
                    @else
                    <a id="browseDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            About Us
                        </a>
                    @endif

                    <div class="dropdown-menu" aria-labelledby="browseDropdown">
                        <a class="dropdown-item" href="{{ url('https://kukuri-arpg.w3spaces.com/rules-tos.html') }}">
                            Group Rules
                        </a>
                        <a class="dropdown-item" href="{{ url('team') }}">
                            Admin Team
                        </a>
                        <a class="dropdown-item" href="{{ url('users') }}">
                            Players
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('https://kukuri-arpg.w3spaces.com/newbie-guide.html') }}">
                            Newbie guide
                        </a>
                        <a class="dropdown-item" href="{{ url('info/guide') }}">
                            Site Guide
                        </a>
                        <a class="dropdown-item" href="{{ url('/info/fpguide') }}">
                            FP guide
                        </a>
                        <a class="dropdown-item" href="{{ url('/info/design') }}">
                            Design FaQ
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('reports/bug-reports') }}">
                            Bug Reports
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="loreDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Kukuology
                    </a>

                    <div class="dropdown-menu" aria-labelledby="loreDropdown">
                        <a class="dropdown-item" href="{{ url('masterlist') }}">
                            Kukuri Masterlist
                        </a>
                        <a class="dropdown-item" href="{{ url('adoption-center') }}">
                            Adoption Center
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('https://kukuri-arpg.w3spaces.com/genetics/genes-and-mutations.html') }}">
                            Genetics
                        </a>
                        <a class="dropdown-item" href="{{ url('world/trait-categories') }}">
                            Physical Features
                        </a>
                        <a class="dropdown-item" href="{{ url('https://kukuri-arpg.w3spaces.com/genetics/species-info.html') }}">
                            Species Information
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('world/pets') }}">
                            Familiars
                        </a>
                        <a class="dropdown-item" href="{{ url('world/item-categories') }}">
                            Items
                        </a>
                        <a class="dropdown-item" href="{{ url('world/awards') }}">
                            Awards
                        </a>
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @if(Auth::user()->isStaff)
                        <li class="nav-item d-flex">
                            <a class="nav-link position-relative display-inline-block" href="{{ url('admin') }}"><i class="fas fa-crown"></i>
                              @if (Auth::user()->hasAdminNotification(Auth::user()))
                                <span class="position-absolute rounded-circle bg-danger text-light" style="top: -2px; right: -5px; padding: 1px 6px 1px 6px; font-weight:bold; font-size: 0.8em; box-shadow: 1px 1px 1px rgba(0,0,0,.25);">
                                  {{ Auth::user()->hasAdminNotification(Auth::user()) }}
                                </span>
                              @endif
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->notifications_unread)
                        <li class="nav-item">
                            <a class="nav-link btn btn-secondary btn-sm" href="{{ url('notifications') }}"><span class="fas fa-envelope"></span> {{ Auth::user()->notifications_unread }}</a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a id="browseDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Submit
                        </a>

                        <div class="dropdown-menu" aria-labelledby="browseDropdown">
                            <a class="dropdown-item" href="{{ url('submissions/new') }}">
                                Submit Prompt
                            </a>
                            <a class="dropdown-item" href="{{ url('claims/new') }}">
                                Submit Claim
                            </a>
                            <a class="dropdown-item" href="{{ url('reports/new') }}">
                                Submit Report
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ Auth::user()->url }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ Auth::user()->url }}">
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ url('notifications') }}">
                                Notifications
                            </a>
                            <a class="dropdown-item" href="{{ url('account/bookmarks') }}">
                                Bookmarks
                            </a>
                            <a class="dropdown-item" href="{{ url('account/settings') }}">
                                Settings
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
