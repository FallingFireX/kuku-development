@extends('admin.layout')

@section('admin-title')
    Adoption Categories
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Adoption Categories' => 'admin/data/adoption-categories']) !!}

    <h1>Adoption Categories</h1>

    <p>Adoption categories should be one of two things: Basecoat color OR Breed.</p>
    <p>The only thing you need (and can) enter is the category name.</p>

    <div class="text-right mb-3">
        <a class="btn btn-primary" href="{{ url('admin/data/adoption-center') }}"><i class="fas fa-arrow-left"></i> Return to Adoptions</a>
        <a class="btn btn-primary" href="{{ url('admin/data/adoption-categories/create') }}"><i class="fas fa-plus"></i> Create New Item Category</a>
    </div>
    @if (!count($categories))
        <p>No Adoption categories found.</p>
    @else
        <table class="table table-sm category-table">
            <tbody id="sortable" class="sortable">
                @foreach ($categories as $category)
                    <tr class="sort-item" data-id="{{ $category->id }}">
                        <td>
                            @if ($category->is_visible)
                                <i class="fas fa-eye-slash mr-1"></i>
                            @endif
                            {!! $category->category_name !!}
                        </td>
                        <td class="text-right">
                            <a href="{{ url('admin/data/adoption-categories/edit/' . $category->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    @endif

@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('.handle').on('click', function(e) {
                e.preventDefault();
            });
            $("#sortable").sortable({
                items: '.sort-item',
                handle: ".handle",
                placeholder: "sortable-placeholder",
                stop: function(event, ui) {
                    $('#sortableOrder').val($(this).sortable("toArray", {
                        attribute: "data-id"
                    }));
                },
                create: function() {
                    $('#sortableOrder').val($(this).sortable("toArray", {
                        attribute: "data-id"
                    }));
                }
            });
            $("#sortable").disableSelection();
        });
    </script>
@endsection
