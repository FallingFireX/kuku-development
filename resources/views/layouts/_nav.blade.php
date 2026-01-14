<div class="mx-auto test-center d-flex justify-content-center" style="margin-right: 16.67% !important">

    <a class="currency-nav bg-dark" href="{{ url('/bank') }}">
        @if (Auth::check())
            @foreach (Auth::user()->getCurrencies(true) as $currency)
                {!! $currency->display($currency->quantity) !!} <i>&nbsp;&nbsp;</i>
            @endforeach
        @endif
    </a>

    <div class="clock-styling bg-dark">

        <i class="far fa-clock"></i> <span id="clock" class="text-right" style="font-size:13px"></span>
    </div>
</div>

<nav class="navbar navbar-expand-md navbar-dark bg-dark col-lg-12" id="headerNav" style="margin:auto; border-radius: 10px 0px 0px 0px">

    <div class="container-fluid">

        </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto ml-auto">
                @php
                    $hasNewsNotif =
                        Auth::check() &&
                        config('lorekeeper.extensions.navbar_news_notif') &&
                        (Auth::user()->is_news_unread || Auth::user()->is_sales_unread || Auth::user()->is_raffles_unread || (Auth::user()->is_dev_logs_unread && Auth::user()->settings->dev_log_notif));
                @endphp

                <li class="nav-item dropdown">
                    <a id="newsDropdown" class="nav-link dropdown-toggle {{ $hasNewsNotif ? 'text-warning d-flex align-items-center' : '' }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Home
                        @if ($hasNewsNotif)
                            <i class="fas fa-bell ml-1"></i>
                        @endif
                    </a>

                    <div class="dropdown-menu" aria-labelledby="newsDropdown">
                        <a class="dropdown-item" href="{{ url('/') }}">Home</a>
                        @if (Auth::check() && Auth::user()->is_news_unread && config('lorekeeper.extensions.navbar_news_notif'))
                            <a class="dropdown-item text-warning d-flex justify-content-between" href="{{ url('news') }}">
                                <span>News</span> <i class="fas fa-bell"></i>
                            </a>
                        @else
                            <a class="dropdown-item" href="{{ url('news') }}">News</a>
                        @endif
                        @if (Auth::check() && Auth::user()->is_dev_logs_unread && Auth::user()->settings->dev_log_notif && Config::get('lorekeeper.extensions.navbar_news_notif'))
                            <a class="dropdown-item text-warning d-flex justify-content-between" href="{{ url('devlogs') }}">
                                <span>Devlog</span> <i class="fas fa-bell"></i>
                            </a>
                        @endif
                        @if (Auth::check() && Auth::user()->is_sales_unread && config('lorekeeper.extensions.navbar_news_notif'))
                            <a class="dropdown-item text-warning d-flex justify-content-between" href="{{ url('sales') }}">
                                <span>Divine Shop</span> <i class="fas fa-bell"></i>
                            </a>
                        @else
                            <a class="dropdown-item" href="{{ url('sales') }}">Divine Shop</a>
                        @endif
                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/rules-tos.html"> Rules and ToS </a>
                        <a class="dropdown-item" href="{{ url('teams') }}">
                            Admin Team
                        </a>
                        <a class="dropdown-item" href="{{ url('users') }}">
                            Players
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/newbie-guide.html"> Newbie Guide </a>
                        <a class="dropdown-item" href="{{ url('/adoption-center') }}"> Adoption Center </a>
                        @if (Auth::check() && Auth::user()->is_raffles_unread && config('lorekeeper.extensions.navbar_news_notif'))
                            <a class="dropdown-item text-warning" href="{{ url('raffles') }}">
                                Raffles <i class="fas fa-bell"></i>
                            </a>
                        @else
                            <a class="dropdown-item" href="{{ url('raffles') }}">
                                Raffles
                            </a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/team') }}"> Discord </a>
                        <a class="dropdown-item" href="https://www.deviantart.com/kukuri-arpg"> DeviantArt Group </a>
                        <a class="dropdown-item" href="https://www.deviantart.com/kukuri-arpg/journal/Questions-and-answers-570883245"> FaQ </a>

                    </div>
                </li>


                <li class="nav-item dropdown">
                    <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Kukuology
                    </a>

                    <div class="dropdown-menu" aria-labelledby="inventoryDropdown">
                        <a class="dropdown-item" href="{{ url('masterlist') }}">
                            Character Masterlist
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/folklore.html">Folklore</a>
                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/genetics/species-info.html">Species Information</a>
                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/lore.html">The Story So Far</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/genetics/genes-and-mutations.html">Genetics and Mutations</a>
                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/genetics/physical-traits.html">Physical Traits</a>
                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/genetics/physical-traits.html">Skill Traits</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/activities/familiars.html">Familiars</a>
                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/handlers-guides.html">Handlers and Guides</a>

                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Your Kukuri
                    </a>

                    <div class="dropdown-menu" aria-labelledby="inventoryDropdown">
                        @if (Auth::check())
                            <a class="dropdown-item" href="{{ Auth::user()->url . '/characters' }}"> My Loaf </a>
                        @endif
                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/training/home.html">Training</a>
                        <a class="dropdown-item" href="{{ url('/info/fp-fate-points') }}">Leveling and Fate Points</a>
                        <a class="dropdown-item" href="https://kukuri-arpg.deviantart.com/journal/Injuries-and-illnesses-645173583">Health and Injuries</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="https://www.kukuri-arpg.com/prompts/prompts?prompt_category_id=2"> Rank Updates </a>
                        <a class="dropdown-item" href="https://www.deviantart.com/kukuri-arpg/journal/Ownership-transfers-593704983">Ownership Transfers</a>
                        <a class="dropdown-item" href="https://www.kukuri-arpg.com/prompts/28">Import Updates</a>
                        <a class="dropdown-item" href="https://www.kukuri-arpg.com/prompts/6">Heal your Kukuri</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="https://www.kukuri-arpg.com/info/design-approval"> Design Approvals </a>
                        <a class="dropdown-item" href="https://www.deviantart.com/momma-kuku/journal/Item-guides-645162809">Import Customization</a>
                        <a class="dropdown-item" href="https://www.deviantart.com/kukuri-arpg/journal/FP-tracker-and-how-to-make-one-604378418">Creating Trackers</a>

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="queueDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Activity
                    </a>
                    <div class="dropdown-menu" aria-labelledby="queueDropdown">
                        <a class="dropdown-item" href="{{ url('/queues') }}">
                            Check Queues
                        </a>
                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/activities/quests.html">
                            Current Quest/Event
                        </a>
                        <a class="dropdown-item" href="{{ url('prompts/prompt-categories') }}">
                            All Prompts
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('info/hunting') }}">
                            Hunting
                        </a>
                        <a class="dropdown-item" href="{{ url('info/gathering') }}">
                            Gathering
                        </a>
                        <a class="dropdown-item" href="{{ url('info/traveling') }}">
                            Traveling
                        </a>
                        <a class="dropdown-item" href="{{ url('info/excavating') }}">
                            Excavating
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('info/letters') }}">
                            Activity Letters
                        </a>
                        <a class="dropdown-item" href="{{ url('info/coliseum') }}">
                            Coliseum
                        </a>
                        <a class="dropdown-item" href="https://kukuri-arpg.w3spaces.com/activities/traveling-merchant.html">
                            Traveling Merchant
                        </a>
                        <div class="dropdown-divider"></div>
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
                        <!-- <a class="dropdown-item" href="{{ url('/info/games') }}">
                                Minigames
                            </a>
                            <a class="dropdown-item" href="{{ url('generators') }}">
                                Random Generators
                            </a>
                            <a class="dropdown-item" href="{{ url('world/info') }}">
                                World Expanded
                            </a> -->

                        <!-- <div class="dropdown-divider"></div>

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
                            </a> -->
                        <!-- <a class="dropdown-item" href="{{ url('designs') }}">
                                Design Approvals
                            </a> -->

                        <!-- <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('characters/transfers/incoming') }}">
                                Character Transfers
                            </a>
                            <a class="dropdown-item" href="{{ url('trades/open') }}">
                                Trades
                            </a> -->
                        <a class="dropdown-item" href="{{ url('shops') }}">
                            Shops
                        </a>
                        <!-- <a class="dropdown-item" href="{{ url('submit-xp') }}">
                                Submit {{ __('art_tracker.xp') }}
                        </a> -->
                    </div>
                </li>

                <!-- <li class="nav-item dropdown">
                    <a id="designhubDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Design Guides
                    </a>

                    <div class="dropdown-menu" aria-labelledby="designhubDropdown">
                        <a class="dropdown-item" href="{{ url('design-hub') }}">
                            Design Hub
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="browseDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Guidebook
                        </a>
                     -->

                <div class="dropdown-menu" aria-labelledby="browseDropdown">

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
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a id="loreDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Account
                        </a>

                        <div class="dropdown-menu" aria-labelledby="loreDropdown">
                            <a class="dropdown-item" href="{{ Auth::user()->url }}">
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ url('characters') }}">
                                My Loaf
                            </a>
                            <a class="dropdown-item" href="{{ url('submissions') }}">
                                My Submissions
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('inventory') }}">
                                Bank
                            </a>
                            <a class="dropdown-item" href="{{ url('bank') }}">
                                Wallet
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('account/settings') }}">
                                Settings
                            </a>

                            <a class="dropdown-item" href="{{ url('notifications') }}">
                                Notifications
                            </a>
                            <a class="dropdown-item" href="{{ url('applications') }}">
                                My Applications
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endif
                @guest
                @else
                    @if (Auth::user()->isStaff)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin') }}"><i class="fas fa-crown"></i></a>
                        </li>
                    @endif

                @endguest
            </ul>



        </div>
    </div>
</nav>
