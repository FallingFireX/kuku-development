@extends('prompts.layout')

@section('prompts-title')
    Prompt Categories
@endsection

@section('content')
    {!! breadcrumbs(['Prompts' => 'prompts', 'Prompt Categories' => 'prompts/prompt-categories']) !!}
    <h1>Prompt Categories</h1>

    <div>
        {!! Form::open(['method' => 'GET', 'class' => 'form-inline justify-content-end']) !!}
        <div class="form-group mr-3 mb-3">
            {!! Form::text('name', Request::get('name'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group mb-3">
            {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>


    {!! $categories->render() !!}
    @foreach ($categories->chunk(4) as $chunk)
    <div class = "container-flex">
        <div class = "row">
        @foreach ($chunk as $category)
            <div class = "col-xs-12 col-s-12 col-md-4 col-lg-3 col-xl-4 mb-3">
                <div class="card" style = "height: 100%">
                    <div class="card-body">
                    @include('prompts._entry', [
                        'edit' => ['object' => $category, 'title' => 'Category'],
                        'imageUrl' => $category->categoryImageUrl,
                        'name' => $category->displayName,
                        'description' => $category->parsed_description,
                        'searchUrl' => $category->searchUrl,
                    ])
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
    {!! $categories->render() !!}

    <div class="text-center mt-4 small text-muted">{{ $categories->total() }} result{{ $categories->total() == 1 ? '' : 's' }} found.</div>
@endsection
