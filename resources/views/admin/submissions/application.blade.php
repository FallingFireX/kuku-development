@extends('admin.layout')

@section('admin-title')
    {{ $applications->id ? 'Application' : 'Claim' }} (#{{ $applications->id }})
@endsection

@section('admin-content')
        {!! breadcrumbs(['Admin Panel' => 'admin', 'Prompt Queue' => 'admin/applications/pending', 'Submission (#' . $applications->id . ')' => $applications->viewUrl]) !!}
    

    @if ($applications->status == 'pending')

        <h1>
            {{ $applications->id ? 'Application' : 'Claim' }} (#{{ $applications->id }})
            <span class="float-right badge badge-{{ $applications->status == 'pending' || $applications->status == 'Draft' ? 'secondary' : ($applications->status == 'Approved' ? 'success' : 'danger') }}">
                {{ $applications->status }}
            </span>
        </h1>

        <div class="mb-1">
            <div class="row">
                <div class="col-md-2 col-4">
                    <h5>User</h5>
                </div>
                <div class="col-md-10 col-8">{!! $applications->user->displayName !!}</div>
            </div>
            
                <div class="row">
                    <div class="col-md-2 col-4">
                        <h5>Team:</h5>
                    </div>
                    <div class="col-md-10 col-8">{{ $teams->name }}</div>
                </div>
              
        <h2>Application</h2>
        <div class="card mb-3">
            <div class="card-body">{!! nl2br(htmlentities($applications->application)) !!}</div>
        </div>
        @if (Auth::check() && $applications->admin_message && ($applications->user_id == Auth::user()->id || Auth::user()->hasPower('edit_teams')))
            <h2>Admin Message ({!! $applications->staff->displayName !!})</h2>
            <div class="card mb-3">
                <div class="card-body">
                    @if (isset($applications->admin_message))
                        {!! $applications->admin_message !!}
                    @else
                        {!! $applications->admin_message !!}
                    @endif
                </div>
            </div>
        @endif

        <div class="form-group">
            {!! Form::label('admin_message', 'Staff Comments (Optional)') !!}
            {!! Form::textarea('admin_message', $applications->admin_message, ['class' => 'form-control wysiwyg']) !!}
        </div>

        <div class="text-right">
    {{-- Approve --}}
    {!! Form::open(['url' => route('admin.applications.post', $applications->id), 'method' => 'POST', 'class' => 'd-inline']) !!}
        @csrf
        <input type="hidden" name="status" value="accepted">
        <button type="submit" class="btn btn-success">Approve</button>
    {!! Form::close() !!}

    {{-- Reject --}}
    {!! Form::open(['url' => route('admin.applications.post', $applications->id), 'method' => 'POST', 'class' => 'd-inline']) !!}
        @csrf
        <input type="hidden" name="status" value="Rejected">
        <button type="submit" class="btn btn-danger">Reject</button>
    {!! Form::close() !!}
</div>

        
    @else
        <div class="alert alert-danger">This {{ $applications->id ? 'applications' : 'claim' }} has already been processed.</div>
        
    @endif

@endsection


@section('scripts')
    @parent
    @if ($applications->status == 'pending')
        @include('js._loot_js', ['showLootTables' => true, 'showRaffles' => true])
        @include('js._character_select_js')

        <script>
            $(document).ready(function() {
                var $confirmationModal = $('#confirmationModal');
                var $submissionForm = $('#submissionForm');

                var $approvalButton = $('#approvalButton');
                var $approvalContent = $('#approvalContent');
                var $approvalSubmit = $('#approvalSubmit');

                var $rejectionButton = $('#rejectionButton');
                var $rejectionContent = $('#rejectionContent');
                var $rejectionSubmit = $('#rejectionSubmit');

                var $cancelButton = $('#cancelButton');
                var $cancelContent = $('#cancelContent');
                var $cancelSubmit = $('#cancelSubmit');

                $approvalButton.on('click', function(e) {
                    e.preventDefault();
                    $approvalContent.removeClass('hide');
                    $rejectionContent.addClass('hide');
                    $cancelContent.addClass('hide');
                    $confirmationModal.modal('show');
                });

                $rejectionButton.on('click', function(e) {
                    e.preventDefault();
                    $rejectionContent.removeClass('hide');
                    $approvalContent.addClass('hide');
                    $cancelContent.addClass('hide');
                    $confirmationModal.modal('show');
                });

                $cancelButton.on('click', function(e) {
                    e.preventDefault();
                    $cancelContent.removeClass('hide');
                    $rejectionContent.addClass('hide');
                    $approvalContent.addClass('hide');
                    $confirmationModal.modal('show');
                });

                $approvalSubmit.on('click', function(e) {
                    e.preventDefault();
                    $submissionForm.attr('action', '{{ url()->current() }}/approve');
                    $submissionForm.submit();
                });

                $rejectionSubmit.on('click', function(e) {
                    e.preventDefault();
                    $submissionForm.attr('action', '{{ url()->current() }}/reject');
                    $submissionForm.submit();
                });

                $cancelSubmit.on('click', function(e) {
                    e.preventDefault();
                    $submissionForm.attr('action', '{{ url()->current() }}/cancel');
                    $submissionForm.submit();
                });
            });
        </script>
    @endif
@endsection
