@extends('layouts.app')


@section('title')
    Design Hub
@endsection


@section('content')
    {!! breadcrumbs(['Design Hub' => 'Design Hub']) !!}
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

        });
    </script>
@endsection
