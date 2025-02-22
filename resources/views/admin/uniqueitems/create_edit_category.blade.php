@extends('admin.layout')

@section('admin-title')
    {{ $category->id ? 'Edit' : 'Create' }} Adoption Category
@endsection

@section('admin-content')
    {!! breadcrumbs([
        'Admin Panel' => 'admin',
        'Item Categories' => 'admin/data/adoption-categories',
        ($category->id ? 'Edit' : 'Create') . ' Category' => $category->id ? 'admin/data/adoption-categories/edit/' . $category->id : 'admin/data/adoption-categories/create',
    ]) !!}

    <h1>{{ $category->id ? 'Edit' : 'Create' }} Adoption Category
        @if ($category->id)
            <a href="#" class="btn btn-danger float-right delete-category-button">Delete Category</a>
        @endif
    </h1>

    {!! Form::open(['url' => $category->id ? 'admin/data/adoption-categories/edit/' . $category->id : 'admin/data/adoption-categories/create', 'files' => true]) !!}

    <h3>Basic Information</h3>

    <div class="form-group">
        {!! Form::label('Name') !!}
        {!! Form::text('category_name', $category->category_name, ['class' => 'form-control']) !!}
    </div>

    <div class="text-right">
        {!! Form::submit($category->id ? 'Edit' : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('.delete-category-button').on('click', function(e) {
                e.preventDefault();
                loadModal("{{ url('admin/data/item-categories/delete') }}/{{ $category->id }}", 'Delete Category');
            });
        });
    </script>
@endsection
