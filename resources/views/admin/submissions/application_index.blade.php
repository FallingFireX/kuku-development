@extends('admin.layout')

@section('admin-title')
    Applications Queue
@endsection

@section('admin-content')
        {!! breadcrumbs(['Admin Panel' => 'admin', 'Admin Applications' => 'admin/applications/pending']) !!}

    <h1>
        Applications Queue
    </h1>

    

    {!! Form::open(['method' => 'GET', 'class' => 'form-inline justify-content-end']) !!}
    <div class="form-inline justify-content-end">
      
    </div>
    <div class="form-inline justify-content-end">
        <div class="form-group ml-3 mb-3">
            {!! Form::select(
                'sort',
                [
                    'newest' => 'Newest First',
                    'oldest' => 'Oldest First',
                ],
                Request::get('sort') ?: 'oldest',
                ['class' => 'form-control'],
            ) !!}
        </div>
        <div class="form-group ml-3 mb-3">
            {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}

   
    <div class="mb-4 logs-table">
        <div class="logs-table-header">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="logs-table-cell">User</div>
                </div>
                <div class="col-4 col-md-3">
                    <div class="logs-table-cell">Team</div>
                </div>
            </div>
        </div>
        <div class="logs-table-body">
            @foreach ($applications as $application)
                <div class="logs-table-row">
                    <div class="row flex-wrap">
                        <div class="col-12 col-md-3 ">
                            <div class="logs-table-cell">{!! $application->user->displayName !!}</a></div>
                        </div>
                        <div class="col-12 col-md-3 ">
                            <div class="logs-table-cell">{{ $teams->name }}</a></div>
                        </div>
                        <div class="col-3 col-md-1">
                            <div class="logs-table-cell"><a href="{{ $application->adminUrl }}" class="btn btn-primary btn-sm py-0 px-1">Details</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    

 
@endsection
