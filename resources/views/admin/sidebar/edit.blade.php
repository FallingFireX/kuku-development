@extends('admin.layout')

@section('admin-title')
    Sidebar
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Pages' => 'admin/sidebar']) !!}

    <div class="container">
        <h2>Edit Sidebar Content</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        {!! Form::open(['method' => 'POST']) !!}
        <div class="form-group">
            {!! Form::label('Season') !!}
            {!! Form::text('box1', $sidebar->box1content, ['class' => 'form-control wysiwyg']) !!}

            {!! Form::label('Quest') !!}
            {!! Form::text('box2', $sidebar->box2content, ['class' => 'form-control wysiwyg']) !!}

            {!! Form::label('Beauty Contest') !!}
            {!! Form::text('box3', $sidebar->box3content, ['class' => 'form-control wysiwyg']) !!}
        </div>
        <div class="text-right">
            {!! Form::submit($sidebar->id ? 'Edit' : 'Create', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
