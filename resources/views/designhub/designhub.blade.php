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
        Design Principles
    </div>
    <div class="card-body">
        <p>These guides are for every reosean! They include the basic principles as well as other resources you can use to find all of the needed information!</p>
        <div class="d-flex flex-gap justify-content-between align-items-center">
            <a class="btn btn-primary" href="#" role="button">General Design Principles</a>
            <a class="btn btn-secondary" href="/design-hub/base-coats/" role="button">Base Coats</a>
            <a class="btn btn-secondary" href="#" role="button">Designing Your Import</a>
            <a class="btn btn-secondary" href="#" role="button">Backgrounds</a>
            <a class="btn btn-secondary" href="#" role="button">Design Approval Checklist</a>
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
                                        'name' => $marking->name . ' ('.$marking->recessive.'/'.$marking->dominant.')',
                                        'description' => $marking->short_description,
                                        'url'         => 'design-hub/marking/'.$marking->slug,
                                    ])
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="card rounded mb-4">
        <div class="card-header">
            Mutations & Non-Passable Modifiers
        </div>
        <div class="card-body">
            <input type="text" placeholder="Search mutations and modifiers..." class="searchBar bg-dark rounded border-0 mb-4 form-control" data-id="mutations" />
            <div class="card rounded mb-4">
                <div class="card-header">Corrupt Mutations</div>
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between searchContent" data-id="mutations">
                        @if ($corrupt_mutations)
                            {!! $corrupt_mutations->render() !!}
                            @foreach ($corrupt_mutations as $mutation)

                                        <?php 
                                            $text = $mutation->description;
                                            $short_description = '';

                                            if($text) {
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
                                    'imageUrl' => $mutation->imageUrl ?? '/images/account.png',
                                    'name' => $mutation->name,
                                    'description' => $short_description ?? '',
                                    'url'         => '/world/traits?name='.$mutation->name,
                                ])
                            @endforeach
                            {!! $corrupt_mutations->render() !!}
                        @endif
                    </div>
                </div>
            </div>
            <div class="card rounded mb-4">
                <div class="card-header">Magical Mutations</div>
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between searchContent" data-id="mutations">
                        @if ($magical_mutations)
                            {!! $magical_mutations->render() !!}
                            @foreach ($magical_mutations as $mutation)

                                <?php 
                                    $text = $mutation->description;
                                    $short_description = '';

                                    if($text) {
                                        $dom = new DOMDocument();
                                        libxml_use_internal_errors(true);
                                        $dom->loadHTML($text);
                                        libxml_clear_errors();
                                        $paragraphs = $dom->getElementsByTagName('p');
                                        if ($paragraphs->length > 0) {
                                            $short_description = $paragraphs->item(0)->textContent;
                                            
                                        }
                                    }
                                ?>

                                @include('designhub._entry', [
                                    'imageUrl' => $mutation->imageUrl ?? '/images/account.png',
                                    'name' => $mutation->name,
                                    'description' => $short_description ?? '',
                                    'url'         => '/world/traits?name='.$mutation->name,
                                ])
                            @endforeach
                            {!! $magical_mutations->render() !!}
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
            <div class="row">
                <div class="col">
                    <div class="card item">
                        <div class="card-body">
                            <h3>Vayron</h3>
                            <p>This is where we'd put the template files!</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card item">
                        <div class="card-body">
                            <h3>Tyrian</h3>
                            <p>This is where we'd put the template files!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded mb-4">
        <div class="card-header">
            Submitting Your Design
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="card item">
                        <div class="card-body">
                            <h3>Submit a New Design</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel dolor nisl. Quisque iaculis bibendum eros et imperdiet. Nulla feugiat, purus quis placerat vehicula, nisi tellus scelerisque ex, pretium euismod nisi
                                nibh et massa.</p>
                            <a class="btn btn-primary" href="#" role="button">Submit Your Design</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card item">
                        <div class="card-body">
                            <h3>Submit a Correction</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel dolor nisl. Quisque iaculis bibendum eros et imperdiet. Nulla feugiat, purus quis placerat vehicula, nisi tellus scelerisque ex, pretium euismod nisi
                                nibh et massa.</p>
                            <a class="btn btn-primary" href="#" role="button">Submit Your Design</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card item">
                        <div class="card-body">
                            <h3>Submit a Touch-Up or Do-Over</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel dolor nisl. Quisque iaculis bibendum eros et imperdiet. Nulla feugiat, purus quis placerat vehicula, nisi tellus scelerisque ex, pretium euismod nisi
                                nibh et massa.</p>
                            <a class="btn btn-primary" href="#" role="button">Submit Your Design</a>
                        </div>
                    </div>
                </div>
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
