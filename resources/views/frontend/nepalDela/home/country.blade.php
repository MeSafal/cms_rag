<!--country-->
@if ($items->isNotEmpty())
    @php
        $parts = splitTitle($title, 2);
    @endphp
    <div class="country-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">{{ $subtitle }}</span>
                        <h2 class="site-title">{{ $parts[0] }} <span>{{ $parts[1] }}</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($items as $item)
                    @php
                        $link = dynamicRoute($item, '_self', 'View Detail');
                    @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="country-item">
                            <div class="country-img">
                                <img src="{{ asset(explode(',', $item->thumb)[0] ?? null) }}" alt>
                            </div>
                            <div class="country-flag">
                                <img src="{{ asset(explode(',', $item->thumb)[1] ?? null) }}" alt>
                            </div>
                            <div class="country-content">
                                <h4>
                                    <a href="{{ $link['url'] }}" target="{{ $link['target'] }}">
                                        {{ $item->title }}
                                    </a>
                                </h4>
                                {!! Str::words($item->description, 40, '..') !!}
                                <br>
                                <a href="{{ $link['url'] }}" target="{{ $link['target'] }}" class="country-read-btn">
                                    {{ $link['title'] }}
                                    <i class="far fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
