@if ($items->isNotEmpty())
    @foreach ($items as $item)
        @php
            $parts = splitTitle($item->title, 3);
        @endphp
        <div class="skill-area py-120">
            <div class="container">
                <div class="skill-wrapper">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 col-12">
                            <div class="skill-left">
                                <div class="skill-img">
                                    <img src="{{ asset(explode(',', $item->thumb)[0]) }}" alt="thumb">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="skill-right">
                                <span class="site-title-tagline">{{ $item->subtitle }}</span>
                                <h2 class="site-title">{{ $parts[0] }} <span>{{ $parts[1] }}</span>
                                    {{ $parts[2] }}</h2>
                                {!! $item->description !!}
                                <br>
                                <div class="skills-section">
                                    @foreach (json_decode($item->entries) as $entry)
                                        <div class="progress-box">
                                            <h5>{{ $entry->title }} <span
                                                    class="pull-right">{{ $entry->subtitle }}%</span>
                                            </h5>
                                            <div class="progress" data-value="{{ $entry->subtitle }}">
                                                <div class="progress-bar" role="progressbar"></div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
