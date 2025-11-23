@php
    $entries = json_decode($item->entries, true); // Use true to decode as an array
@endphp


<!DOCTYPE html>
<html lang="en">
    <head>
        @include('backend.layout.sidebar')
    </head>
<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('backend.layout.header')

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row bg-secondary rounded align-items-center justify-content-center mx-0">
                    <div class="modal-header p-0">
                        <img src="{{ asset($item->cover) }}" id="viewModalCover" alt="Cover Image"
                            style="width: 100%; height: 300px; object-fit: cover; border-bottom: 2px solid #ddd;" />
                    </div>
                    <div class="modal-body">
                        <!-- Title and Subtitle -->
                        <h4 class="text-center mt-3">{{ $item->title }} </h4>
                        <h6 class="text-center text-muted">( {{ $item->subtitle }} )</h6>

                        <!-- Thumbnails and Description -->
                        <div class="row mt-4">
                            <!-- Thumbnails Section -->
                            <div class="col-md-6">
                                <img src="{{ asset($item->thumb) }}" alt="Thumbnail"
                                    style="width: 50%; height: 300px; object-fit: cover; border: 1px solid #ddd; border-radius: 5px;" />
                            </div>
                            <!-- Description Section -->
                            <div class="col-md-6">
                                <div id="viewModalDescription" style="overflow-y: auto; max-height: 300px;">
                                    {!! $item->description !!}
                                </div>
                            </div>
                        </div>
                        @if (!empty($entries) && count($entries) > 0)
                        <div class="col-12">
                            <div class="bg-secondary rounded h-100 p-4">
                                <h6 class="mb-4">Extra Content</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Subtitle</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($entries as $entry)
                                                    <tr>
                                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                                        <td>{{ $entry['title'] }}</td>
                                                        <td>{{ $entry['subtitle'] }}</td>
                                                        <td>{{ $entry['description'] }}</td>
                                                        <td>
                                                            @if (!empty($entry['extraImg']))
                                                                @php
                                                                    // Split the 'extraImg' CSV string into an array
                                                                    $images = explode(',', $entry['extraImg']);
                                                                @endphp

                                                                @foreach ($images as $image)
                                                                    @if (!empty($image))
                                                                        <img src="{{ asset(trim($image)) }}"
                                                                            alt="{{ $entry['title'] }}"
                                                                            class="hoverable-image"
                                                                            style="width: 45px; height: 45px; object-fit: cover; margin-right: 5px;">
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Remarks -->
                        <div id="viewModalRemarks" class="mt-4">
                            <h5>Remarks</h5>
                            <p>{{$item->remarks}}</p>
                        </div>

                        <!-- User and Time Info -->
                        <div id="viewModalUserInfo" class="mt-4 text-muted">
                            <p><strong>Created By:</strong> <span id="viewModalCreatedBy" class="text-icon-welcome">{{ optional($item->createdBy)->name ?? 'N/A' }}</span>
                                <span id="viewModalCreatedAt" style="font-size: 16px;">({{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }})</span>
                            </p>
                            <p><strong>Updated By:</strong> <span id="viewModalUpdatedBy" class="text-icon-welcome">{{ optional($item->updatedBy)->name ?? 'N/A' }}</span>
                                <span id="viewModalUpdatedAt" style="font-size: 16px;">({{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }})</span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Blank End -->


            @include('backend.layout.footer')
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

</body>

</html>

<style>
    #viewModalDescription {
    overflow-y: auto;
    max-height: 300px;
    background-color: var(--bs-secondary); /* Uses Bootstrap's bg-secondary */
    padding: 10px; /* Optional: for better spacing */
}

/* Webkit Browsers (Chrome, Edge, Safari) */
#viewModalDescription::-webkit-scrollbar {
    width: 8px;
}

#viewModalDescription::-webkit-scrollbar-track {
    background: var(--bs-secondary); /* Matches bg-secondary */
}

#viewModalDescription::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3); /* Light contrast */
    border-radius: 5px;
}

#viewModalDescription::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}

</style>
