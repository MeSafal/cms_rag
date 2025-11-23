@if ($items->isNotEmpty())
    @foreach ($items as $item)
        @php
            $words = explode(' ', $item->title);
            $count = count($words);

            $partSize = ceil($count / 4);

            $firstPart = implode(' ', array_slice($words, 0, $partSize));
            $middlePart = implode(' ', array_slice($words, $partSize, $partSize));
            $lastPart = implode(' ', array_slice($words, $partSize * 2));
        @endphp
        <div class="choose-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="choose-content">
                            <div class="site-heading">
                                <span class="site-title-tagline text-white">{{ $item->subtitle }}</span>
                                <h2 class="site-title text-white mb-10">
                                    {{ $firstPart }} <span>{{ $middlePart }}</span> {{ $lastPart }}
                                </h2>
                                {!! $item->description !!}

                            </div>
                            <div class="choose-content-wrapper">
                                @if ($item->entries)
                                    @foreach (json_decode($item->entries) as $entry)
                                        <div class="choose-item">
                                            <div class="choose-item-icon">
                                                <i class="{{ $entry->extraImg }}"></i>
                                            </div>
                                            <div class="choose-item-info">
                                                <h3>{{ $entry->title }}</h3>
                                                {!! $entry->description !!}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="choose-img"
                            style="background-image: url({{ asset(explode(',', $item->thumb)[0]) }});">
                            <div class="video-wrapper">
                                <a class="play-btn popup-youtube" href="https://www.youtube.com">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
