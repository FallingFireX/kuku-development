@extends('layouts.app')


@section('title')
    Design Hub
@endsection


@section('content')
    {!! breadcrumbs(['Design Hub' => 'design-hub', $marking->name => $marking->url]) !!}
    <x-admin-edit title="Marking" :object="$marking" />
    <h1>{{ $marking->name }} <span style="text-transform:none;">({{ $marking->recessive }}/{{ $marking->dominant }})</span></h1>
    <p>{{ $marking->short_description }}</p>

    <div class="site-page-content parsed-text">
        {!! $marking->description !!}
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('img').each(function(i, e) {
                $(this).wrap('<a href="' + $(this).attr('src') + '" data-lightbox="entry" ></a>');
            });
        });
    </script>
@endsection
