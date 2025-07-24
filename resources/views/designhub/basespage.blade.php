@extends('layouts.app')


@section('title')
    Bases
@endsection


@section('content')
    {!! breadcrumbs(['Design Hub' => 'design-hub', 'Bases' => 'Bases']) !!}
    <h1>Bases</h1>
    <a class="btn btn-primary" href="/design-hub/" role="button">Back to Design Hub</a>

    <div class="card rounded my-4">
        <div class="card-body">
            <input type="text" placeholder="Search base coats..." class="searchBar bg-dark rounded border-0 mb-4 form-control" data-id="baseSearch" />

            <div class="d-flex flex-wrap justify-content-between searchContent base-card-container" data-id="baseSearch">
                @if ($bases)
                    @foreach ($bases as $base)
                        <div class="card rounded mb-4 bg-dark">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ file_exists($base->imageDirectory . '/' . $base->imageFileName) ? asset($base->imageDirectory . '/' . $base->imageFileName) : '/images/account.png' }}" class="img-fluid mb-3" />
                                </div>
                                <h4 class="mb-0">{{ $base->name }} <span style="text-transform:none;" class="font-weight-normal">({{ $base->code }})</span></h4>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('.searchBar').on('keyup', function(e) {
                var sTerm = $(this).val().toLowerCase();
                var type = $(this).attr('data-id');
                console.log(type)
                console.log(sTerm);
                $('.searchContent[data-id="' + type + '"]').children().each(function() {
                    console.log($(this))
                    $(this).toggle($(this).text().toLowerCase().indexOf(sTerm) > -1);
                });
            });
        });
    </script>
@endsection
