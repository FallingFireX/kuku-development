<h1 style="text-align:center">{{ config('lorekeeper.settings.site_name', 'Lorekeeper') }}</h1>
<br>
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                {!! $about->parsed_text !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
@include('widgets._news', ['textPreview' => true])
            </div>
        </div>
    </div>
<h1>{{ config('lorekeeper.settings.site_name', 'Lorekeeper') }}</h1>
{!! $about->parsed_text !!}

<br><br>
@include('widgets._affiliates', ['affiliates' => $affiliates, 'featured' => $featured_affiliates, 'open' => $open])
