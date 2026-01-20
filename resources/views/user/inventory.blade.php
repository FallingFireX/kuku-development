@extends('user.layout')

@section('profile-title')
    {{ $user->name }}'s Bank
@endsection

@section('profile-content')
    {!! breadcrumbs(['Users' => 'users', $user->name => $user->url, 'Inventory' => $user->url . '/inventory']) !!}

    <h1>
        Bank
    </h1>

    <div class="text-right mb-3">
        <div class="btn-group">
            <button type="button" class="btn btn-secondary active def-view-button" data-toggle="tooltip" title="Default View" alt="Default View"><i class="fas fa-th"></i></button>
            <button type="button" class="btn btn-secondary sum-view-button" data-toggle="tooltip" title="Summarized View" alt="Summarized View"><i class="fas fa-bars"></i></button>
        </div>
    </div>

    <div>
        <ul class="nav nav-tabs card-header-tabs">
            @foreach ($items as $categoryId => $categoryItems)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="categoryTab-{{ isset($categories[$categoryId]) ? $categoryId : 'misc' }}" data-toggle="tab" href="#category-{{ isset($categories[$categoryId]) ? $categoryId : 'misc' }}"
                        role="tab">
                        {!! isset($categories[$categoryId]) ? $categories[$categoryId]->name : 'Miscellaneous' !!}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body tab-content">
        @foreach ($items as $categoryId => $categoryItems)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="category-{{ isset($categories[$categoryId]) ? $categoryId : 'misc' }}">
                @foreach ($categoryItems->chunk(4) as $chunk)
                    <div class="row mb-3">
                        @foreach ($chunk as $itemId => $stack)
                            <div class="col-sm-3 col-6 text-center inventory-item" data-id="{{ $stack->first()->pivot->id }}" data-name="{{ $user->name }}'s {{ $stack->first()->name }}">
                                @if ($stack->first()->has_image)
                                    <div class="mb-1">
                                        <a href="#" class="inventory-stack">
                                            <img src="{{ $stack->first()->imageUrl }}" style="height: 125px;" alt="{{ $stack->first()->name }}" />
                                        </a>
                                    </div>
                                @endif
                                <div>
                                    <a href="#" class="inventory-stack inventory-stack-name">{{ $stack->first()->name }} x{{ $stack->sum('pivot.count') }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>


    <!-- <div id="defView" class="hide">
                                                        @foreach ($items as $categoryId => $categoryItems)
    <div class="card mb-3 inventory-category">
                                                                <h5 class="card-header inventory-header">
                                                                    {!! isset($categories[$categoryId]) ? '<a href="' . $categories[$categoryId]->searchUrl . '">' . $categories[$categoryId]->name . '</a>' : 'Miscellaneous' !!}
                                                                    <a class="small inventory-collapse-toggle collapse-toggle" href="#categoryId_{!! isset($categories[$categoryId]) ? $categories[$categoryId]->id : 'miscellaneous' !!}" data-toggle="collapse">
                                                                        Show
                                                                    </a>
                                                                </h5>
                                                                <div class="card-body inventory-body collapse show" id="categoryId_{!! isset($categories[$categoryId]) ? $categories[$categoryId]->id : 'miscellaneous' !!}">
                                                                    @foreach ($categoryItems->chunk(4) as $chunk)
    <div class="row mb-3">
                                                                            @foreach ($chunk as $itemId => $stack)
    <div class="col-sm-3 col-6 text-center inventory-item" data-id="{{ $stack->first()->pivot->id }}" data-name="{{ $user->name }}'s {{ $stack->first()->name }}">
                                                                                    @if ($stack->first()->has_image)
    <div class="mb-1">
                                                                                            <a href="#" class="inventory-stack">
                                                                                                <img src="{{ $stack->first()->imageUrl }}" alt="{{ $stack->first()->name }}" />
                                                                                            </a>
                                                                                        </div>
    @endif
                                                                                    <div>
                                                                                        <a href="#" class="inventory-stack inventory-stack-name">
                                                                                            {{ $stack->first()->name }} x{{ $stack->sum('pivot.count') }}
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
    @endforeach
                                                                        </div>
    @endforeach
                                                                </div>
                                                            </div>
    @endforeach
                                                    </div>

                                                    <div id="sumView" class="hide">
                                                        @foreach ($items as $categoryId => $categoryItems)
    <div class="card mb-2">
                                                                <h5 class="card-header">
                                                                    {!! isset($categories[$categoryId]) ? '<a href="' . $categories[$categoryId]->searchUrl . '">' . $categories[$categoryId]->name . '</a>' : 'Miscellaneous' !!}
                                                                    <a class="small inventory-collapse-toggle collapse-toggle" href="#categoryId_{!! isset($categories[$categoryId]) ? $categories[$categoryId]->id : 'miscellaneous' !!}" data-toggle="collapse">
                                                                        Show
                                                                    </a>
                                                                </h5>
                                                                <div class="card-body p-2 collapse show row" id="categoryId_{!! isset($categories[$categoryId]) ? $categories[$categoryId]->id : 'miscellaneous' !!}">
                                                                    @foreach ($categoryItems as $itemtype)
    <div class="col-lg-3 col-sm-4 col-12">
                                                                            @if ($itemtype->first()->has_image)
    <img src="{{ $itemtype->first()->imageUrl }}" style="height: 25px;" alt="{{ $itemtype->first()->name }}" />
    @endif
                                                                            <a href="{{ $itemtype->first()->idUrl }}">
                                                                                {{ $itemtype->first()->name }}
                                                                            </a>
                                                                            <ul class="mb-0" data-id="{{ $itemtype->first()->pivot->id }}" data-name="{{ $user->name }}'s {{ $itemtype->first()->name }}">
                                                                                @foreach ($itemtype as $item)
    <li>
                                                                                        <a class="inventory-stack" href="#">
                                                                                            Stack of x{{ $item->pivot->count }}
                                                                                        </a>.
                                                                                    </li>
    @endforeach
                                                                            </ul>
                                                                        </div>
    @endforeach
                                                                </div>
                                                            </div>
    @endforeach
                                                </div> -->
    <br><br>


    <h3>Adopted Genos</h3>

    @if ($uniqueItems->isNotEmpty())
        <div class="row">
            @foreach ($uniqueItems as $uniqueItem)
                <div class="card col-3 col-md-3 mb-3 mx-2"> <!-- Add mb-3 for margin-bottom spacing between cards -->
                    <div class="card-body text-center">
                        @if (!$uniqueItem->deleted)
                            <!-- Check if the item is not deleted -->
                            <b>{{ $uniqueItem->item_slug }}</b>
                            <br><a href="{{ $uniqueItem->link }}">Link to Proof</a>
                            <br>
                            <br>{!! $uniqueItem->description !!}
                        @endif

                        @if (Auth::check() && Auth::user()->hasPower('edit_inventories'))
                            <!-- Admin has the permission to delete unique items -->
                            <div class="unique-item">
                                <span>{{ $uniqueItem->name }}</span>
                                <!-- Button to open modal for deleting item -->
                                <button class="btn btn-secondary active def-view-button" data-toggle="modal" data-target="#deleteModal{{ $uniqueItem->id }}">Delete</button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal for each unique item -->
        @foreach ($uniqueItems as $uniqueItem)
            <div class="modal fade" id="deleteModal{{ $uniqueItem->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $uniqueItem->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $uniqueItem->id }}">Confirm Deletion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Deleting a geno marks it as used and removes it from the User's inventory. This is <b>not</b> reversible!
                            <br><br>
                            Are you sure you want to delete this Adoption geno: <strong>{{ $uniqueItem->item_slug }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('uniqueitems.destroy', $uniqueItem->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>You don't have any Adopted genos!</p>
    @endif




    <h3>Latest Activity</h3>
    <div class="mb-4 logs-table">
        <div class="logs-table-header">
            <div class="row">
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Sender</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Recipient</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Item</div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="logs-table-cell">Log</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Date</div>
                </div>
            </div>
        </div>
        <div class="logs-table-body">
            @foreach ($logs as $log)
                <div class="logs-table-row">
                    @include('user._item_log_row', ['log' => $log, 'owner' => $user])
                </div>
            @endforeach
        </div>
    </div>

    <div class="text-right">
        <a href="{{ url($user->url . '/item-logs') }}">View all...</a>
    </div>
@endsection

@section('scripts')
    @include('widgets._inventory_view_js')
    <script>
        $(document).ready(function() {
            $('.inventory-stack').on('click', function(e) {
                e.preventDefault();
                var $parent = $(this).parent().parent();
                loadModal("{{ url('items') }}/" + $parent.data('id'), $parent.data('name'));
            });
        });
    </script>
@endsection
