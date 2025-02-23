@extends('admin.layout')

@section('admin-title')
    Items
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Adoption Center' => 'admin/data/adoption-center']) !!}

    <h1>Adoption Center</h1>

    <div class="text-right mb-3">
        <a class="btn btn-primary" href="{{ url('admin/data/adoption-categories') }}"><i class="fas fa-folder"></i> Adoption Categories</a>
        <a class="btn btn-primary" href="{{ url('admin/data/adoption-center/create') }}"><i class="fas fa-plus"></i> Create New Adoption</a>
    </div>


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
                    <div class="col-2 col-md-2">
                        <div class="logs-table-cell">Owner</div>
                    </div>
                </div>
            </div>
            <div class="logs-table-body">
                @foreach ($items as $item)
                    <div class="logs-table-row">
                        <div class="row flex-wrap">
                            <div class="col-2 col-md-2">
                                <div class="logs-table-cell">
                                    {{ $item->item_slug }}
                                </div>
                            </div>
                            <div class="col-3 col-md-3">
                                <div class="logs-table-cell"><a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a></div>
                            </div>
                            <div class="col-2 col-md-4">
                                <div class="logs-table-cell">
                                    <a href="{{ $item->link }}" target="_blank">{!! $item->description !!}</a>
                                </div>
                            </div>

                            <div class="col-2 col-md-2">
                                <div class="logs-table-cell">
                                    <a href="{{ $item->link }}" target="_blank">
                                        {{ $item->owner ? $item->owner->name : 'No Owner' }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-3 col-md-1 text-right">
                                <div class="logs-table-cell">
                                    <a href="{{ url('admin/data/adoption-center/edit/' . $item->id) }}" class="btn btn-primary py-0 px-2">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="pagination">
    {{ $items->links() }}
</div>


@endsection
