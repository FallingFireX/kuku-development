@extends('layouts.app')


@section('title')
    Design Hub
@endsection


@section('content')
    {!! breadcrumbs(['Design Hub' => 'Design Hub']) !!}
    <h1>Design Hub</h1>
    <p>Welcome to the World of Reos Design Hub! Here you can find all of the applicable guides to design your reosean.</p>

    <div class="card rounded mb-4">
        <div class="card-header">
            {!! $dh_start->title !!}
        </div>
        <div class="card-body">
            {!! $dh_start->text !!}
        </div>
    </div>

    <div class="card rounded mb-4">
        <div class="card-header">
            Markings
        </div>
        <div class="card-body">
            <input type="text" placeholder="Search markings by name or code..." class="searchBar bg-dark rounded border-0 mb-4 form-control" data-id="markingSearch" />

            @if ($rarity_list)
                @foreach ($rarity_list as $rarity_item)
                    <div class="card rounded mb-4">
                        <div class="card-header"><span class="rarity-indicator" style="background-color:#{{ $rarity_item->color }}"></span> {{ $rarity_item->name }} Markings</div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between searchContent" data-id="markingSearch">
                                @foreach ($markings as $marking)
                                    @if ($marking->rarity_id === $rarity_item->id)
                                        @include('designhub._entry', [
                                            'imageUrl' => file_exists($marking->imageDirectory . '/' . $marking->imageFileName) ? asset($marking->imageDirectory . '/' . $marking->imageFileName) : '/images/account.png',
                                            'name' => $marking->name . ' (' . $marking->recessive . '/' . $marking->dominant . ')',
                                            'description' => $marking->short_description,
                                            'url' => 'design-hub/marking/' . $marking->slug,
                                        ])
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="card rounded mb-4">
        <div class="card-header">
            Mutations & Non-Passable Modifiers
        </div>
        <div class="card-body">
            <input type="text" placeholder="Search traits..." class="searchBar bg-dark rounded border-0 mb-4 form-control" data-id="traits" />
            <div class="card rounded mb-4">
                <div class="card-header">Corrupt Mutations</div>
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between searchContent" data-id="traits">
                        @if ($trait_lists)
                            {!! $trait_lists->render() !!}
                            @foreach ($trait_lists as $trait)
                                <?php
                                $text = $trait->description;
                                $short_description = '';
                                
                                if ($text) {
                                    $dom = new DOMDocument();
                                    libxml_use_internal_errors(true);
                                    $dom->loadHTML($text);
                                    libxml_clear_errors();
                                
                                    $paragraphs = $dom->getElementsByTagName('p');
                                
                                    if ($paragraphs->length > 0) {
                                        $short_description = $paragraphs->item(0)->textContent; // Get the text content of the first <p> tag
                                    }
                                }
                                ?>

                                @include('designhub._entry', [
                                    'imageUrl' => $trait->imageUrl ?? '/images/account.png',
                                    'name' => $trait->name,
                                    'description' => $short_description ?? '',
                                    'url' => $trait->getUrlAttribute() ?: '/world/traits?name=' . $trait->name,
                                ])
                            @endforeach
                            {!! $trait_lists->render() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded mb-4">
        <div class="card-header">
            Import Templates
        </div>
        <div class="card-body">
            @foreach ($specieses as $species)
                <div class="card rounded mb-4">
                    <div class="card-header">{{ $species->name }} Templates</div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap flex-column justify-content-between">
                            @foreach ($subtypes as $subtype)
                                @if ($subtype->species_id === $species->id)
                                    <div class="card item flex-fill my-2">
                                        <div class="card-body">
                                            @if ($subtype->subtypeImageUrl)
                                                <a href="{{ $subtype->subtypeImageUrl }}" data-lightbox="entry" data-title="{{ $subtype->name }}">
                                                    <img src="{{ $subtype->subtypeImageUrl }}" class="world-entry-image" alt="{{ $subtype->name }}" />
                                                </a>
                                            @endif
                                            <h3>{{ $subtype->name }}</h3>
                                            <p>{!! $subtype->description !!}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="card rounded mb-4">
        <div class="card-header">
            {!! $dh_end->title !!}
        </div>
        <div class="card-body">
            {!! $dh_end->text !!}
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
