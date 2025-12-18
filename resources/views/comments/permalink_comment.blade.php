
@extends('layouts.app')

@section('title')
Comments
@endsection

@section('profile-title')
Comment
@endsection

@section('content')
    @php
        use App\Models\User\User;
        use App\Models\Submission\Submission;
        use App\Models\Sales\Sales;
        use App\Models\News;
        use App\Models\DevLogs;
        use App\Models\Report\Report;
        use App\Models\SitePage;
        use App\Models\Trade\TradeListing;
        use App\Models\Gallery\GallerySubmission;
        use App\Models\Submission\AdminApplication;
        use Illuminate\Support\Facades\Settings;

        $commentable = $comment->commentable;
        $type = $comment->type;

        $link = null;
        $label = null;
        $profile = null;

        switch ($comment->commentable_type) {

            case 'App\Models\User\UserProfile':
                $label = 'Profile';
                $link = $comment->commentable->user->displayName;
                $profile = true;
                break;

            case 'App\Models\Submission\Submission':
                $label = 'Claim';
                $link = url('claims/view' . '/' . $commentable->id);
                $profile = false;
                break;
                
            case 'App\Models\Prompt\Prompt':
                $label = 'Prompt';
                $link = url('claims/view' . $commentable->id) - '/comment-' . $comment->id;    
                $profile = false;
                break;

            case 'App\Models\Sales\Sales':
                $label = 'Sales Post';
                $link = $commentable->url . '/#comment-' . $comment->getKey();
                $profile = false;
                break;

            case 'App\Models\News':
                $label = 'News Post';
                $link = $commentable->url . '/#comment-' . $comment->getKey();
                $profile = false;
                break;

            case 'App\Models\DevLogs':
                $label = 'Dev Log';
                $link = $commentable->url . '/#comment-' . $comment->getKey();
                $profile = false;
                break;

            case 'App\Models\Report\Report':
                $label = 'Report';
                $link = url('reports/view/' . $commentable->id) . '/#comment-' . $comment->getKey();
                $profile = false;
                break;

            case 'App\Models\SitePage':
                $label = 'Site Page';
                $link = $commentable->url . '/#comment-' . $comment->getKey();
                $profile = false;
                break;

            case 'App\Models\Trade\TradeListing':
                $label = 'Trade Listing';
                $link = $commentable->url . '/#comment-' . $comment->getKey();
                $profile = false;
                break;

            case 'App\Models\Gallery\GallerySubmission':
                $label = 'Gallery Submission';
                $link = (
                    $type !== 'User-User'
                        ? $commentable->queueUrl
                        : $commentable->url
                ) . '/#comment-' . $comment->getKey();
                $profile = false;
                break;

            case 'App\Models\Submission\AdminApplication':
                $label = 'Application';
                $link = $commentable->url . '/applications/' . $commentable->id;
                $profile = false;
                break;

            default:
                $label = 'Unknown source';
                $link = null;
                $profile = false;
                break;
        }
    @endphp


    <h1> Comments on: 
        @if ($profile)
            {!! $link !!}
        @else
            @if ($link)
                <a href="{{ $link }}">{{$label}}</a>
            @else
                <span class="text-muted">Unknown source</span>
            @endif
        @endif
    </h1>
    <h5>
        @if (count($comment->children))
            <a href="{{ url('comment/') . '/' . $comment->endOfThread->id }}" class="btn btn-secondary btn-sm mr-2">Go To End Of Thread</a>
        @endif
        @if (isset($comment->child_id))
            <a href="{{ url('comment/') . '/' . $comment->child_id }}" class="btn btn-secondary btn-sm mr-2">See Parent</a>
            <a href="{{ url('comment/') . '/' . $comment->topComment->id }}" class="btn btn-secondary btn-sm mr-2">Go To Top Comment</a>
        @endif
    </h5>

    <hr class="mb-3">
    <div class="d-flex mw-100 row mx-0" style="overflow:hidden;">
        @include('comments._perma_comments', ['comment' => $comment, 'limit' => 0, 'depth' => 0])
    </div>
@endsection
@section('scripts')
    @include('js._tinymce_wysiwyg', ['tinymceSelector' => '.comment-wysiwyg', 'tinymceHeight' => '300'])
@endsection
