<div class="card">
    <div class="card-header">
        <h4 class="mb-0"> News and Announcements </h4>
    </div>

    <div class="card-body pt-2">
        @if ($newses->count())
            @foreach ($newses as $news)
                <div class="card">
                    <div class="row">
                        <div class="col-md-5">
                            <span class="d-flex flex-column flex-sm-row align-items-sm-end pt-3 @if (!$textPreview) pb-3 @endif">
                                <h5 class="mb-0">{!! $news->displayName !!}</h5>

                            </span>
                            <span class=" small">{!! $news->post_at ? pretty_date($news->post_at) : pretty_date($news->created_at) !!}</span>
                        </div>
                        <div class="col-md-7">

                            @if ($textPreview)
                                <p class="pt-2">{!! substr(strip_tags(str_replace('<br />', '&nbsp;', $news->parsed_text)), 0, 300) !!}... </p>
                                <p><a href="{!! $news->url !!}">Read more <i class="fas fa-arrow-right"></i></a></p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center">
                <h5 class="text-muted">There is no news.</h5>
            </div>
        @endif
    </div>
</div>
