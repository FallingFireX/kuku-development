<style>
    .sidebar-item a {
    display: block;         /* Makes the whole row clickable */
    padding: 10px 15px;
    text-decoration: none;
    font-weight: bold;  /* Remove underline */
    color: var(--dark);            /* Text color */
    background: var(--secondary);    /* Default background */
    border-radius: 5px;     /* Rounded corners (optional) */
    transition: background 0.2s ease;
}

.sidebar-item a:hover {
    background: var(--cyan);    /* Hover effect */
    cursor: pointer;
}

.sidebar-item a.active {
    background: #b0b0b0;    /* Active state */
    font-weight: bold;
}

</style>
@extends('layouts.app')

@section('title')
    {{ $page->title }}
@endsection

@section('content')
    <x-admin-edit title="Page" :object="$page" />
    {!! breadcrumbs([$page->title => $page->url]) !!}
    <h1>{{ $page->title }}</h1>
    <div class="mb-4">
        <div><strong>Created:</strong> {!! format_date($page->created_at) !!}</div>
        <div><strong>Last updated:</strong> {!! format_date($page->updated_at) !!}</div>
    </div>

    <div class="site-page-content parsed-text">
        {!! $page->parsed_text !!}
    </div>

    @if ($page->can_comment)
        <div class="container">
            @comments([
                'model' => $page,
                'perPage' => 5,
                'allow_dislikes' => $page->allow_dislikes,
            ])
        </div>
    @endif
@endsection
