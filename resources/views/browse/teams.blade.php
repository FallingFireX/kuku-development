@extends('layouts.app')

@section('title')
    Admins and Staff
@endsection

@section('content')
    {!! breadcrumbs(['Teams' => 'teams']) !!}
    <h1>Admins and Staff</h1>
    <div class="text-right mb-3">
        <a class="btn btn-primary" href="{{ url('join-the-team') }}"><i class="fas fa-plus"></i> Join the Team!</a>
    </div>
    <div class="text-center">
        <!--Leadership teams ALWAYS show all members-->
        @foreach($leadership as $teamId => $members)
        <div class="card mt-3 pt-2 rounded">
            <h3>{{ $members->first()->team->name }}</h3>
            <div class="row justify-content-center mt-3">
                @foreach($members as $entry)
                    <div class="col-md-3">
                        <div class="card mb-3" style="background-color:transparent; border-width:0px;">
                            <div class="card-body text-center">
                            <img src="/images/avatars/{{ $entry->user->avatar }}" class="rounded-circle" style="width:100px; height:100px;" alt="{{ $entry->user->name }}">
                                <h5>{!! $entry->user->displayName !!}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
</div>
        @endforeach

        <!-- Normal teams sort by role priority -->
        <div class="mt-4">
        @foreach($teams as $teamId => $members)
        <div class="card mt-3 pt-2 rounded">
            <h4>{{ $members->first()->team->name }}</h4>
            <div class="container mt-3">
                <div class="row justify-content-center align-items-stretch">
                    @foreach($members->sortBy('priority') as $entry) 
                        <div class="col-md-3 d-flex">
                            <div class="card mb-3 flex-fill" style="background-color:transparent; border-width:0px;">
                                <div class="card-body text-center">
                                    <img src="/images/avatars/{{ $entry->user->avatar }}" class="rounded-circle" style="width:100px; height:100px;" alt="{{ $entry->user->name }}">
                                    <h5>{!! $entry->user->displayName !!}</h5>
                                        @if ($entry->role === 'primary')
                                        <h6>Main</h6>
                                        @else
                                        <h6>{{ $entry->role }}</h6>
                                        @endif
                                    @if($entry->otherRoles->isNotEmpty())
                                        <div class="text-center">
                                            @foreach($entry->otherRoles as $role)
                                                {{ $role['team']->name }} ({{ $role['role'] }})<br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
        @endforeach
        
        </div>
    </div>
@endsection
