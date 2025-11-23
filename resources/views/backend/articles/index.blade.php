<!-- resources/views/backend/articles/index.blade.php -->
@extends('backend.layout.app')
@section('mainSection')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="me-2 fs-3 text-primary"><i class="bx bx-show"></i></span>
                            <p class="mb-0 text-uppercase fw-medium text-muted">Active Articles</p>
                        </div>
                        <h4 class="mb-0 fs-22 fw-semibold">{{ $activeCount }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-animate h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="me-2 fs-3 text-primary"><i class="bx bx-pencil"></i></span>
                            <p class="mb-0 text-uppercase fw-medium text-muted">Inactive Articles</p>
                        </div>
                        <h4 class="mb-0 fs-22 fw-semibold">{{ $inactiveCount }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-animate h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="me-2 fs-3 text-primary"><i class="bx bx-file"></i></span>
                            <p class="mb-0 text-uppercase fw-medium text-muted">Total Articles</p>
                        </div>
                        <h4 class="mb-0 fs-22 fw-semibold">{{ $activeCount + $inactiveCount }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-animate h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        @can('articles.create')
                            <div class="d-flex align-items-center">
                                <span class="me-2 fs-3 text-primary"><i class="bx bx-plus"></i></span>
                                <p class="mb-0 text-uppercase fw-medium text-muted">Create New</p>
                            </div>
                            <a href="{{ route('articles.create') }}" class="btn btn-primary">Create</a>
                        @else
                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="me-2 fs-3 text-primary"><i class="bx bx-error"></i></span>
                                    <p class="mb-0 text-uppercase fw-medium text-muted">Create New</p>
                                </div>
                                <strong class="text-muted">Permission denied.</strong>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="col-12">
            <div class="rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0">Articles List</h6>
                    <form class="d-none d-md-flex ms-4">
                        {!! CreateText(
                            'search',
                            request('search', ''),
                            'Title',
                            [
                                'id' => 'searchInput',
                                'autofocus' => 'autofocus',
                                'placeholder' => 'Search',
                                'type' => 'search',
                            ],
                            '12',
                        ) !!}
                    </form>
                    <div class="col-auto" style="padding: 5px;">
                        <select class="form-select form-select-sm" id="rowsDropdown"
                            onchange="window.location.href=this.value">
                            <option value="{{ route('articles.index', array_merge(request()->query(), ['rows' => 10])) }}"
                                {{ request('rows', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="{{ route('articles.index', array_merge(request()->query(), ['rows' => 25])) }}"
                                {{ request('rows') == 25 ? 'selected' : '' }}>25</option>
                            <option value="{{ route('articles.index', array_merge(request()->query(), ['rows' => 50])) }}"
                                {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                            <option value="{{ route('articles.index', array_merge(request()->query(), ['rows' => 100])) }}"
                                {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                </div>

                <form id="update-order-form" action="{{ route('articles.updateOrder') }}" method="POST"
                    style="display: none;">
                    @csrf
                    <input type="hidden" name="order" value="">
                </form>

                <div class="table-responsive">
                    <table class="table table-borderless reorderable-table" id="articles-table"
                        data-url="{{ route('articles.updateOrder') }}"
                        data-permission="{{ auth()->user()->can('articles.updateOrder') ? 'true' : 'false' }}">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Alias</th>
                                <th scope="col">Cover</th>
                                <th scope="col">Status</th>
                                @canany(['articles.view', 'articles.edit', 'articles.delete'])
                                    <th scope="col">Action</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr data-id="{{ $item->articles_id }}" data-order="{{ $item->display_order }}">
                                    <th scope="row"
                                        class="{{ auth()->user()->can('articles.updateOrder') ? 'move-up-icon' : '' }}">
                                        {{ $loop->index + 1 }}</th>
                                    <td>{{ Str::limit($item->title, 50) }}</td>
                                    @can('articles.alias')
                                        <td>
                                            <span class="alias-text" data-id="{{ $item->articles_id }}"
                                                data-url-template="{{ route('articles.alias', ['id' => ':id']) }}"
                                                style="cursor: pointer;">
                                                {{ Str::limit($item->alias, 10) }}
                                            </span>
                                            <input type="text" class="alias-input d-none form-control"
                                                data-id="{{ $item->articles_id }}"
                                                data-url-template="{{ route('articles.alias', ['id' => ':id']) }}"
                                                value="{{ $item->alias }}" style="width: 150px;">
                                        </td>
                                    @else
                                        <td>
                                            {{ Str::limit($item->alias, 10) }}
                                        </td>
                                    @endcan
                                    <td>
                                        @if ($item->cover)
                                            @foreach (explode(',', $item->cover) as $coverImage)
                                                <img src="{{ asset(trim($coverImage)) }}"
                                                    alt="{{ Str::limit($item->title, 10) }}" class="hoverable-image"
                                                    style="width: 45px; height: 45px; object-fit: cover;">
                                            @endforeach
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    @can('articles.publish')
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input page-toggle" type="checkbox"
                                                    data-page-id="{{ $item->articles_id }}"
                                                    data-url-template="{{ route('articles.publish', ['id' => $item->articles_id, 'publish' => ':publish']) }}"
                                                    {{ $item->status == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    @endcan
                                    @canany(['articles.view', 'articles.edit', 'articles.publish', 'articles.delete'])
                                        <td class="icon-wrapper">
                                            <div class="toggle-icons" title="Options">
                                                <i style="font-size: 20px;" class="fa fa-ellipsis-h"></i>
                                            </div>
                                            <div class="popup-container">
                                                @can('articles.view')
                                                    <a href="{{ route('articles.view', ['id' => $item->articles_id]) }}"
                                                        class="text-icon" title="View">
                                                        <i style="font-size: 20px; padding-right: 10px;" class="fa fa-eye"></i>
                                                        View
                                                    </a>
                                                @endcan
                                                @can('articles.edit')
                                                    <a href="{{ route('articles.edit', ['id' => $item->articles_id]) }}"
                                                        class="text-icon" title="Edit">
                                                        <i style="font-size: 20px; padding-right: 10px;" class="fa fa-edit"></i>
                                                        Edit
                                                    </a>
                                                @endcan
                                                @can('articles.delete')
                                                    <a href="#" class="text-icon delete-btn" data-action="delete"
                                                        data-url="{{ route('articles.delete', ['id' => $item->articles_id]) }}"
                                                        title="Delete">
                                                        <i style="font-size: 20px; padding-right: 10px;" class="fa fa-trash"></i>
                                                        Delete
                                                    </a>
                                                @endcan
                                            </div>
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>



                <div id="pagination-container" class="mt-3">
                    {{ $items->withQueryString()->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Load the main js (your modified index.js) BEFORE the inline initializers below -->
    <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>

    <script>
        // Search & AJAX binding (keeps original behavior but uses functions defined in index.js)
        function bindSearchInput() {
            $(document).ready(function() {
                let typingTimer; // Timer for the typing delay
                const typingDelay = 300; // Delay in milliseconds
                let searchQueryCache = ""; // Cache the last search query to avoid unnecessary requests

                $('#searchInput').on('input', function() {
                    let searchQuery = $(this).val();
                    let rows = parseInt($('#rowsDropdown').val()) || 10;
                    clearTimeout(typingTimer);
                    updateTableLocally(searchQuery);
                    typingTimer = setTimeout(function() {
                        if (searchQuery !== searchQueryCache) {
                            searchQueryCache = searchQuery;
                            if (searchQueryCache === '') {
                                let urlParams = new URLSearchParams(window.location.search);
                                let currentPage = urlParams.get('page') || 1;
                                let rows = urlParams.get('rows') || 10;
                                const params = [];
                                if (currentPage !== 1) params.push(`page=${currentPage}`);
                                if (rows !== 10) params.push(`rows=${rows}`);
                                const query = params.length ? `?${params.join('&')}` : '';
                                window.location.href = `/admin/articles${query}`;
                            } else {
                                fetchTableData(searchQuery, rows);
                            }
                        }
                    }, typingDelay);
                });

                function fetchTableData(searchQuery, rows) {
                    $.ajax({
                        url: '{{ route('articles.index') }}',
                        method: 'GET',
                        data: {
                            search: searchQuery,
                            rows: rows,
                            page: 1
                        },
                        success: function(response) {
                            $('#articles-table tbody').html(response.item_html);
                            $('#pagination-container').html(response.pagination_html);
                            // rebind the dynamic behaviors after replacing HTML
                            bindPublishToggle();
                            initializeOrder(); // safe now
                            bindAliasEditing();
                            bindPopupToggle();
                            bindDragAndDropForTable('articles-table');
                            bindActionButtons && bindActionButtons();
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching data:", error);
                        }
                    });
                }

                function updateTableLocally(query) {
                    $('#articles-table tbody tr').each(function() {
                        const rowText = $(this).text().toLowerCase();
                        if (rowText.includes(query.toLowerCase())) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }

                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    let searchQuery = $('#searchInput').val();
                    let rows = parseInt($('#rowsDropdown').val()) || 10;
                    fetchTableData(searchQuery, rows, page);
                });
            });
        }

        // Initialize bindings when DOM ready
        document.addEventListener('DOMContentLoaded', function() {
            bindSearchInput();
            bindAliasEditing(); // uses token from index.js (if provided)
            initializeOrder();
            bindDragAndDropForTable('articles-table');
            // bindPopupToggle is safe to call - it will find elements if present
            bindPopupToggle();
            bindPublishToggle();
        });
    </script>
@endsection
