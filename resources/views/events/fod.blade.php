@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/' . $theme->cssUrl) }}">


<link rel="stylesheet" href="http://localhost:8000/css/3.css">

@section('title') Fesitval of Death 2025 @endsection


@section('content')
{!! breadcrumbs(['FoD-2025' => 'linkthatgoesthere']) !!}


<div class="site-page-content parsed-text">
    {!! $page->parsed_text !!}

    <b>test test test</b>
</div>


@endsection
