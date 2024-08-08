@extends('user.layout')

@section('profile-title')
    {{ $user->name }}'s Characters
@endsection

@section('profile-content')
    {!! breadcrumbs(['Users' => 'users', $user->name => $user->url, 'Characters' => $user->url . '/characters']) !!}

    <h1>
        {!! $user->displayName !!}'s Characters
    </h1>
    <div class="text-right mb-2">
        <a class="btn btn-primary create-folder mx-1" href="#"><i class="fas fa-plus"></i> Sort/Manage Kukuri</a>
    </div>
    @include('user._characters', ['characters' => $characters, 'myo' => false])
@endsection
