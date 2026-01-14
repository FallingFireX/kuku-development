@extends('admin.layout')

@section('admin-title')
    {{ $unique_item->id ? 'Edit' : 'Create' }} Item
@endsection

@section('admin-content')
    {!! breadcrumbs([
        'Admin Panel' => 'admin',
        'Adoption Center' => 'admin/data/adoption-center',
        ($unique_item->id ? 'Edit' : 'Create') . ' Adoption' => $unique_item->id ? 'admin/data/adoption-center/edit/' . $unique_item->id : 'admin/data/adoption-center/create',
    ]) !!}

    <h1>{{ $unique_item->id ? 'Edit' : 'Create' }} Adoption
        @if ($unique_item->id)
            <form action="{{ route('admin.uniqueitems.delete', $unique_item->id) }}" method="POST" class="delete-item-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger float-right">Delete Item</button>
            </form>
        @endif
    </h1>


    {!! Form::open(['url' => $unique_item->id ? 'admin/data/adoption-center/edit/' . $unique_item->id : 'admin/data/adoption-center/create', 'files' => true]) !!}

    <h3>Basic Information</h3>

    <div class="row">
        <div class="col-md">
            <div class="form-group">
                {!! Form::label('Item ID') !!}
                {!! Form::text('item_id', $unique_item->item_id ?? '', ['class' => 'form-control']) !!}
                <i><b>Recommended ID is <span id="recommended-id">{{ $nextItemId }}</b>. Only change this if a new Adoption is being made!</span></i>
            </div>
        </div>

        <div class="col-md">
            <div class="form-group">
                {!! Form::label('Item Name') !!}
                <div class="input-group">
                    {!! Form::text('item_slug', $unique_item->item_slug ?? '', ['class' => 'form-control', 'id' => 'item-slug']) !!}
                    <div class="input-group-append">
                        <button type="button" class="btn btn-secondary" id="generate-slug-btn" data-toggle="tooltip" title="This will create a recommended Name for the AC entry">Generate Name</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('Link') !!}
        {!! Form::text('link', $unique_item->link, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Description (Optional)') !!}
        {!! Form::textarea('description', $unique_item->description, ['class' => 'form-control wysiwyg']) !!}
    </div>

    <div class="row">
        <div class="col-md">
            <div class="form-group">
                {!! Form::label('category_1', 'Main Category') !!}
                {!! Form::select('category_1', $categories, $unique_item->category_1 ?? null, ['class' => 'form-control', 'placeholder' => 'Select a category']) !!}
            </div>
        </div>
        <div class="col-md">
            <div class="form-group">
                {!! Form::label('category_2', 'Second Category') !!}
                {!! Form::select('category_2', $categories, $unique_item->category_2 ?? null, ['class' => 'form-control', 'placeholder' => 'Select a category']) !!}
            </div>
        </div>
    </div>
    <hr>

    <p>If a player is adopting a geno, modify this to grant it to them! Otherwise please leave untouched</p>
    <p>Remember to give the geno to the player via DeviantArt too:
        <br>-> Ensure the geno is the correct one
        <br>-> Use Kuku-ri to give the geno
    </p>
    <div class="form-group">
        {!! Form::label('player', 'Owner') !!}
        {!! Form::select('owner_id', $user, $unique_item->owner_id ?? null, [
            'class' => 'form-control',
            'placeholder' => 'No Owner Selected',
        ]) !!}
    </div>


    <div class="text-right">
        {!! Form::submit($unique_item->id ? 'Edit' : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#generate-slug-btn").click(function() {
            // Get the item_id from the input field
            var itemId = $.trim($("input[name='item_id']").val());

            // Check if item_id is provided
            if (itemId === "") {
                alert("Please enter an Item ID first.");
                return;
            }

            // Generate the slug in the format "AC[item_id]"
            var itemSlug = "AC" + itemId;

            // Insert it into the slug input field
            $("#item-slug").val(itemSlug);

            // Confirmation for delete button
            $(document).on("submit", ".delete-item-form", function(event) {
                if (!confirm("Are you sure you want to delete this item? This action cannot be undone.")) {
                    event.preventDefault();
                }
            });
        });

    });
</script>
