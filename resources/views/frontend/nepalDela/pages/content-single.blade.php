    @php
        $items = collect([$content])->merge($items);
    @endphp
    <main class="main">

        @foreach ($items as $item)
            <div class="site-breadcrumb" style="background: url({{ asset(explode(',', $item->cover)[0]) }})">
                <div class="container">
                    <h2 class="breadcrumb-title">{{ $item->title }}</h2>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                        <li class="active">{{ $item->title }}</li>
                    </ul>
                </div>
            </div>

            <div class="service-single-area py-120">
                <div class="container">
                    <div class="service-single-wrapper">
                        <div class="row">
                            @include(frontendpath() . '.pages.form')
                            <!-- Main Content -->
                            <div class="col-xl-8 col-lg-8">
                                <div class="service-details">
                                    <div class="service-details-img mb-30">
                                        <img src="{{ asset(explode(',', $item->thumb)[0]) }}"
                                            alt="{{ $item->subtitle }}">
                                    </div>
                                    <div class="service-details">
                                        <h3 class="mb-30">{{ $item->subtitle }}</h3>
                                        {!! $item->description !!}


                                        <!-- Benefits -->
                                        @if($item->entries)
                                        @foreach (json_decode($item->entries) as $entry)
                                            <div class="my-4">
                                                <h3 class="mb-3">{{ $entry->title }}</h3>
                                                {!! $entry->description !!}
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- End Main Content -->
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
