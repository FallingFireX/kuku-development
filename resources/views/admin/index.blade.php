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
                                <h5><i class="fas fa-calculator"></i> Rank Updates
                                    @if ($arCount)
                                        <span class="badge badge-primary">{{ $arCount }}</span>
                                    @else
                                        <span class="badge badge-success ml-3 pt-1">Clear</span>
                                    @endif
                                    </h5>
                                <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=2&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                            
                                <h5 class="mt-3 pt-3"><i class="fas fa-upload"></i> Bulk Uploads
                                    @if ($arCount)
                                        <span class="badge badge-primary">{{ $arCount }}</span>
                                    @else
                                        <span class="badge badge-success ml-3 pt-1">Clear</span>
                                    @endif
                                    </h5>
                                <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=4&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                            
                                <h5 class="mt-3 pt-3"><i class="fas fa-dumbbell"></i> SP updates
                                    @if ($arCount)
                                        <span class="badge badge-primary">{{ $arCount }}</span>
                                    @else
                                        <span class="badge badge-success ml-3 pt-1">Clear</span>
                                    @endif
                                    </h5>
                                <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=8&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1 pb-3"></span></a>
                            </div>
                        
                </div>
            </div>
            <div class="col-md-3 d-flex">
                        <div class="card text-center flex-fill">
                            <h3 class="card-header">Activity Rolls</h3>
                            <div class="card-body pt-3" style="text-align: center;">
                                <h5><i class="fas fa-compass"></i> Traveling
                                    @if ($arCount)
                                        <span class="badge badge-primary">{{ $arCount }}</span>
                                    @else
                                        <span class="badge badge-success ml-3 pt-1">Clear</span>
                                    @endif
                                    </h5>
                                <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=2&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                            
                                <h5 class="mt-3 pt-3"><i class="fas fa-gem"></i> Excavation
                                    @if ($arCount)
                                        <span class="badge badge-primary">{{ $arCount }}</span>
                                    @else
                                        <span class="badge badge-success ml-3 pt-1">Clear</span>
                                    @endif
                                    </h5>
                                <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=4&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                            
                                <h5 class="mt-3 pt-3"><i class="fas fa-leaf"></i> Gathering
                                    @if ($arCount)
                                        <span class="badge badge-primary">{{ $arCount }}</span>
                                    @else
                                        <span class="badge badge-success ml-3 pt-1">Clear</span>
                                    @endif
                                    </h5>
                                <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=8&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                                <h5 class="mt-3 pt-3"><i class="fas fa-drumstick-bite"></i> Hunting
                                    @if ($arCount)
                                        <span class="badge badge-primary">{{ $arCount }}</span>
                                    @else
                                        <span class="badge badge-success ml-3 pt-1">Clear</span>
                                    @endif
                                    </h5>
                                <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=8&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1 pb-3"></span></a>
                            
                            </div>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                        <div class="card text-center flex-fill">
                            <h3 class="card-header">Adventures</h3>
                            <div class="card-body pt-3" style="text-align: center;">
                                <h5><i class="fas fa-map"></i> Quest/Event
                                    @if ($arCount)
                                        <span class="badge badge-primary">{{ $arCount }}</span>
                                    @else
                                        <span class="badge badge-success ml-3 pt-1">Clear</span>
                                    @endif
                                    </h5>
                                <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=2&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                            
                                <h5 class="mt-3 pt-3"><i class="fas fa-envelope"></i> Letters
                                    @if ($arCount)
                                        <span class="badge badge-primary">{{ $arCount }}</span>
                                    @else
                                        <span class="badge badge-success ml-3 pt-1">Clear</span>
                                    @endif
                                    </h5>
                                <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=4&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                            
                                <h5 class="mt-3 pt-3"><i class="fas fa-stamp"></i> Training
                                    @if ($arCount)
                                        <span class="badge badge-primary">{{ $arCount }}</span>
                                    @else
                                        <span class="badge badge-success ml-3 pt-1">Clear</span>
                                    @endif
                                    </h5>
                                <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=8&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>

                                <h5 class="mt-3 pt-3"><i class="fas fa-dumbbell"></i> Coli/Merchant
                                    @if ($arCount)
                                        <span class="badge badge-primary">{{ $arCount }}</span>
                                    @else
                                        <span class="badge badge-success ml-3 pt-1">Clear</span>
                                    @endif
                                    </h5>
                                <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=8&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1 pb-3"></span></a>
                            
                            </div>
                </div>
            </div>
    </div>
<br>
            <!-- big box -->
            <div class="col-sm-12">
                <div class="card mb-3">
                    <!-- small box-->
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card-body" style="text-align: center">
                                <br><br><br>
                                <h3 class="card-title">Other Activities</h3>
                                <br>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-map"></i></h3>
                                <h5 class="card-title">Quests</h5>
                                <p class="card-text">
                                    @if ($questCount)
                                        <h5><span class="badge badge-primary">{{ $questCount }}</span></h5>
                                    @else
                                        <h5><span class="badge badge-success">Clear</span></h5>
                                    @endif
                                </p>
                                <br>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_category_id=10&prompt_id=none&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-flag"></i></h3>
                                <h5 class="card-title">Coliseum</h5>
                                <p class="card-text">
                                    @if ($coliCount)
                                        <h5><span class="badge badge-primary">{{ $coliCount }}</span></h5>
                                    @else
                                        <h5><span class="badge badge-success">Clear</span></h5>
                                    @endif
                                </p>
                                <br>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_category_id=7&prompt_id=none&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-envelope"></i></h3>
                                <h5 class="card-title">Letters</h5>
                                <p class="card-text">
                                    @if ($letterCount)
                                        <h5><span class="badge badge-primary">{{ $letterCount }}</span></h5>
                                    @else
                                        <h5><span class="badge badge-success">Clear</span></h5>
                                    @endif
                                </p>
                                <br>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_category_id=4&prompt_id=none&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-stamp"></i></h3>
                                <h5 class="card-title">Trainings</h5>
                                <p class="card-text">
                                    @if ($trainingCount)
                                        <h5><span class="badge badge-primary">{{ $trainingCount }}</span></h5>
                                    @else
                                        <h5><span class="badge badge-success">Clear</span></h5>
                                    @endif
                                </p>
                                <br>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=19&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- big box -->
            <div class="col-sm-5">
                <div class="card mb-4">
                    <br>
                    <h3 class="card-title" style="text-align: center; margin-top:10px;">Breeding</h3>
                    <!-- small box-->
                    <center>
                        <p class="card-text">
                            @if ($breedCount)
                                <h5><span class="badge badge-primary">{{ $breedCount }}</span></h5>
                            @else
                                <h5><span class="badge badge-success">Clear</span></h5>
                            @endif
                        </p>
                    </center>

                    <div class="row" style="justify-content:center">
                        <div class="col-sm-5">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-heart"></i></h3>
                                <h5 class="card-title">Breeding</h5>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=26&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-egg"></i></h3>
                                <h5 class="card-title">Eggs</h5>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=25&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="card mb-4">
                    <br>
                    <h3 class="card-title" style="text-align: center; margin-top:10px;">Design</h3>
                    <center>
                        <p class="card-text">
                            @if ($designCount)
                                <h5><span class="badge badge-primary">{{ $designCount }}</span></h5>
                            @else
                                <h5><span class="badge badge-success">Clear</span></h5>
                            @endif
                        </p>
                    </center>
                    <!-- small box-->

                    <div class="row" style="justify-content:center">
                        <div class="col-sm-4">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-palette"></i></h3>
                                <h5 class="card-title">Approvals</h5>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=22&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-pen"></i></h3>
                                <h5 class="card-title">Corrections</h5>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=23&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-frog"></i></h3>
                                <h5 class="card-title">Rebirths</h5>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=24&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- big box -->
            <div class="col-sm-7">
                <div class="card mb-4">
                    <br>
                    <h3 class="card-title" style="text-align: center; margin-top:10px;">Adoptions</h3>
                    <center>
                        <p class="card-text">
                            @if ($adoptCount)
                                <h5><span class="badge badge-primary">{{ $adoptCount }}</span></h5>
                            @else
                                <h5><span class="badge badge-success">Clear</span></h5>
                            @endif
                        </p>
                    </center>
                    <!-- small box-->

                    <div class="row" style="justify-content:center">
                        <div class="col-sm-4">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-hand-holding-heart"></i></h3>
                                <h5 class="card-title">First Time Adopts</h5>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=10&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-calendar"></i></h3>
                                <h5 class="card-title">Monthly Adopts</h5>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=11&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-gift"></i></h3>
                                <h5 class="card-title">Donations</h5>
                                <div class="text-center">
                                    <a href="{{ url('https://www.kukuri-arpg.com/admin/submissions/pending?prompt_id=9&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="card mb-4">
                    <br>
                    <h3 class="card-title" style="text-align: center; margin-top:10px;">Other Queues</h3>
                    <center>
                        <p class="card-text">
                            @if ($misc2Count)
                                <h5><span class="badge badge-primary">{{ $misc2Count }}</span></h5>
                            @else
                                <h5><span class="badge badge-success">Clear</span></h5>
                            @endif
                        </p>
                    </center>
                    <!-- small box-->

                    <div class="row" style="justify-content:center">
                        <div class="col-sm-5">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-gavel"></i></h3>
                                <h5 class="card-title">Misc</h5>
                                <div class="text-center">
                                    <a href="{{ url('admin/submissions/pending?prompt_category_id=3&prompt_id=none&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-wrench"></i></h3>
                                <h5 class="card-title">Import Updates</h5>
                                <div class="text-center">
                                    <a href="{{ url('admin/submissions/pending?prompt_category_id=3&prompt_id=28&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- big box -->
            <div class="col-sm-12">
                <div class="card mb-3">
                    <h3 class="card-title" style="text-align: center; margin-top:10px;">Error Fixes</h3>
                    <!-- small box-->
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-calculator"></i></h3>
                                <h5 class="card-title">FP Area</h5>
                                <p class="card-text">
                                    @if ($fpErrorCount)
                                        <h5><span class="badge badge-primary">{{ $fpErrorCount }}</span></h5>
                                    @else
                                        <h5><span class="badge badge-success">Clear</span></h5>
                                    @endif
                                </p>
                                <br>
                                <div class="text-center">
                                    <a href="{{ url('admin/submissions/pending?prompt_category_id=11&prompt_id=38&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-map-marker-alt"></i></h3>
                                <h5 class="card-title">AR and Quests</h5>
                                <p class="card-text">
                                    @if ($arquestErrorCount)
                                        <h5><span class="badge badge-primary">{{ $arquestErrorCount }}</span></h5>
                                    @else
                                        <h5><span class="badge badge-success">Clear</span></h5>
                                    @endif
                                </p>
                                <br>
                                <div class="text-center">
                                    <a href="{{ url('admin/submissions/pending?prompt_category_id=11&prompt_id=39&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-mail-bulk"></i></h3>
                                <h5 class="card-title">Letter/Coliseum/Training</h5>
                                <p class="card-text">
                                    @if ($lctErrorCount)
                                        <h5><span class="badge badge-primary">{{ $lctErrorCount }}</span></h5>
                                    @else
                                        <h5><span class="badge badge-success">Clear</span></h5>
                                    @endif
                                </p>
                                <br>
                                <div class="text-center">
                                    <a href="{{ url('admin/submissions/pending?prompt_category_id=11&prompt_id=40&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-images"></i></h3>
                                <h5 class="card-title">Imports</h5>
                                <p class="card-text">
                                    @if ($importErrorCount)
                                        <h5><span class="badge badge-primary">{{ $importErrorCount }}</span></h5>
                                    @else
                                        <h5><span class="badge badge-success">Clear</span></h5>
                                    @endif
                                </p>
                                <br>
                                <div class="text-center">
                                    <a href="{{ url('admin/submissions/pending?prompt_category_id=11&prompt_id=3&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-heart"></i></h3>
                                <h5 class="card-title">Breeding</h5>
                                <p class="card-text">
                                    @if ($breedErrorCount)
                                        <h5><span class="badge badge-primary">{{ $breedErrorCount }}</span></h5>
                                    @else
                                        <h5><span class="badge badge-success">Clear</span></h5>
                                    @endif
                                </p>
                                <br>
                                <div class="text-center">
                                    <a href="{{ url('admin/submissions/pending?prompt_category_id=11&prompt_id=41&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card-body" style="text-align: center;">
                                <h3><i class="fas fa-coins"></i></h3>
                                <h5 class="card-title">Bank</h5>
                                <p class="card-text">
                                    @if ($bankErrorCount)
                                        <h5><span class="badge badge-primary">{{ $bankErrorCount }}</span></h5>
                                    @else
                                        <h5><span class="badge badge-success">Clear</span></h5>
                                    @endif
                                </p>
                                <br>
                                <div class="text-center">
                                    <a href="{{ url('admin/submissions/pending?prompt_category_id=11&prompt_id=37&sort=oldest') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if (Auth::user()->hasPower('manage_reports'))
                <div class="col-sm-3">
                    <div class="card mb-3">
                        <div class="card-body" style="text-align: center">
                            <h3><i class="fas fa-exclamation"></i></h3>
                            <h5 class="card-title">Reports</h5>
                            <p class="card-text">
                                @if ($reportCount || $assignedReportCount)
                                    <h5><span class="badge badge-primary">{{ $reportCount + $assignedReportCount }}</span></h5>
                                @else
                                    <span class="badge badge-success">Clear</span>
                                @endif
                            </p>
                            <br>
                            <div class="text-center">
                                <a href="{{ url('admin/reports/pending') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-sm-3">
                <div class="card mb-3">
                    <div class="card-body" style="text-align: center">
                        <h3><i class="fas fa-exclamation"></i></h3>
                        <h5 class="card-title">Claims</h5>
                        <p class="card-text">
                            @if ($claimCount)
                                <h5><span class="badge badge-primary">{{ $claimCount }}</span></h5>
                            @else
                                <span class="badge badge-success">Clear</span>
                            @endif
                        </p>
                        <br>
                        <div class="text-center">
                            <a href="{{ url('admin/claims/pending') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($openTransfersQueue)
            <div class="col-sm-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            Character Transfers
                            @if ($transferCount)
                                <span class="badge badge-primary">{{ $transferCount }}</span>
                            @endif
                        </h5>
                        <p class="card-text">
                            @if ($transferCount)
                                {{ $transferCount }} character transfer{{ $transferCount == 1 ? '' : 's' }} awaiting processing.
                            @else
                                The character transfer/trade queue is clear. Hooray!
                            @endif
                        </p>
                        <div class="text-right">
                            <a href="{{ url('admin/masterlist/transfers/incoming') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($openTradesQueue)
            <div class="col-sm-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            Trades
                            @if ($tradeCount)
                                <span class="badge badge-primary">{{ $tradeCount }}</span>
                            @endif
                        </h5>
                        <p class="card-text">
                            @if ($tradeCount)
                                {{ $tradeCount }} trade{{ $tradeCount == 1 ? '' : 's' }} awaiting processing.
                            @else
                                The trade queue is clear. Hooray!
                            @endif
                        </p>
                        <div class="text-right">
                            <a href="{{ url('admin/trades/incoming') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (Auth::user()->hasPower('manage_reports'))
            <div class="col-sm-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Reports @if ($reportCount || $assignedReportCount)
                                <span class="badge badge-primary">{{ $reportCount + $assignedReportCount }}</span>
                            @endif
                        </h5>
                        <p class="card-text">
                            @if ($reportCount || $assignedReportCount)
                                @if ($reportCount)
                                    {{ $reportCount }} report{{ $reportCount == 1 ? '' : 's' }} awaiting assignment.
                                @endif
                                {!! $reportCount && $assignedReportCount ? '<br/>' : '' !!}
                                @if ($assignedReportCount)
                                    {{ $assignedReportCount }} report{{ $assignedReportCount == 1 ? '' : 's' }} awaiting processing.
                                @endif
                            @else
                                The report queue is clear. Hooray!
                            @endif
                        </p>
                        <div class="text-right">
                            <a href="{{ url('admin/reports/pending') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (!Auth::user()->hasPower('manage_submissions') && !Auth::user()->hasPower('manage_characters') && !Auth::user()->hasPower('manage_reports'))
            <div class="card p-4 col-12">
                <h5 class="card-title">You do not have a rank that allows you to access any queues.</h5>
                <p class="mb-1">
                    Refer to the sidebar for what you can access as a staff member.
                </p>
                <p class="mb-0">
                    If you believe this to be in error, contact your site administrator.
                </p>
            </div>
        @endif
        @if (Auth::user()->hasPower('manage_submissions'))
            @if ($galleryRequireApproval)
                <div class="col-sm-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Gallery Submissions @if ($gallerySubmissionCount)
                                    <span class="badge badge-primary">{{ $gallerySubmissionCount }}</span>
                                @endif
                            </h5>
                            <p class="card-text">
                                @if ($gallerySubmissionCount)
                                    {{ $gallerySubmissionCount }} gallery submission{{ $gallerySubmissionCount == 1 ? '' : 's' }} awaiting processing.
                                @else
                                    The gallery submission queue is clear. Hooray!
                                @endif
                            </p>
                            <div class="text-right">
                                <a href="{{ url('admin/gallery/submissions/pending') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (Auth::user()->hasPower('manage_affiliates'))
                <div class="col-sm-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Affiliate Requests @if ($affiliateCount)
                                    <span class="badge badge-primary">{{ $affiliateCount }}</span>
                                @endif
                            </h5>
                            <p class="card-text">
                                @if ($affiliateCount)
                                    {{ $affiliateCount }} affiliate request{{ $affiliateCount == 1 ? '' : 's' }} awaiting processing.
                                @else
                                    The affiliate request queue is clear. Hooray!
                                @endif
                            </p>
                            <div class="text-right">
                                <a href="{{ url('admin/affiliates/pending') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($galleryCurrencyAwards)
                <div class="col-sm-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Gallery Currency Awards @if ($galleryAwardCount)
                                    <span class="badge badge-primary">{{ $galleryAwardCount }}</span>
                                @endif
                            </h5>
                            <p class="card-text">
                                @if ($galleryAwardCount)
                                    {{ $galleryAwardCount }} gallery submission{{ $galleryAwardCount == 1 ? '' : 's' }} awaiting currency rewards.
                                @else
                                    The gallery currency award queue is clear. Hooray!
                                @endif
                            </p>
                            <div class="text-right">
                                <a href="{{ url('admin/gallery/currency/pending') }}" class="card-link">View Queue <span class="fas fa-caret-right ml-1"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        @if (Auth::user()->hasPower('edit_teams'))
            <div class="col-sm-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Team applications
                            @if ($AppCount)
                                <span class="badge badge-primary">{{ $AppCount }}</span>
                            @endif
                        </h5>
                        <p class="card-text">
                            @if ($AppCount)
                                {{ $AppCount }} application{{ $AppCount == 1 ? '' : 's' }} awaiting review.
                            @else
                                No applications waiting review
                            @endif
                        </p>
                        <div class="text-right">
                            <a href="{{ url('admin/applications') }}" class="card-link">View Applications <span class="fas fa-caret-right ml-1"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        @if (Auth::user()->hasPower('manage_submissions'))
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
        @endif
        @endif
    </div>
@endsection
