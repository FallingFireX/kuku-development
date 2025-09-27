@extends('layouts.app')


@section('title')
    Design Hub
@endsection


@section('content')
    {!! breadcrumbs(['Design Hub' => 'Design Hub']) !!}
    <h1>Design Hub</h1>

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
        <i>Kukuris have many different markings that express themselves in many different ways; rarely do two kukuri look the same.</i>
        <p>Our markings come with various rules and guidelines, please click each link below to see each page for marking guides and ranges!
            <br><br>
            Its important to note, that Aquatics have different rarities than other breeds on certain markings. Each marking lists the standard rarity, as well as the 
            aquatic rarity.
        </p>

        <div class="card-body">
    <input type="text" placeholder="Search markings by name or gene..." 
           class="searchBar bg-dark rounded border-0 mb-4 form-control" 
           data-id="markingSearch" />

        <div class="row">
            @foreach ($rarity_list as $rarity_item)
                <div class="col-md-4"> {{-- 3 equal columns --}}
                    <div class="card mb-4 h-100">
                        <div class="card-header" style="color:#{{ $rarity_item->color }}">
                           <h4 style="text-transform: unset;"> {{ $rarity_item->name }} </h4>
                        </div>
                        <div class="card-body" style="padding: 0.25rem;">
                            <div class="d-flex flex-wrap searchContent" data-id="markingSearch">
                                @foreach ($markings as $marking)
                                    @if ($marking->rarity_id === $rarity_item->id)
                                        @include('designhub._entry', [
                                            'imageUrl' => file_exists($marking->imageDirectory . '/' . $marking->imageFileName) 
                                                ? asset($marking->imageDirectory . '/' . $marking->imageFileName) 
                                                : '/images/account.png',
                                            'name' => $marking->name . ' (' . $marking->recessive . '/' . $marking->dominant . ')',
                                            'description' => $marking->short_description,
                                            'url' => 'design-hub/marking/' . $marking->slug,
                                        ])
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
  
</div>

    </div>

    <div class="card rounded mb-4">
        <div class="card-header">
            Trait Guides
        </div>
        <div class="card-body">
            <input type="text" placeholder="Search traits..." class="searchBar bg-dark rounded border-0 mb-4 form-control" data-id="traits" />
            <div class="card rounded mb-4">
                <div class="card-header">Trait Guides</div>
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
