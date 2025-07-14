@extends('layouts.app')


@section('title') Design Hub @endsection


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
            <a class="btn btn-secondary" href="#" role="button">Base Coats</a>
            <a class="btn btn-secondary" href="#" role="button">Designing Your Import</a>
            <a class="btn btn-secondary" href="#" role="button">Backgrounds</a>
            <a class="btn btn-secondary" href="#" role="button">Design Approval Checklist</a>
        </div>
    </div>
</div>

<div class="card rounded mb-4">
    <div class="card-header">
        Markings
    </div>
    <div class="card-body">
        <input type="text" placeholder="Search markings by name or code..." class="searchBar bg-dark rounded border-0 mb-4 form-control" data-id="markingSearch" />
        <div class="d-flex flex-wrap justify-content-between searchContent" data-id="markingSearch">
            @if ($markings)
                {!! $markings->render() !!}
                    @foreach ($markings as $marking)

                        @include('designhub._entry', [
                            'imageUrl' => '/images/data/traits/pwGUf24yDN5-image.png',
                            'name' => $marking->name . ' ('.$marking->recessive.'/'.$marking->dominant.')',
                            'description' => $marking->short_description,
                            'url'         => 'design-hub/marking/'.$marking->slug,
                        ])
                    @endforeach
                {!! $markings->render() !!}
            @endif
        </div>
    </div>
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

                                @include('designhub._entry', [
                                    'imageUrl' => $mutation->imageUrl ?? '/images/data/traits/XSqTnJ6wYW3-image.png',
                                    'name' => $mutation->name,
                                    'description' => 'add a short description field',
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

                                @include('designhub._entry', [
                                    'imageUrl' => $mutation->imageUrl ?? '/images/data/traits/XSqTnJ6wYW3-image.png',
                                    'name' => $mutation->name,
                                    'description' => 'add a short description field',
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel dolor nisl. Quisque iaculis bibendum eros et imperdiet. Nulla feugiat, purus quis placerat vehicula, nisi tellus scelerisque ex, pretium euismod nisi nibh et massa.</p>
                        <a class="btn btn-primary" href="#" role="button">Submit Your Design</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card item">
                    <div class="card-body">
                        <h3>Submit a Correction</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel dolor nisl. Quisque iaculis bibendum eros et imperdiet. Nulla feugiat, purus quis placerat vehicula, nisi tellus scelerisque ex, pretium euismod nisi nibh et massa.</p>
                        <a class="btn btn-primary" href="#" role="button">Submit Your Design</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card item">
                    <div class="card-body">
                        <h3>Submit a Touch-Up or Do-Over</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel dolor nisl. Quisque iaculis bibendum eros et imperdiet. Nulla feugiat, purus quis placerat vehicula, nisi tellus scelerisque ex, pretium euismod nisi nibh et massa.</p>
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