@extends('admin.layout')

@section('admin-title')
    Dashboard
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Home' => 'admin']) !!}

    <h1>
        Admin Dashboard</h1>
    <div class="row">
        @if (Auth::user()->hasPower('manage_submissions'))
            <div class="col-md-3 d-flex">
                <div class="card text-center flex-fill">
                    <h3 class="card-header">Status Updates</h3>
                    <div class="card-body pt-3" style="text-align: center;">
                        <h5>
                            @if ($fpCount)
                                <span class="badge badge-primary">{{ $fpCount }}</span>
                            @else
                                <span class="badge badge-success ml-3 pt-1">Clear</span>
                            @endif
                        </h5>
                        <h5><i class="fas fa-calculator"></i> Rank Updates</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=2&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-upload"></i> Bulk Uploads</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=4&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-dumbbell"></i> SP updates</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=8&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1 pb-3"></span></a>
                    </div>

                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="card text-center flex-fill">
                    <h3 class="card-header">Activity Rolls</h3>
                    <div class="card-body pt-3" style="text-align: center;">
                        <h5>
                            @if ($arCount)
                                <span class="badge badge-primary">{{ $arCount }}</span>
                            @else
                                <span class="badge badge-success ml-3 pt-1">Clear</span>
                            @endif
                        </h5>
                        <h5><i class="fas fa-compass"></i> Traveling</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=14&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-gem"></i> Excavation</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=15&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-leaf"></i> Gathering</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=13&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-drumstick-bite"></i> Hunting</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=12&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1 pb-3"></span></a>

                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="card text-center flex-fill">
                    <h3 class="card-header">Adventures</h3>
                    <div class="card-body pt-3" style="text-align: center;">
                        <h5><i class="fas fa-map"></i> Quest/Event
                            @if ($questCount)
                                <span class="badge badge-primary">{{ $questCount }}</span>
                            @else
                                <span class="badge badge-success ml-3 pt-1">Clear</span>
                            @endif
                        </h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_category_id=10&prompt__id=none&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-envelope"></i> Letters
                            @if ($letterCount)
                                <span class="badge badge-primary">{{ $letterCount }}</span>
                            @else
                                <span class="badge badge-success ml-3 pt-1">Clear</span>
                            @endif
                        </h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_category_id=4&prompt__id=none&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-stamp"></i> Training
                            @if ($trainingCount)
                                <span class="badge badge-primary">{{ $trainingCount }}</span>
                            @else
                                <span class="badge badge-success ml-3 pt-1">Clear</span>
                            @endif
                        </h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=19&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-dumbbell"></i> Coli/Merchant
                            @if ($coliCount)
                                <span class="badge badge-primary">{{ $coliCount }}</span>
                            @else
                                <span class="badge badge-success ml-3 pt-1">Clear</span>
                            @endif
                        </h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending??prompt_category_id=7&prompt__id=none&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1 pb-3"></span></a>

                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="card text-center flex-fill">
                    <h3 class="card-header">Design</h3>
                    <div class="card-body pt-3" style="text-align: center;">
                        <h5>
                            @if ($designCount)
                                <span class="badge badge-primary">{{ $designCount }}</span>
                            @else
                                <span class="badge badge-success ml-3 pt-1">Clear</span>
                            @endif
                        </h5>
                        <h5><i class="fas fa-palette"></i> Approvals</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=22&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-pen"></i> Corrections</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=23&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-frog"></i> Rebirths</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=24&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1 pb-3"></span></a>
                    </div>

                </div>
            </div>

            <div class="col-md-3 d-flex mt-2">
                <div class="card text-center flex-fill">
                    <h3 class="card-header">Adoptions</h3>
                    <div class="card-body pt-3" style="text-align: center;">
                        <h5>
                            @if ($adoptCount)
                                <span class="badge badge-primary">{{ $adoptCount }}</span>
                            @else
                                <span class="badge badge-success ml-3 pt-1">Clear</span>
                            @endif
                        </h5>
                        <h5><i class="fas fa-hand-holding-heart"></i> First Time Adopts</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=10&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-calendar"></i> Monthly Adopts</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=11&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-gift"></i> Donations</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=9&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1 pb-3"></span></a>
                    </div>

                </div>
            </div>
            <div class="col-md-3 d-flex mt-2">
                <div class="card text-center flex-fill">
                    <h3 class="card-header">Misc</h3>
                    <div class="card-body pt-3" style="text-align: center;">
                        <h5>
                            @if ($misc2Count)
                                <span class="badge badge-primary">{{ $misc2Count }}</span>
                            @else
                                <span class="badge badge-success ml-3 pt-1">Clear</span>
                            @endif
                        </h5>
                        <h5><i class="fas fa-gavel"></i> Create Character</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/masterlist/create-character') }}" class="card-link">Open Tool<span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-wrench"></i> Misc Queues</h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_category_id=3&prompt__id=none&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        <h5 class="mt-3 pt-3"><i class="fas fa-bug"></i> Errors
                            @if ($errorCount)
                                <span class="badge badge-primary">{{ $errorCount }}</span>
                            @else
                                <span class="badge badge-success ml-3 pt-1"></span>
                            @endif
                        </h5>
                        <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_category_id=11&prompt_id=none&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        @if ($openTransfersQueue)
                            <h5 class="mt-3 pt-3"><i class="fas fa-caret-right"></i> Transfers
                                @if ($transferCount)
                                    <span class="badge badge-primary">{{ $transferCount }}</span>
                                @else
                                    <span class="badge badge-success ml-3 pt-1"></span>
                                @endif
                            </h5>
                            <a href="{{ url('admin/masterlist/transfers/incoming') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                        @endif
                        @if ($openTradesQueue)
                            <h5 class="mt-3 pt-3"><i class="fas fa-caret-right"></i> Trades
                                @if ($tradeCount)
                                    <span class="badge badge-primary">{{ $tradeCount }}</span>
                                @else
                                    <span class="badge badge-success ml-3 pt-1"></span>
                                @endif
                            </h5>
                            <a href="{{ url('admin/trades/incoming') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex mt-2">
                <div class="card text-center flex-fill">
                    <h3 class="card-header">Site</h3>
                    <div class="card-body pt-3" style="text-align: center;">
                        <h5 class="mt-3 pt-3"><i class="fas fa-clipboard"></i> Claims
                            @if ($claimCount)
                                <span class="badge badge-primary">{{ $claimCount }}</span>
                            @else
                                <span class="badge badge-success ml-3 pt-1">Clear</span>
                            @endif
                        </h5>
                        <a href="{{ url('admin/claims/pending') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                        @if (Auth::user()->hasPower('manage_reports'))
                            <h5 class="mt-3 pt-3"><i class="fas fa-exclamation"></i> Reports
                                @if ($reportCount)
                                    <span class="badge badge-primary">{{ $reportCount }}</span>
                                @else
                                    <span class="badge badge-success ml-3 pt-1">Clear</span>
                                @endif
                            </h5>
                            <a href="{{ url('admin/reports/pending') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                        @endif
                        @if (Auth::user()->hasPower('manage_affiliates'))
                            <h5 class="mt-3 pt-3"><i class="fas fa-exclamation"></i> Affiliate Requests
                                @if ($affiliateCount)
                                    <span class="badge badge-primary">{{ $affiliateCount }}</span>
                                @else
                                    <span class="badge badge-success ml-3 pt-1">Clear</span>
                                @endif
                            </h5>
                            <a href="{{ url('admin/affiliates/pending') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                        @endif
                        @if (Auth::user()->hasPower('edit_teams'))
                            <h5 class="mt-3 pt-3"><i class="fas fa-exclamation"></i> Applications
                                @if ($AppCount)
                                    <span class="badge badge-primary">{{ $AppCount }}</span>
                                @else
                                    <span class="badge badge-success ml-3 pt-1">Clear</span>
                                @endif
                            </h5>
                            <a href="{{ url('admin/applications') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                        @endif
                    </div>
                </div>

            </div>
    </div>
    </div>
    @endif

    <!-- @if (Auth::user()->hasPower('manage_submissions'))
                                                    <div class="col-sm-6">
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Tracker Submissions
                                                                    @if ($trackerCount)
    <span class="badge badge-primary">{{ $trackerCount }}</span>
    @endif
                                                                </h5>
                                                                <p class="card-text">
                                                                    @if ($trackerCount)
    @if ($trackerCount)
    {{ $trackerCount }} tracker submission{{ $trackerCount == 1 ? '' : 's' }} awaiting assignment.
    @endif
                                                                        {!! $trackerCount ? '<br/>' : '' !!}
@else
    The tracker submission queue is clear. Hooray!
    @endif
                                                                </p>
                                                                <div class="text-right">
                                                                    <a href="{{ url('admin/trackers/pending') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif -->

    </div>
@endsection
