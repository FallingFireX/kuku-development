@extends('world.layout')

@section('world-title')
    Items
@endsection

@section('world-content')
    {!! breadcrumbs(['Adoption Center' => 'adoption-center']) !!}

    <h1>Adoption Center</h1>
    <p>This is the Adoption Center, all available kukuri (genos or Imports) are viewable here.</p>
    <p>To view kukuri of certain breeds or basecoat, use the dropdowns below to view specific adoption center residents.</p>
    <br>
    <p>Each automatically shows if they are Newbie/first time adoptions only, or if they are open to monthly adoptions</p>

    <!-- Filter Form -->
    <form method="GET" action="{{ url('adoption-center') }}">
        <div class="row" style="float:left";>
            <div class="col-5">
            <select name="category_1" class="form-control">
                <option value="">Select Filter</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_1') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                @endforeach
            </select>
            </div>
            <div class="col-5">
            <select name="category_2" class="form-control">
                <option value="">Select Filter</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_2') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                @endforeach
            </select>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
</div>
<br>
    <div class="mb-4 logs-table">
        <div class="logs-table-header">
            <div class="row">
                <div class="col-2 col-md-2">
                    <div class="logs-table-cell">Name</div>
                </div>
                <div class="col-3 col-md-3">
                    <div class="logs-table-cell">Link</div>
                </div>
                <div class="col-2 col-md-4">
                    <div class="logs-table-cell">Geno</div>
                </div>
            </div>
        </div>
        <div class="logs-table-body">
    @foreach ($items as $item)
        @if ($item->owner) <!-- Skip the item if it has an owner -->
            @continue
        @endif
        <div class="logs-table-row">
            <div class="row flex-wrap">
                <div class="col-2 col-md-2">
                    <div class="logs-table-cell">
                        @if ($item->is_over_a_year)
                            <b style="font-size: medium";><span class="badge badge-info">Monthly</span></b>
                        @else
                            <b style="font-size: medium";><span class="badge badge-success">Newbie</span></b>
                        @endif
                        {{ $item->item_slug }}  <!-- No <a> tag here -->
                    </div>
                </div>
                <div class="col-3 col-md-3">
                    <div class="logs-table-cell">
                        <a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a>  <!-- Only the link text should be clickable -->
                    </div>
                </div>
                <div class="col-5 col-md-5">
                    <div class="logs-table-cell">
                        {!! $item->description !!}  <!-- Only the description text should be clickable -->
                    </div>
                </div>
            </div>
        </div>
    @endforeach

<div class="pagination">
    {{ $items->links() }}
</div>



@endsection
